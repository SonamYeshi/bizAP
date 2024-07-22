<x-app-layout>
    @include('top_nav_bar')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                    <nav class="navbar navbar-light bg-light">
                    <strong>Presentation Scores for <font color = "blue">{{ $application->name }}</font></strong>
                    </nav>
                    <div id="successMessage">
                            @include('flash-message')
                         </div>
                    <form class="row g-3" role="form" method="POST" action="{{ route('pptupdatescore') }}" enctype="multipart/form-data" id="pptScoreForm">
                            {{ csrf_field() }}
                            <!-- <input type="hidden" name="key" value=""> -->
                            <input type="hidden" name="appid" value="{{$appid}}">
                            <input type="hidden" name="fundid" value="{{$fundid}}">
                            
                            <br>
                            <div class="form-group col-md-10">
                                <label for="name" class="form-label"><strong>Shortlist Status:&nbsp;</strong></label>
                                <?php if ($application->shortlist_status == 1) { ?><b><font color = 'green'>Accepted</font></b> <?php } ?> &nbsp;&nbsp;{{$application->shortlist_on}}
                            </div>

                            <div class="form-group col-md-10">
                                <label for="name" class="form-label"><strong>Presentation Scores:&nbsp;</strong></label>
                            </div>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered table-sm table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Sl.No</th>
                                            <th>Panel Member</th>
                                            <th>Designation</th>
                                            <th>Role</th>
                                            <th>Score</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1;
                                        $scount =  count(App\Models\PresentationStatus::where('appID', $appid)->get());
                                        @endphp
                                        @foreach ($pannels as $pl)
                                            <tr>
                                                <td>{{$i}}
                                                <input type="hidden" name="rowss[steps][3][]" value="{{$pl->id}}">
                                                <input type="hidden" name="rowss[steps][4][]" value="{{$pl->ppt_score_id}}">
                                                </td>
                                                <td>{{$pl->name}}</td>
                                                <td>{{$pl->designation}}</td>
                                                <td>{{$pl->rolename}}</td>
                                                <td><input type="decimal" name='rowss[steps][1][]' value="{{$pl->score}}" class='form-control txtCal' required></td>
                                                <td><textarea name="rowss[steps][2][]" rows="1" class='form-control' required>{{$pl->remark}}</textarea></td>

                                            </tr>
                                        @php $i++; @endphp
                                        @endforeach
                                        <tr>
                                            <td colspan="4">Average Score</td>
                                            <td><b><span id="total_sum_value"></span></b></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">Export/Import </td>
                                            <td><a class="bbtn btn-primary btn-sm" href="{{ route('exportfund', $fundid) }}" style="text-decoration: none;">Export Score Sheet</a></td>
                                            <td>
                                            <a class='bbtn btn-primary btn-sm' data-toggle='modal' data-target="#addRoleModel" style="text-decoration: none;">Import Score Sheet
                                            </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                            @if($scount == '0')
                                <button type="submit" class="btn btn-primary btn-sm" onclick='return validateAndConfirm({{$application->ppt_schedule_id}})'>Save</button>
                            @endif
                            <a  href="{{ url()->previous() }}">
                            <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Back</button>
                            </a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="addRoleModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Import Score Sheet</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="{{ route('fundimport') }}" accept-charset="utf-8" enctype="multipart/form-data" >
          {{ csrf_field() }}
          <input type="hidden" name="appid" value="{{ $appid }}">
          <!-- <input type="hidden" name="sstatus" value=""> -->
          <!-- <input type="hidden" name="slstatus" value=""> -->
            <div class="form-group">
                  <label class="col-md-4 control-label"></label>
                   <div class="col-md-6">
                  <input type="file" id="exampleInputFile" name="file" class="form-control"><font color="red">(xlsx)</font>
                </div>
                </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-sm">Save</button>
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
    $(document).ready(function() {
        $("#successMessage").delay(2500).slideUp(300);
    });
</script>
    <script type="text/javascript">

function validateAndConfirm(ppt_schedule_id){
    var isValid = true;

    if(ppt_schedule_id == null){
        alert("Presentation date has not been scheduled.");
        return false;
    }else{
        // Validate all required fields
    $('#pptScoreForm :input[required]').each(function() {
    if (!$(this).val().trim()) {
        isValid = false;
        return false; // Exit each loop early if any field is invalid
    }
    });

    if(!isValid) {
        alert("Please fill in all required fields.");
    } else {
        return confirm("Are you sure you want to save the scores?");
    }
    }
}
$(document).ready(function () {
    $("#myTable").on('input', '.txtCal', function () {
        var calculated_total_sum = 0;
        var i=0;
        $("#myTable .txtCal").each(function () {
            var get_textbox_value = $(this).val();
            if ($.isNumeric(get_textbox_value)) {
                calculated_total_sum += parseFloat(get_textbox_value);
                }
                i++
            });
                $("#total_sum_value").html(calculated_total_sum/i);
        });
    });
</script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <br>
                    <div class="row">
                    <p class="text-end"><a href="{{route('fapp_pdf',$appid)}}" style="text-decoration:none"><i class="fas fa-file-pdf"></i> Download PDF </a></p>
                            <div class="form-group col-md-12">
                                <label for="cid" class="form-label"><strong>Fund Applied for:&nbsp;
                                {{$application->fund_name}}</strong></label>
                            </div>
                         <hr>
                        
                            <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"> <label for="form_message"><strong> Personal Information </strong></label></div>
                            </div>
                            <p></p>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name"><strong>CID:&nbsp;</strong></label>{{$application->cid}}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name"><strong>Mr / Mrs / Ms:&nbsp;</strong></label>{{$application->initial}}
                                    </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name"><strong>Name:&nbsp;</strong></label>{{$application->name}}
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name"><strong>Date of Birth:&nbsp;</strong></label>{{$application->dob}}
                                    </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name"><strong>Mobile No:&nbsp;</strong></label>{{$application->mobileno}}
                                    </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name"><strong>EMail:&nbsp;</strong></label>{{$application->email}}
                                     </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Current Address:&nbsp;</strong></label>{{$application->current_address}}
                                    </div>
                            </div>
                        </div>
                         <p></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"> <label for="form_message"><strong>Primary Source of Income </strong></label></div>
                            </div>
                            <?php $Source = explode(',', $application->source_of_income); ?>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Employment</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="1" <?php foreach ($Source as $rslt1) : if ($rslt1 == '1') { ?> checked <?php } endforeach; ?> >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Private Business</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="2" <?php foreach ($Source as $rslt2) : if ($rslt2 == '2') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Others</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="3" <?php foreach ($Source as $rslt3) : if ($rslt3 == '3') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message">Please Specify if Others:&nbsp;</label>{{$application->source_of_income_others}}
                                    </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name"><strong>Name of Business:&nbsp;</strong></label>{{$application->business_name}}
                                   </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name"><strong>Business Location:&nbsp;</strong></label>{{$application->business_location}}
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Description of business (maximum of 250 words)</strong></label>
                                    <textarea id="form_message" class="form-control" rows="4" disabled>{{$application->business_description}}</textarea>
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Select the sector that your business currently operating</strong></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <?php $sector = explode(',', $application->business_sector); ?>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Agriculture and Forestry</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="1" <?php foreach ($sector as $rslt1) : if ($rslt1 == '1') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Consctruction and Real Estate</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="2" <?php foreach ($sector as $rslt2) : if ($rslt2 == '2') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Consumer packaged goods</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="3" <?php foreach ($sector as $rslt3) : if ($rslt3 == '3') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Dairy and / or cooperatives</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="4" <?php foreach ($sector as $rslt4) : if ($rslt4 == '4') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Education</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="5" <?php foreach ($sector as $rslt5) : if ($rslt5 == '5') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Environmental Services</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="6" <?php foreach ($sector as $rslt6) : if ($rslt6 == '6') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Financial Services</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="7" <?php foreach ($sector as $rslt7) : if ($rslt7 == '7') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Food and culinary</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="8" <?php foreach ($sector as $rslt8) : if ($rslt8 == '8') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Health</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="9" <?php foreach ($sector as $rslt9) : if ($rslt9 == '9') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Information Technology</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="10" <?php foreach ($sector as $rslt10) : if ($rslt10 == '10') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Paper / Packaging</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="11" <?php foreach ($sector as $rslt11) : if ($rslt11 == '11') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Transportation</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="12" <?php foreach ($sector as $rslt12) : if ($rslt12 == '12') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Textiles</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="13" <?php foreach ($sector as $rslt13) : if ($rslt13 == '13') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Tourism</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="14" <?php foreach ($sector as $rslt14) : if ($rslt14 == '14') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Waste Management and Sanitation</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="15" <?php foreach ($sector as $rslt15) : if ($rslt15 == '15') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Others</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="16" <?php foreach ($sector as $rslt16) : if ($rslt16 == '16') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Please Specify if Others:&nbsp;</label>{{$application->business_sector_others}}
                                  </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Explain the specific problem or opportunity your business was created to address (Maximum of 250 words)</strong></label>
                                    <textarea id="form_message" class="form-control" rows="4" required="required" disabled>{{$application->business_to_address}}</textarea>
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>What stage is your business activity / service in?</strong></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <?php $activity = explode(',', $application->business_activity); ?>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Research</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="1" <?php foreach ($activity as $rslt1) : if ($rslt1 == '1') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Proven Concept</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="2" <?php foreach ($activity as $rslt2) : if ($rslt2 == '2') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Initial prototype / early market testing</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="3" <?php foreach ($activity as $rslt3) : if ($rslt3 == '3') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Advanced prototype / Obtained market testing results</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="4" <?php foreach ($activity as $rslt4) : if ($rslt4 == '4') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Testing and certification completed for commercial use</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="5" <?php foreach ($activity as $rslt5) : if ($rslt5 == '5') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Being sold in the market</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="6" <?php foreach ($activity as $rslt6) : if ($rslt6 == '6') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>What is the status of your business? (You can select more than One)</strong></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <?php $status = explode(',', $application->business_status); ?>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Already in the market (obtained business license)</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="1" <?php foreach ($status as $rslt1) : if ($rslt1 == '1') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Expect to commercially launch in the next 6 months</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="2" <?php foreach ($status as $rslt2) : if ($rslt2 == '2') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Expect to commercially launch in 7-12 Months</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="3" <?php foreach ($status as $rslt3) : if ($rslt3 == '3') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Expect to commercially launch more than 12 months</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="4" <?php foreach ($status as $rslt4) : if ($rslt4 == '4') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Not Yet Decided</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="5" <?php foreach ($status as $rslt5) : if ($rslt5 == '5') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Additional Information about your business</strong></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">What is your revenue for the last three months (in Ngulturm)?</label>
                                    <input id="form_name" type="number" disabled class="form-control" value="<?php echo $application->revenue; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Who is your current customer target segment?</label>
                                    <input id="form_name" type="text" disabled class="form-control" value="<?php echo $application->customer_target; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Number of current customers</label>
                                    <input id="form_name" type="number" disabled class="form-control" value="<?php echo $application->no_of_current_customer; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">When did you start your company (specify date)?</label>
                                    <input id="form_name" type="date" disabled class="form-control" value="<?php echo $application->company_start_date; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">How much money have you already invested in your business so far?</label>
                                    <input id="form_name" type="number" disabled class="form-control" value="<?php echo $application->money_invested; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">How did you raise finance for your business?</label>
                                    <input id="form_name" type="text" disabled class="form-control" value="<?php echo $application->raise_finance; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">How many employees have you hired?</label>
                                    <input id="form_name" type="number" disabled class="form-control" value="<?php echo $application->employees_hired; ?>">
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Who is on your team? (You can select more than one)</strong></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <?php $team = explode(',', $application->team); ?>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Accountant</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="1" <?php foreach ($team as $rslt1) : if ($rslt1 == '1') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Marketing and sales expert</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="2" <?php foreach ($team as $rslt2) : if ($rslt2 == '2') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Technical Expert</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="3" <?php foreach ($team as $rslt3) : if ($rslt3 == '3') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Others</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="4" <?php foreach ($team as $rslt4) : if ($rslt4 == '4') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Please Specify if Others:&nbsp;</label>{{$application->team_others}}
                                    </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>What is the biggest challenge you are currently facing to the successful commercialization of your business? (Maximum of

                                            150 words)</strong></label>
                                    <textarea id="form_message" name="biggest_challenge" class="form-control" rows="4" disabled>{{$application->biggest_challenge}}</textarea>
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>What specific resources do you require in ordr to expand / grow your business? (Maximum 150 words)</strong></label>
                                    <textarea id="form_message" name="specific_resources" class="form-control" rows="4" disabled>{{$application->specific_resources}}</textarea>
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Is there anything else you would like us to know about your business opportunity? (Maximum 150 words)</strong></label>
                                    <textarea id="form_message" name="business_opportunity" class="form-control" rows="4" disabled >{{$application->business_opportunity}}</textarea>
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Declaration</strong></label>
                                    <div class="form-group"> <label for="form_name">By submitting this application, I affirm that the information provided are true and complete to the best of my knowledge. Any false statements, omission of any fac and misrepresentation in my resume, application or any other material, may result in my immediate dismissal from the DHI funding Process.<br>I hereby authorize DHI to verify the above information.</label></div>
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Attach the following</strong></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Passport size Photo:&nbsp;</label>
                                    @if($application->passport == null)
                                    <font color="red">No Documents Found </font>
                                    @else
                                    <a href="{{ url($application->doc_path.'/'.$application->passport) }}" target="_blank"><i class="bi bi-file-pdf"></i>{{$application->passport}}</a><br>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">CV:&nbsp;</label>
                                    @if($application->cv == null)
                                    <font color="red">No Documents Found </font>
                                    @else
                                    <a href="{{ url($application->doc_path.'/'.$application->cv) }}" target="_blank"><i class="bi bi-file-pdf"></i>{{$application->cv}}</a><br>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Business License:&nbsp;</label>
                                    @if($application->business_license == null)
                                    <font color="red">No Documents Found </font>
                                    @else
                                    <a href="{{ url($application->doc_path.'/'.$application->business_license) }}" target="_blank"><i class="bi bi-file-pdf"></i>{{$application->business_license}}</a><br>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Security clearance:&nbsp;</label>
                                    @if($application->noc == null)
                                    <font color="red">No Documents Found </font>
                                    @else
                                    <a href="{{ url($application->doc_path.'/'.$application->noc) }}" target="_blank"><i class="bi bi-file-pdf"></i>{{$application->noc}}</a><br>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Tax Clearance:&nbsp;</label>
                                    @if($application->tax_clearance == null)
                                    <font color="red">No Documents Found </font>
                                    @else
                                    <a href="{{ url($application->doc_path.'/'.$application->tax_clearance) }}" target="_blank"><i class="bi bi-file-pdf"></i>{{$application->tax_clearance}}</a><br>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Business Proposal:&nbsp;</label>
                                    @if($application->business_proposal == null)
                                    <font color="red">No Documents Found </font>
                                    @else
                                    <a href="{{ url($application->doc_path.'/'.$application->business_proposal) }}" target="_blank"><i class="bi bi-file-pdf"></i>{{$application->business_proposal}}</a><br>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">CID:&nbsp;</label>
                                    @if($application->cid_attach == null)
                                    <font color="red">No Documents Found </font>
                                    @else
                                    <a href="{{ url($application->doc_path.'/'.$application->cid_attach) }}" target="_blank"><i class="bi bi-file-pdf"></i>{{$application->cid_attach}}</a><br>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">CIB Report:&nbsp;</label>
                                    @if($application->cib == null)
                                    <font color="red">No Documents Found </font>
                                    @else
                                    <a href="{{ url($application->doc_path.'/'.$application->cib) }}" target="_blank"><i class="bi bi-file-pdf"></i>{{$application->cib}}</a><br>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Account statement of past two years:&nbsp;</label>
                                    @if($application->acc_statement == null)
                                    <font color="red">No Documents Found </font>
                                    @else
                                    <a href="{{ url($application->doc_path.'/'.$application->acc_statement) }}" target="_blank"><i class="bi bi-file-pdf"></i>{{$application->acc_statement}}</a><br>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Professional Recommendation:&nbsp;</label>
                                    @if($application->recomendation == null)
                                    <font color="red">No Documents Found </font>
                                    @else
                                    <a href="{{ url($application->doc_path.'/'.$application->recomendation) }}" target="_blank"><i class="bi bi-file-pdf"></i>{{$application->recomendation}}</a><br>
                                    @endif
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script type="text/javascript">
    $('#test').on('change', function() {
        if (this.value == "0") {
            $('#yesno').show();
        } else {
            $('#yesno').hide();
        }
    });
</script>
