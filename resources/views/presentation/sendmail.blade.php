<p>Dear Applicant,</p>
 <p>Here are the details regarding your presentation schedule. Make sure to make your presentation as per the template shared.</p>
 <p><h3>Presentation Date and Time</h3><br>
Date : {{ $date }}<br>
Time : {{ $time }}</p>

Following are the links to Presentation Templates: <br>
<?php foreach($attachments as $at)
        {
            $filename = $at->filename;
             ?>
            <a href="{{ url('/uploads/templates/'.$filename) }}" target="_blank" ><?php echo $at->filename; ?></a> <br>
      <?php }
 ?>
<p>For any clarification or details contact us during office hours at 02-336257 ext.126 or email dhibizap@dhi.bt</p>

<p>Regards,<br>
DHI BizAP Team</p>




