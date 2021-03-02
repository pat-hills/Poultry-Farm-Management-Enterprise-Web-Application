<?php

namespace App\Http\Controllers;

use App\Repositories\FarmDrugRecordingRepository;
use App\Repositories\FarmItemRepository;
use App\Repositories\PenHouseRepository;
use App\Repositories\StockTrackingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

//getFarmDrugs
class FarmDrugRecordingController extends Controller
{
    //
    protected $farmDrugRecordingRepository;
    protected $penHouseRepository;
    protected $stockTrackingReposiotry;
    protected $farmitemReposiotry;

    public function __construct(FarmDrugRecordingRepository $farmDrugRecordingRepository, PenHouseRepository $penHouseRepository, StockTrackingRepository $stockTrackingReposiotry,
    FarmItemRepository $farmitemReposiotry
    )
    {
        $this->farmDrugRecordingRepository = $farmDrugRecordingRepository;
        $this->penHouseRepository = $penHouseRepository;
        $this->stockTrackingReposiotry = $stockTrackingReposiotry;
        $this->farmitemReposiotry = $farmitemReposiotry;
    }

    public function createDrugRecording(Request $request)
    {
        if ($request->isMethod('get')) {
            $response = $this->drugRecordingView($request);
            return view('users.drugrecording', $response);
        } else if ($request->isMethod('post')) {
            $this->saveFarmDrugRecording($request);
            return redirect(route('birds.druggiven'));
        }
    }

    public function drugRecordingView($request)
    {
        $farm_id = $request->user()->farm_id;
        $penHouse = $this->penHouseRepository->getAllPenHouseForFarm($farm_id);
        $batch = $this->stockTrackingReposiotry->getStockTrackingByFarmId($farm_id);
        $drugGiven = $this->farmDrugRecordingRepository->getAllDrugsGiven($farm_id);
        $getFarmDrugs = $this->farmitemReposiotry->getFarmDrugs($farm_id);
        $response = ['penHouse' => $penHouse, 'drugGiven' => $drugGiven,'batches' => $batch,'getFarmDrugs'=>$getFarmDrugs];
        return $response;
    }

    public function saveFarmDrugRecording(Request $request)
    {
        $user = $request->user();
        $drugRecord = $request->except('_token');
        $drugRecord['farm_id'] = $user->farm_id;
        $drugRecord['created_by'] = $user->id;
        $this->farmDrugRecordingRepository->createFarmDrugRecord($drugRecord);
    }

    public function updateFarmDrugRecording(Request $request, $id)
    {
        $user = $request->user();
        $drugRecord = $request->except(['_token', '_method']);
        $this->farmDrugRecordingRepository->updateFarmDrugsRecording($user->farm_id, $id, $drugRecord);
        Session::flash('message', 'Drug record updated successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect(route('birds.druggiven'));
    }

    public function deleteFarmDrugRecording(Request $request, $id)
    {
        $user = $request->user();
        $deleted = $this->farmDrugRecordingRepository->deleteFarmDrugsRecording($user->farm_id, $id);
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
        return json_encode($data);
    }

}
