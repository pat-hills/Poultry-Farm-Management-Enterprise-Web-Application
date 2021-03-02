<?php

namespace App\Repositories;

use App\Models\PenHouse;
use Illuminate\Support\Facades\Auth;

class PenHouseRepository
{
    private $pen_house;

    public function __construct(PenHouse $pen_house)
    {
        $this->pen_house = $pen_house;
    }

    //check if farm has atleast one penhouse
    public function pen_house_setup($farm_id)
    {
        $farm_id = Auth::User()->farm_id;
        $has_pen_house = PenHouse::where('farm_id', $farm_id)
            ->first();
        if ($has_pen_house) {
            return true;
        } else {
            return false;
        }
    }

    // get the first pen house for the farm
    public function get_pen_house($farm_id)
    {
        $farm_id = Auth::User()->farm_id;
        $first_pen_house = PenHouse::where('farm_id', $farm_id)
            ->first();
        if ($first_pen_house) {
            return $first_pen_house;
        }
    }

    // public function createPenHouse($pen_name, $pen_number)
    // {
    //     $user = Auth::user();
    //     // $this->pen_house = PenHouse::firstOrCreate(['farm_id' => $farm_id]);
    //     $this->pen_house->pen_name = $pen_name;
    //     $this->pen_house->pen_number = $pen_number;
    //     $this->pen_house->stocked = 'NO';
    //     $this->pen_house->farm_id = $user->farm_id;
    //     $this->pen_house->created_by = $user->id;
    //     $this->pen_house->save();
    // }
    public function createPenHouse($penHouse)
    {
        return PenHouse::create($penHouse)->id;
    }

    public function getMaxPenNumber($farmId)
    {
        $penNumber = PenHouse::where('farm_id', $farmId)->max('pen_number');
        if ($penNumber) {
            return $penNumber;
        } else {
            return 0;
        }
    }

    public function findPenHouseById($id)
    {
        return PenHouse::find($id);
    }

    public function getAllPenHouseForFarm($farmId)
    {
        // $penhoueMatch = ['farm_id' => $farmId, 'stocked' => 'NO'];
        $penHouse = PenHouse::where('farm_id', $farmId)->get();
        return $penHouse;
    }

    //Get all non stocked penhouse
    public function nonStockedPenHouseForFarm($farmId)
    {
        $penhouseMatch = ['farm_id' => $farmId, 'stocked' => 'NO'];
        return PenHouse::where($penhouseMatch)->get();
    }

    public function changePenHouseStockStatus($id, $status)
    {
        $penHouse = PenHouse::find($id);
        $penHouse->stocked = $status;
        $penHouse->save();
    }

    public function findByPenhouseNumber($penhouseNumber, $user)
    {
        return PenHouse::where(['pen_number' => $penhouseNumber, 'farm_id' => $user->farm_id])->first();
    }

    public function updatePenhouse($id, $user, $penhouse)
    {
        return PenHouse::where(['farm_id' => $user->farm_id, 'id' => $id])->update($penhouse);
    }

    public function findPenhouse($id, $farm_id)
    {
        return PenHouse::where(['id' => $id, 'farm_id' => $user->farm_id])->get();
    }
    
    public function deletePenhouse($id, $user)
    {
        $penhouse = PenHouse::where(['id' => $id, 'farm_id' => $user->farm_id])->first();
        if ($penhouse->stocked == 'NO') {
            $penhouse->delete();
            return 1;
        } else {
            return 0;
        } 
    }
}
