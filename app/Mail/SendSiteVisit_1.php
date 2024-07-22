<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSiteVisit_1 extends Mailable
{
    use Queueable, SerializesModels;
    public $fundid;
    public $date;
    public $time;
    public $agenda;

    public function __construct($fundid, $date, $time, $agenda)
    {
        $this->fundid = $fundid;
        $this->date = $date;
        $this->time = $time;
        $this->agenda = $agenda;
    }

    public function build()
    {
        return $this->from('dhibizap@gmail.com', 'DHI Business Acceleration Program')
            ->subject('Site Visit')
            ->view('sitevisit.sendsitevisitmail_1');
       // return $this->view('admin.user.sendmail');
    }
}
