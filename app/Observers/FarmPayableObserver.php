<?php

namespace App\Observers;

use App\Models\FarmPayable;

class FarmPayableObserver
{
    /**
     * Handle to the farm payable "created" event.
     *
     * @param  \App\FarmPayable  $farmPayable
     * @return void
     */
    public function created(FarmPayable $farmPayable)
    {
        //
    }

    /**
     * Handle the farm payable "updated" event.
     *
     * @param  \App\FarmPayable  $farmPayable
     * @return void
     */
    public function updated(FarmPayable $farmPayable)
    {
        //
    }

    /**
     * Handle the farm payable "deleted" event.
     *
     * @param  \App\FarmPayable  $farmPayable
     * @return void
     */
    public function deleted(FarmPayable $farmPayable)
    { 
            $farmPayable->farm_payable_payments()->delete(); 
            $farmPayable->farm_payables_details()->delete(); 
    }
    /**
     * Handle the farm payable "delete" event.
     *
     * @param  \App\FarmPayable  $farmPayable
     * @return void
     */
    public function delete(FarmPayable $farmPayable)
    { 
            $farmPayable->farm_payable_payments()->delete(); 
            $farmPayable->farm_payables_details()->delete(); 
    }
      
      /**
     * Handle the farm payable "restored" event.
     *
     * @param  \App\FarmPayable  $farmPayable
     * @return void
     */
    public function restored(FarmPayable $farmPayable)
    {
        FarmPayable::restored(function($farmPayable) {
            $farmPayable->farm_payable_payments()->withTrashed()->restore();
        });

        FarmPayable::restored(function($farmPayable) {
            $farmPayable->farm_payables_details()->withTrashed()->restore();
        });
   
    }
}
