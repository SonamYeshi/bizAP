<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FundSelectedListMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cohortopen;
    public $no;

    public function __construct($cohortopen, $no)
    {
        $this->cohortopen = $cohortopen;
        $this->no = $no;
    }

    public function build()
    {
        return $this->from('dhibizap@gmail.com', 'DHI Business Acceleration Program')
            ->subject('NOTIFICATION')
            ->view('ppt_scores.selectedlistpdf');

    }
}
