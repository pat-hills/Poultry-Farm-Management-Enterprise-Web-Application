<?php

namespace App\Http\Controllers;

use App\Repositories\FarmPayableDetailRepository;
use App\Repositories\FarmPayablePaymentRepository;
use App\Repositories\FarmPayableRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FarmPayablesController extends Controller
{
    //

    protected $farmPayablesRepository;
    protected $farmPayablesRepositoryDetail;
    protected $farmPayablePaymentRepository;

    public function __construct(FarmPayableRepository $farmPayablesRepository,
        FarmPayablePaymentRepository $farmPayablePaymentRepository,
        FarmPayableDetailRepository $farmPayablesRepositoryDetail) {

        $this->farmPayablesRepository = $farmPayablesRepository;
        $this->farmPayablesRepositoryDetail = $farmPayablesRepositoryDetail;
        $this->farmPayablePaymentRepository = $farmPayablePaymentRepository;
    }

    public function saveBillPayableItems(Request $request)
    {
        $payable_id = $this->farmPayablesRepositoryDetail->saveFarmPayable($request->user(),
            $request->vendor_id, $request->invoice_number,
            $request->description);
        foreach ($request['item_id'] as $index => $value) {
            $this->farmPayablesRepositoryDetail->savePayableItems($value,
                $payable_id, $request['quantity'][$index], $request['price'][$index]
            );
        }
    }

    public function makePayment(Request $request, $id)
    {
       if($request->amount=="0"){
        Session::flash('messagefailed', 'No payment to be made on bill!');
        Session::flash('alert-class', 'alert-info');
        return redirect(route('account.viewbills'));
       }else{

        $user = $request->user();
        $payments = ['farm_id' => $user->farm_id, 'farm_payable_id' => $id, 'vendor_id' => $request->vendorid,
            'date_paid' => $request->datePaid, 'amount_paid' => $request->amount, 'mode_of_payment' => $request->modeOfPayment,
            'cheque_number' => $request->chequeNumber, 'date_on_cheque' => $request->dateOnCheque,
            'transaction_id' => $request->tarnsactionId, 'description' => $request->description, 'payment_code' => $request->paymentCode,
            'name_of_bank' => $request->bankName, 'created_by' => $user->id, 'operator_type' => $request->operatorType];
        $this->farmPayablePaymentRepository->createFarmPayablePayment($payments);
        Session::flash('message', 'Payment made successfully!');
        Session::flash('alert-class', 'alert-success');
        return redirect(route('account.viewbills'));
       }
   


      
    }
}
