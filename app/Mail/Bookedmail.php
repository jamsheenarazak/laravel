<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Bookedmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
//    public  $user_name,$doctor,$date,$time;
//    public  $user_name;
    public function __construct()
    {
//            $this->user_name=$user_name;
//        $this->doctor=$doctor;
//        $this->date=$date;
//            $this->time=$time;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('jamsheashiq@gmail.com','jamshi'),
            subject: 'Booking details',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.booked',
//            with: [
//                'user_name'=>$this->user_name,
//                'doctor'=>$this->doctor,
//                'date'=>$this->date,
//                'time'=>$this->time,
//
//            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
//    public function attachments(): array
//    {
//        return [];
//    }
}
