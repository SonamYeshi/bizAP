<x-app-layout>
    @include('top_nav_bar')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-5">
                        @include('flash-message')
                            <div class="flex-shrink-0 flex items-center" >
                    <img class="img-responsive" src="{{URL::asset('/headd.JPG')}}">
		</div>
              <hr>
                <div class="row">
                                <div class="col-md-12 text-center">
                                    <h5><b>Disbursement Order</b></h5>
                                </div>
                            </div>

<input type="hidden" name="fundid" value="{{$id}}">
<input type="hidden" name="key" value="{{$key}}">
<p>
    DHI/DOI/7/<?php echo date('Y'); ?>/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Date:
</p>
<p style="margin: 0in; margin-bottom: .0001pt; text-rendering: optimizelegibility; font-feature-settings: 'kern'; font-kerning: normal;"><span style="color: #333333;">Head,</span></p>
<p style="margin: 0in; margin-bottom: .0001pt; text-rendering: optimizelegibility; font-feature-settings: 'kern'; font-kerning: normal;"><span style="color: #333333;">Credit Operations,</span></p>
<p style="margin: 0in; margin-bottom: .0001pt; text-rendering: optimizelegibility; font-feature-settings: 'kern'; font-kerning: normal;"><span style="color: #333333;">Bank of Bhutan Limited,</span></p>
<p style="margin: 0in; margin-bottom: .0001pt; text-rendering: optimizelegibility; font-feature-settings: 'kern'; font-kerning: normal;"><span style="color: #333333;">Thimphu.</span></p>

<p style="margin: 0in; margin-bottom: .0001pt;"><span style="color: #333333;">&nbsp;</span></p>
<p style="margin: 0in; margin-bottom: .0001pt; text-rendering: optimizelegibility; font-feature-settings: 'kern'; font-kerning: normal;"><strong><span style="color: #333333;">Subject: Disbursement order for the DHI Business Acceleration Fund.</span></strong></p>
<p style="margin: 0in; margin-bottom: .0001pt;"><strong><span style="color: #333333;">&nbsp;</span></strong></p>
<p style="margin: 0in; margin-bottom: .0001pt; text-rendering: optimizelegibility; font-feature-settings: 'kern'; font-kerning: normal;"><span style="color: #333333;">Dear Madam / Sir,</span></p>
<p style="margin: 0in; margin-bottom: .0001pt; text-rendering: optimizelegibility; font-feature-settings: 'kern'; font-kerning: normal;"><span style="color: #333333;">&nbsp;</span></p>
<p style="margin: 0in; margin-bottom: .0001pt; text-rendering: optimizelegibility; font-feature-settings: 'kern'; font-kerning: normal;"><span style="color: #333333;">With reference to the agreement signed and the DHI Business Acceleration Fund managed by Bank of Bhutan, kindly maintain a  Financing account and make a disbursement with the following details.</span></p>
<p>
<table id="example" class="table table-bordered table-sm table-striped">
<tbody>
<?php foreach($allapplication as $app): ?>
    <tr>
<td style="width: 36.4421%;">&nbsp;FDO No. 1:</td>
<td style="width: 55.4404%;">&nbsp;<b>DHI Business Acceleration Fund account no: 201669417</b></td>
</tr>
<tr>
<td style="width: 36.4421%;">&nbsp;Name of Entrepreneur:</td>
<td style="width: 55.4404%;">&nbsp;{{$app->name}}</td>
</tr>
<tr>
<td style="width: 36.4421%;">&nbsp;CID No:</td>
<td style="width: 55.4404%;">&nbsp;{{$app->cid}}</td>
</tr>
<tr>
<td style="width: 36.4421%;">&nbsp;Financing Account No.:</td>
<td style="width: 55.4404%;">&nbsp;{{$app->financing_account_no}}</td>
</tr>
<tr>
<td style="width: 36.4421%;">&nbsp;Mobile No.:</td>
<td style="width: 55.4404%;">{{$app->mobileno}}&nbsp;</td>
</tr>
<tr>
<td style="width: 36.4421%;">&nbsp;Total Approved Amount.:</td>
<td style="width: 55.4404%;">&nbsp;Nu.
<?php echo number_format($app->total_disbursed, 0);?>
/- (Five Lakhs) only
</td>
</tr>
<tr>
<td style="width: 36.4421%;">&nbsp;Tranche: (Figure and Words)</td>
<td style="width: 55.4404%;">&nbsp;Nu.
<?php echo number_format($app->actual_disbursed, 0);?>/-
(Nu. <?php echo App\Models\FundRequest::where('id', $id)->value('tranche');?>)
</td>
</tr>
<tr>
<td style="width: 36.4421%;">&nbsp;Entrepreneur (Fund Release to (Business Name  / License No):</td>
<td style="width: 55.4404%;">&nbsp;
{{$app->name}} &nbsp; ({{$app->business_name}}) <br>&nbsp; {{$app->business_licence_no}}
</td>
</tr>
<tr>
<td style="width: 36.4421%;">&nbsp;Entrepreneur (Fund Release bank account details):</td>
<td style="width: 55.4404%;">&nbsp; {{$app->bank_account_no}},&nbsp;{{$app->bank}}
</td>
</tr>
</tbody>
</table>
<div id="u3797" class="ax_default label">
<div id="u3797_text" class="text ">
<p>The above may kindly be debited to our DHI Business Acceleration Fund A/c No. 201669417 maintained</p>
<p>with Bank of Bhutan, Thimphu.</p>
<p>&nbsp;</p>
</div>
</div>
<div id="u3798" class="ax_default label">
<div id="u3798_text" class="text ">
<p>You are requested to arrange the above at the earliest.</p>
</div>
</div>
<div id="u3799" class="ax_default label">
<div id="u3799_text" class="text ">
<p>Thanking you,</p>
</div>
</div>
<div id="u3800" class="ax_default label">
<div id="u3800_div" class="">&nbsp;</div>
<div id="u3800_text" class="text ">
<p>Yours sincerely,</p>
</div>
</div>
<div id="u3801" class="ax_default label">
<div id="u3801_div" class="">&nbsp;</div>
<div id="u3801_text" class="text ">
<p>({{ $ad }})&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    &nbsp;({{ $accounthead }})</p>

    <p>Associate Director&nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
         &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
         &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
         &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
         &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp;
        Head of Accounts</p>
</div>
</div>
<div id="u3803" class="ax_default label">
<div id="u3803_text" class="text ">
<p>DOI, DHI&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
   &nbsp; &nbsp;
    DOF, DHI</p>

</div>
</div>
<hr>
<center>
<p style="font-size:12px">P.O.Box 1127 Motithang, Thimphu: Bhutan Tel: +975 2 336257/58 Fax: +975 2 336259
<br><u>www.dhi.bt</u></p></center>

<div class="modal-footer">

                               <a href="{{ route('disbursementpdf', array($fundid, $key)) }}">
				<button type="submit" class="btn btn-primary btn-sm" >Download</button>
                              </a>
                                <a  href="{{ url()->previous() }}">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Back</button>
           </a>
                            </div>

<?php endforeach; ?>

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




