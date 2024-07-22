<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendInterviewDate extends Mailable
{
    use Queueable, SerializesModels;

    public $date;
    public $time;

    public function __construct($date, $time)
    {
        $this->date = $date;
        $this->time = $time;
    }

    public function build()
    {
        return $this->from('dhibizap@gmail.com', 'DHI Business Acceleration Program')
            ->subject('Interview Date and Time:')
            ->view('interview.sendmail');
       // return $this->view('admin.user.sendmail');
    }
}
