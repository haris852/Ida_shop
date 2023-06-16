<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewOrderEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $name;
    public $status;
    public $user_id;

    public function __construct($name, $status, $user_id)
    {
        $this->name = $name;
        $this->status = $status;
        $this->user_id = $user_id;
    }

    public function broadcastOn()
    {
        return new Channel('new-order');
    }

    public function broadcastAs()
    {
        return 'new-order-event';
    }
}
