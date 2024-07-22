<x-app-layout>
    @include('top_nav_bar_applicant')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-5">
                        @include('flash-message')
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h5>Fund Release Request Form</h5>
                                </div>
                            </div>
                            <div class="flex-shrink-0 flex items-center" >
                    <img class="img-responsive" src="{{URL::asset('/u0.png')}}"style="height:60px;width:150px;">
                </div>
<form id="contact-form" role="form" method="POST" action="{{ route('releasefund') }}" enctype="multipart/form-data">
{{ csrf_field() }}
<?php foreach($allapplication as $app): ?>
<input type="hidden" name="fundappid" value="{{ $fundappid }}" />
<input type="hidden" name="business_name" value="{{ $app->business_name }}" />
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
<td style="width: 55.4404%;">&nbsp;{{$app->name}}</td>
</tr>
<tr>
<td style="width: 8.11741%;">&nbsp;2</td>
<td style="width: 36.4421%;">&nbsp;Business Name:</td>
<td style="width: 55.4404%;">&nbsp;{{$app->business_name}}</td>
</tr>
<tr>
<td style="width: 8.11741%;">&nbsp;3</td>
<td style="width: 36.4421%;">&nbsp;License No.:</td>
<td style="width: 55.4404%;">{{$app->business_licence_no}}&nbsp;</td>
</tr>
<tr>
<td style="width: 8.11741%;">&nbsp;4</td>
<td style="width: 36.4421%;">&nbsp;Financing Account No.:</td>
<td style="width: 55.4404%;">&nbsp;{{$app->financing_account_no}}</td>
</tr>
<tr>
<td style="width: 8.11741%;">&nbsp;5</td>
<td style="width: 36.4421%;">&nbsp;Tranche: (Figure and Words)<font color="red">*</font></td>
<td style="width: 55.4404%;">&nbsp;
<input id="form_name" type="text" name="tranche" class="form-control" required>
</td>
</tr>
<tr>
<td style="width: 8.11741%;">&nbsp;6</td>
<td style="width: 36.4421%;">&nbsp;Usage:</td>
<td style="width: 55.4404%;">&nbsp;
<textarea id="form_message" name="usage" class="form-control" rows="4" required ></textarea>
</td>
</tr>
<tr>
<td style="width: 8.11741%;">&nbsp;7</td>
<td style="width: 36.4421%;">&nbsp;Attach Proof:<font color="red">*</font></strong>
<td style="width: 55.4404%;">&nbsp;
<input type="file" class="form-control" id="customFile" name="proof[]" required/>
</td>
</tr>
<tr>
<td style="width: 8.11741%;">&nbsp;8</td>
<td style="width: 36.4421%;">&nbsp;To be paid to (Business Name):</td>
<td style="width: 55.4404%;">&nbsp;<input id="form_name" type="text" name="paidto" class="form-control" value="<?php echo $app->business_name; ?>"></td>
</tr>
<tr>
<td style="width: 8.11741%;">&nbsp;9</td>
<td style="width: 36.4421%;">&nbsp;Enterpreneur Bank Account Details</td>
<td style="width: 55.4404%;">&nbsp;{{$app->bank_account_no}}</td>
</tr>
<tr>
<td style="width: 8.11741%;">&nbsp;10</td>
<td style="width: 36.4421%;">&nbsp;Tranche No.<font color="red">*</font></td>
<td style="width: 55.4404%;">&nbsp;<select name="trancheno" class="form-control" required>
    <option value="">--select--</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
</select></td>
</tr>
</tbody>
</table>
</p>
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
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>Yours Sincerely,</p>
</div>
</div>
<div id="u68" class="ax_default label">
<div id="u68_text" class="text ">
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>Name: {{$app->name}}</p>
<p>CID: {{$app->cid}}</p>
<p>Mobile: {{$app->mobileno}}</p>
</div>
</div>
<div id="u71" class="ax_default label">
<div id="u71_div" class="">Email: {{$app->email}}</div>
</div>
<div id="u72" class="ax_default primary_button">&nbsp;</div>
<div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm" onclick='return confirm("Are you sure to Submit ?")' >Submit</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
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
<script>
    function addSchedule(id)
    {
      var view_url = $("#hidden_view_add").val();
      $.ajax({
        url: view_url,
        type:"GET",
        data: {"id":id},
        success: function(result){
            $("#app_id").val(result.id);
        }
      });
    }
</script>
<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="myModalLabel">Upload Contract</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" role="form" method="POST" action="{{ route('uploadcontract') }}" enctype="multipart/form-data">
      <input type="hidden" name="appid" id='app_id'>
      {{ csrf_field() }}
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Upload Contract<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="file" class="form-control" id="contract" name="contract[]" />
        </div>
        </div>

      </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm" onclick='return confirm("Are you sure to Submit ?")' >Save</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
        </div>
      </form>
</div>
</div>
</div>
