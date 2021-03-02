<?php

namespace App\Http\Controllers;

use App\Repositories\EmployeeRepository;
use App\Repositories\PayrollRepository;
use Illuminate\Http\Request;
use \Datetime;

class PayrollController extends Controller
{
    protected $payrollRepository;
    protected $employeeRepository;

    public function __construct(PayrollRepository $payrollRepository,
        EmployeeRepository $employeeRepository) {
        $this->payrollRepository = $payrollRepository;
        $this->employeeRepository = $employeeRepository;
    }

    public function createPayroll(Request $request)
    {
        $user = $request->user();
        if ($request->isMethod('get')) {
            $employees = $this->index($user);
            $response = ['employees' => $employees];
            return view('users.farm_payroll', $response);
        } else if ($request->isMethod('post')) {
            $now = new DateTime();
            for ($i = 0; $i < count($request->amount); $i++) {
                $payroll = ['amount' => $request->amount[$i],
                    'employee_id' => $request->employeeid[$i], 'date_received' => $now];
                $payroll['farm_id'] = $user->farm_id;
                $payroll['created_by'] = $user->id;
                $payroll['updated_by'] = $user->id;
                $this->savepayroll($payroll);
            }
            return redirect(route('account.payroll'));
        }
    }
    public function index($user)
    {
        return $this->employeeRepository->getAllEmployee($user->farm_id);
    }

    public function savePayroll($payroll)
    {
        $this->payrollRepository->createFarmPayroll($payroll);
    }

    public function updatePayroll(Request $request, $id)
    {
        $user = $request->user();
        $payroll = $request->except(['_token', '_method']);
        $this->payrollRepository->updateFarmPayroll($id, $user->farm_id, $payroll);
        return redirect(route('account.payroll'));
    }

    public function deletePayroll(Request $request, $id)
    {
        $user = $request->user();
        $deleted = $this->payrollRepository->deleteFarmPayroll($id, $user->farm_id);
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
