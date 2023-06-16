<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderStatusEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $transaction_code;
    public $status;
    public $user_id;

    public function __construct($transaction_code, $status, $user_id)
    {
        $this->transaction_code = $transaction_code;
        $this->status = $status;
        $this->user_id = $user_id;
    }

    public function broadcastOn()
    {
        return new Channel('order-status');
    }

    public function broadcastAs()
    {
        return 'order-status-event';
    }
}
