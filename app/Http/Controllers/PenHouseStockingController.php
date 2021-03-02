<?php

namespace App\Http\Controllers;

use App\Models\PenHouse;
use App\Repositories\FarmItemRepository;
use App\Repositories\FarmPayableDetailRepository;
use App\Repositories\FarmPayablePaymentRepository;
use App\Repositories\FarmPayableRepository;
use App\Repositories\PenHouseRepository;
use App\Repositories\PenHouseStockingRepository;
use App\Repositories\StockTrackingRepository;
use App\Repositories\VendorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PenHouseStockingController extends Controller
{
    private $penHouseStockingRepository;
    private $penHouseRepository;
    private $stockTrackingRepository;
    private $vendorRepository;
    private $farmItemRepository;
    private $farmPayableRepository;
    private $farmPayableDetailRepository;
    private $farmPayablePaymentRepository;

    public function __construct(PenHouseStockingRepository $penHouseStockingRepository,
        FarmItemRepository $farmItemRepository, PenHouseRepository $penHouseRepository,
        FarmPayablePaymentRepository $farmPayablePaymentRepository, FarmPayableDetailRepository $farmPayableDetailRepository,
        FarmPayableRepository $farmPayableRepository, StockTrackingRepository $stockTrackingRepository,
        VendorRepository $vendorRepository) {
        $this->penHouseStockingRepository = $penHouseStockingRepository;
        $this->penHouseRepository = $penHouseRepository;
        $this->stockTrackingRepository = $stockTrackingRepository;
        $this->vendorRepository = $vendorRepository;
        $this->farmItemRepository = $farmItemRepository;
        $this->farmPayableRepository = $farmPayableRepository;
        $this->farmPayableDetailRepository = $farmPayableDetailRepository;
        $this->farmPayablePaymentRepository = $farmPayablePaymentRepository;
    }

    public function penHouseStockingView()
    {
        $farm_id = Auth::user()->farm_id;
        $penHouses = $this->penHouseRepository->nonStockedPenHouseForFarm($farm_id);
        $batch = $this->stockTrackingRepository->getStockTrackingByFarmId($farm_id);
        $maxBatch = $this->stockTrackingRepository->getMaxBatchIdForFarm($farm_id);
        $penHouseStocking = $this->penHouseStockingRepository->getAllPenHouseStockingForFarm($farm_id);
        // echo $penHouseStocking[0]->pen_house_id;
        $response = ['penHouses' => $penHouses, 'batches' => $batch, 'maxBatch' => $maxBatch, 'penHouseStocking' => $penHouseStocking];
       
        // echo json_encode($response);
        return view('users.stockingsetup', $response);
    }

    public function createOrUpdateStocking(Request $request)
    {

        $ldate = date('Y-m-d H:i:s');
        $user = $request->user();
        $bill ="Bill";
        $batchNumberExist = $this->stockTrackingRepository->findStockTrackingByBatchId($request->batchId, $user->farm_id);
        if (!$batchNumberExist) {

            $batchId = $this->stockTrackingRepository->createOrUpdateStockTracking($user, $request->batchId);
            $itemId = $this->farmItemRepository->createFarmItemFromStocking($user, $request->typeOfBird, $request->amount,$bill);
            $vendorId = $this->vendorRepository->createVendor($user, $request->vendorName);
           // $paidstock = $request->paidstock;
            $farmPayable = ['created_by' => $user->id, 'farm_id' => $user->farm_id, 'vendor_id' => $vendorId,
                'batch_id' => $batchId, 'date_due' => $request->dateDue];
            $farmPayableId = $this->farmPayableRepository->saveFarmPayable($farmPayable);
            $penstocking = ['batch_id' => $batchId, 'number_of_stock' => $request->numberOfStock,
                'type_of_bird' => $request->typeOfBird, 'pen_house_id' => $request->penHouse,
                'farm_id' => $user->farm_id, 'penhouse_identity' => $batchId . "/" . $request->penHouse,
                'created_by' => $user->id, 'description' => $request->description,
                'vendor_id' => $vendorId, 'farm_payables_id' => $farmPayableId,'date_stocked' => $request->datestocked ];
                

            $penHouseStocking = $this->penHouseStockingRepository->createPenHouseStocking($penstocking);

            if ($penHouseStocking) {

                $changedstatus = "YES";
                // $changestatus =   ['stocked'=> 'YES'];
                $penHouse = PenHouse::findOrFail($request->penHouse);
                $penHouse->stocked = $changedstatus;
                $penHouse->save();

            }
            // $farmPayableDetailRepository->savePayableItems($user, $farmPayableId,
            //     $itemId, $request->numberOfStock, $request->amount,
            //     $request->amount * $request->numberOfStock);changePenStatus
            $farmPayablesDetail = ['farm_payables_id' => $farmPayableId, 'created_by' => $user->id, 'item_id' => $itemId, 'quantity' => $request->numberOfStock,
                'price' => $request->amount, 'total_amount' => $request->amount * $request->numberOfStock];
            $this->farmPayableDetailRepository->savePayableItems($farmPayablesDetail);


            //if (strcmp("YES", $paid)) {
            //     if(($request->checkme)) {
            //     $farmPayablePayment = ['created_by' => $user->id, 'farm_id' => $user->farm_id, 'vendor_id' => $vendorId,
            //         'amount_paid' => $request->amount, 'date_paid' => $request->datestocked, 'farm_payable_id' => $farmPayableId];
            //     $this->farmPayablePaymentRepository->createFarmPayablePayment($farmPayablePayment);
            // }
            Session::flash('message', "Pen house stocking created successfully");
            Session::flash('alert-class', 'alert-success');
        } else {
            Session::flash('message', "Batch Number already exist");
            Session::flash('alert-class', 'alert-warning');
        }
        return redirect(route('onboarding.stocking'));
    }

    public function updatePenHouseStocking(Request $request, $id)
    {
        $user = $request->user();
        // get the current penhouse stocking about to be updated. This will help
        // us compare the old state to the knew once to see if there are any new changes
        $currentPenHouseStocking = $this->penHouseStockingRepository->findPenHouseStockingById($id);
        $stockTracking = ['batch_id' => $request->batchId, 'farm_id' => $user->farm_id];
        $batchId = $this->stockTrackingRepository->createStockTracking($stockTracking, $user);
        $batchNumberExist = $this->stockTrackingRepository->findStockTrackingByBatchId($request->batchId, $user->farm_id);

        if ($batchNumberExist->id == $currentPenHouseStocking->batch_id) {

            $itemId = $this->farmItemRepository->createFarmItemFromStocking($user, $request->typeOfBird, $request->amount);
            $vendorId = $this->vendorRepository->createVendor($user, $request->vendorName);
            $paid = $request->paid;
            $penstocking = ['batch_id' => $batchId, 'number_of_stock' => $request->numberOfStock,
                'type_of_bird' => $request->typeOfBird, 'farm_id' => $user->farm_id, 'created_by' => $user->id,
                'description' => $request->description, 'vendor_id' => $vendorId];
            if ($request->penHouse) {
                $penstocking['pen_house_id'] = $request->penHouse;
                $penstocking['penhouse_identity'] = $currentPenHouseStocking->batch_id . "/" . $request->penHouse;
            }
            $penHouseStocking = $this->penHouseStockingRepository->updatePenhousingStocking($id, $penstocking);
            $farmPayableId = $currentPenHouseStocking->farm_payable->id;
            $farmPayable = ['batch_id' => $batchId, 'vendor_id' => $vendorId, 'date_due' => $request->dateDue];
            $this->farmPayableRepository->updateFarmPayableById($farmPayableId, $farmPayable);
            $farmPayablesDetail = ['item_id' => $itemId, 'quantity' => $request->numberOfStock,
                'price' => $request->amount, 'total_amount' => $request->amount * $request->numberOfStock];
            $this->farmPayableDetailRepository->updateFarmPayableDetailByfarmPayableId($farmPayableId, $farmPayablesDetail);
            if ($request->penHouse) {
                if ($penHouseStocking) {
                    $changedstatus = "YES";
                    // $changestatus =   ['stocked'=> 'YES'];
                    $penHouse = PenHouse::findOrFail($request->penHouse);
                    $penHouse->stocked = $changedstatus;
                    $penHouse->save();
                    $prevPenHouse = $currentPenHouseStocking->pen_house;
                    $prevPenHouse->stocked = 'NO';
                    $prevPenHouse->save();
                }
            }
            Session::flash('message', "Pen house stocking updated successfully");
            Session::flash('alert-class', 'alert-success');
        } else {
            Session::flash('message', "Batch Number already exist");
            Session::flash('alert-class', 'alert-warning');
            echo "exist";
        }
        return redirect(route('onboarding.stocking'));
    }

    public function dashPenHouseStockingView()
    {
        $farm_id = Auth::user()->farm_id;
        $penHouses = $this->penHouseRepository->nonStockedPenHouseForFarm($farm_id);
        $batch = $this->stockTrackingRepository->getStockTrackingByFarmId($farm_id);
        $maxBatch = $this->stockTrackingRepository->getMaxBatchIdForFarm($farm_id);
        // echo json_encode($maxBatch);
        $penHouseStockingdas = $this->penHouseStockingRepository->getAllPenHouseStockingForFarm($farm_id);
        // dd($penHouseStocking);

        $vendors = $this->vendorRepository->getAllVendorForFarm($farm_id);
        $response = ['penHouses' => $penHouses, 'batches' => $batch, 'maxBatch' => $maxBatch, 'penHouseStockingdas' => $penHouseStockingdas, 'vendors' => $vendors];
        
        return view('users.stock', $response);
    }

    public function createOrUpdateDashStocking(Request $request)
    {
        $user = $request->user();
        $stockTracking = ['batch_id' => $request->batchId, 'farm_id' => $user->farm_id, 'created_by' => $user->id];
        $batchId = $this->stockTrackingRepository->createStockTracking($stockTracking, $user);
           $bill ="Bill";
        $itemId = $this->farmItemRepository->createFarmItemFromStocking($user, $request->typeOfBird, $request->amount,$bill);
        // $vendorId = $vendorRepository->createVendor($user, $request->vendorName);
        $paid = $request->paid;
        $farmPayable = ['farm_id' => $user->farm_id, 'vendor_id' => $request->vendor,
            'batch_id' => $batchId, 'date_due' => $request->dateDue,
            'created_by' => $user->id];
        $farmPayableId = $this->farmPayableRepository->saveFarmPayable($farmPayable);
        // $farmPayableId = $this->farmPayableRepository->saveFarmPayable($user, $request->vendor, $batchId, $request->dateDue, $request->dateIssued);

        $penHouseStocking = ['created_by' => $user->id, 'batch_id' => $batchId,
            'number_of_stock' => $request->numberOfStock, 'type_of_bird' => $request->typeOfBird,
            'pen_house_id' => $request->penHouse,'penhouse_identity' => $batchId . "/" . $request->penHouse, 'description' => $request->descriptiontchId,
            'vendor_id' => $request->vendor, 'farm_payables_id' => $farmPayableId,
            'farm_id' => $user->id];
        $penHouseStocking = $this->penHouseStockingRepository->createPenHouseStocking($penHouseStocking);
        if ($penHouseStocking) {
            $this->penHouseRepository->changePenHouseStockStatus($request->penHouse, "YES");
        }
        $farmPayableDetails = ['created_by' => $user->id, 'price' => $request->amount,
            'total_amount' => $request->amount * $request->numberOfStock, 'farm_payables_id' => $farmPayableId,
            'item_id' => $itemId, 'quantity' => $request->numberOfStock];
        $this->farmPayableDetailRepository->savePayableItems($farmPayableDetails);

        if (strcmp("YES", $paid) == 0) {
            $farmPayablePayment = ['created_by' => $user->id, 'farm_payable_id' => $farmPayableId,
                'vendor_id' => $user->id, 'farm_id' => $user->farm_id, 'amount_paid' => $request->amount,'mode_of_payment'=>'CASH'];
            $this->farmPayablePaymentRepository->createFarmPayablePayment($farmPayablePayment);
        }
        Session::flash('message', 'You have succesfully stocked your penhouse!');
        Session::flash('alert-class', 'alert-success');
        return redirect(route('birds.stock'));
    }

    public function updateDashStocking(Request $request, $id)
    {
        $user = $request->user();
        $penStocking = $this->penHouseStockingRepository->findPenHouseStockingById($id);
        $stockTracking = ['batch_id' => $request->batchId, 'farm_id' => $user->farm_id, 'created_by' => $user->id];
        $batchId = $this->stockTrackingRepository->createStockTracking($stockTracking, $user);

        $itemId = $request->farmitemid;

        //findFarmItemAndUpdate
        // $vendorId = $vendorRepository->createVendor($user, $request->vendorName);
        $paid = $request->paid;
        $farmPayableId = $penStocking->farm_payables_id;
        $farmPayable = ['vendor_id' => $request->vendor, 'batch_id' => $request->vendor, 'date_due' => $request->dateDue];
        $this->farmPayableRepository->updateFarmPayableById($farmPayableId, $farmPayable);

        $penHouseStocking = ['batch_id' => $batchId, 'number_of_stock' => $request->numberOfStock,
            'type_of_bird' => $request->typeOfBird, 'description' => $request->descriptiontchId, 'vendor_id' => $request->vendor,
            'date_stocked' => $request->dtstocked,
        ];
        // if ($request->penHouse !== '') {
        //     $penHouseStocking['pen_house_id'] = $request->penHouse;
        //     $this->penHouseRepository->changePenHouseStockStatus($request->penHouse, "YES");
        //     $this->penHouseRepository->changePenHouseStockStatus($penStocking->pen_house_id, "NO");
        // }
        $penHouseStocking = $this->penHouseStockingRepository->updatePenhousingStocking($id, $penHouseStocking);
        if ($penStocking->farm_payable->farm_payables_details) {
            $farmPayableDetailId = $penStocking->farm_payable->farm_payables_details[0]->id;
            $farmPayableDetails = ['price' => $request->amount,
                'total_amount' => $request->amount * $request->numberOfStock , 'item_id' => $itemId,
                'quantity' => $request->numberOfStock];
            $this->farmPayableDetailRepository->updateFarmPayableDetailById($farmPayableDetailId, $farmPayableDetails);
        } else {
            $farmPayableDetails = ['created_by' => $user->id, 'price' => $request->amount,
                'total_amount' => $request->amount * $request->numberOfStock, 'farm_payables_id' => $farmPayableId,
                'item_id' => $itemId, 'quantity' => $request->numberOfStock];
            $this->farmPayableDetailRepository->savePayableItems($farmPayableDetailId, $farmPayableDetails);
        }

        if($itemId){
            $this->farmItemRepository->findFarmItemAndUpdate($itemId,$request->typeOfBird,$request->amount);
        }

        // if (strcmp("YES", $paid) == 0) {
        //     if ($penStocking->farm_payable->farm_payable_payments) {
        //         $farmPayablePaymentId = $penStocking->farm_payable->farm_payable_payments[0];
        //         $farmPayablePayment = ['farm_payable_id' => $farmPayableId,
        //             'vendor_id' => $user->id, 'amount_paid' => $request->amount];
        //         $this->farmPayablePaymentRepository->updateFarmPayableById($farmPayablePaymentId, $farmPayablePayment);
        //     } else {
        //         $farmPayablePayment = ['created_by' => $user->id, 'farm_payable_id' => $farmPayableId,
        //             'vendor_id' => $user->id, 'farm_id' => $user->farm_id, 'amount_paid' => $request->amount];
        //         $this->farmPayablePaymentRepository->createFarmPayablePayment($farmPayablePaymentId, $farmPayablePayment);
        //     }
        // }
        Session::flash('message', 'You have succesfully stocked your penhouse!');
        Session::flash('alert-class', 'alert-success');
        return redirect(route('birds.stock'));
    }

    //deleteStockingOnDashboard

    public function deletePenhouseStocking($id)
    {
        $penstocking = $this->penHouseStockingRepository->findPenHouseStockingById($id);
        $deleted = $this->penHouseStockingRepository->deletePenhouseStocking($id);
        $this->farmPayableRepository->deleteFarmPayable($penstocking->farm_payables_id);
        if ($deleted) {
            $data = [
                'status' => '1',
                'id' => $id,
                'msg' => 'success',
            ];
        } else {
            $data = [
                'status' => '0',
                'id' => $id,
                'msg' => 'failed',
            ];
        }
        return $data;
    }



  
    public function deleteStockingOnDashboard($id)
    {
        $penstocking = $this->penHouseStockingRepository->findPenHouseStockingById($id);
        $deleted = $this->penHouseStockingRepository->deletePenhouseStocking($id);
        $this->farmPayableRepository->deleteFarmPayable($penstocking->farm_payables_id);
        if ($deleted) {
            $data = [
                'status' => '1',
                'id' => $id,
                'msg' => 'success',
            ];
        } else {
            $data = [
                'status' => '0',
                'id' => $id,
                'msg' => 'failed',
            ];
        }
        return $data;
    }  

}
