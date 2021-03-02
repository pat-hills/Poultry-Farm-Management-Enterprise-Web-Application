<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\PenHouseStockingRepository;
use Illuminate\Support\Facades\Auth;


class CheckPenHouseStocking
{

    protected $penHouseStockingRepository;

    public function __construct(PenHouseStockingRepository $penHouseStockingRepository)
    {
        $this->penHouseStockingRepository = $penHouseStockingRepository;
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
        $farm_id = Auth::user()->farm_id;
        $stocked = $this->penHouseStockingRepository->pen_house_stocking($farm_id);
        if($stocked){
            return $next($request);
        }
        else{
           return redirect(route('onboarding.stocking'));
        }
        
    }
    
}
