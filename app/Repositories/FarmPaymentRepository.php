<?php

namespace App\Repositories;

use App\Models\FarmPayment;
use \Carbon\Carbon;

class FarmPaymentRepository
{

    public function getAllSalesDetail($sales_id)
    {
        return FarmPayment::where('sales_id', $sales_id)->get();
    }

    public function getAllFarmPaymentBySalesId($sales_id)
    {
        return FarmPayment::where('sales_id', $sales_id)->get();
    }

    public function deleteFarmPayment($id)
    {
        return FarmPayment::destroy($id);
    }

    public function addFarmPayment($payment)
    {
        return FarmPayment::create($payment)->id;
    }

    public function paymentsToday($farmId)
    {
        $today = Carbon::today()->format('Y-m-d');
        // return $today . ' 23:59:59';
        return FarmPayment::where(['farm_id' => $farmId])
            ->whereBetween('created_at', [$today, $today . ' 23:59:59'])->sum('amount');
    }

    public function getMaxReceiptNumber($farmId)
    {
        return FarmPayment::where(['farm_id' => $farmId])->max('receipt');

    }
}
