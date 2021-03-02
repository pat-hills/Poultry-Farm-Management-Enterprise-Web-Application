<?php

namespace App\Http\Middleware;

use Closure;

use App\Repositories\PenHouseRepository;
use Illuminate\Support\Facades\Auth;

class CheckPenHouseRecord
{
    
    protected $pen_house_repository;

    public function __construct(PenHouseRepository $pen_house_repository)
    {
        $this->pen_house_repository = $pen_house_repository;
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
        $user = Auth::user();
        if($this->pen_house_repository->pen_house_setup($user->farm_id)){
            return $next($request);
        }
        else{
            return redirect(route('onboarding.penhouse')); 
        }
    }



}
