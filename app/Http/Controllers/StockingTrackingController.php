<?php

namespace App\Http\Controllers;

use App\Repositories\StockTrackingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockingTrackingController extends Controller
{
    private $stockTrackingRepository;

    public function __construct(StockTrackingRepository $stockTrackingRepository) {
        $this->stockTrackingRepository = $stockTrackingRepository;

    }

    public function stockTrackingView() {
        $farm_id = Auth::user()->farm_id;
        $stockTracking = $this->stockTrackingRepository->getStockTrackingByFarmId($farm_id);
        return view('users.cyclelist' , ['stockTracking' => $stockTracking]);
        
    }

}
