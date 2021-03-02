<?php

namespace App\Repositories;

use App\Models\FarmFeedRecording;

class FarmFeedRecordingRepository
{
    public function createRecordFeed($feedRecord)
    {
        return FarmFeedRecording::create($feedRecord)->id;
    }

    public function updateRecordFeed($id, $user, $feedRecord)
    {
        return FarmFeedRecording::where(['farm_id' => $user->farm_id, 'id' => $id])->update($feedRecord);
    }

    public function deleteRecordFeed($id, $user)
    {
        return FarmFeedRecording::where(['farm_id' => $user->farm_id, 'id' => $id])->delete();
    }

    public function getAllFeedGiven($farmId)
    {
        return FarmFeedRecording::where('farm_id', $farmId)->orderBy('created_at', 'desc')->get();
    }
}
