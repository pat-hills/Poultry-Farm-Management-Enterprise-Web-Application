<?php

namespace App\Repositories;

use App\Models\StockTracking;

class StockTrackingRepository
{

    private $stockTracking;

    public function __construct(StockTracking $stockTracking)
    {
        $this->stockTracking = $stockTracking;
    }

    public function createOrUpdateStockTracking($user, $batchId)
    {
        $stockTracking = StockTracking::firstOrCreate(
            ['batch_id' => $batchId, 'farm_id' => $user->farm_id], ['created_by' => $user->id]
        );
        return $stockTracking->id;
    }

    public function getStockTrackingByFarmId($farmId)
    {
        return StockTracking::where("farm_id", $farmId)->get();
    }

    public function getMaxBatchIdForFarm($farmId)
    {
        $batchId = StockTracking::where('farm_id', $farmId)->max('batch_id');
        if ($batchId) {
            return $batchId;
        } else {
            return 0;
        }
    }

    public function editStockingTracking($id)
    {
        //     $penhoueMatch = ['id'=> $id,'farm_id' => $farm_id,'batch_id' => $batchidd,
        //     'qty_stock' => $qty,'amount'=>$amount,'created_by'=>$created_by];
        //   $crateorupdate =  StockTracking::updateOrcreate($penhoueMatch);

        //return $crateorupdate;
        $penHousestocking = StockTracking::findOrFail($id);
        $penHousestocking->qty_stock = $qty;
        $penHousestocking->amount = $amount;
        $penHousestocking->update();

    }

    // public function findStockTrackingByBatchId($id)
    // {
    //     return StockTracking::find($id);
    // }
    public function findStockTrackingByBatchId($batchId, $farm_id)
    {
        return StockTracking::where(['batch_id' => $batchId, 'farm_id' => $farm_id])->first();
    }

    public function createStockTracking($stockTracking, $user)
    {
        return StockTracking::firstOrCreate($stockTracking, ['created_by' => $user->id])->id;
    }
}
