<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\ChartsOfAccountRepository;
 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
//ChartsOfAccountRepository

class ChartOfAccountsController extends Controller
{
    private $chartofaccountrepository;

    public function __construct(ChartsOfAccountRepository $chartofaccountrepository)
    {
        $this->chartofaccountrepository = $chartofaccountrepository;
    }

    public function index()
    {
        $user = Auth::user();
        $chartaccounts = $this->chartofaccountrepository->getAllAccounts($user->farm_id);
        return view('users.chartsofaccounts', ['chartaccounts' => $chartaccounts]);
    }



    public function createaccounts(Request $request)
    {
        $user = $request->user();
        if ($request->isMethod('post')) {
            $acccitem = $request->except('_token');
            $acccitem['farm_id'] = $request->user()->farm_id;
            $acccitem['created_by'] = $request->user()->id;
            $saved = $this->chartofaccountrepository->createChartsOfAccounts($acccitem);
            if ($saved) {
                Session::flash('message', 'Accounts have been saved successfully!');
                Session::flash('alert-class', 'alert-success');
            } else {
                Session::flash('message', 'An error occured!');
                Session::flash('alert-class', 'alert-danger');
            }
        }

        return redirect(route('account.chartofaccountlist'));
    }
}
