<?php

namespace App\Repositories;

use App\Models\FarmSale;

class SalesRepository
{

    public function getAllSalesForFarm($farmId)
    {
        return FarmSale::where('farm_id', $farmId)->with(['sales_details', 'farm_payments'])->orderBy('created_at', 'desc')->get();
    }

    //find sales by id
    public function getSalesById($id)
    {
        return FarmSale::find($id);
    }

    //find sales by id and farm_id
    public function getSalesByFarmId($id, $farmId)
    {
        return FarmSale::where(['id' => $id, 'farm_id' => $farmId])->first();
    }

    //update sales status for full payment
    public function updateSalesStatus($id, $farm_id)
    {
        return FarmSale::where(['id' => $id, 'farm_id' => $farm_id])->update(['status' => 'PAID']);
    }

    public function updateSalesById($salesId, $sales)
    {
        FarmSale::where('id', $salesId)
            ->update($sales);
    }

    public function createFarmSales($farmSales)
    {
        $farmSale = FarmSale::create($farmSales);
        return $farmSale->id;
    }

    public function deleteFarmSales($id)
    {
        return FarmSale::find($id)->delete();
    }

    public function getAllUnpaidSales($farmId)
    {
        return FarmSale::whereNull('status')->
            orWhere('status', 'UNPAID')->where('farm_id', $farmId)->with('sales_details')->get();
    }

    public function getAllPaidSales($farmId)
    {
        return FarmSale::where(['status' => 'PAID', 'farm_id' => $farmId])->with('sales_details')->get();

    }

    public function getMaxInvoiceNumber($farmId)
    {
        return FarmSale::where(['farm_id' => $farmId])->max('invoice_number');
    }

    public function invoiceNumberExist($farmId, $invoiceNumber)
    {
        return FarmSale::where(['farm_id' => $farmId, 'invoice_number' => $invoiceNumber])->first();
    }

}
