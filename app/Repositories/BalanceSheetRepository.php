<?php

namespace App\Repositories;

use App\Models\ChartsOfAccount;
use App\Models\Journal;
use DB;
 
class BalanceSheetRepository
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


    public function getAllAssestsOfFarmFromJournal($farmId){
 
        $querysql = "SELECT acc_name,SUM(credit) AS SUMCREDIT,SUM(debit) AS SUMDEBIT,SUM(bal) AS ASSESSUMBAL FROM journal
        WHERE farm_id IN ($farmId) AND acc_type IN ('Asset')  GROUP BY acc_name";
        $result = DB::SELECT($querysql);

        return $result;
    }

    public function getAllLiabilityOfFarmFromJournal($farmId){
 
        $querysql = "SELECT acc_name,SUM(credit) AS SUMCREDIT,SUM(debit) AS SUMDEBIT,SUM(bal) AS LIBSUMBAL FROM journal
        WHERE farm_id IN ($farmId) AND acc_type IN ('Liability')  GROUP BY acc_name";
        $result = DB::SELECT($querysql);

        return $result;
    }


    public function getAllEquityOfFarmFromJournal($farmId){
 
        $querysql = "SELECT acc_name,SUM(credit) AS SUMCREDIT,SUM(debit) AS SUMDEBIT,SUM(bal) AS EQUSUMBAL FROM journal
        WHERE farm_id IN ($farmId) AND acc_type IN ('Equity')  GROUP BY acc_name";
        $result = DB::SELECT($querysql);

        return $result;
    }


    public function getSumTotalAssestOfFarmJournal($farmId){
 
        $querysql = "SELECT SUM(bal) AS ASSESTSUMBAL FROM journal
        WHERE farm_id IN ($farmId) AND acc_type IN ('Asset')";
        $result = DB::SELECT($querysql);

        return $result;
    }

    public function getSumTotalLiabilitiesOfFarmJournal($farmId){
 
        $querysql = "SELECT SUM(bal) AS LIABILITIESSUMBAL FROM journal
        WHERE farm_id IN ($farmId) AND acc_type IN ('Liability')";
        $result = DB::SELECT($querysql);

        return $result;
    }

    public function getSumTotalEquityOfFarmJournal($farmId){
 
        $querysql = "SELECT SUM(bal) AS EQUITIESSUMBAL FROM journal
        WHERE farm_id IN ($farmId) AND acc_type IN ('Equity')";
        $result = DB::SELECT($querysql);

        return $result;
    }



  

    // public function updateBillItem($id, $billItem)
    // {
    //     return BillItem::where('id', $id)->update($billItem);
    // }

    

    // public function deleteBillItem2($user,$id)
    // {
    //     return BillItem::where(['farm_id' => $user->farm_id, 'id' => $id])->delete();

       
    // }
    
     
}
