<?php

namespace App\Repositories;

use App\Models\FarmDrugsRecording;

class FarmDrugRecordingRepository
{
    public function createFarmDrugRecord($drugRecord)
    {
        return FarmDrugsRecording::create($drugRecord)->id;
    }

    public function getAllDrugsGiven($farmId)
    {
        return FarmDrugsRecording::where('farm_id', $farmId)->orderBy('created_at', 'desc')->get();
    }

    public function updateFarmDrugsRecording($farmId, $id, $farmDrugRecord)
    {
        return FarmDrugsRecording::where(['farm_id' => $farmId, 'id' => $id])->update($farmDrugRecord);
    }

    public function deleteFarmDrugsRecording($farmId, $id)
    {
        return FarmDrugsRecording::where(['farm_id' => $farmId, 'id' => $id])->delete();
    }

}
