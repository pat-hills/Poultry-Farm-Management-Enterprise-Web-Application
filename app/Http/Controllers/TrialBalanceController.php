<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Repositories\JournalsRepository;
use App\Repositories\ChartsOfAccountRepository;
use App\Repositories\ProfitAndLossRepository;
use App\Repositories\TrialBalanceRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
//ChartsOfAccountRepository

class TrialBalanceController extends Controller
{
    private $journalrepository;
    private $chartofaccountrepository;
    private $profitandlossrepository;
    private $trialbalancerepository;

    public function __construct(JournalsRepository $journalrepository,
    ChartsOfAccountRepository $chartofaccountrepository,ProfitAndLossRepository $profitandlossrepository,
    TrialBalanceRepository $trialbalancerepository
    
    )
    {
        $this->journalrepository = $journalrepository;
        $this->chartofaccountrepository = $chartofaccountrepository;
        $this->profitandlossrepository = $profitandlossrepository;
        $this->trialbalancerepository = $trialbalancerepository;
    }

    public function index()
    {
        $user = Auth::user();
        $journals = $this->profitandlossrepository->getAllJournals($user->farm_id);
        $chartaccounts = $this->chartofaccountrepository->getAllAccounts($user->farm_id);
        $getAllIncome = $this->profitandlossrepository->getAllIncome($user->farm_id);
        $getAllSalesSumAsIncome = $this->profitandlossrepository->getAllSalesSumAsIncome($user->farm_id);
        $getAllPaybleSumAsExpense = $this->profitandlossrepository->getAllPaybleSumAsExpense($user->farm_id);
        $getAllAccountsOfFarmFromJournal = $this->trialbalancerepository->getAllAccountsOfFarmFromJournal($user->farm_id);
       


           //SUM OF ALL SALES MADE FROM FARM
           foreach($getAllSalesSumAsIncome as $getAllSalesSumAsIncome){
            $bb =  $getAllSalesSumAsIncome->SUMOFFARMSALES;
          }

          //SUM OF ALL PAYABLES MADE FROM FARM
          foreach($getAllPaybleSumAsExpense as $getAllPaybleSumAsExpense){
            $aa =  $getAllPaybleSumAsExpense->SUMOFFARMPAYABLES;
          }

        $response = ['getAllAccountsOfFarmFromJournal' => $getAllAccountsOfFarmFromJournal
    ,'bb'=>$bb,'aa' => $aa ];


        return view('users.trialbalance',$response );  
    }

    // public function getAllIncome(){
    //     $user = Auth::user();
    //     $getAllIncome = $this->profitandlossrepository->getAllIncome($user->farm_id);
    //     return view('users.profitandloss', ['getAllIncome' => $getAllIncome]);  
    // }





    public function createjournals(Request $request)
    {
        $user = $request->user();
        if ($request->isMethod('post')) {
            $acccitem = $request->except('_token');
            $acccitem['farm_id'] = $request->user()->farm_id;
            $acccitem['created_by'] = $request->user()->id;
            $acccitem['acc_type']= $this-> chartofaccountrepository->getAccountTypeByname($request->user()->farm_id,$request->acc_name);
            $saved = $this->journalrepository->createJournal($acccitem);
            if ($saved) {
                Session::flash('message', 'Accounts have been saved successfully!');
                Session::flash('alert-class', 'alert-success');
            } else {
                Session::flash('message', 'An error occured!');
                Session::flash('alert-class', 'alert-danger');
            }
        }

        return redirect(route('account.journals'));
    }
}
