<?php

namespace App\Observers;

use App\Models\FarmSale;

class FarmSalesObserver
{
    /**
     * Handle to the farm sale "created" event.
     *
     * @param  \App\FarmSale  $farmSale
     * @return void
     */
    public function created(FarmSale $farmSale)
    {
        //
    }

    /**
     * Handle the farm sale "updated" event.
     *
     * @param  \App\FarmSale  $FarmSale
     * @return void
     */
    public function updated(FarmSale $farmSale)
    {
        //
    }

    /**
     * Handle the farm sale "deleted" event.
     *
     * @param  \App\FarmSale  $FarmSale
     * @return void
     */
    public function deleted(FarmSale $farmSale)
    {
       
            $farmSale->farm_payments()->delete();
      
            $farmSale->sales_details()->delete();
       
    }
      
      /**
     * Handle the farm sale "restored" event.
     *
     * @param  \App\FarmSale  $FarmSale
     * @return void
     */
    public function restored(FarmSale $farmSale)
    {
        FarmSale::restored(function(FarmSale $farmSale) {
            $farmSale->farm_payments()->withTrashed()->restore();
        });

        FarmSale::restored(function($farmSale) {
            $farmSale->farm_payments()->withTrashed()->restore();
        });
   
    }
}
