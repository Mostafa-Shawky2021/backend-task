<?php

namespace App\Listeners;

use App\Mail\WelcomeMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeMessage implements ShouldQueue
{
    /**
     * Create the event listener.
     */

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        //
        Mail::to($event->employee->employee_email)
            ->send(new WelcomeMessage($event->employee));
    }
}
