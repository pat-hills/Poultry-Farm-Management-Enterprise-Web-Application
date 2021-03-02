<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class CheckFarmSetup
{

    protected $user_repository;

    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository = $user_repository;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        if($this->user_repository->check_if_user_setup_farm($user)){
            return $next($request);
        }
        else{
            return redirect(route('onboarding.farmsetup'));
        }
       
    }
}
