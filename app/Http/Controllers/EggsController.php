<?php

namespace App\Http\Controllers;

use App\Repositories\EggsRepository;
use App\Repositories\PenHouseRepository;
use App\Repositories\StockTrackingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EggsController extends Controller
{

    protected $eggrepository;
    protected $stockTrackingRepository;
    protected $penHouseRepository;

    public function __construct(EggsRepository $eggrepository,
        StockTrackingRepository $stockTrackingRepository, PenHouseRepository $penHouseRepository) {
        $this->eggrepository = $eggrepository;
        $this->stockTrackingRepository = $stockTrackingRepository;
        $this->penHouseRepository = $penHouseRepository;
    }

    // public function onboarding()
    // {
    //     $user = Auth::user();
    //     $farm_account = $this->user_repository->getUserFarmAccount($user);
    //     $pen_house = $this->pen_house_repository->get_pen_house($user);
    //     $pen_house_stocking = $this->pen_house_stock_repository->get_pen_house_stocking($user);
    //     return view('users.onboarding', ['farmaccount' => $farm_account,
    //         'pen_house' => $pen_house,
    //         'stocking' => $pen_house_stocking]);
    // }

    public function create_farm_account(Request $request)
    {
        $farm_account = Auth::user()->farm_account;
        if ($farm_account) {
            $farm_account->farm_name = $request->farm_name;
        } else {

        }
    }

    public function eggs()
    {
        $farm_id = Auth::user()->farm_id;
        //getSumOfEggsWeekly

        $getAllEggsForFarmgood = $this->eggrepository->getAllEggsForFarmgood($farm_id);
        $goodeggs = $this->eggrepository->getTotalGoodEggsRemaining();
        $brokeneggs = $this->eggrepository->getTotalBrokenEggsRemaining();
        $getSumOfEggs = $this->eggrepository->getSumOfEggs();
        $response = ['getSumOfEggs' => $getSumOfEggs, 'goodeggs' => $goodeggs, 'getAllEggsForFarmgood' => $getAllEggsForFarmgood, 'brokeneggs' => $brokeneggs];

        return view('users.eggscollection', $response);
    }

    public function collecteggslist()
    {
        $farm_id = Auth::user()->farm_id;
        $penHouseStocking = $this->eggrepository->getAllEggsForFarm($farm_id);
        $batches = $this->stockTrackingRepository->getStockTrackingByFarmId($farm_id);
        $penhouses = $this->penHouseRepository->getAllPenHouseForFarm($farm_id);
        $response = ['penHouseStocking' => $penHouseStocking, 'batches' => $batches, 'penhouses' => $penhouses];
        return view('users.collecteggslist', $response);
    }

    public function collectEggs(Request $request)
    {
        $user = $request->user();

        $collection_with_no_remaing = ['batch_id' => $request->batch_id, 'pen_house_id' => $request->pen_house_id,
        'type_of_egg' => $request->type_of_egg, 'tray_quantity' => $request->tray_quantity,
        'farm_id' => $user->farm_id, 'pen_house_identity' => $request->batch_id . "/" . $request->pen_house_id,
        'created_by' => $user->id, 'date_recorded' => $request->date_recorded,'size' => 'NONE'];


        $collection_with_remaing = ['batch_id' => $request->batch_id, 'pen_house_id' => $request->pen_house_id,
        'type_of_egg' => $request->type_of_egg, 'tray_quantity' => $request->tray_quantity,
        'farm_id' => $user->farm_id, 'pen_house_identity' => $request->batch_id . "/" . $request->pen_house_id,
        'created_by' => $user->id, 'date_recorded' => $request->date_recorded,'eggs_remaining'=> $request->eggs_remaining,'size' => 'NONE'];
        
     if(!empty($request->eggs_remaining)){
        $saveid = $this->eggrepository->createEggCollection($collection_with_remaing);
        if($saveid){
            Session::flash('message', 'Your eggs collection with remaining collected have been saved successfully!');
            Session::flash('alert-class', 'alert-success');
            return redirect(route('account.collectlist'));  
        }else{
            Session::flash('message', 'Failed in saving!');
            Session::flash('alert-class', 'alert-danger');
            return redirect(route('account.collectlist'));  
        }
     }else{
        $saveid = $this->eggrepository->createEggCollection($collection_with_no_remaing);
       
        if($saveid){
            Session::flash('message', 'Your eggs collection have been saved successfully!');
            Session::flash('alert-class', 'alert-success');
            return redirect(route('account.collectlist'));  
        }else{
            Session::flash('message', 'Failed in saving!');
            Session::flash('alert-class', 'alert-danger');
            return redirect(route('account.collectlist'));  
        }
     }


       
        // $eggsremaining = $request->eggsremaining;
        // $eggCollection = $request->except(['_token']);
        // $eggCollection['farm_id'] = $user->farm_id;
        // $eggCollection['created_by'] = $user->id;
        // $eggCollection['pen_house_identity'] = $request->pen_house_id;
        // $eggCollection['size'] = "NONE";
        // $saveid = $this->eggrepository->createEggCollection($eggCollection);

        // if ($saveid) {
        //     Session::flash('message', 'Your eggs have been saved successfully!');
        //     Session::flash('alert-class', 'alert-success');
        //     return redirect(route('account.collectlist'));
        // } else {
        //     Session::flash('message', 'Failed in saving!');
        //     Session::flash('alert-class', 'alert-danger');
        //     return redirect(route('account.collectlist'));
        // }

    }

    public function collectUpdatedEggs(Request $request){
        $saveid = $this->eggrepository->editAllCollection($request->formposttype,
    $request->id,$request->batch_id,$request->pen_house_id,$request->type_of_egg,
    $request->tray_quantity,$request->date_recorded,$request->eggs_remaining
    );
if($saveid){
    Session::flash('message', 'Your eggs collection have been edited successfully!');
    Session::flash('alert-class', 'alert-success');
    return redirect(route('account.collectlist'));  
}else{
    Session::flash('message', 'Your eggs collection failed to edit!');
    Session::flash('alert-class', 'alert-success');
    return redirect(route('account.collectlist'));  
}


    }


    public function deleteCollection(Request $request, $id)
    {
        $user = $request->user();
       $deleted = $this->eggrepository->deleteCollection($id, $user->farm_id);
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


    public function printMonthlyCollection(Request $request)
    {
        $user = $request->user();
       $resultformonth = $this->eggrepository->printMonthlyCollection($user->farm_id);
        
       return response()->json($resultformonth);
       // return json_encode($data);
    }
    
    
    public function eggMetrics()
    {
       $eggsmonthlysum = $this->eggrepository->getSumOfEggs();
      $response = ['eggsmonthlysum' => $eggsmonthlysum];
     return view('users.dashboard', $response);
    } 

}
