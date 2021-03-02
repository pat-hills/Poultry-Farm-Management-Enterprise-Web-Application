<?php

namespace App\Repositories;

use App\Models\ChartsOfAccount;
use App\Models\Journal;
use DB;
 
class TrialBalanceRepository
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


    public function getAllAccountsOfFarmFromJournal($farmId){
 
        $querysql = "SELECT acc_name,SUM(credit) AS SUMCREDIT,SUM(debit) AS SUMDEBIT,SUM(bal) AS SUMBAL FROM journal
        WHERE farm_id IN ($farmId)  GROUP BY acc_name";
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
