<?php
namespace App\Libraries;
               
  function con_con (){
   $hostdb = "localhost";  // MySQl host
   $userdb = "root";  // MySQL username
   $passdb = "";  // MySQL password
   $namedb = "akv3i";  // MySQL database name

   // Establish a connection to the database
   $dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);
   if ($dbhandle->connect_error) {
  	exit("There was an error with your connection: ".$dbhandle->connect_error);
   }
   
   return $dbhandle;
  }
  
  function member_code_gen(){
      $region = "BATCH";
      $member_code = "";
      $db = con_con();
      $current_year = date("y");
      $month =  date("M");
      $currentday =  date("d");
     // $lasttwo = substr($current_year, 2);
      
          
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
      
      $start_code = $region."/"."000001"."/".$currentday."/".$monthcon."/".$current_year;
 $query = "SELECT col_pen_id FROM tbl_stock_tracking  ORDER BY col_pen_id DESC LIMIT 1 ";
       $result= $db->query($query) or die("Error");
       if($result == NULL){
           $member_code = $start_code;
          
       } 
       
       else {
          while ($res = mysqli_fetch_assoc($result)) { 
             $results_code = $res['col_pen_id'];
             $newcode = $results_code + 1;
             if(strlen($newcode)==1){
                 //$member_code =$region."-"."00000".$newcode.$lasttwo;
                 $start_code = $region."/"."00000".$newcode."/".$currentday."/".$monthcon."/".$current_year;
             }else if(strlen($newcode)==2){
                $start_code = $region."/"."0000".$newcode."/".$currentday."/".$monthcon."/".$current_year;
             }else if(strlen($newcode)==3){
               $start_code = $region."/"."000".$newcode."/".$currentday."/".$monthcon."/".$current_year;
             }else if(strlen($newcode)==4){
               $start_code = $region."/"."00".$newcode."/".$currentday."/".$monthcon."/".$current_year;
             }else if(strlen($newcode)==5){
                $start_code = $region."/"."0".$newcode."/".$currentday."/".$monthcon."/".$current_year;
             } else {
                 
             
                 $start_code = $region."/".$newcode."/".$currentday."/".$monthcon."/".$current_year;
             }
          } 
       }
       
         return $start_code;
      

  }
  
   function member_code_gen2(){
      $region = "AKOKOTAKRA-REG-NUM";
      $member_code = "";
      $db = con_con();
      $current_year = date("y");
      $month =  date("M");
      $currentday =  date("d");
     // $lasttwo = substr($current_year, 2);
      
          
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
 $query = "SELECT id FROM tbl_farm_account_details  ORDER BY id DESC LIMIT 1 ";
       $result= $db->query($query) or die("Error");
       if($result == NULL){
           $start_code = $start_code;
          
       } 
       
       else {
          while ($res = mysqli_fetch_assoc($result)) {

             $results_code = $res['id'];
             $newcode = $results_code + 1;
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
       }
       
         return $start_code;
      

  }
  
  
   
   function member_code_gen2c(){
      $region = "AKOKOTAKRA-USER-CODE";
      $member_code = "";
      $db = con_con();
      $current_year = date("y");
      $month =  date("M");
      $currentday =  date("d");
     // $lasttwo = substr($current_year, 2);
      
          
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
 $query = "SELECT id FROM tbl_farm_users_users  ORDER BY id DESC LIMIT 1 ";
       $result= $db->query($query) or die("Error");
       if($result == NULL){
           $start_code = $start_code;
          
       } 
       
       else {
          while ($res = mysqli_fetch_assoc($result)) { 
             $results_code = $res['id'];
             $newcode = $results_code + 1;
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
       }
       
         return $start_code;
      

  }
  
  
   function member_code_gen2cbrn(){
      $region = "AKOKOTAKRA-BRANCH-CODE";
      $member_code = "";
      $db = con_con();
      $current_year = date("y");
      $month =  date("M");
      $currentday =  date("d");
     // $lasttwo = substr($current_year, 2);
      
          
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
 $query = "SELECT id FROM tbl_farm_branches  ORDER BY id DESC LIMIT 1 ";
       $result= $db->query($query) or die("Error");
       if($result == NULL){
           $start_code = $start_code;
          
       } 
       
       else {
          while ($res = mysqli_fetch_assoc($result)) { 
             $results_code = $res['id'];
             $newcode = $results_code + 1;
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
       }
       
         return $start_code;
      

  }