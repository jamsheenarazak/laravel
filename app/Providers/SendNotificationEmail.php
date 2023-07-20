<?php

namespace App\Providers;

use App\Providers\AppointmentCancelled;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNotificationEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AppointmentCancelled $event): void
    {
        $data = array('name' => $event->user->name, 'email' => 'jamsheashiq@gmail.com', 'body' => 'Welcome to our website.');

        Mail::send('emails.mail',$data,function($message) use($data) {
          $message->to($data['email'])
              ->subject('your booking has been cancelled');
        });
    }
}
