<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LoginOrCreateUserEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $provider;

    /**
     * Create a new event instance.
     *
     * @param string $provider
     */
    public function __construct(string $provider)
    {
        $this->provider = $provider;
    }
}
