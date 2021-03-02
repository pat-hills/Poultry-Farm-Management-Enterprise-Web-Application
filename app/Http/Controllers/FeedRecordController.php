<?php

namespace App\Http\Controllers;

use App\Repositories\FarmFeedRecordingRepository;
use App\Repositories\PenHouseRepository;
use App\Repositories\FarmItemRepository;
use App\Repositories\StockTrackingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FeedRecordController extends Controller
{
    protected $farmFeedRecordingRepository;
    protected $penHouseRepository;
    protected $stockTrackingRepository;
    protected $farmitemRepository;
//getFarmFeed
    public function __construct(FarmFeedRecordingRepository $farmFeedRecordingRepository, PenHouseRepository $penHouseRepository,
        StockTrackingRepository $stockTrackingRepository,
        FarmItemRepository $farmitemRepository
        
        ) {
        $this->farmFeedRecordingRepository = $farmFeedRecordingRepository;
        $this->penHouseRepository = $penHouseRepository;
        $this->stockTrackingRepository = $stockTrackingRepository;
        $this->farmitemRepository = $farmitemRepository;
    }

    public function createFeedRecording(Request $request)
    {
        if ($request->isMethod('get')) {
            $this->feedRecordingView();
        } else if ($request->isMethod('post')) {
            $this->farmFeedRecording($request);
            Session::flash('message', 'Farm record created successfully');
            Session::flash('alert-class', 'alert-success');
            return redirect(route('birds.feedgiven'));
        }
    }
    public function farmFeedRecording($request)
    {
        $user = Auth::user();
        $feedRecord = $request->except('_token');
        $feedRecord['created_by'] = $user->id;
        $feedRecord['farm_id'] = $user->farm_id;
        $this->farmFeedRecordingRepository->createRecordFeed($feedRecord);
    }
    public function feedRecordingView()
    {
        $farm_id = Auth::user()->farm_id;
        $penHouse = $this->penHouseRepository->getAllPenHouseForFarm($farm_id);
        $batch = $this->stockTrackingRepository->getStockTrackingByFarmId($farm_id);
        $penHouses = $this->penHouseRepository->getAllPenHouseForFarm($farm_id);
        $feedGiven = $this->farmFeedRecordingRepository->getAllFeedGiven($farm_id);
        $getFarmFeed = $this->farmitemRepository->getFarmFeed($farm_id);
        return view('users.feedrecording', ['getFarmFeed'=>$getFarmFeed,  'penHouses' => $penHouse, 'feedGiven' => $feedGiven, 'batches' => $batch]);
    }

    public function updateFeedRecording(Request $request, $id)
    {
        if ($request->isMethod('put')) {
            $feedRecord = $request->except(['_token', '_method']);
            $this->farmFeedRecordingRepository->updateRecordFeed($id, $request->user(), $feedRecord);
        }
        Session::flash('message', 'farm record updated successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect(route('birds.feedgiven'));
    }

    public function deleteFeedRecording(Request $request, $id)
    {
        if ($request->isMethod('delete')) {
            $feedRecord = $request->except('_token');
            $deleted = $this->farmFeedRecordingRepository->deleteRecordFeed($id, $request->user());
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

}
