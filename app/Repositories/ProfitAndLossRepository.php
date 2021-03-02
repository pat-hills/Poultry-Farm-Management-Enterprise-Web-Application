<?php

namespace App\Repositories;

use App\Models\ChartsOfAccount;
use App\Models\Journal;
use App\Models\FarmPayment;
use App\Models\FarmPayablePayment;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;
 
class ProfitAndLossRepository
{

    private $chartsofaccountsItem;
    private $JournalItem;

    public function __construct(ChartsOfAccount $chartsofaccountsItem,Journal $JournalItem)
    {
        $this->ChartsOfAccount = $chartsofaccountsItem;
        $this->JournalItem = $JournalItem;
    }

   

    public function getAllAccounts($farmId)
    {
        return ChartsOfAccount::where('farm_id', $farmId)->get();
    }

    public function getAccountTypeByname($farmId,$accname){
           $query = ['farm_id'=> $farmId,'acc_name'=> $accname];

         $acctype = ChartsOfAccount::where($query)->first(['acc_type']);
         return $acctype->acc_type;

    }

    public function getAllJournals($farmId)
    {
       // $query = ['farm_id'=> $farmId];

        return Journal::where('farm_id',$farmId)->get()->groupBy('acc_name');
    }

    public function getAllIncome($farmId)
    {
       return Journal::where('farm_id',$farmId)->get();
    }

   
    //ALL TIME RECORDS

public function getAllIncomeOfFarmFromJournal($farmId){
 
        $querysql = "SELECT acc_name,SUM(credit) AS SUMCREDIT,SUM(debit) AS SUMDEBIT FROM journal
        WHERE farm_id IN ($farmId) AND acc_type IN ('Income')  GROUP BY acc_name";
        $result = DB::SELECT($querysql);

        return $result;
    }

    public function getSumIncomeOfFarmJournal($farmId){
 
        $querysql = "SELECT SUM(bal) AS INCOMESUMCREDIT FROM journal
        WHERE farm_id IN ($farmId) AND acc_type IN ('Income')";
        $result = DB::SELECT($querysql);

        return $result;
    }


    public function getAllExpenseOfFarmFromJournal($farmId){
 
        $querysql = "SELECT acc_name,SUM(credit) AS SUMCREDITE,SUM(debit) AS SUMDEBITE FROM journal
        WHERE farm_id IN ($farmId) AND acc_type IN ('Expense')  GROUP BY acc_name";
        $result = DB::SELECT($querysql);

        return $result;
    }

    public function getSumExpenseOfFarmJournal($farmId){
 
        $querysql = "SELECT SUM(bal) AS EXPENSESUMCREDIT FROM journal
        WHERE farm_id IN ($farmId) AND acc_type IN ('Expense')";
        $result = DB::SELECT($querysql);

        return $result;
    }


    public function getAllSalesSumAsIncome($farmId){
 
        $querysql = "SELECT SUM(amount) AS SUMOFFARMSALES FROM farm_payments
        WHERE farm_id IN ($farmId)";
        $result = DB::SELECT($querysql);

        return $result;
    }

    public function getAllPaybleSumAsExpense($farmId){
 
        $querysql = "SELECT SUM(amount_paid) AS SUMOFFARMPAYABLES FROM farm_payable_payments
        WHERE farm_id IN ($farmId)";
        $result = DB::SELECT($querysql);

        return $result;
    }


    public function get_daily_income_from_farmpayments(){
        $farm_id = Auth::User()->farm_id;
        $todayFarmPayments = FarmPayment::where('farm_id', $farm_id)
        ->whereDate('created_at', Carbon::today())->sum('amount');
if($todayFarmPayments) {
            return $todayFarmPayments;
            // return $goodremaining->good_eggs;
        }else{
            return 0.0;
        }
    }



    public function get_daily_income_from_journals(){
        $farm_id = Auth::User()->farm_id;
        $query_ = ['farm_id'=>$farm_id,'acc_type'=>'Income'];
        $todayFarmPayments = Journal::where($query_)
        ->whereDate('created_at', Carbon::today())->sum('bal');
if($todayFarmPayments) {
            return $todayFarmPayments;
            // return $goodremaining->good_eggs;
        }else{
            return 0.0;
        }
    }

    public function get_daily_expense_from_farmpayablespayments(){
        $farm_id = Auth::User()->farm_id;
        $todayFarmPayments = FarmPayablePayment::where('farm_id', $farm_id)
        ->whereDate('created_at', Carbon::today())->sum('amount_paid');
if($todayFarmPayments) {
            return $todayFarmPayments;
            // return $goodremaining->good_eggs;
        }else{
            return 0.0;
        }
    }

    public function get_daily_expense_from_journals(){
        $farm_id = Auth::User()->farm_id;
        $query_ = ['farm_id'=>$farm_id,'acc_type'=>'Expense'];
        $todayFarmPayments = Journal::where($query_)
        ->whereDate('created_at', Carbon::today())->sum('bal');
if($todayFarmPayments) {
            return $todayFarmPayments;
            // return $goodremaining->good_eggs;
        }else{
            return 0.0;
        }
    }


    public function get_total_daily_expense(){
        $farmpaymentsincome  = $this->get_daily_expense_from_farmpayablespayments();
        $farmjournalsincome = $this-> get_daily_expense_from_journals();

        $doubletotals = $farmjournalsincome + $farmpaymentsincome;

        return $doubletotals;
    }

    public function get_total_daily_income(){
        $farmpaymentsincome  = $this->get_daily_income_from_farmpayments();
        $farmjournalsincome = $this-> get_daily_income_from_journals();

        $doubletotals = $farmjournalsincome + $farmpaymentsincome;

        return $doubletotals;
    }


    public function daily_net_balance(){
        $get_balance_paid = $this -> get_total_daily_expense() - $this -> get_total_daily_income();
        if($get_balance_paid){
            if($get_balance_paid==0){
        $get_balance_paid =   $get_balance_paid." -"."";
          }elseif ($get_balance_paid<0) {
        $get_balance_paid = str_replace("-", "", number_format($get_balance_paid, 2, ".", ",")) . " Profit";
         }  else {
        
        $get_balance_paid = number_format($get_balance_paid, 2, ".", ",")." Loss";
         }
        }
        
        return $get_balance_paid;
            }





// WEEKLY RECORDS



public function get_week_income_from_farmpayments(){
    $farm_id = Auth::User()->farm_id;
    $todayFarmPayments = FarmPayment::where('farm_id', $farm_id)
    ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');
if($todayFarmPayments) {
        return $todayFarmPayments;
        // return $goodremaining->good_eggs;
    }else{
        return 0.0;
    }
}



public function get_week_income_from_journals(){
    $farm_id = Auth::User()->farm_id;
    $query_ = ['farm_id'=>$farm_id,'acc_type'=>'Income'];
    $todayFarmPayments = Journal::where($query_)
    ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('bal');

if($todayFarmPayments) {
        return $todayFarmPayments;
        // return $goodremaining->good_eggs;
    }else{
        return 0.0;
    }
}

public function get_total_week_income(){
    $farmpaymentsincome  = $this->get_week_income_from_farmpayments();
    $farmjournalsincome = $this-> get_week_income_from_journals();

    $doubletotals = $farmjournalsincome + $farmpaymentsincome;

    return $doubletotals;
}





public function get_week_expense_from_farmpayablespayments(){
    $farm_id = Auth::User()->farm_id;
    $todayFarmPayments = FarmPayablePayment::where('farm_id', $farm_id)
    ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount_paid');
;
if($todayFarmPayments) {
        return $todayFarmPayments;
        // return $goodremaining->good_eggs;
    }else{
        return 0.0;
    }
}



public function get_week_expense_from_journals(){
    $farm_id = Auth::User()->farm_id;
    $query_ = ['farm_id'=>$farm_id,'acc_type'=>'Expense'];
    $todayFarmPayments = Journal::where($query_)
    ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('bal');
;
if($todayFarmPayments) {
        return $todayFarmPayments;
        // return $goodremaining->good_eggs;
    }else{
        return 0.0;
    }
}

public function get_total_week_expense(){
    $farmpaymentsincome  = $this->get_week_expense_from_farmpayablespayments();
    $farmjournalsincome = $this-> get_week_expense_from_journals();

    $doubletotals = $farmjournalsincome + $farmpaymentsincome;

    return $doubletotals;
}


public function week_net_balance(){
$get_balance_paid = $this -> get_total_week_expense() - $this -> get_total_week_income();
if($get_balance_paid){
if($get_balance_paid==0){
$get_balance_paid =   $get_balance_paid." -"."";
}elseif ($get_balance_paid<0) {
$get_balance_paid = str_replace("-", "", number_format($get_balance_paid, 2, ".", ",")) . " Profit";
}  else {

$get_balance_paid = number_format($get_balance_paid, 2, ".", ",")." Loss";
}
}

return $get_balance_paid;
}




//MONTHLY RECORDS




public function get_month_income_from_farmpayments(){
    $farm_id = Auth::User()->farm_id;
    $todayFarmPayments = FarmPayment::where('farm_id', $farm_id)
    ->whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->month)->sum('amount');
if($todayFarmPayments) {
        return $todayFarmPayments;
        // return $goodremaining->good_eggs;
    }else{
        return 0.0;
    }
}



public function get_month_income_from_journals(){
    $farm_id = Auth::User()->farm_id;
    $query_ = ['farm_id'=>$farm_id,'acc_type'=>'Income'];
    $todayFarmPayments = Journal::where($query_)
    ->whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->month)->sum('bal');

if($todayFarmPayments) {
        return $todayFarmPayments;
        // return $goodremaining->good_eggs;
    }else{
        return 0.0;
    }
}

public function get_total_month_income(){
    $farmpaymentsincome  = $this->get_month_income_from_farmpayments();
    $farmjournalsincome = $this-> get_month_income_from_journals();

    $doubletotals = $farmjournalsincome + $farmpaymentsincome;

    return $doubletotals;
}





public function get_month_expense_from_farmpayablespayments(){
    $farm_id = Auth::User()->farm_id;
    $todayFarmPayments = FarmPayablePayment::where('farm_id', $farm_id)
    ->whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->month)->sum('amount_paid');
;
if($todayFarmPayments) {
        return $todayFarmPayments;
        // return $goodremaining->good_eggs;
    }else{
        return 0.0;
    }
}



public function get_month_expense_from_journals(){
    $farm_id = Auth::User()->farm_id;
    $query_ = ['farm_id'=>$farm_id,'acc_type'=>'Expense'];
    $todayFarmPayments = Journal::where($query_)
    ->whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->month)->sum('bal');
;
if($todayFarmPayments) {
        return $todayFarmPayments;
        // return $goodremaining->good_eggs;
    }else{
        return 0.0;
    }
}

public function get_total_month_expense(){
    $farmpaymentsincome  = $this->get_month_expense_from_farmpayablespayments();
    $farmjournalsincome = $this-> get_month_expense_from_journals();

    $doubletotals = $farmjournalsincome + $farmpaymentsincome;

    return $doubletotals;
}


public function month_net_balance(){
$get_balance_paid = $this -> get_total_month_expense() - $this -> get_total_month_income();
if($get_balance_paid){
if($get_balance_paid==0){
$get_balance_paid =   $get_balance_paid." -"."";
}elseif ($get_balance_paid<0) {
$get_balance_paid = str_replace("-", "", number_format($get_balance_paid, 2, ".", ",")) . " Profit";
}  else {

$get_balance_paid = number_format($get_balance_paid, 2, ".", ",")." Loss";
}
}

return $get_balance_paid;
}


  
//ALLL TIME RECORDS
   





public function get_alltime_income_from_farmpayments(){
    $farm_id = Auth::User()->farm_id;
    $todayFarmPayments = FarmPayment::where('farm_id', $farm_id)->sum('amount');
if($todayFarmPayments) {
        return $todayFarmPayments;
        // return $goodremaining->good_eggs;
    }else{
        return 0.0;
    }
}



public function get_alltime_income_from_journals(){
    $farm_id = Auth::User()->farm_id;
    $query_ = ['farm_id'=>$farm_id,'acc_type'=>'Income'];
    $todayFarmPayments = Journal::where($query_)->sum('bal');

if($todayFarmPayments) {
        return $todayFarmPayments;
        // return $goodremaining->good_eggs;
    }else{
        return 0.0;
    }
}

public function get_total_alltime_income(){
    $farmpaymentsincome  = $this->get_alltime_income_from_farmpayments();
    $farmjournalsincome = $this-> get_alltime_income_from_journals();

    $doubletotals = $farmjournalsincome + $farmpaymentsincome;

    return $doubletotals;
}





public function get_alltime_expense_from_farmpayablespayments(){
    $farm_id = Auth::User()->farm_id;
    $todayFarmPayments = FarmPayablePayment::where('farm_id', $farm_id)->sum('amount_paid');
;
if($todayFarmPayments) {
        return $todayFarmPayments;
        // return $goodremaining->good_eggs;
    }else{
        return 0.0;
    }
}



public function get_alltime_expense_from_journals(){
    $farm_id = Auth::User()->farm_id;
    $query_ = ['farm_id'=>$farm_id,'acc_type'=>'Expense'];
    $todayFarmPayments = Journal::where($query_)->sum('bal');
;
if($todayFarmPayments) {
        return $todayFarmPayments;
        // return $goodremaining->good_eggs;
    }else{
        return 0.0;
    }
}

public function get_total_alltime_expense(){
    $farmpaymentsincome  = $this->get_alltime_expense_from_farmpayablespayments();
    $farmjournalsincome = $this-> get_alltime_expense_from_journals();

    $doubletotals = $farmjournalsincome + $farmpaymentsincome;

    return $doubletotals;
}


public function alltime_net_balance(){
$get_balance_paid = $this -> get_total_alltime_expense() - $this -> get_total_alltime_income();
if($get_balance_paid){
if($get_balance_paid==0){
$get_balance_paid =   $get_balance_paid." -"."";
}elseif ($get_balance_paid<0) {
$get_balance_paid = str_replace("-", "", number_format($get_balance_paid, 2, ".", ",")) . " Profit";
}  else {

$get_balance_paid = number_format($get_balance_paid, 2, ".", ",")." Loss";
}
}

return $get_balance_paid;
}

 


//DATE SELECTION



public function getAllIncomeOfFarmFromJournalDateSelect($from,$to){
    $farm_id = Auth::User()->farm_id;
 
    $querysql = "SELECT acc_name,SUM(credit) AS SUMCREDIT,SUM(debit) AS SUMDEBIT FROM journal
    WHERE farm_id IN ($farm_id) AND acc_type IN ('Income') AND created_at <= $from AND created_at >= $to  GROUP BY acc_name";
    $result = DB::SELECT($querysql);

    return $result;
}

  

     
     
}
