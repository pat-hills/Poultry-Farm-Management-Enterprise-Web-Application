<?php

namespace App\Providers;

use App\Models\FarmPayable;
use App\Models\PenHouse;
use App\Models\FarmSale;
use App\Models\PenHouseStocking;
use App\Observers\FarmPayableObserver;
use App\Observers\PenHouseObserver;
use App\Observers\FarmSalesObserver;
use App\Observers\PenHouseStockingObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        FarmPayable::observe(FarmPayableObserver::class);
        PenHouse::observe(PenHouseObserver::class);
        FarmSale::observe(FarmSalesObserver::class);
        PenHouseStocking::observe(PenHouseStockingObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
