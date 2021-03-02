<?php

namespace App\Http\Controllers;

use App\Repositories\FarmAccountRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FarmAccountController extends Controller
{
    //
    protected $farmAccountRepository;
    protected $userRepository;

    public function __construct(FarmAccountRepository $farmAccountRepository,
        UserRepository $userRepository) {
        $this->farmAccountRepository = $farmAccountRepository;
        $this->userRepository = $userRepository;

    }

    public function farmSetUpView()
    {
        $user = Auth::user();
        $farmAccount = $this->userRepository->getUserFarmAccount($user);
        return view('users.farmsetup', ['farmaccount' => $farmAccount]);
    }

    public function createOrUpdateFarmAccount(Request $request)
    {

        $this->farmAccountRepository->createOrUpdateFarmAccount($request->user(),
            $request->farmName, $request->country,
            $request->currency, $request->numberOfBirds,
            $request->farmAddress);
        return redirect(route('onboarding.penhouse'));
    }

}
