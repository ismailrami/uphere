<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\User;
use App\Location;

class LocationSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


     /**
     * User that sent the message
     *
     * @var User
     */
    public $user;

    /**
     * User that sent the message
     *
     * @var Location
     */
    public $location;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Location $location)
    {
        $this->user = $user;
        $this->location = $location;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel');
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->location->id,
            'body' => $this->location->message,
            'user' => [
                'name' => $this->location->user->name,
                'id' => $this->location->user->id,
            ],
        ];
    }
}
