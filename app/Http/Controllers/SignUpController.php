<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Farmusers;

class SignUpController extends Controller
{
    //

    function signup(){
    	return "This is my signup";
    }

     function users(){
    	$allusers = Farmusers::all();
        foreach ($allusers as $user) {
        	echo $user->col_fullname;
        }
    	//var_dump($allusers);
    }

    function createUsers(Request $req){

    	var_dump($req->except('email'));

    }

    function register(){

    	return view('register'); 

    }
}
