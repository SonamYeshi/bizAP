<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Virtualmail extends Mailable
{
    use Queueable, SerializesModels;

    public $business_name;
    public $name;

    public function __construct($business_name, $name)
    {
        $this->business_name = $business_name;
        $this->name = $name;
    }

    public function build()
    {
        return $this->from('dhibizap@gmail.com', 'DHI Business Acceleration Program')
            ->subject('NOTIFICATION: Virtual Site Visit Form Upload FOR ' .$this->business_name)
            ->view('fundrequest.virtualmail');

    }
}
