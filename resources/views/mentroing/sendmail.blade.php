<html>
    <head></head>
    <body>
<p>Dear Applicant,</p>
 <p>A Mentroing session has been orginzed</p>
 <p><h3>Followings are the Details</h3><br>
 <?php foreach($apps as $ap)
        { ?>
 Support Type : {{ $ap->SupportType }}<br>
 Start Date : {{ $ap->StartDate }}<br>
 End Date : {{ $ap->EndDate }}<br>
 Mentor : {{ $ap->Mentor }} &nbsp;&nbsp;Mentor CV:
 <?php foreach($attachments as $at)
        {
            $filename = $at->file_name;
             ?>
            <a href="{{ url('/uploads/CVoftheMentor/'.$filename) }}" target="_blank" ><?php echo $at->file_name; ?></a>
      <?php }
 ?>
 <br>
 No of Partipants : {{ $ap->NoofPartipants }}<br>
 Objective : {{ $ap->Objective }}<br>
 Requirements : {{ $ap->Requirements }}</p>
<?php } ?>
<p>For any clarification or details contact us during office hours at 02-336257 ext.126 or email dhibizap@dhi.bt</p>

<p>Regards,<br>
DHI BizAP Team</p>

    </body>
</html>


