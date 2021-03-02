<?php

namespace App\Http\Controllers;

use App\Repositories\FarmItemRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FarmItemsController extends Controller
{
    private $farmItemRepository;

    public function __construct(FarmItemRepository $farmItemRepository)
    {
        $this->farmItemRepository = $farmItemRepository;
    }

    public function index()
    {
        $user = Auth::user();
        $farmItems = $this->farmItemRepository->getAllItems($user->farm_id);
        return view('users.products', ['farmItems' => $farmItems]);
    }

    public function createFarmItem(Request $request)
    {
        $user = $request->user();
        if ($request->isMethod('post')) {
            $farmItems = $request->except('_token');
            $farmItems['farm_id'] = $request->user()->farm_id;
            $farmItems['created_by'] = $request->user()->id;
            $farmItems['status_bill_sale'] = 'Sale';
            $saved = $this->farmItemRepository->createFarmItem($farmItems);
            if ($saved) {
                Session::flash('message', 'Items have been saved successfully!');
                Session::flash('alert-class', 'alert-success');
            } else {
                Session::flash('message', 'An error occured!');
                Session::flash('alert-class', 'alert-danger');
            }
        }

        return redirect(route('account.items'));
    }

    public function updateFarmItem(Request $request, $id)
    {
        $user = $request->user();
        if ($request->isMethod('post')) {
            $farmItems = $request->except('_token');
            $updated = $this->farmItemRepository->updateFarmItem($id, $farmItem);
            if ($updated) {
                Session::flash('message', 'Items have been saved successfully!');
                Session::flash('alert-class', 'alert-success');
            } else {
                Session::flash('message', 'An error occured!');
                Session::flash('alert-class', 'alert-danger');
            }
        }
        return redirect(route('account.items'));
    }

    public function deleteFarmItem(Request $request, $id)
    {
       
                $deleted = $this->farmItemRepository->deleteFarmItem($request->user(),$id);
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
