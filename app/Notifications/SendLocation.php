<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Location;

class SendLocation extends Notification
{
    use Queueable;

    protected $location;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Location $location)
    {
        $this->location = $location;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

   
    public function toDatabase($notifiable)
    {
        return [
            'location_id' => $this->location->id,
            'user_id' => $this->location->user_id,
        ];
    }

    public function toArray($notifiable)
    {
        return [
            'id' => $this->id,
            'read_at' => null,
            'data' => [
                'location' => $this->location,
                'user_id' => $this->location->user_id,
            ],
        ];
    }
    
}
