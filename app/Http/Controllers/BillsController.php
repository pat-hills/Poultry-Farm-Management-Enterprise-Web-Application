<?php

namespace App\Http\Controllers;

use App\Repositories\FarmItemRepository;
use App\Repositories\FarmPayableDetailRepository;
use App\Repositories\FarmPayableRepository;
use App\Repositories\StockTrackingRepository;
use App\Repositories\VendorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BillsController extends Controller
{
    //
    protected $vendorRepository;
    protected $farmPayableRepository;
    protected $stockTrackingRepository;
    protected $farmPayableDetailRepository;

    public function __construct(VendorRepository $vendorRepository, StockTrackingRepository $stockTrackingRepository,
        FarmPayableDetailRepository $farmPayableDetailRepository, FarmPayableRepository $farmPayableRepository,
        FarmItemRepository $farmItemRepository) {
        $this->vendorRepository = $vendorRepository;
        $this->stockTrackingRepository = $stockTrackingRepository;
        $this->farmPayableDetailRepository = $farmPayableDetailRepository;
        $this->farmPayableRepository = $farmPayableRepository;
        $this->farmItemRepository = $farmItemRepository;
    }

    public function index()
    {
        $user = Auth::user();
        $batchCycle = $this->stockTrackingRepository->getStockTrackingByFarmId($user->farm_id);
        $vendors = $this->vendorRepository->getAllVendorForFarm($user->farm_id);
        $billItems = $this->farmItemRepository->getAllItems($user->farm_id);
        $getAllItemsF = $this->farmItemRepository->getAllItemsF($user->farm_id);
        $getAllBillItems = $this->farmItemRepository->getAllBillItems($user->farm_id);
        //getAllItemsF
        return view('users.createbill', ['vendors' => $vendors,'getAllItemsF'=>$getAllItemsF, 'batchCycles' => $batchCycle, 'billItems' => $billItems,'getAllBillItems' => $getAllBillItems]);
    }

    public function billdetails($id)
    {
        $user = Auth::user();
        $billItems = $this->farmItemRepository->getAllItems($user->farm_id);
        $getAllItemsF = $this->farmItemRepository->getAllItemsF($user->farm_id);
        $batchCycle = $this->stockTrackingRepository->getStockTrackingByFarmId($user->farm_id);
        $billsDetails = $this->farmPayableDetailRepository->getFarmBillsDetails($id);
        $bill = $this->farmPayableRepository->findFarmBillById($id);
        $vendors = $this->vendorRepository->getAllVendorForFarm($user->farm_id);
        $payments = $bill->farm_payable_payments;
        // echo $payments;
        $args = ['payments' => $payments,'getAllItemsF' => $getAllItemsF, 'bill' => $bill,
            'vendors' => $vendors, 'batchCycles' => $batchCycle,
            'billItems' => $billItems, 'billsDetail' => $bill->farm_payables_details];
        // echo json_encode($args);
        return view('users.viewbilldetails', $args);
    }

    public function viewBills(FarmPayableRepository $farmPayableRepository,
        VendorRepository $vendorRepository, StockTrackingRepository $stockTrackingRepository) {
        $user = Auth::user();
        $bills = $farmPayableRepository->viewAllBillsForFarm($user->farm_id);
        $vendors = $vendorRepository->getAllVendorForFarm($user->farm_id);
        $batchCycle = $stockTrackingRepository->getStockTrackingByFarmId($user->farm_id);
        return view('users.viewbill', ['bills' => $bills, 'vendors' => $vendors, 'batchCycles' => $batchCycle]);
    }
    
    public function deletebill($id)
    {
        $deleted = $this->farmPayableRepository->deleteFarmPayable($id);
        if ($deleted) {
            $data = [
                'status' => '1',
                'msg' => 'Success',
            ];
        } else {
            $data = [
                'status' => '0',
                'msg' => 'fail, constraint',
            ];
        }
        return json_encode($data);
    }

    public function createBills(Request $request, FarmPayableRepository $farmPayableRepository,
        FarmPayableDetailRepository $farmPayableDetailRepository) {

     if($this->arrayContainsDuplicate($request->input('billItem'))){
        Session::flash('messagefailed', 'Your bills have duplicated item! Please check items before saving bill');
        Session::flash('alert-class', 'alert-danger');
        return redirect(route('account.viewbills'));
     }
     else{


        $user = $request->user();
        $dateDue = $request->dateDue;
        $dateIssued = $request->dateIssued;
        $farmPayableData = ['vendor_id' => $request->vendor, 'batch_id' => $request->batchId,
            'batch_id' => $request->batchId, 'invoice_number' => $request->invoiceNumber,
            'description' => $request->description, 'currency' => $request->currency,
            'date_due' => $request->dateDue, 'date_issued' => $request->dateIssued,
            'created_by' => $user->id, 'farm_id' => $user->farm_id];
        $farmPayable = $farmPayableRepository->saveFarmPayable($farmPayableData);


        for ($i = 0; $i < count($request->input('billItem')); $i++) {
            $farmPayableDetail = ['farm_payables_id' => $farmPayable, 'created_by' => $user->id, 'item_id' => $request->billItem[$i],
                'quantity' => $request->quantity[$i], 'price' => $request->amount[$i], 'total_amount' => $request->amount[$i] * $request->quantity[$i]];
            $farmPayableDetailRepository->savePayableItems($farmPayableDetail);

            
        }


        Session::flash('message', 'Your bills have been saved successfully!');
        Session::flash('alert-class', 'alert-success');
        return redirect(route('account.viewbills'));

    }


    }
    public function updateBillsDetail(Request $request, $id)
    {
        $dateDue = $request->dateDue;
        $dateIssued = $request->dateIssued;
        // echo count($request->billId);
        $farmPayable = $this->farmPayableRepository->updateFarmPayable($id, $request->user(), $request->vendor,
            $request->batchId, $dateDue, $dateIssued,
            $request->currency, $request->invoiceNumber,
            $request->description);

        for ($i = 0; $i < count($request->input('billItem')); $i++) {
            $this->farmPayableDetailRepository->updatePayableItems($request->billId[$i], $request->user(), $farmPayable,
                $request->input('billItem')[$i], $request->input('quantity')[$i],
                $request->input('amount')[$i]);
        }

        Session::flash('message', 'Your bills have been saved successfully!');
        Session::flash('alert-class', 'alert-success');
        return redirect(route('account.viewbills'));
    }

    public function deleteBillItem($id)
    {
        $this->farmPayableDetailRepository->deletePayableItem($id);
    }

    public function stringToDate($date)
    {
        return DateTime::createFromFormat('m-d-Y', $date)->format('Y-m-d');
    }

 

   public function arrayContainsDuplicate($array)  
{  
      return count($array) != count(array_unique($array));    
} 

}
