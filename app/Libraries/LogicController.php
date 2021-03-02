<?php
namespace App\Libraries;
use Illuminate\Support\Collection;
use App\FarmAccount;
use App\User;
use App\PenHouse;
use App\PehHouseStocking;

class LogicController
{
    //


 public function farm_account_check($farm_id){
 try {
//$farm_id = Auth::user()->col_farm_id;
$farm_acount = FarmAccount::where(['col_farm_id'=>$farm_id])->first();

return $farm_acount->name;

 } catch (Exception $e) {
 echo $e->getTraceAsString();
 } 
   } 

}
 

