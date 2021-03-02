<?php

namespace App\Http\Controllers;

use App\Repositories\FarmPayablePaymentRepository;
use Illuminate\Http\Request;

class FarmPayablePaymentController extends Controller
{
    //

    protected $farmPayablePaymentRepository;
    public function __construct(FarmPayablePaymentRepository $farmPayablePaymentRepository)
    {
        $this->farmPayablePaymentRepository = $farmPayablePaymentRepository;
    }

    public function makePayment(Request $request, $id)
    {
        echo $id;
    }

    public function deleteBillPayment($id)
    {
        $this->farmPayablePaymentRepository->deleteFarmPayableById($id);
    }
}
