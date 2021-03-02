<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository
{

    public function getAllCustomers($farm_id)
    {
        return Customer::where('farm_id', $farm_id)->get();
    }

    public function createCustomer($customer)
    {
        return Customer::create($customer);
    }

    public function updateCustomer($id, $customer)
    {
        return Customer::where('id', $id)->update($customer);
    }

    public function getCustomerById($id)
    {
        return Customer::find($id);
    }

    public function deleteCustomer($id)
    {
        return Customer::destroy($id);
    }
}
