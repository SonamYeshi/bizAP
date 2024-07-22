<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-5">
                        @include('flash-message')
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h5>Disbursement Order</h5>
                                </div>
                            </div>
        <div class="flex-shrink-0 flex items-center" >
        <img class="img-responsive" src="{{URL::asset('/u0.png')}}"style="height:60px;width:80px;"><br><br>
        </div>
<form id="contact-form" role="form" method="POST" action="{{ route('postbankreview') }}" enctype="multipart/form-data">
{{ csrf_field() }}
<input type="hidden" name="fundid" value="{{$id}}">
<p style="margin: 0in; margin-bottom: .0001pt;"><span style="color: #333333;">Director,</span></p>
<p style="margin: 0in; margin-bottom: .0001pt; text-rendering: optimizelegibility; font-feature-settings: 'kern'; font-kerning: normal;"><span style="color: #333333;">Head,</span></p>
<p style="margin: 0in; margin-bottom: .0001pt; text-rendering: optimizelegibility; font-feature-settings: 'kern'; font-kerning: normal;"><span style="color: #333333;">Credit Operations,</span></p>
<p style="margin: 0in; margin-bottom: .0001pt; text-rendering: optimizelegibility; font-feature-settings: 'kern'; font-kerning: normal;"><span style="color: #333333;">Bank of Bhutan Limited,</span></p>
<p style="margin: 0in; margin-bottom: .0001pt; text-rendering: optimizelegibility; font-feature-settings: 'kern'; font-kerning: normal;"><span style="color: #333333;">Thimphu</span></p>

<p style="margin: 0in; margin-bottom: .0001pt;"><span style="color: #333333;">&nbsp;</span></p>
<p style="margin: 0in; margin-bottom: .0001pt; text-rendering: optimizelegibility; font-feature-settings: 'kern'; font-kerning: normal;"><strong><span style="color: #333333;">Subject: Disbursement order for the DHI Business Acceleration Fund.</span></strong></p>
<p style="margin: 0in; margin-bottom: .0001pt;"><strong><span style="color: #333333;">&nbsp;</span></strong></p>
<p style="margin: 0in; margin-bottom: .0001pt; text-rendering: optimizelegibility; font-feature-settings: 'kern'; font-kerning: normal;"><span style="color: #333333;">Dear Madam / Sir,</span></p>
<p style="margin: 0in; margin-bottom: .0001pt; text-rendering: optimizelegibility; font-feature-settings: 'kern'; font-kerning: normal;"><span style="color: #333333;">&nbsp;</span></p>
<p style="margin: 0in; margin-bottom: .0001pt; text-rendering: optimizelegibility; font-feature-settings: 'kern'; font-kerning: normal;"><span style="color: #333333;">With reference to the agrement signed and the DHI Business Acceleration Fund managed by Bank of Bhutan, kindly
maintain a  Financing account and make a disbursement with the following details.</span></p>
<p>
<table id="example" class="table table-bordered table-sm table-striped">
<tbody>
<?php foreach($allapplication as $app): ?>
    <tr>
<td style="width: 36.4421%;">&nbsp;FDD No. 1:</td>
<td style="width: 55.4404%;">&nbsp;DHI Business Acceleration Fund account no: 201669714</td>
</tr>
<tr>
<td style="width: 36.4421%;">&nbsp;Name of Entrepreneur:</td>
<td style="width: 55.4404%;">&nbsp;{{$app->name}}</td>
</tr>
<tr>
<td style="width: 36.4421%;">&nbsp;CID No:</td>
<td style="width: 55.4404%;">&nbsp;{{$app->business_name}}</td>
</tr>
<tr>
<td style="width: 36.4421%;">&nbsp;Financing Account No.:</td>
<td style="width: 55.4404%;">&nbsp;{{$app->financing_account_no}}</td>
</tr>
<tr>
<td style="width: 36.4421%;">&nbsp;Mobile No.:</td>
<td style="width: 55.4404%;">{{$app->business_licence_no}}&nbsp;</td>
</tr>
<tr>
<td style="width: 36.4421%;">&nbsp;Total Approved Amount.:</td>
<td style="width: 55.4404%;">&nbsp;Nu. 500,000 (Nu. Five Hundred Thousand Only)</td>
</tr>
<tr>
<td style="width: 36.4421%;">&nbsp;Tranche: (Figure and Words)</td>
<td style="width: 55.4404%;">&nbsp;
<?php echo App\Models\FundRequest::where('id', $id)->value('tranche');?>
</td>
</tr>
<tr>
<td style="width: 36.4421%;">&nbsp;Entrepreneur (Fund Release to (Business Name  / License No):</td>
<td style="width: 55.4404%;">&nbsp;
{{$app->business_name}}, &nbsp; {{$app->business_licence_no}}
</td>
</tr>
<tr>
<td style="width: 36.4421%;">&nbsp;Entrepreneur (Fund Release bank account details):</td>
<td style="width: 55.4404%;">&nbsp; {{$app->bank_account_no}}
</td>
</tr>
</tbody>
</table>
<div id="u3797" class="ax_default label">
<div id="u3797_text" class="text ">
<p>The above may kindly be debited to our DHI Business Acceleration Fund A/c No. 201669714 maintained</p>
<p>with Bank of Bhutan, Thimphu</p>
<p>&nbsp;</p>
</div>
</div>
<div id="u3798" class="ax_default label">
<div id="u3798_text" class="text ">
<p>You are requested to arrange th above at the earliest.</p>
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
<p>(Tenzin)&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;(Loday Phintsho)</p>
<p>Associate Director&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Head of Accounts</p>
</div>
</div>
<div id="u3803" class="ax_default label">
<div id="u3803_text" class="text ">
<p>DOI, DHI&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Accounts Unit, DHI</p>
</div>
</div>
<div id="u3804" class="ax_default label">
<div id="u3804_div" class="">&nbsp;</div>
<div id="u3804_text" class="text ">&nbsp;</div>
</div>
<div id="u3807" class="ax_default primary_button">&nbsp;</div>
<hr>
<center><h5>Fund Release Details</h5></center>

                            <div class="form-group col-md-4">
                                <label for="name" class="form-label"><strong>Received by: CID<font color="red">*</font></strong></label>
                                <input type="number" class="form-control" id="customFile" name="received_cid" />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name" class="form-label"><strong>Received by: Name<font color="red">*</font></strong></label>
                                <input type="text" class="form-control" id="customFile" name="received_name" />
                            </div>
                            <div class="form-group col-md-4">
                                    <label for="name" class="form-label"><strong>Remarks</strong></label>
                                    <textarea class="form-control" id="challenge" name="remarks" rows="3"></textarea>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="name" class="form-label"><strong>Attach Document</strong></label>
                                    <input type="file" class="form-control" id="customFile" name="bankdoc[]" />
                                </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm" onclick='return confirm("Are you sure to Save ?")'>Save</button>
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Back</button>
                            </div>

<?php endforeach; ?>
</form>
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


