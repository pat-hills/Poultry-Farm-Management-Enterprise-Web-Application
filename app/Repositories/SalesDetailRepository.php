<?php

namespace App\Repositories;

use App\Models\SalesDetail;

class SalesDetailRepository
{

    public function getAllSalesDetail($sales_id)
    {
        return SalesDetail::where('sales_id', $sales_id)->get();
    }
    public function createSalesDetail($salesDetail)
    {
        return SalesDetail::create($salesDetail)->id;
    }

    public function updateSalesDetail($id, $salesDetail)
    {
        $sales = SalesDetail::findorNew($id);
        $sales->fill($salesDetail);
        $sales->save();
        // SalesDetail::firstOrCreate(['id', $id],$salesDetail);
        // SalesDetail::updateOrCreate(['id', $id],$salesDetail);
    }

    public function deleteSalesDetail($id)
    {
        return SalesDetail::destroy($id);
    }

    // public function deleteSalesDetail($id)
    // {
    //     return SalesDetail::destroy($id);
    // }
}
