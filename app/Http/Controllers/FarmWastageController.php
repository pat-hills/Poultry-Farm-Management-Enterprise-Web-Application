<?php

namespace App\Http\Controllers;

use App\Repositories\FarmWastageRecordingRepository;
use App\Repositories\PenHouseRepository;
use App\Repositories\StockTrackingRepository;
use App\Repositories\FarmItemRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FarmWastageController extends Controller
{
    //getFarmFeed
    protected $farmWastageRecordingRepository;
    protected $penHouseRepository;
    protected $stockTrackingRepository;
    protected $farmitemrepository;

    public function __construct(FarmWastageRecordingRepository $farmWastageRecordingRepository, PenHouseRepository $penHouseRepository,
        StockTrackingRepository $stockTrackingRepository,
        FarmItemRepository $farmitemrepository
        
        ) {
        $this->farmWastageRecordingRepository = $farmWastageRecordingRepository;
        $this->penHouseRepository = $penHouseRepository;
        $this->stockTrackingRepository = $stockTrackingRepository;
        $this->farmitemrepository = $farmitemrepository;
    }

    public function createWasteRecording(Request $request)
    {
        if ($request->isMethod('get')) {
            $response = $this->wasteRecordingView();
            return view('users.wasterecording', $response);
        } else if ($request->isMethod('post')) {
            $this->saveFarmWasteRecording($request);
            Session::flash('message', 'Farm record created successfully');
            Session::flash('alert-class', 'alert-success');
            return redirect(route('birds.feedwastage'));
        }
    }

    public function updateWasteRecording(Request $request, $id)
    {
        if ($request->isMethod('put')) {
            $wasteRecord = $request->except(['_token', '_method']);
            
            $this->farmWastageRecordingRepository->updateWasteRecording($id, $request->user(), $wasteRecord);
        }
        Session::flash('message', 'farm record updated successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect(route('birds.feedwastage'));
    }

    public function deleteWasteRecording(Request $request, $id)
    {
        if ($request->isMethod('delete')) {
            $wasteRecord = $request->except('_token');
            $deleted = $this->farmWastageRecordingRepository->deleteWasteRecording($id, $request->user());
            if ($deleted) {
                $data = [
                    'status' => '1',
                    'msg' => 'Success',
                ];
            } else {
                $data = [
                    'status' => '0',
                    'msg' => 'fail, constraint',
                ];
            }
        }

        return json_encode($data);
    }

    public function wasteRecordingView()
    {
        $farm_id = Auth::user()->farm_id;
        $penHouse = $this->penHouseRepository->getAllPenHouseForFarm($farm_id);
        $batch = $this->stockTrackingRepository->getStockTrackingByFarmId($farm_id);
        $penHouses = $this->penHouseRepository->getAllPenHouseForFarm($farm_id);
        $wastes = $this->farmWastageRecordingRepository->getAllWasteRecord($farm_id);
        $getFarmFeed = $this->farmitemrepository->getFarmFeed($farm_id);
        $response = ['getFarmFeed' => $getFarmFeed,'penHouses' => $penHouse, 'wastes' => $wastes, 'batches' => $batch];
        return $response;
    }

    public function saveFarmWasteRecording($request)
    {
        $user = Auth::user();
        $wasteRecord = $request->except('_token');
        $wasteRecord['created_by'] = $user->id;
        $wasteRecord['farm_id'] = $user->farm_id;
        $this->farmWastageRecordingRepository->createWasteRecord($wasteRecord);
    }
}
