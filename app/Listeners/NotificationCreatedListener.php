<?php

namespace App\Listeners;

use App\Events\NotificationCreated;
use App\Models\Notification;

class NotificationCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NotificationCreatedListener  $event
     * @return void
     */
    public function handle(NotificationCreated $event)
    {
        // $user = $event->user;
        // $notification = new Notification();
        // $notification->user_id = $user->id;
        // $notification->message = "New User Created named - ".$user->name;
        // $notification->seen = 0;
        // $notification->save();
        // return $notification;
    }
}
