<?php

namespace App\Events;

use App\Models\Job;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TestEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $user;
    public $worker;

    public function __construct(User $user, Worker $worker)
    {
        $this->user = $user;
        $this->worker = $worker;
    }
}
