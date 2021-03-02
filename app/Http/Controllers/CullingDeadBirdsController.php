<?php

namespace App\Http\Controllers;

use App\Repositories\CullingDeadBirdRepository;
use App\Repositories\PenHouseRepository;
use App\Repositories\StockTrackingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CullingDeadBirdsController extends Controller
{
    //

    protected $cullingDeadBirdRepository;
    protected $penHouseRepository;
    protected $stockTrackingRepository;

    public function __construct(CullingDeadBirdRepository $cullingDeadBirdRepository, PenHouseRepository $penHouseRepository, StockTrackingRepository $stockTrackingRepository)
    {
        $this->cullingDeadBirdRepository = $cullingDeadBirdRepository;
        $this->penHouseRepository = $penHouseRepository;
        $this->stockTrackingRepository = $stockTrackingRepository;
    }

    public function deadBirdsView()
    {
        $farm_id = Auth::user()->farm_id;
        $penHouse = $this->penHouseRepository->getAllPenHouseForFarm($farm_id);
        $batch = $this->stockTrackingRepository->getStockTrackingByFarmId($farm_id);
        $deadBirds = $this->cullingDeadBirdRepository->getAllCullingDeadBirds($farm_id);
        return view('users.mortality', ['deadBirds' => $deadBirds, 'penHouse' => $penHouse, 'batches' => $batch]);

    }

    public function deadBirdsCreate(Request $request)
    {
        $user = Auth::user();
        $reason = $request->reason;
        if (!$reason) {
            $reason = "None";
        }
        $deadBirds = ['farm_id' => $user->farm_id, 'batch_id' => $request->batchId, 'number_of_birds' => $request->numberOfBirds,
            'reason' => $reason, 'pen_house_id' => $request->penHouse, 'created_by' => $user->id,
            'date_stocked' => $request->daterecorded];

        $this->cullingDeadBirdRepository->createCullingDeadBird($deadBirds);
        return redirect(route('birds.mortality'));
    }

    public function deadBirdsUpdate(Request $request, $id)
    {
        
        $deadBirds = $request->except(['_token', '_method']);
         $this->cullingDeadBirdRepository->createCullingDeadBird($id, $request->user(), $deadBirds);
        return redirect(route('birds.mortality'));
    }

    public function editCullingDeadBirds(Request $request)
    {
        
        
        $deadBirds =   $this->cullingDeadBirdRepository->editCullingDeadBirds(
          $request->idrecord,  $request->batchId ,$request->penHouse ,
          $request->numberOfBirds ,$request->reason ,$request->daterecorded
    );

    if($deadBirds){
        Session::flash('message', 'Your records have been edited successfully!');
        Session::flash('alert-class', 'alert-success');
        return redirect(route('birds.mortality'));
    }else{
        Session::flash('message', 'Your records failed to edit!');
        Session::flash('alert-class', 'alert-danger');
        return redirect(route('birds.mortality'));
    }

       
       
    }

    //editCullingDeadBirds

    public function deadBirdsDelete(Request $request, $id)
    {
       // $user = Auth::user();
        $deleted = $this->cullingDeadBirdRepository->deleteCullingDeadBird($request->user(),$id);
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
