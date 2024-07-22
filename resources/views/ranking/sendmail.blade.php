<p>Dear Applicant,</p>
@if($status == 1)
<p>Congratulations! You are selected for the Training <b>{{ $trainingname }}</b>, DHI BizAP Program. </p>
<p>Please kindly visit DHI website for details or  contact us during office hours at 02-336257 ext.126 or email dhibizap@dhi.bt.</p>
@endif
@if($status == 0)
<p>We appreciate that you took the time to apply for this opportunity. We received applications from many people.
While we are thankful for the time you took, we have not selected your application for the Training <b>{{ $trainingname }}</b>.
</p>
<p>For any clarification or details contact us during office hours at 02-336257 ext.148 or email dhibizap@dhi.bt</p>
<p>Again, thank you for applying. We wish you every personal and professional success.</p>
@endif

<p>Regards,<br>
DHI BizAP Team </p>
