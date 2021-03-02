<?php

namespace App\Observers;

use App\Models\PenHouseStocking;

class PenHouseStockingObserver
{
    /**
     * Handle to the pen house stocking "created" event.
     *
     * @param  \App\PenHouseStocking  $penHouseStocking
     * @return void
     */
    public function created(PenHouseStocking $penHouseStocking)
    {
        //
    }

    /**
     * Handle the pen house stocking "updated" event.
     *
     * @param  \App\PenHouseStocking  $penHouseStocking
     * @return void
     */
    public function updated(PenHouseStocking $penHouseStocking)
    {
        //
    }

    /**
     * Handle the pen house stocking "deleted" event.
     *
     * @param  \App\PenHouseStocking  $penHouseStocking
     * @return void
     */
    public function deleted(PenHouseStocking $penHouseStocking)
    {
        // $penHouseStocking->farm_payable()->farm_payables_details()->delete();
        // $penHouseStocking->farm_payable()->farm_payable_payments()->delete();
        // $penHouseStocking->farm_payable()->delete();
    }
}
