<?php

namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository
{

    public function getAllEmployee($farm_id)
    {
        return Employee::where('farm_id', $farm_id)->get();
    }

    public function createEmployee($employee)
    {
        return Employee::create($employee);
    }

    public function updateEmployee($id, $farmId, $employee)
    {
        return Employee::where(['id'=> $id, 'farm_id' => $farmId])->update($employee);
    }

    public function getEmployeeById($id)
    {
        return Employee::find($id);
    }

    public function deleteEmployee($id, $farmId)
    {
        return Employee::where(['id' => $id, 'farm_id' => $farmId])->delete();
    }
}
