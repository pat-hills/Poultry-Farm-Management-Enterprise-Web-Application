<?php

namespace App\Http\Controllers;

use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    //
    private $customerRepository;
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function index()
    {
        $user = Auth::user();
        $customers = $this->customerRepository->getAllCustomers($user->farm_id);
        return view('users.customers', ['customers' => $customers]);
    }

    public function createCustomer(Request $request)
    {
        if ($request->isMethod('get')) {
            return view();
        } else {
            $user = $request->user();
            $customerInfo = ['name' => $request->name, 'email' => $request->email,
                'residence' => $request->residence, 'contact' => $request->contact,
                'customer_code' => $request->contact,
                'farm_id' => $user->farm_id, 'created_by' => $user->id];
            $customer = $this->customerRepository->createCustomer($customerInfo);
            if ($customer) {
                Session::flash('message', 'Customer saved successfully!');
                Session::flash('alert-class', 'alert-success');
            } else {
                Session::flash('message', 'An error occured, we could not save the information!');
                Session::flash('alert-class', 'alert-warning');
            }
            return redirect(route('account.customer'));
        }

    }

    public function updateCustomer(Request $request, $id)
    {
        if ($request->isMethod('get')) {
            return view();
        } else {
            $user = $request->user();
            $customerInfo = ['name' => $request->name, 'email' => $request->email,
                'residence' => $request->residence, 'contact' => $request->contact];
            $customer = $this->customerRepository->updateCustomer($id, $customerInfo);
            if ($customer) {
                Session::flash('message', 'Customer updated successfully!');
                Session::flash('alert-class', 'alert-success');
            } else {
                Session::flash('message', 'An error occured, we could not save the information!');
                Session::flash('alert-class', 'alert-warning');
            }
            return redirect(route('account.customer'));
        }

    }

    public function deleteCustomer(Request $request, $id)
    {
        if ($request->isMethod('get')) {
            return view();
        } else {
            $customer = $this->customerRepository->getCustomerById($id);
            if (count($customer->farm_sales) > 0) {
                $data = [
                    'status' => '0',
                    'id' => $customer->id,
                    'msg' => 'fail, constraint',
                ];
            } else {
                $deleted = $this->customerRepository->deleteCustomer($id);
                if ($deleted) {
                    $data = [
                        'status' => '1',
                        'id' => $customer->id,
                        'msg' => 'success',
                    ];
                } else {
                    $data = [
                        'status' => '0',
                        'id' => $customer->id,
                        'msg' => 'fail',
                    ];
                }
            }
        }
        return json_encode($data); 
    }

}
