<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login()
    {

        return view('login');

    }

    public function home()
    {

        return view('welcome');

    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('primary_contact', 'password');
        // echo $request->pincode ;
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('account/dashboard');

           // return redirect()->intended('onboarding/farmsetup');
        } else {
            return redirect()->back()->withInput()->withErrors("Invalid Username Or Password");
        }
    }

    public function logout()
    { 
        Auth::logout();
        return redirect(route('login-view'));

    }

}
