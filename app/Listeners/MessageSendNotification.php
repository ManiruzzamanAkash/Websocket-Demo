<?php

namespace App\Listeners;

use App\Events\MessageSendEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MessageSendNotification
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
     * @param  MessageSendEvent  $event
     * @return void
     */
    public function handle(MessageSendEvent $event)
    {
        //
    }
}
