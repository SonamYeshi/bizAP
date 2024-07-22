<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSelectedStatusTraining extends Mailable
{
    use Queueable, SerializesModels;

    public $trainingname;
    public $status;

    public function __construct($trainingname, $status)
    {
        $this->trainingname = $trainingname;
        $this->status = $status;
    }

    public function build()
    {
        return $this->from('dhibizap@gmail.com', 'DHI Business Acceleration Program')->subject('Selection Notice')->view('ranking.sendmail');

        // return $this->view('admin.user.sendmail');
    }
}
