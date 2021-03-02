<?php
namespace App\Libraries;
use Illuminate\Support\Collection;
use App\FarmAccount;
use App\User;

class CodeGeneratorController
{
    //

public function farm_users_id(){

    $region = "AKOKOTAKRAUSER";
      $member_code = "";
      
      $current_year = date("y");
      $month =  date("M");
      $currentday =  date("d");
           
if($month=="Jan"){
     $monthcon = "01";
 }elseif ($month=="Feb") {
       $monthcon = "02";  
    }
 elseif ($month=="Mar") {
       $monthcon = "03";  
    }
  elseif ($month=="Apr") {
       $monthcon = "04";  
    } elseif ($month=="May") {
       $monthcon = "05";  
    } elseif ($month=="Jun") {
       $monthcon = "06";  
    } elseif ($month=="Jul") {
       $monthcon = "07";  
    } elseif ($month=="Aug") {
       $monthcon = "08";  
    } elseif ($month=="Sep") {
       $monthcon = "09";  
    } elseif ($month=="Oct") {
       $monthcon = "10";  
    } elseif ($month=="Nov") {
       $monthcon = "11";  
    }elseif ($month=="Dec") {
       $monthcon = "12";  
    }
      
      $start_code = $region."/"."000000000001"."/".$currentday."/".$monthcon."/".$current_year;
//$lastRecordId = User::orderBy('id', 'DESC')->first(['id']);
      $lastRecordId = User::orderBy('id', 'DESC')->first(['id']);

if(!$lastRecordId){
  $start_code = $start_code; 
  }else{
     //dd($lastRecordId->id);
$newcode = $lastRecordId->id + 1;
  //$newcode = $lastRecordId->id + 1;

 //dd($newcode);

 if(strlen($newcode)==1){
                 //$member_code =$region."-"."00000".$newcode.$lasttwo;
                 $start_code = $region."/"."00000000000".$newcode."/".$currentday."/".$monthcon."/".$current_year;
             }else if(strlen($newcode)==2){
                $start_code = $region."/"."0000000000".$newcode."/".$currentday."/".$monthcon."/".$current_year;
             }else if(strlen($newcode)==3){
               $start_code = $region."/"."000000000".$newcode."/".$currentday."/".$monthcon."/".$current_year;
             }else if(strlen($newcode)==4){
               $start_code = $region."/"."00000000".$newcode."/".$currentday."/".$monthcon."/".$current_year;
             }else if(strlen($newcode)==5){
                $start_code = $region."/"."0000000".$newcode."/".$currentday."/".$monthcon."/".$current_year;
             }else if(strlen($newcode)==6){
                $start_code = $region."/"."000000".$newcode."/".$currentday."/".$monthcon."/".$current_year;
             }else if(strlen($newcode)==7){
                $start_code = $region."/"."00000".$newcode."/".$currentday."/".$monthcon."/".$current_year;
             }else if(strlen($newcode)==8){
                $start_code = $region."/"."0000".$newcode."/".$currentday."/".$monthcon."/".$current_year;
             }else if(strlen($newcode)==9){
                $start_code = $region."/"."000".$newcode."/".$currentday."/".$monthcon."/".$current_year;
             }else if(strlen($newcode)==10){
                $start_code = $region."/"."00".$newcode."/".$currentday."/".$monthcon."/".$current_year;
             }else if(strlen($newcode)==11){
                $start_code = $region."/"."0".$newcode."/".$currentday."/".$monthcon."/".$current_year;
             }
             else {
                 
             
                 $start_code = $region."/".$newcode."/".$currentday."/".$monthcon."/".$current_year;
             }
          


  }

    return $start_code; 

}
  



     function users(){
    	$allusers = Farmusers::all();
        foreach ($allusers as $user) {
        	echo $user->col_fullname;
        }
    	//var_dump($allusers);
}
    }
 

