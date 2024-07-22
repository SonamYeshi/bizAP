
<input type="hidden" name="fundid" value="">
<p style="margin: 0in; margin-bottom: .0001pt;" align="right"><span style="color: #333333;">
<?php $date = date("m.d.y"); ?>Date : {!! date('d F Y', strtotime($date))  !!}
</span></p>
<p style="margin: 0in; margin-bottom: .0001pt;" align="center"><span style="color: #333333;"><b>ANNOUNCEMENT</b></span></p>
<br>
<p style="margin: 0in; margin-bottom: .0001pt; text-rendering: optimizelegibility; font-feature-settings: 'kern'; font-kerning: normal;"><span style="color: #333333;">
Druk Holding and Investments Limited is pleased to announce the following shortlisted candidates for the final interview of the
<b>{{ $cohortopen }} {{ $no }}</b> DHI Business Acceleration Program (DHI BizAP)
</span></p>
<p>
<table style="width: 500px; margin-left:120px;" border="1" class="table">
<tbody>
     <tr>
        <TH colspan="3"><b>{{ $cohortopen }} {{ $no }}</b></TH>
    </tr>
    <tr>
        <TH>Sl.No</TH>
        <TH>Name</TH>
        <TH>CID Number</TH>
    </tr>
<?php $i = 1; foreach($allapplication as $app): ?>
    <tr>
<td>&nbsp;<?php echo $i; ?></td>
<td>&nbsp;{{ $app->name }}</td>
<td>&nbsp;{{ $app->cid }}</td>
</tr>
<?php $i++; endforeach; ?>
</tbody>
</table>
<div id="u3797" class="ax_default label">
<div id="u3797_text" class="text ">
<p>All shortlisted applicants are required to prepare a Deep Dive presentation for the interview.
    Please refer to the Deep Dive presentation template for instructions.
    Each applicant will be given only 10 minutes for presentation followed by 20 minutes of question and answer session.</p>
<p>&nbsp;</p>
</div>

<div id="u3797_text" class="text ">
<p><i><b> "Entrepreneurs are strongly encouraged to bring your product samples, marketing materials,
    or any other interesting materials related to your business during the deep dive presentation." </b></i></p>
<p>&nbsp;</p>
</div>
</div>

<style>
    table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>

