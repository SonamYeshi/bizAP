<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $date;
    public $date1;

    public function __construct($date, $date1)
    {
        $this->user = $date;
        $this->password = $date1;
    }

    public function build()
    {
        return $this->from('ads@gmail.com', 'Anti-Corruption Commission - ADS')
            ->subject('ADS User Credentials:')
            ->view('admin.user.sendmailpwd');
       // return $this->view('admin.user.sendmail');
    }
}
