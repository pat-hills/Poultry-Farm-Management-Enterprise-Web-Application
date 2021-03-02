<?php

namespace App\Repositories;

use App\Models\FarmPayablePayment;

class FarmPayablePaymentRepository
{

    private $farmPayablePayment;

    public function __construct(FarmPayablePayment $farmPayablePayment)
    {
        $this->payment = $farmPayablePayment;
    }

    public function createFarmPayablePayment($farmPayablePayment)
    {
        return FarmPayablePayment::create($farmPayablePayment);

    }
    // public function createFarmPayablePayment($user, $farmPayableId,
    //     $vendorId, $amount, $datePaid = null,
    //     $modeOfPayment = null, $chequeNumber = null,
    //     $description = null, $dateOnCheque = null, $transactionId = null,
    //     $operatorType = null, $bankName = null, $paymentCode = null) {
    //     $this->payment->farm_id = $user->farm_id;
    //     $this->payment->farm_payable_id = $farmPayableId;
    //     $this->payment->vendor_id = $vendorId;
    //     $this->payment->date_paid = $datePaid;
    //     $this->payment->farm_id = $user->farm_id;
    //     $this->payment->amount_paid = $amount;
    //     $this->payment->mode_of_payment = $modeOfPayment;
    //     $this->payment->cheque_number = $chequeNumber;
    //     $this->payment->description = $description;
    //     $this->payment->date_on_cheque = $dateOnCheque;
    //     $this->payment->transaction_id = $transactionId;
    //     $this->payment->operator_type = $operatorType;
    //     $this->payment->name_of_bank = $bankName;
    //     $this->payment->payment_code = $paymentCode;
    //     $this->payment->created_by = $user->id;
    //     $this->payment->save();
    //     return $this->payment->id;
    // }

    public function getPaymentsByFarmPayableId($farmPayableId)
    {
        FarmPayablePayment::find($id);
    }

    public function deleteFarmPayableById($id)
    {
        $payment = FarmPayablePayment::find($id);
        if ($payment) {
            $payment->delete();
        }
    }

    public function updateFarmPayableById($id, $farmPayablePayment)
    {
        FarmPayablePayment::where('id', $id)->update($farmPayablePayment);

    }
}
