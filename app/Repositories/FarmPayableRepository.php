<?php

namespace App\Repositories;

use App\Models\FarmPayable;

class FarmPayableRepository
{

    private $farmPayable;

    public function __construct(FarmPayable $farmPayable)
    {
        $this->farmPayable = $farmPayable;
    }

    public function saveFarmPayable($farmPayable)
    {
        return FarmPayable::create($farmPayable)->id;
    }

    // public function saveFarmPayable($user, $vendorId, $batchId, $dateDue = null, $dateIssued = null,
    //     $currency = null, $invoiceNumber = null, $description = null) {
    //         FarmPayable::create($farmpayable)
    //     $this->farmPayable->vendor_id = $vendorId;
    //     $this->farmPayable->batch_id = $batchId;
    //     $this->farmPayable->invoice_number = $invoiceNumber;
    //     $this->farmPayable->description = $description;
    //     $this->farmPayable->currency = $currency;
    //     $this->farmPayable->date_issued = $dateIssued;
    //     $this->farmPayable->date_due = $dateDue;
    //     $this->farmPayable->created_by = $user->id;
    //     $this->farmPayable->farm_id = $user->farm_id;
    //     $this->farmPayable->save();
    //     return $this->farmPayable->id;
    // }

    public function updateFarmPayable($id, $user, $vendorId, $batchId, $dateDue = null, $dateIssued = null,
        $currency = null, $invoiceNumber = null, $description = null) {
        $farmPayable = FarmPayable::findOrFail($id);
        $farmPayable->vendor_id = $vendorId;
        $farmPayable->batch_id = $batchId;
        $farmPayable->invoice_number = $invoiceNumber;
        $farmPayable->description = $description;
        $farmPayable->currency = $currency;
        $farmPayable->date_issued = $dateIssued;
        $farmPayable->date_due = $dateDue;
        $farmPayable->created_by = $user->id;
        $farmPayable->farm_id = $user->farm_id;
        $farmPayable->save();
        return $farmPayable->id;
    }

    public function deleteFarmPayable($id)
    {
        $farmPayable = FarmPayable::find($id);
        if ($farmPayable) {
         return $farmPayable->delete();
        }}

    public function viewAllBillsForFarm($farmId)
    {
        return FarmPayable::where('farm_id', $farmId)->with(['farm_payables_details', 'farm_payable_payments'])->orderBy('created_at', 'desc')->get();
    }

    public function findFarmBillById($farmPayableId)
    {
        return FarmPayable::find($farmPayableId);
    }

    public function updateFarmPayableById($id, $farmpayable)
    {
      return  FarmPayable::where('id', $id)->update($farmpayable);     
    }

}
