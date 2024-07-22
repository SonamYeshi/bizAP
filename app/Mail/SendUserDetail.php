<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendUserDetail extends Mailable
{
    use Queueable, SerializesModels;

    public $userid;
    public $password;

    public function __construct($userid, $password)
    {
        $this->userid = $userid;
        $this->password = $password;
    }

    public function build()
    {
        return $this->from('dhibizap@gmail.com', 'DHI Business Acceleration Program')
            ->subject('User Credential for BizAP Database System')
            ->view('contractschedule.sendusermail');
       // return $this->view('admin.user.sendmail');
    }
}
