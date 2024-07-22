<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendRejectEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $remarks;

    public function __construct($remarks)
    {
        $this->remarks = $remarks;
    }

    public function build()
    {
        return $this->from('dhibizap@gmail.com', 'DHI Business Acceleration Program')
            ->subject('Fund Request Status:')
            ->view('fundrequest.fundrejectmail');
       // return $this->view('admin.user.sendmail');
    }
}
