<x-app-layout>
    @include('top_nav_bar')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-5">
                        @include('flash-message')
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h5>Short Listed Applicants</h5>
                                </div>
                            </div>
                            <div class="flex-shrink-0 flex items-center" >
                    <img class="img-responsive" src="{{URL::asset('/u0.png')}}"style="height:60px;width:150px;">
                </div>

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
<table id="example" class="table table-bordered table-sm table-striped" style="width: 500px; margin-left:250px;">
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
<p>All shortlisted applicants are required to prepare a
     <a href="http://bizap.dhi.bt/templates/Deep_Dive_Presentation_Template_2022.pptx" target="_blank">Deep Dive presentation</a>
      for the interview. Please refer to the Deep Dive presentation template for instructions.
      Each applicant will be given only 10 minutes for presentation followed by 20 minutes of question and answer session.
</p>
<p>
Each applicant must report to the venue thirty minutes prior to their allocated interview time.
Kindly note the interview schedule which will be shared via email soon. Kindly check both your Inbox as well as Spam boxes.
</p>
<p><i><b> "Entrepreneurs are strongly encouraged to bring your product samples, marketing materials,
    or any other interesting materials related to your business during the deep dive presentation." </b></i></p>
<p>
For any clarifications email us at <a href="dhibizap@dhi.bt" target="_blank">dhibizap@dhi.bt</a>  or call us at 336257/8 during office hours.
</p>
</div>
</div>
<div id="u3807" class="ax_default primary_button">&nbsp;</div>
                            <div class="modal-footer">
                            <a href="{{route('fsl_mail', array($cohortopen, $no))}}" class='bbtn btn-primary btn-sm' style="text-decoration: none;">Send Mail</a>
                            <a href="{{ redirect()->getUrlGenerator()->previous() }}" class='bbtn btn-danger btn-sm' style="text-decoration: none;">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="jquery.js"></script>
<script src="jquery_tables.js"></script>
<link href="{{ asset('css/app_tables.css') }}" rel="stylesheet">


