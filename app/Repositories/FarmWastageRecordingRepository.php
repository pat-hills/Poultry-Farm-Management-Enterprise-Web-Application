<?php

namespace App\Repositories;

use App\Models\FarmWastage;

class FarmWastageRecordingRepository
{
    public function createWasteRecord($wasteRecord)
    {
        return FarmWastage::create($wasteRecord)->id;
    }

    public function updateWasteRecording($id, $user, $wasteRecord)
    {
        return FarmWastage::where(['farm_id' => $user->farm_id, 'id' => $id])->update($wasteRecord);
    }

    public function deleteWasteRecording($id, $user)
    {
        return FarmWastage::where(['farm_id' => $user->farm_id, 'id' => $id])->delete();
    }

    public function getAllWasteRecord($farmId)
    {
        return FarmWastage::where('farm_id', $farmId)->orderBy('created_at', 'desc')->get();
    }
}
