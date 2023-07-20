<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\Bookedmail;



class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $mail;
    /**
     * Create a new job instance.
     */
    public function __construct($mail)
    {
        $this->mail=$mail;
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $email=new bookedmail();

        Mail::to($this->mail)->send(new bookedmail());
           // Mail::to('jamsheashiq@gmail.com')->send(new bookedmail());

        //
    }
}
