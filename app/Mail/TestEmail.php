<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;

    public function __construct($name = "User")
    {
        $this->name = $name;
    }

    public function build()
    {
        return $this->subject('🌟 Test Email from Ruthiksha Infotech')
                    ->view('emails.test'); // We'll create this next
    }
}
