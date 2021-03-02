<?php

namespace App\Http\Controllers;

use App\Repositories\BilltemsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BillItemsController extends Controller
{
    private $billItemRepository;

    public function __construct(BilltemsRepository $billItemRepository)
    {
        $this->billItemRepository = $billItemRepository;
    }

    public function index()
    {
       // $user = Auth::user();
        $getAllItemsF = $this->billItemRepository->getAllItemsF();
        return view('users.farm_items', ['getAllItemsF' => $getAllItemsF]);
    }

//createSaleItem


 

    public function createBillItem(Request $request)
    {
        $user = $request->user();
        if ($request->isMethod('post')) {
            $billItem = $request->except('_token');
            $billItem['status_bill_sale'] = "Bill";
            $billItem['farm_id'] = $request->user()->farm_id;
            $billItem['created_by'] = $request->user()->id;
            $saved = $this->billItemRepository->createFarmItem($billItem);
            if ($saved) {
                Session::flash('message', 'Items have been saved successfully!');
                Session::flash('alert-class', 'alert-success');
            } else {
                Session::flash('message', 'An error occured!');
                Session::flash('alert-class', 'alert-danger');
            }
        }

        return redirect(route('account.billitems'));
    }

    public function updateBillItem(Request $request, $id)
    {
        $user = $request->user();
        if ($request->isMethod('post')) {
            $billItem = $request->except('_token');
            $updated = $this->billItemRepository->updateBillItem($id, $billItem);
            if ($updated) {
                Session::flash('message', 'Items have been saved successfully!');
                Session::flash('alert-class', 'alert-success');
            } else {
                Session::flash('message', 'An error occured!');
                Session::flash('alert-class', 'alert-danger');
            }
        }
        return redirect(route('account.billitems'));
    }

    public function deleteBillItem(Request $request, $id)
    {
        if ($request->isMethod('get')) {
            return view();
        } else {
            $billItem = $this->billItemRepository->findBillItemById($id);
            if (!$billItem) {
                $data = [
                    'status' => '0',
                    'id' => $billItem->id,
                    'msg' => 'fail, constraint',
                ];
            } else {
                $deleted = $this->billItemRepository->deleteBillItem($id);
                if ($deleted) {
                    $data = [
                        'status' => '1',
                        'id' => $billItem->id,
                        'msg' => 'success',
                    ];
                } else {
                    $data = [
                        'status' => '0',
                        'id' => $billItem->id,
                        'msg' => 'fail',
                    ];
                }
            }
        }
        return json_encode($data);
    }

    public function deleteBillItem2(Request $request, $id)
    {
       
                $deleted = $this->billItemRepository->deleteBillItem2($request->user(),$id);
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

}
