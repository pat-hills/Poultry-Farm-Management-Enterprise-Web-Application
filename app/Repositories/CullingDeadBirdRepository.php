<?php

namespace App\Repositories;

use App\Models\CullingDeadBird;

class CullingDeadBirdRepository
{
    // private $deadbirds;

    // public function __construct(CullingDeadBird $deadbirds )
    // {
    //       $this->deadbirds  = $deadbirds;
    // }

    public function createCullingDeadBird($deadBirds)
    {
        return CullingDeadBird::create($deadBirds)->id;
    }

    public function updateCullingDeadBird($id, $user, $deadBirds)
    {
        return CullingDeadBird::where(['farm_id' => $user->farm_id, 'id' => $id])->update($deadBirds);
    }


    public function editCullingDeadBirds($id, $batch_id, $pen_house_id, $number_of_birds,$reason,$date_stocked)
    {
      
        $CullingDeadBird = CullingDeadBird::findOrFail($id);
        $CullingDeadBird->batch_id = $batch_id;
        $CullingDeadBird->pen_house_id = $pen_house_id;
        $CullingDeadBird->number_of_birds = $number_of_birds;
        $CullingDeadBird->reason = $reason;
        $CullingDeadBird->date_stocked = $date_stocked;
        $CullingDeadBird->save(); 
       } 


    public function deleteCullingDeadBird($user,$id)
    {
        return CullingDeadBird::where(['farm_id' => $user->farm_id, 'id' => $id])->delete();
    }

    public function getAllCullingDeadBirds($farmId)
    {
        return CullingDeadBird::where('farm_id', $farmId)->get();
    }

}
