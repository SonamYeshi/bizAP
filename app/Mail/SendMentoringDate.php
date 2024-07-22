<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Mentoring;
use App\Models\MentroingDocs;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMentoringDate extends Mailable
{
    use Queueable, SerializesModels;

    public $mid;

    public function __construct($mid)
    {
        $this->mid = $mid;
    }

    public function build()
    {
        $attachments = MentroingDocs::where('mentoringid', $this->mid)->get();
        $apps = Mentoring::where('id', $this->mid)->get();

        return $this->from('dhibizap@gmail.com', 'DHI Business Acceleration Program')
            ->subject('Mentoring Announcement')
            ->view('mentroing.sendmail', compact('attachments', 'apps'));
    }
}
