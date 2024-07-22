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
                                    <h5>Presentation</h5>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                    <div class="row">
                                        <form class="row g-3" role="form" method="POST" action="{{ route('fppt_search') }}" enctype="multipart/form-data">
                                          {{ csrf_field() }}
                                            <div class="col-md-4">
                                                <div class="form-group"> <label style="float: left;"><b>Filter By</b></label>
                                                    <select id="save" name="key" class="form-control" onchange="this.form.submit();">
                                                    <option value="" selected disabled>-- Select --</option>
                                                    
                                                    @foreach($funding as $t)
                                                    <option value="{{$t->id}}">{{$t->opencohort}} {{$t->opencohortno}}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            <div class="table-responsive">
                                <table id="example" class="table table-bordered table-sm table-striped">
                                    <thead class="thead-light">

                                    <tr>
                                            <td colspan="8">Send Email to the Candidates</td>
                                            <td>
                                                <a href="{{ route('sendinterviewmail') }}" class='btn btn-primary  btn-sm pull-right' data-toggle='modal' data-target="#addRoleModel" style="text-decoration: none; float:right;">Email
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Group</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">CID</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Name</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Email</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Mobile</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Business</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Location</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Schedule</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1; @endphp
                                        @foreach ($allapplication as $app)
                                            <tr>
                                                <td style="font-size: 14px;"><?php echo $i; ?></td>
                                                <td style="font-size: 14px;"><?php echo $app->cohortopen; ?>&nbsp;<?php echo $app->cohortopenno; ?></td>
                                                <td style="font-size: 14px;"><a href="{{ route('p_app_details', array($app->id)) }}"><?php echo $app->cid; ?></a></td>
                                                <td style="font-size: 14px;"><?php echo $app->name; ?></td>
                                                <td style="font-size: 14px;"><?php echo $app->email; ?></td>
                                                <td style="font-size: 14px;" ><?php echo $app->mobileno; ?></td>
                                                <td style="font-size: 14px;"><?php echo $app->business_name; ?></td>
                                                <td style="font-size: 14px;"><?php echo $app->business_location; ?></td>
                                                <td style="font-size: 14px;">
                                                
                                                @if(is_null($app->ppt_dateline_id))
                                                <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#Modal" onclick='addSchedule({{$app->id}})'>Schedule</button>
                                                @else 
                                                {{$app->ppdate}} {{$app->pptime}}<br>
                                                <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#editModal" onclick='fun_edit({{$app->ppt_dateline_id}},"{{$app->ppdate}}","{{$app->pptime}}")'><font color="blue">Reschedule</font></button>
                                                @endif
                                             </td>
                                            </tr>
                                        @php $i++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- <input type="hidden" name="hidden_view_add" id="hidden_view_add" value="{{url('ppt/add')}}">
                            <input type="hidden" name="hidden_view_edit" id="hidden_view_edit" value="{{url('ppt/edit')}}"> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="myModalLabel">Add Presentation Date and Time</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" role="form" method="POST" action="{{ route('pdateadd') }}" id="pptScheduleForm">
      <input type="hidden" name="appid" id='app_id'>
      {{ csrf_field() }}
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Presentation Date<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="date" class="form-control form-control-sm" id="pptdate" name="pptdate" required>
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Presentation Time<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="time" class="form-control form-control-sm" id="ppttime" name="ppttime" required>
        </div>
        </div>
      </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm" onclick='return validateAndConfirm("pptScheduleForm")' >Save</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
        </div>
      </form>
</div>
</div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
        <div class="modal-header"><h5 class="modal-title" id="myModalLabel">Update Presentation Date and Time</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ route('pptupdate') }}" id="pptScheduleUpdateForm">
          {{ csrf_field() }}
          <input type="hidden" name="edit_id" id='edit_id'>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Presentation Date<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="date" class="form-control form-control-sm" id="epptdate" name="pptdate" required>
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Presentation Time<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="time" class="form-control form-control-sm" id="eppttime" name="ppttime" required>
        </div>
        </div>
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-xs" onclick='return validateAndConfirm("pptScheduleUpdateForm")'>Update</button>
        <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
        </div>
        </form>
</div>
</div>
</div>

<div class="modal fade" id="addRoleModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="{{ route('sendpptmail') }}" accept-charset="utf-8" enctype="multipart/form-data" >
          {{ csrf_field() }}

          <!-- <input type="hidden" name="key" value=""> -->
            <div class="form-group">
                  <label class="col-md-4 control-label">COHORT/OPEN<font color="red">*</font></label>
                   <div class="col-md-6">
                   <select id="form_name"  name="cohortopen" class="form-control" required>
                                                    <option value="">-- Select One --</option>
                                                    <option value="COHORT">COHORT</option>
                                                    <option value="OPEN">OPEN</option>
                                                 </select>
                </div>
            </div>
            <div class="form-group">
                        <label class="col-md-6 control-label">COHORT/OPEN NO<font color="red">*</font></label>
                        <div class="col-md-6">
                            <input id="form_name" type="number" name="cohortopenno" class="form-control" placeholder="Eenter NO" required>
                        </div>
                    </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-sm">Submit</button>
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="jquery.js"></script>
<script src="jquery_tables.js"></script>
<link href="{{ asset('css/app_tables.css') }}" rel="stylesheet">
<script>

function validateAndConfirm(formId){
    var isValid = true;
    // Validate all required fields
    $('#'+formId+' :input[required]').each(function() {
      if (!$(this).val().trim()) {
          isValid = false;
          return false; // Exit each loop early if any field is invalid
      }
    });

    if(!isValid) {
        alert("Please fill in all required fields.");
      } else {
        if(formId == "interviewUpdateForm"){
          return confirm("Are you sure you want to update?");
        }else{
          return confirm("Are you sure you want to save?");
        }
      }
}

function addSchedule(id){
  $("#app_id").val(id);
}

function fun_edit(id, ppt_date, ppt_time){
  $("#edit_id").val(id);
  $("#epptdate").val(ppt_date);
  $("#eppttime").val(ppt_time);
}

$(document).ready(function() {
  $('#example').DataTable();
});

$(window).load(function(){
   setTimeout(function(){ $('.alert-success').fadeOut() }, 5000);
});
</script>


