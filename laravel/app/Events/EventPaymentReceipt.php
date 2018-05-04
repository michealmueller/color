<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EventPaymentReceipt
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $amount;
    public $event;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $amount, $event)
    {
        //
        $this->user = $user;
        $this->amount = $amount;
        $this->event = $event;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
