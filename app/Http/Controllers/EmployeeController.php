<?php

namespace App\Http\Controllers;

use App\Repositories\EmployeeRepository;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $employeeRepository;
    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function createEmployee(Request $request)
    {
        $user = $request->user();
        if ($request->isMethod('get')) {
            $employees = $this->index($user);
            $response = ['employees' => $employees];
            return view('users.employee', $response);
        } else if ($request->isMethod('post')) {
            $employee = $request->except('_token');
            $employee['farm_id'] = $user->farm_id;
            $employee['created_by'] = $user->id;
            $this->saveEmployee($employee);
            return redirect(route('account.employee'));
        }
    }
    public function index($user)
    {
        return $this->employeeRepository->getAllEmployee($user->farm_id);
    }

    public function saveEmployee($employee)
    {
        $this->employeeRepository->createEmployee($employee);
    }

    public function updateEmployee(Request $request, $id)
    {
        $user = $request->user();
        $employee = $request->except(['_token', '_method']);
        $this->employeeRepository->updateEmployee($id, $user->farm_id, $employee);
        return redirect(route('account.employee'));
    }
    
    public function deleteEmployee(Request $request, $id)
    {
        $user = $request->user();
       $deleted = $this->employeeRepository->deleteEmployee($id, $user->farm_id);
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
}
