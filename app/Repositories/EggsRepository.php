<?php

namespace App\Repositories;

//SalesDetail
use App\Models\EggsRemainingTrack;
use App\Models\FarmEgg;
use App\Models\SalesDetail;
use App\Models\PenHouseStocking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\FarmItem;

use Carbon\Carbon;

class EggsRepository
{
    
    private $pen_house_stocking;

    

    public function __construct(FarmEgg $pen_house_stocking)
    {
        $this->pen_house_stocking = $pen_house_stocking;
    }

    public function getAllEggsForFarm($farmId)
    {
//Posts::orderBy('created_at', 'desc')->get();

        $allfarmstocking = FarmEgg::orderBy('date_recorded', 'asc')->where('farm_id', $farmId)->get();

        if (!count($allfarmstocking)) {
            return "";
        } else {
            return $allfarmstocking;
        }
    }

    // public function getAllEggsForFarmbreak($farmId)
    // {
    //     $allfarmstocking = FarmEgg::where('farm_id', $farmId)->get();
    //     if (!count($allfarmstocking)) {
    //         return "";
    //     } else {
    //         return $allfarmstocking;
    //     }
    // }

    // public function getAllEggsForFarmgood($farmId)
    // {
    //     $qty = "Good";
    //     $goodlist = (['farm_id' => $farmId, 'type_of_egg' => $qty]);
    //     // $penhoueMatch = ['farm_id' => $farmId, 'stocked' => 'NO'];

    //     $allfarmstocking = FarmEgg::where($goodlist)->get();
    //     if (!count($allfarmstocking)) {
    //         return "";
    //     } else {
    //         return $allfarmstocking;
    //     }
    // }

    public function getSumOfEggs()
    {
        $farm_id = Auth::User()->farm_id;
        $tray_quantity = FarmEgg::where('farm_id', $farm_id)->sum('tray_quantity');
        if ($tray_quantity) {
            return $tray_quantity;
            // return $goodremaining->good_eggs;
        }
    }


    public function getSumOfEggsMonthly()
    {
        $farm_id = Auth::User()->farm_id;
        //$articles=Article::where("created_at",">", Carbon::now()->subMonths(6))->get();
        $tray_quantity = FarmEgg::where('farm_id', $farm_id)
        ->whereYear('created_at', Carbon::now()->year)
                        ->whereMonth('created_at', Carbon::now()->month)
              ->sum('tray_quantity');
if ($tray_quantity) {
            return $tray_quantity;
            // return $goodremaining->good_eggs;
        }
    }


    public function getSumOfEggsToday()
    {
        $farm_id = Auth::User()->farm_id;
        //$articles=Article::where("created_at",">", Carbon::now()->subMonths(6))->get();
        $tray_quantity = FarmEgg::where('farm_id', $farm_id)
        ->whereDate('date_recorded', Carbon::today())->sum('tray_quantity');
if($tray_quantity) {
            return $tray_quantity;
            // return $goodremaining->good_eggs;
        }
    }



    // public function getAllSalesForFarm($farmId)
    // {
    //     return FarmSale::where('farm_id', $farmId)->with(['sales_details', 'farm_payments'])->orderBy('created_at', 'desc')->get();
    // }




    public function getSumOfEggsSoldToday()
    {
        $farm_id = Auth::User()->farm_id;
    $query_for_id_farm_item = ['item_category'=>'Egg','status_bill_sale'=>'Sale','farm_id'=>$farm_id];
   
    $id_farm_sale_item =  FarmItem::where($query_for_id_farm_item)->get();
      foreach($id_farm_sale_item as $all_ids){
        $ids = $all_ids->id;
        $query_sum_on_id = ['farm_id'=>$farm_id,'item_id'=> $ids];

        $tray_quantity = SalesDetail::where($query_sum_on_id)
        ->whereDate('created_at', Carbon::today())->sum('quantity');
if($tray_quantity) {
            return $tray_quantity;
            // return $goodremaining->good_eggs;
        }
      
       }
}


public function getSumOfEggsSoldWeekly()
{
    $farm_id = Auth::User()->farm_id;
$query_for_id_farm_item = ['item_category'=>'Egg','status_bill_sale'=>'Sale','farm_id'=>$farm_id];

$id_farm_sale_item =  FarmItem::where($query_for_id_farm_item)->get();
  foreach($id_farm_sale_item as $all_ids){
    $ids = $all_ids->id;
    $query_sum_on_id = ['farm_id'=>$farm_id,'item_id'=> $ids];

    $tray_quantity = SalesDetail::where($query_sum_on_id)
    ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('quantity');
if($tray_quantity) {
        return $tray_quantity;
        // return $goodremaining->good_eggs;
    }
  
   }
}


public function getSumOfEggsSoldMonthly()
{
    $farm_id = Auth::User()->farm_id;
$query_for_id_farm_item = ['item_category'=>'Egg','status_bill_sale'=>'Sale','farm_id'=>$farm_id];

$id_farm_sale_item =  FarmItem::where($query_for_id_farm_item)->get();
  foreach($id_farm_sale_item as $all_ids){
    $ids = $all_ids->id;
    $query_sum_on_id = ['farm_id'=>$farm_id,'item_id'=> $ids];

    $tray_quantity = SalesDetail::where($query_sum_on_id)
    ->whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->month)
->sum('quantity');
if($tray_quantity) {
        return $tray_quantity;
        // return $goodremaining->good_eggs;
    }
  
   }
}


public function getSumOfEggsSoldAllTime()
{
    $farm_id = Auth::User()->farm_id;
$query_for_id_farm_item = ['item_category'=>'Egg','status_bill_sale'=>'Sale','farm_id'=>$farm_id];

$id_farm_sale_item =  FarmItem::where($query_for_id_farm_item)->get();
  foreach($id_farm_sale_item as $all_ids){
    $ids = $all_ids->id;
    $query_sum_on_id = ['farm_id'=>$farm_id,'item_id'=> $ids];

    $tray_quantity = SalesDetail::where($query_sum_on_id)->sum('quantity');
if($tray_quantity) {
        return $tray_quantity;
        // return $goodremaining->good_eggs;
    }
  
   }
}


    public function getSumOfEggsWeekly()
    {
        
        $farm_id = Auth::User()->farm_id;
        //$articles=Article::where("created_at",">", Carbon::now()->subMonths(6))->get();
        $tray_quantity = FarmEgg::where('farm_id', $farm_id)
        ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('tray_quantity');
if ($tray_quantity) {
            return $tray_quantity;
            // return $goodremaining->good_eggs;
        }
    }

    public function getTotalGoodEggsRemaining()
    {
        $farm_id = Auth::User()->farm_id;
        $goodremaining = EggsRemainingTrack::where('farm_id', $farm_id)->first(['good_eggs']);
        if ($goodremaining) {
            return $goodremaining->good_eggs;
        }
    }

    public function getTotalBrokenEggsRemaining()
    {
        $farm_id = Auth::User()->farm_id;
        $broken_eggsremaining = EggsRemainingTrack::where('farm_id', $farm_id)->first(['broken_eggs']);
        if ($broken_eggsremaining) {
            return $broken_eggsremaining->broken_eggs;
        }

    }

    public function updateEggsRemaining($farm_id, $typeofegg, $qty, $created_by)
    {

//$good_eggs = EggsRemainingTrack::updateOrCreate(['farm_id' => $farm_id], ['good_eggs' => $qty], ['created_by' => $created_by]);
        // $broken_eggs = EggsRemainingTrack::updateOrCreate(['farm_id' => $farm_id], ['broken_eggs' => $qty], ['created_by' => $created_by]);

        if ($typeofegg == "Broken") {

            EggsRemainingTrack::updateOrCreate(['farm_id' => $farm_id], ['broken_eggs' => $qty], ['created_by' => $created_by]);

        } else { // $penHousestocking = EggsRemainingTrack::findOrFail($farm_id);

            EggsRemainingTrack::updateOrCreate(['farm_id' => $farm_id], ['good_eggs' => $qty], ['created_by' => $created_by]);

        }}

    public function createEggCollection($eggCollection)
    {
        return FarmEgg::create($eggCollection)->id;
    }

    // public function createEggsRemaing($eggsRemaining)
    // {
    //     return EggsRemainingTrack::create($eggsRemaining)->id;
    // }

    public function collectEgg($batchId, $penhouse, $eggtype, $qty, $datecollected, $eggsremaining)
    {

        if ($eggtype == "Good") {
            $egggtocratesnow = $this->getTotalGoodEggsRemaining() + $eggsremaining;

            if ($egggtocratesnow >= 30) {
                $newremain = $egggtocratesnow - 30;
                $TotalQuantityOfTraysNow = $qty + 1;
            } else {
                $newremain = $egggtocratesnow;
                $TotalQuantityOfTraysNow = $qty;
            }

            $farm_id = Auth::User()->farm_id;
            $farm_iduser = Auth::User()->id;
            $this->pen_house_stocking->farm_id = $farm_id;

            $this->pen_house_stocking->batch_id = $batchId;
            $this->pen_house_stocking->pen_house_id = $penhouse;
            // $this->pen_house_stocking->pen_house_identity = $penhouse."/".$batchId;
            //pen_house_identity
            $this->pen_house_stocking->type_of_egg = $eggtype;
            $this->pen_house_stocking->tray_quantity = $TotalQuantityOfTraysNow;
            $this->pen_house_stocking->date_recorded = $datecollected;

            $this->pen_house_stocking->created_by = $farm_iduser;
            $this->pen_house_stocking->save();

            $this->updateEggsRemaining($farm_id, $eggtype, $newremain, $farm_iduser);
            return $this->pen_house_stocking->id;
        } else {

            $egggtocratesnow = $this->getTotalBrokenEggsRemaining() + $eggsremaining;

            if ($egggtocratesnow >= 30) {
                $newremain = $egggtocratesnow - 30;
                $TotalQuantityOfTraysNow = $qty + 1;
            } else {
                $newremain = $egggtocratesnow;
                $TotalQuantityOfTraysNow = $qty;
            }

            $farm_id = Auth::User()->farm_id;
            $farm_iduser = Auth::User()->id;
            $this->pen_house_stocking->farm_id = $farm_id;

            $this->pen_house_stocking->batch_id = $batchId;
            $this->pen_house_stocking->pen_house_id = $penhouse;
            $this->pen_house_stocking->type_of_egg = $eggtype;
            $this->pen_house_stocking->tray_quantity = $TotalQuantityOfTraysNow;
            $this->pen_house_stocking->date_recorded = $datecollected;

            $this->pen_house_stocking->created_by = $farm_iduser;
            $this->pen_house_stocking->save();

            $this->updateEggsRemaining($farm_id, $eggtype, $newremain, $farm_iduser);
            return $this->pen_house_stocking->id;

        }

    }
    public function getAllPenHouseStockingForFarm($farmId)
    {
        $allfarmstocking = PenHouseStocking::where('farm_id', $farmId)->get();
        if (!count($allfarmstocking)) {
            return "";
        } else {
            return $allfarmstocking;
        }
    }

    public function editAllCollection($typepost,$id, $batch_id, $pen_house_id, $type_of_egg,$tray_quantity,$date_recorded,
    $eggs_remaining)
    {
       if($typepost=="UPDATEFORM"){
        $FarmEgg = FarmEgg::findOrFail($id);
        $FarmEgg->batch_id = $batch_id;
        $FarmEgg->pen_house_id = $pen_house_id;
        $FarmEgg->type_of_egg = $type_of_egg;
        $FarmEgg->tray_quantity = $tray_quantity;
        $FarmEgg->date_recorded = $date_recorded;
        $FarmEgg->eggs_remaining = $eggs_remaining;
        $FarmEgg->save(); 
       }else{
        $FarmEgg = FarmEgg::findOrFail($id);
        $FarmEgg -> delete();
       }


       

    }


    public function deleteCollection($id, $farmId)
    {
        return FarmEgg::where(['id' => $id, 'farm_id' => $farmId])->delete();
    }

    
    public function printMonthlyCollection($farmId){
    
      //  return FarmEgg::where(['id' => $id, 'farm_id' => $farmId])->orderBy(DB::raw("MONTH(date_recorded)"))->get();
        return FarmEgg::where(['farm_id' => $farmId])->orderBy('date_recorded', 'ASC')->get();
   

}

public function sumMonthlyCollection($farmId){
     
        $tray_quantity = FarmEgg::where('farm_id', $farm_id)->sum('tray_quantity');
        if ($tray_quantity) {
            return $tray_quantity;

} 

 

}


}
