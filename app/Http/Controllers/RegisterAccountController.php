<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterAccountController extends Controller
{
    
    protected $user_repository;

    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    public function signup()
    {
        return view('register');
    }

    public function createaccount(Request $request)
    {
        try {
            if ($request->password != $request->password_confirm) {
                return redirect()->back()->withInput()->withErrors("Passwords Mismatch");
            } elseif($user=$this->user_repository->saveUser($request->fullname,
                    $request->email,
                    $request->phoneNumber,
                    $request->password,
                    $request->country)){
                        Auth::login($user);
                 return redirect(route('onboarding.farmsetup'));
                    }
              else{
                return redirect()->back()->withInput()->withErrors("Email already exist");
               }

     } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors("Email already exist");
        }

    }

}
