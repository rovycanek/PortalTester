<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class runTestsEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $email;
    public $IP;
    public $user_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($email,$IP,$user_id)
    {
        $this->email=$email;
        $this->IP=$IP;
        $this->user_id=$user_id;
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
