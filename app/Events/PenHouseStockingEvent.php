<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PenHouseStockingEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $penHouseStocking;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PenHouseStocking $penHouseStocking)
    {
        $this->penHouseStocking = $penHouseStocking;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
