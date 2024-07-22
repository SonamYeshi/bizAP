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
                                    <h5>Fund Release Request Application</h5>
                                </div>
                            </div>
                            <div class="flex-shrink-0 flex items-center" >
                    <img class="img-responsive" src="{{URL::asset('/u0.png')}}"style="height:60px;width:150px;">
                </div>
<form id="contact-form" role="form" method="POST" action="{{ route('updatefundreview') }}" enctype="multipart/form-data">
{{ csrf_field() }}
<?php foreach($allapplication as $app): ?>
<input type="hidden" name="fundid" value="{{$id}}">
<input type="hidden" name="fundappid" value="{{$fundappid}}">
<input type="hidden" name="business_name" value="{{$app->business_name}}">
<p style="margin: 0in; margin-bottom: .0001pt;"><span style="color: #333333;">Director,</span></p>
<p style="margin: 0in; margin-bottom: .0001pt; text-rendering: optimizelegibility; font-feature-settings: 'kern'; font-kerning: normal;"><span style="color: #333333;">Department of Investments,</span></p>
<p style="margin: 0in; margin-bottom: .0001pt; text-rendering: optimizelegibility; font-feature-settings: 'kern'; font-kerning: normal;"><span style="color: #333333;">Durk Holding and and Investment Limited</span></p>
<p style="margin: 0in; margin-bottom: .0001pt;"><span style="color: #333333;">&nbsp;</span></p>
<p style="margin: 0in; margin-bottom: .0001pt; text-rendering: optimizelegibility; font-feature-settings: 'kern'; font-kerning: normal;"><strong><span style="color: #333333;">Subject: Fund Release from the DHI Business Acceleration Fund.</span></strong></p>
<p style="margin: 0in; margin-bottom: .0001pt;"><strong><span style="color: #333333;">&nbsp;</span></strong></p>
<p style="margin: 0in; margin-bottom: .0001pt; text-rendering: optimizelegibility; font-feature-settings: 'kern'; font-kerning: normal;"><span style="color: #333333;">Dear Madam / Sir,</span></p>
<p style="margin: 0in; margin-bottom: .0001pt; text-rendering: optimizelegibility; font-feature-settings: 'kern'; font-kerning: normal;"><span style="color: #333333;">&nbsp;</span></p>
<p style="margin: 0in; margin-bottom: .0001pt; text-rendering: optimizelegibility; font-feature-settings: 'kern'; font-kerning: normal;"><span style="color: #333333;">With reference to the financing agreement signed with DHI, I would like to request for release of the fund as detailed below.</span></p>
<p>
<table id="example" class="table table-bordered table-sm table-striped">
<tbody>

<tr>
<td style="width: 8.11741%;">&nbsp;1</td>
<td style="width: 36.4421%;">&nbsp;Name of Entrepreneur:</td>
<td style="width: 55.4404%;">&nbsp;
<input type="text" class="form-control" name="NameofEntrepreneur" value="{{$app->name}}"/>
</td>
</tr>
<tr>
<td style="width: 8.11741%;">&nbsp;2</td>
<td style="width: 36.4421%;">&nbsp;Business Name:</td>
<td style="width: 55.4404%;">&nbsp;
<input type="text" class="form-control" name="BusinessName" value="{{$app->business_name}}"/>
</td>
</tr>
<tr>
<td style="width: 8.11741%;">&nbsp;3</td>
<td style="width: 36.4421%;">&nbsp;License No.:</td>
<td style="width: 55.4404%;">&nbsp;
<input type="text" class="form-control" name="LicenseNo" value="{{$app->business_licence_no}}"/>
</td>
</tr>
<tr>
<td style="width: 8.11741%;">&nbsp;4</td>
<td style="width: 36.4421%;">&nbsp;Financing Account No.:</td>
<td style="width: 55.4404%;">&nbsp;{{$app->financing_account_no}}</td>
</tr>
<tr>
<td style="width: 8.11741%;">&nbsp;5</td>
<td style="width: 36.4421%;">&nbsp;Tranche: (Figure and Words)</td>
<td style="width: 55.4404%;">&nbsp;
<?php $tranche = App\Models\FundRequest::where('id', $id)->value('tranche');?>
<input type="text" class="form-control" name="Tranche" value="{{$tranche}}"/>
</td>
</tr>
<tr>
<td style="width: 8.11741%;">&nbsp;6</td>
<td style="width: 36.4421%;">&nbsp;Usage:</td>
<td style="width: 55.4404%;">&nbsp;
<?php $usage = App\Models\FundRequest::where('id', $id)->value('usage');?>
<input type="text" class="form-control" name="Usage" value="{{$usage}}"/>
</td>
</tr>
<tr>
<td style="width: 8.11741%;">&nbsp;7</td>
<td style="width: 36.4421%;">&nbsp;Attach Proof:</td>
<td style="width: 55.4404%;">&nbsp;
<?php $filename = App\Models\FundRequest::where('id', $id)->value('proof'); ?>
@if($filename != '')
<a href="{{ url('/uploads/proof/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $filename; ?></a>
@else
No Document
@endif
</td>
</tr>
<tr>
<td style="width: 8.11741%;">&nbsp;8</td>
<td style="width: 36.4421%;">&nbsp;To be paid to (Business Name):</td>
<td style="width: 55.4404%;">&nbsp;
<?php $Tobepaid = App\Models\FundRequest::where('id', $id)->value('paid_to');?>
<input type="text" class="form-control" name="Tobepaid" value="{{$Tobepaid}}"/>
</td>
</tr>
<tr>
<td style="width: 8.11741%;">&nbsp;9</td>
<td style="width: 36.4421%;">&nbsp;Enterpreneur Bank Account Details</td>
<td style="width: 55.4404%;">&nbsp;{{$app->bank}}:&nbsp;
<input type="text" class="form-control" name="BankAccount" value="{{$app->bank_account_no}}"/>
</td>
</tr>
</tbody>
</table>
<div class="modal-footer">
    <button type="submit" class="btn btn-warning btn-sm" onclick='return confirm("Are you sure to Update ?")'>Update</button>
</div>
</form>

<div id="u65" class="ax_default label">
<div id="u65_text" class="text ">
<p>&nbsp;</p>
<p>Applicable deductions for fund transfer if any may kindly be deducted from the approved financing.</p>
<p>I hereby confirm that the fund release is being requested as per the financing agreeement signed and that the funds</p>
<p>will be utilized for the agreed business plan only.</p>
</div>
</div>
<div id="u66" class="ax_default label">
<div id="u66_div" class="">&nbsp;</div>
<div id="u66_text" class="text ">
<p>Thanking You,</p>
<p>Yours Sincerely,</p>
</div>
</div>
<div id="u68" class="ax_default label">
<div id="u68_text" class="text ">
<p>Name: {{$app->name}}</p>
<p>CID: {{$app->cid}}</p>
<p>Mobile: {{$app->mobileno}}</p>
</div>
</div>
<div id="u71" class="ax_default label">
<div id="u71_div" class="">Email: {{$app->email}}</div>
</div>
<div id="u72" class="ax_default primary_button">&nbsp;</div>
<hr>
<?php endforeach; ?>
<center><h5>Review Details</h5></center>
<form id="contact-form" role="form" method="POST" action="{{ route('postfundreview') }}" enctype="multipart/form-data">
{{ csrf_field() }}
<?php foreach($allapplication as $app): ?>
<input type="hidden" name="fundid" value="{{$id}}">
<input type="hidden" name="fundappid" value="{{$fundappid}}">
<input type="hidden" name="business_name" value="{{$app->business_name}}">
                                <div class="form-group col-md-4">
                                    <label for="name" class="form-label"><strong>Approved Fund Amount<font color="red">*</font></strong></label>
                                    <input type="number" class="form-control" name="approvedfundamount" required />
                                </div>
                            <div class="form-group col-md-4">
                                <label for="name" class="form-label"><strong>Review Status<font color="red">*</font></strong></label>
                                <select class='form-control' required name="reviewstatus">
                                    <option value="1" >Reviewed</option>
                                    <option value="2" >Rejected</option>
                                </select>
                            </div>
                                <div class="form-group col-md-4">
                                    <label for="name" class="form-label"><strong>Remarks</strong></label>
                                    <textarea class="form-control" id="challenge" name="remarks" rows="3"></textarea>
                                </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm" onclick='return confirm("Are you sure to Save ?")'>Save</button>
                                <a  href="{{ url()->previous() }}">
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Back</button>
</a>
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



