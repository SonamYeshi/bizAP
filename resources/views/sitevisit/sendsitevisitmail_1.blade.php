<p>Dear Applicant</p>
<p>
Please find attached the Virtual Site Visit form. Fill out the form and upload through the DHI BizAP Portal
</p>
Following is the link to Virtual Form<br>
<?php
$attachments = App\Models\SitevisitDateTime::where('fundid', $fundid)->get();
foreach($attachments as $at)
        {
            $filename = $at->virtual_form;
             ?>
            <a href="{{ url('/uploads/virtualform/'.$filename) }}" target="_blank" ><?php echo $at->virtual_form; ?></a> <br>
      <?php }
 ?>

<p>For any clarification or details contact us during office hours at 02-336257 ext.126 or email dhibizap@dhi.bt</p>
<p>
Regards,<br>
DHI BizAP Team</p>



