<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//
use App\Repositories\JournalsRepository;
use App\Repositories\ChartsOfAccountRepository;
use App\Repositories\ProfitAndLossRepository;
use App\Repositories\BalanceSheetRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
//ChartsOfAccountRepository

class BalanceSheetController extends Controller
{
    private $journalrepository;
    private $chartofaccountrepository;
    private $profitandlossrepository;
    private $balancesheetrepository;

    public function __construct(JournalsRepository $journalrepository,
    ChartsOfAccountRepository $chartofaccountrepository,ProfitAndLossRepository $profitandlossrepository,
    BalanceSheetRepository $balancesheetrepository)
    {
        $this->journalrepository = $journalrepository;
        $this->chartofaccountrepository = $chartofaccountrepository;
        $this->profitandlossrepository = $profitandlossrepository;
        $this->balancesheetrepository = $balancesheetrepository;
    }

    public function index()
    {
        $user = Auth::user();
        $journals = $this->profitandlossrepository->getAllJournals($user->farm_id);
        $chartaccounts = $this->chartofaccountrepository->getAllAccounts($user->farm_id);
        $getAllIncome = $this->profitandlossrepository->getAllIncome($user->farm_id);

        $getSumIncomeOfFarmJournal = $this->profitandlossrepository->getSumIncomeOfFarmJournal($user->farm_id);
        $getSumExpenseOfFarmJournal = $this->profitandlossrepository->getSumExpenseOfFarmJournal($user->farm_id);
        $getAllSalesSumAsIncome = $this->profitandlossrepository->getAllSalesSumAsIncome($user->farm_id);
        $getAllPaybleSumAsExpense = $this->profitandlossrepository->getAllPaybleSumAsExpense($user->farm_id);
       
        $getAllAssestsOfFarmFromJournal = $this->balancesheetrepository->getAllAssestsOfFarmFromJournal($user->farm_id);
        $getAllLiabilityOfFarmFromJournal = $this->balancesheetrepository->getAllLiabilityOfFarmFromJournal($user->farm_id);
     
     $getAllEquityOfFarmFromJournal = $this->balancesheetrepository->getAllEquityOfFarmFromJournal($user->farm_id);
     $getSumTotalAssestOfFarmJournal = $this->balancesheetrepository->getSumTotalAssestOfFarmJournal($user->farm_id);
     $getSumTotalLiabilitiesOfFarmJournal = $this->balancesheetrepository->getSumTotalLiabilitiesOfFarmJournal($user->farm_id);
     $getSumTotalEquityOfFarmJournal = $this->balancesheetrepository->getSumTotalEquityOfFarmJournal($user->farm_id);
     
        foreach($getSumTotalAssestOfFarmJournal as $asstotal){
            $a  =  number_format($asstotal->ASSESTSUMBAL, 2, ".", ",");
          //  $a  =  $asstotal->ASSESTSUMBAL;
           }

           foreach($getSumTotalLiabilitiesOfFarmJournal as $liabilitu){
            $b  =  number_format($liabilitu->LIABILITIESSUMBAL, 2, ".", ",");
           // $b  =  $liabilitu->LIABILITIESSUMBAL;
           }

           foreach($getSumTotalEquityOfFarmJournal as $equity){
            $c  =  number_format($equity->EQUITIESSUMBAL, 2, ".", ",");   
           // $  =  $equity->EQUITIESSUMBAL;
           }





         //SUM OF TOTAL EXPENSE FROM JOURNAL
         foreach($getSumExpenseOfFarmJournal as $totaexponsej){
            $ae  =  $totaexponsej->EXPENSESUMCREDIT;
           }
               //SUM OF TOTAL INCOME FROM JOURNAL
           foreach($getSumIncomeOfFarmJournal as $totalincomej){
            $be =  $totalincomej->INCOMESUMCREDIT;
          }
  
            //SUM OF ALL SALES MADE FROM FARM
          foreach($getAllSalesSumAsIncome as $getAllSalesSumAsIncome){
              $bb =  $getAllSalesSumAsIncome->SUMOFFARMSALES;
            }
  
            //SUM OF ALL PAYABLES MADE FROM FARM
            foreach($getAllPaybleSumAsExpense as $getAllPaybleSumAsExpense){
              $aa =  $getAllPaybleSumAsExpense->SUMOFFARMPAYABLES;
            }
  
            $total_income = $be + $bb;
            $total_expense = $ae + $aa;
  
  //ALL EXPENSE - ALL INCOMES FOR NET PROFIT AND LOSS
          $get_balance_paid = ($ae + $aa) - ($be + $bb);
          if($get_balance_paid){
              if($get_balance_paid==0){
          $get_balance_paid =   $get_balance_paid." -"."";
            }elseif ($get_balance_paid<0) {
         $get_balance_paid = str_replace("-", "", number_format($get_balance_paid, 2, ".", ",")) . " Profit";
           }  else {
  
         $get_balance_paid = number_format($get_balance_paid, 2, ".", ",")." Loss";
           }
  }

       
        $response = ['getAllAssestsOfFarmFromJournal' => $getAllAssestsOfFarmFromJournal, 'getAllLiabilityOfFarmFromJournal' => $getAllLiabilityOfFarmFromJournal
        ,'getSumIncomeOfFarmJournal' => $getSumIncomeOfFarmJournal,'getSumExpenseOfFarmJournal' => $getSumExpenseOfFarmJournal,
          'getAllSalesSumAsIncome' => $getAllSalesSumAsIncome,'getAllPaybleSumAsExpense' => $getAllPaybleSumAsExpense,'adv' => $a,'b' => $b,
          'getAllEquityOfFarmFromJournal' => $getAllEquityOfFarmFromJournal,'c' => $c,'get_balance_paid' => $get_balance_paid
          ];
        return view('users.balancesheet', $response);  
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
