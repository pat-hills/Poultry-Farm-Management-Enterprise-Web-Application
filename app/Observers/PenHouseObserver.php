<?php

namespace App\Observers;

use App\Models\PenHouse;

class PenHouseObserver
{
    /**
     * Handle to the pen house "created" event.
     *
     * @param  \App\PenHouse  $penHouse
     * @return void
     */
    public function created(PenHouse $penHouse)
    {
        //
    }

    /**
     * Handle the pen house "updated" event.
     *
     * @param  \App\PenHouse  $penHouse
     * @return void
     */
    public function updated(PenHouse $penHouse)
    {
        //
    }

    /**
     * Handle the pen house "deleted" event.
     *
     * @param  \App\PenHouse  $penHouse
     * @return void
     */
    public function deleted(PenHouse $penHouse)
    {
        // $penHouse->pen_house_stockings()->delete();
    }

    /**
     * Handle the pen house "deleted" event.
     *
     * @param  \App\PenHouse  $penHouse
     * @return void
     */
    public function delete(PenHouse $penHouse)
    {
        $penHouse->pen_house_stockings()->delete();
    }
}
