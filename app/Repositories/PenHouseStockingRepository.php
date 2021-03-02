<?php

namespace App\Repositories;

use App\Models\PenHouseStocking;
use App\Models\PenHouse;
use Illuminate\Support\Facades\Auth;

class PenHouseStockingRepository
{

    private $pen_house_stocking;

    public function __construct(PenHouseStocking $pen_house_stocking)
    {
        $this->pen_house_stocking = $pen_house_stocking;
    }

    //check if farm has atleast one penhouse stocking
    public function pen_house_stocking($farm_id)
    {
        // $farm_id = Auth::User()->farm_id;
        $has_pen_house_stocking = PenHouseStocking::where('farm_id', $farm_id)
            ->first();
        if ($has_pen_house_stocking) {
            return true;
        } else {
            return false;
        }
    }

    // get the first pen house for the farm
    public function get_pen_house_stocking($farm_id)
    {
        $farm_id = Auth::User()->farm_id;
        $first_pen_house_stocking = PenHouseStocking::where('farm_id', $farm_id)
            ->first();
        if ($first_pen_house_stocking) {
            return $first_pen_house_stocking;
        }
    }

    public function createPenHouseStocking($penHouseStocking)
    {
        return PenHouseStocking::create($penHouseStocking);
    }
    public function getAllPenHouseStockingForFarm($farmId)
    {
        return PenHouseStocking::where('farm_id', $farmId)->with('vendor')->get();
    }

    public function editPenhousingStocking($id, $numberofstock, $typeOfbird, $pehouseid)
    {
        $penHousestocking = PenHouseStocking::findOrFail($id);
        $penHousestocking->number_of_stock = $numberofstock;
        $penHousestocking->type_of_bird = $typeOfbird;
        $penHousestocking->pen_house_id = $pehouseid;
        $penHousestocking->save();
        return $penHousestocking;
    }
    public function updatePenhousingStocking($id, $penHouseStocking)
    {
        return PenHouseStocking::where('id', $id)->update($penHouseStocking);
    }

    public function findPenHouseStockingBybatchIdAndPenHouse($batchId, $penHouseId)
    {
        return PenHouseStocking::where(['batch_id' => $batchId, 'pen_house_id' => $penHouseId])->get();
    }
    public function findPenHouseStockingById($id)
    {
        return PenHouseStocking::findorFail($id);
    }
    public function deletePenhouseStocking($id)
    {

 if($id){
   $allrec = PenHouseStocking::find($id);
   $penid = $allrec->pen_house_id;
   $changedstatus = "NO";
$penHouse = PenHouse::findOrFail($penid);
     $penHouse->stocked = $changedstatus;
    $penHouse->save();
 // $allstockrecords = StockTracking::find($allrec->batch_id);
 // $allstockrecords->id->delete();
 
 return PenHouseStocking::find($id)->delete();
 }

      
    }
}
