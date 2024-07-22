<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPresentationDate extends Mailable
{
    use Queueable, SerializesModels;

    public $cohortopen;
    public $no;
    public $date;
    public $time;

    public function __construct($cohortopen, $no, $date, $time)
    {
        $this->cohortopen = $cohortopen;
        $this->no = $no;
        $this->date = $date;
        $this->time = $time;
    }

    public function build()
    {
        $attachments = Attachment::where('cohortopen', $this->cohortopen)->where('cohortopenno', $this->no)->get();

        return $this->from('dhibizap@gmail.com', 'DHI Business Acceleration Program')
            ->subject('Presentation Date and Time:')
            ->view('presentation.sendmail', compact('attachments'));
    }
}
