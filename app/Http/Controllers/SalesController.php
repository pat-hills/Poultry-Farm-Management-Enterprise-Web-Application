<?php

namespace App\Http\Controllers;

use App\Repositories\CustomerRepository;
use App\Repositories\FarmItemRepository;
use App\Repositories\FarmPaymentRepository;
use App\Repositories\SalesDetailRepository;
use App\Repositories\SalesRepository;
use App\Repositories\StockTrackingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

//this class handle sales made to customers.
class SalesController extends Controller
{
    private $salesRepository;
    private $salesDetailRepository;
    private $farmPaymentRepository;
    private $customerRepository;
    private $farmItemRepository;
    private $stockTrackingRepository;
    private $unpaidSum;

    public function __construct(SalesDetailRepository $salesDetailRepository,
        FarmPaymentRepository $farmPaymentRepository,
        SalesRepository $salesRepository, CustomerRepository $customerRepository,
        FarmItemRepository $farmItemRepository, StockTrackingRepository $stockTrackingRepository) {
        $this->salesRepository = $salesRepository;
        $this->farmPaymentRepository = $farmPaymentRepository;
        $this->salesDetailRepository = $salesDetailRepository;
        $this->customerRepository = $customerRepository;
        $this->farmItemRepository = $farmItemRepository;
        $this->stockTrackingRepository = $stockTrackingRepository;
    }

    // this is the view rendered when a user visists the sales record from dashboard
    public function index()
    {
        //users farm id
        $farm_id = Auth::user()->farm_id;
        //get all sales made by the farm
        $sales = $this->salesRepository->getAllSalesForFarm($farm_id);
        //get all the customers for this farm
        $customers = $this->customerRepository->getAllCustomers($farm_id);
        $batches = $this->stockTrackingRepository->getStockTrackingByFarmId($farm_id);
        // get all outstanding debt from customers
        $paymentsToday = $this->farmPaymentRepository->paymentsToday($farm_id);
        $unPaidSales = $this->salesRepository->getAllUnpaidSales($farm_id);
        $paidSales = $this->salesRepository->getAllPaidSales($farm_id);
        $unpaidSum = $this->getUnPaidSalesDetailTotalSum($unPaidSales);
        $maxReceipt = $this->farmPaymentRepository->getMaxReceiptNumber($farm_id);
        $args = ['allsales' => $sales, 'paidSales' => $paidSales, 'customers' => $customers,
            'unpaidSales' => $unPaidSales, 'unpaidSum' => $unpaidSum, 'receipt' => $maxReceipt + 1,
            'batches' => $batches, 'paymentsToday' => $paymentsToday];
        return view('users.salesrecords', $args);
        // echo json_encode($unPaidSales->sales_details());
    }

    // get all sales that full payment is made
    public function getAllPaidSales($sales)
    {
        $paidSales = array();
        foreach ($sales as $sale) {
            if ($sale->farm_payments->sum('amount') >= $sale->sales_details->sum('total_amount')) {
                $paidSales[] = $sale;
            }
        }
        return $paidSales;
    }

    //get for invoice
    public function addSales()
    {
        //get the farm id
        $farm_id = Auth::user()->farm_id;
        //get all items for sale
        $items = $this->farmItemRepository->getAllItems($farm_id);
        //get stock tracking for a farm
        $batches = $this->stockTrackingRepository->getStockTrackingByFarmId($farm_id);
        $customers = $this->customerRepository->getAllCustomers($farm_id);
        $maxInvoiceNumber = $this->salesRepository->getMaxInvoiceNumber($farm_id);
        $args = ['items' => $items, 'batches' => $batches, 'customers' => $customers,
            'invoiceNumber' => $maxInvoiceNumber + 1];
        return view('users.invoice', $args);
    }

    //add new sales
    public function createSales(Request $request)
    {


        if($this->arrayContainsDuplicate($request->billItem)){
            Session::flash('messagefailedduplicate', 'Your sales have duplicated item! Please check items before saving sales');
            Session::flash('alert-class', 'alert-danger');
            return redirect(route('account.sales'));
         }else{

         
        $user = $request->user();
        $invoiceNumber = $this->salesRepository->invoiceNumberExist($user->farm_id, $request->invoiceNumber);
        if ($invoiceNumber) {
            Session::flash('message', "Invoice number \"" . $request->invoiceNumber . "\" already exist");
            Session::flash('alert-class', 'alert-warning');
            // return redirect()->back();
            return redirect()->back()->withInput()->withErrors("Invoice number \"" . $request->invoiceNumber . "\" already exist");
        } else {
            $sales = ['farm_id' => $user->farm_id, 'customer_id' => $request->customer,
                'batch_id' => $request->batchId,
                'invoice_number' => $request->invoiceNumber, 'sales_date' => $request->salesDate,
                'payment_due' => $request->paymentDue, 'created_by' => $user->id];
            $salesId = $this->salesRepository->createFarmSales($sales);

            for ($i = 0; $i < count($request->billItem); $i++) {
                $saleDetail = ['item_id' => $request->billItem[$i], 'quantity' => $request->quantity[$i],
                    'amount' => $request->amount[$i],
                    'sales_id' => $salesId, 'created_by' => $user->id,
                    'total_amount' => $request->amount[$i] * $request->quantity[$i],
                    'farm_id' => $user->farm_id];
                $this->salesDetailRepository->createSalesDetail($saleDetail);
            }

            Session::flash('message', 'Sales have been saved successfully!');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect(route('account.sales'));


    }


    }

    public function getUnPaidSalesDetailTotalSum($unPaidSales)
    {
        $total = 0;
        foreach ($unPaidSales as $sales) {
            $total += $sales->sales_details->sum('total_amount') - $sales->farm_payments->sum('amount');
        }
        return $total;
    }

    //get all unpaid sales
    public function getAllUnPaidSales($sales)
    {
        $this->unpaidSum = 0;
        $unpaidSales = array();
        foreach ($sales as $sale) {
            if ($sale->sales_details->sum('total_amount') > $sale->farm_payments->sum('amount')) {
                $unpaidSales[] = $sale;
                $this->unpaidSum += $sale->sales_details->sum('total_amount') - $sale->farm_payments->sum('amount');
            }
        }
        return $unpaidSales;
    }

    public function editSalesView($id)
    {
        //get the farm id
        $farm_id = Auth::user()->farm_id;
        $sales = $this->salesRepository->getSalesById($id);
        $items = $this->farmItemRepository->getAllItems($farm_id);
        //get stock tracking for a farm
        $batches = $this->stockTrackingRepository->getStockTrackingByFarmId($farm_id);
        $customers = $this->customerRepository->getAllCustomers($farm_id);

        $response = ['sales' => $sales, 'batches' => $batches, 'items' => $items, 'customers' => $customers];
        return view('users.invoice_edit', $response);
        // echo json_encode($args);
    }

    public function editSales(Request $request, $id)
    {
        $sales = ['customer_id' => $request->customer, 'batch_id' => $request->batchId,
            'invoice_number' => $request->invoiceNumber, 'sales_date' => $request->salesDate,
            'payment_due' => $request->paymentDue];
        $salesId = $this->salesRepository->updateSalesById($id, $sales);

        for ($i = 0; $i < count($request->billItem); $i++) {
            $saleDetail = ['item_id' => $request->billItem[$i], 'quantity' => $request->quantity[$i],
                'amount' => $request->amount[$i], 'farm_id' => $request->user()->farm_id,
                'sales_id' => $id, 'total_amount' => $request->amount[$i] * $request->quantity[$i]];
            $this->salesDetailRepository->updateSalesDetail($request->itemId[$i], $saleDetail);
        }
        Session::flash('message', 'Your sales have been updated successfully!');
        Session::flash('alert-class', 'alert-success');
        return redirect(route('account.sales'));
    }

    public function deleteSaleItem($id)
    {
        $deleted = $this->salesDetailRepository->deleteSalesDetail($id);
        if ($deleted) {
            $data = [
                'status' => '1',
                'msg' => 'success',
            ];
        } else {
            $data = [
                'status' => '0',
                'msg' => 'fail',
            ];
        }
        return json_encode($data);
    }

    public function deleteFarmPayment($id)
    {
        $deleted = $this->farmPaymentRepository->deleteFarmPayment($id);
        if ($deleted) {
            $data = [
                'status' => '1',
                'msg' => 'success',
            ];
        } else {
            $data = [
                'status' => '0',
                'msg' => 'fail',
            ];
        }
        return json_encode($data);
    }

    public function addPaymentToSales(Request $request, $id)
    {
        $allSalesPayment = $this->farmPaymentRepository->getAllFarmPaymentBySalesId($id);
        $totalSalesPaid = $allSalesPayment->sum('amount');
        $user = $request->user();
        $sales = $this->salesRepository->getSalesByFarmId($id, $user->farm_id);
       
        $totatamountnowpaying = $totalSalesPaid + $request->amount;


        if($request->amount <= 0){
            Session::flash('messagefailed', 'Payment cannot be zero or less!');
            Session::flash('alert-class', 'alert-danger');
            return redirect(route('account.sales'));
        }elseif(empty($request->amount)){
            Session::flash('messagefailedempty', 'Payment cannot cannot be empty!');
            Session::flash('alert-class', 'alert-danger');
            return redirect(route('account.sales'));
        }elseif($totatamountnowpaying > $sales->sales_details->sum('total_amount')){
            Session::flash('messagefailedpayment', 'Payment made is exceeding sales amount!');
            Session::flash('alert-class', 'alert-danger');
            return redirect(route('account.sales'));
        }
        else{


        
        $payment = ['sales_id' => $id, 'farm_id' => $user->farm_id,
            'amount' => $request->amount, 'receipt' => $request->receipt, 'description' => $request->description,
            'mode_of_payment' => $request->modeOfPayment, 'name_of_bank' => $request->bankName,
            'cheque_number' => $request->chequeNumber, 'cheque_date' => $request->dateOnCheque,
            'date_paid' => $request->datePaid, 'transaction_id' => $request->transactionId,
            'operator_type' => $request->operatorType, 'created_by' => $user->id];
        $paid = $this->farmPaymentRepository->addFarmPayment($payment);
       
        if ($totalSalesPaid = $sales->sales_details->sum('total_amount')) {
            $this->salesRepository->updateSalesStatus($id, $user->farm_id);
        }


        // if ($sales->sales_details->sum('total_amount') >= $totalSalesPaid) {
        //     $this->salesRepository->updateSalesStatus($id, $user->farm_id);
        // }


        if ($paid) {

            Session::flash('message', 'Payment have been saved successfully!');
            Session::flash('alert-class', 'alert-success');
       
        } else {
            Session::flash('message', 'An error occured!');
            Session::flash('alert-class', 'alert-warning');
        }
        return redirect(route('account.sales'));
        dd($sales->sales_details->sum('total_amount'));
   

    }

   
    }
    public function deleteSales($id)
    {
        $deleted = $this->salesRepository->deleteFarmSales($id);
        if ($deleted) {
            $data = [
                'status' => '1',
                'msg' => 'success',
            ];
        } else {
            $data = [
                'status' => '0',
                'msg' => 'fail',
            ];
        }
        return json_encode($data);
    }



    public function arrayContainsDuplicate($array)  
    {  
          return count($array) != count(array_unique($array));    
    } 

}
