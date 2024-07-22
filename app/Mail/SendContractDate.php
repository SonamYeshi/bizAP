<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendContractDate extends Mailable
{
    use Queueable, SerializesModels;

    public $date;
    public $time;
    public $venue;
    public $instruction;

    public function __construct($date, $time, $venue, $instruction)
    {
        $this->date = $date;
        $this->time = $time;
        $this->venue = $venue;
        $this->instruction = $instruction;
    }

    public function build()
    {
        return $this->from('dhibizap@gmail.com', 'DHI Business Acceleration Program')
            ->subject('Contract Signing Date and Time:')
            ->view('contractschedule.sendmail');
       // return $this->view('admin.user.sendmail');
    }
}
