<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Repositories\JournalsRepository;
use App\Repositories\ChartsOfAccountRepository;
use App\Repositories\ProfitAndLossRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
//ChartsOfAccountRepository

class ProfitAndLossController extends Controller
{
    private $journalrepository;
    private $chartofaccountrepository;
    private $profitandlossrepository;

    public function __construct(JournalsRepository $journalrepository,
    ChartsOfAccountRepository $chartofaccountrepository,ProfitAndLossRepository $profitandlossrepository)
    {
        $this->journalrepository = $journalrepository;
        $this->chartofaccountrepository = $chartofaccountrepository;
        $this->profitandlossrepository = $profitandlossrepository;
    }

    public function index()
    {
      
       //getAllSalesSumAsIncome
        $user = Auth::user();
        $journals = $this->profitandlossrepository->getAllJournals($user->farm_id);
        $chartaccounts = $this->chartofaccountrepository->getAllAccounts($user->farm_id);
        $getAllIncome = $this->profitandlossrepository->getAllIncome($user->farm_id);
        $getAllIncomeOfFarmFromJournal = $this->profitandlossrepository->getAllIncomeOfFarmFromJournal($user->farm_id);
        $getAllExpenseOfFarmFromJournal = $this->profitandlossrepository->getAllExpenseOfFarmFromJournal($user->farm_id);
        $getSumIncomeOfFarmJournal = $this->profitandlossrepository->getSumIncomeOfFarmJournal($user->farm_id);
        $getSumExpenseOfFarmJournal = $this->profitandlossrepository->getSumExpenseOfFarmJournal($user->farm_id);
        $getAllSalesSumAsIncome = $this->profitandlossrepository->getAllSalesSumAsIncome($user->farm_id);
        $getAllPaybleSumAsExpense = $this->profitandlossrepository->getAllPaybleSumAsExpense($user->farm_id);


         //SUM OF TOTAL EXPENSE FROM JOURNAL
         foreach($getSumExpenseOfFarmJournal as $totaexponsej){
          $a  =  $totaexponsej->EXPENSESUMCREDIT;
         }
             //SUM OF TOTAL INCOME FROM JOURNAL
         foreach($getSumIncomeOfFarmJournal as $totalincomej){
          $b =  $totalincomej->INCOMESUMCREDIT;
        }

          //SUM OF ALL SALES MADE FROM FARM
        foreach($getAllSalesSumAsIncome as $getAllSalesSumAsIncome){
            $bb =  $getAllSalesSumAsIncome->SUMOFFARMSALES;
          }

          //SUM OF ALL PAYABLES MADE FROM FARM
          foreach($getAllPaybleSumAsExpense as $getAllPaybleSumAsExpense){
            $aa =  $getAllPaybleSumAsExpense->SUMOFFARMPAYABLES;
          }

          $total_income = $b + $bb;
          $total_expense = $a + $aa;

//ALL EXPENSE - ALL INCOMES
        $get_balance_paid = ($a + $aa) - ($b + $bb);
        if($get_balance_paid){
            if($get_balance_paid==0){
        $get_balance_paid =   $get_balance_paid." -"."";
          }elseif ($get_balance_paid<0) {
       $get_balance_paid = str_replace("-", "", number_format($get_balance_paid, 2, ".", ",")) . " Profit";
         }  else {

       $get_balance_paid = number_format($get_balance_paid, 2, ".", ",")." Loss";
         }
}
                                                                                                        
          

        $response = ['getAllIncomeOfFarmFromJournal' => $getAllIncomeOfFarmFromJournal, 'getAllExpenseOfFarmFromJournal' => $getAllExpenseOfFarmFromJournal
    ,'getSumIncomeOfFarmJournal' => $getSumIncomeOfFarmJournal,'getSumExpenseOfFarmJournal' => $getSumExpenseOfFarmJournal,
      'get_balance_paid' => $get_balance_paid,'getAllSalesSumAsIncome' => $getAllSalesSumAsIncome,'getAllPaybleSumAsExpense' => $getAllPaybleSumAsExpense,'bb'=>$bb,'aa'=>$aa,
      'total_income'=>$total_income,'total_expense'=>$total_expense
      ];
       
       
        return view('users.profitandloss',$response);  
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


    public function getAllIncomeOfFarmFromJournalDateSelect(Request $request)
    {
         $submit = false;
       
        if ($request->isMethod('post')) {
             $submit = true;
             $getAllIncomeOfFarmFromJournalDateSelect = $this->profitandlossrepository->getAllIncomeOfFarmFromJournalDateSelect($request->FromDate,$request->ToDate);
       
            if ($getAllIncomeOfFarmFromJournalDateSelect) {
                $responseSelect = ['getAllIncomeOfFarmFromJournalDateSelect' => $getAllIncomeOfFarmFromJournalDateSelect,'submit'=>$submit];
                return redirect(route('account.profitandloss',$responseSelect));
            
            } 
            
            else {
                Session::flash('message', 'An error occured!');
                Session::flash('alert-class', 'alert-danger');
                return redirect(route('account.profitandloss',$responseSelect));
            }
        }

       
    }
}
