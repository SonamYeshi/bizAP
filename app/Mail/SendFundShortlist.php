<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendFundShortlist extends Mailable
{
    use Queueable, SerializesModels;

    public $businessname;
    public $status;

    public function __construct($businessname, $status)
    {
        $this->businessname = $businessname;
        $this->status = $status;
    }

    public function build()
    {
        return $this->from('dhibizap@gmail.com', 'DHI Business Acceleration Program')
            ->subject('Shortlist Notice')
            ->view('shortlistfund.sendmail');
       // return $this->view('admin.user.sendmail');
    }
}
