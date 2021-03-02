<?php

namespace App\Repositories;

use App\Models\BillItem;
use App\Models\FarmItem;
use Illuminate\Support\Facades\Auth;
class BilltemsRepository
{

    private $billItem;

    public function __construct(BillItem $billItem)
    {
        $this->BillItem = $billItem;
    }

    public function createBillItemFromStocking($user, $itemName, $amount)
    {
        $this->BillItem->item_name = $itemName;
        $this->BillItem->price = $amount;
        $this->BillItem->created_by = $user->id;
        $this->BillItem->farm_id = $user->farm_id;
        $this->BillItem->save();
        return $this->BillItem->id;
    }

    public function getAllItems($farmId)
    {
        return BillItem::where('farm_id', $farmId)->get();
    }

    public function getAllItemsF()
    {
        $farm_id = Auth::User()->farm_id;

        $query_item = ['farm_id'=>$farm_id,'status_bill_sale'=>'Bill'];

        return FarmItem::where($query_item)->get();
    }

    public function createBillItem($billItem)
    {
        return BillItem::create($billItem);
    }


    public function createFarmItem($billItem)
    {
        return FarmItem::create($billItem);
    }

    public function updateBillItem($id, $billItem)
    {
        return BillItem::where('id', $id)->update($billItem);
    }

    public function deleteBillItem($id)
    {
        return BillItem::destroy($id);
    }

    public function deleteBillItem2($user,$id)
    {
        return BillItem::where(['farm_id' => $user->farm_id, 'id' => $id])->delete();

        //return FarmItem::destroy($id);
    }
    
    public function findBillItemById($id)
    {
        return BillItem::find($id);
    }
}
