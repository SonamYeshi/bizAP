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
                                    <h5>Interview</h5>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                    <div class="row">
                                        <form class="row g-3" role="form" method="POST" action="{{ route('tintsearch') }}" enctype="multipart/form-data">
                                          {{ csrf_field() }}
                                            <div class="col-md-4">
                                                <div class="form-group"> <label style="float: left;"><b>Filter By</b></label>
                                                    <select id="save" name="key" class="form-control" onchange="this.form.submit();">
                                                    <option value="" selected disabled>-- Select --</option>
                                                    @foreach($training as $t)
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
                                          <button class='bbtn btn-primary btn-sm' data-toggle='modal' data-target="#addRoleModel" style="text-decoration: none; float:right;">Email
                                          </button>
                                      </td>
                                    </tr>
                                    <tr>
                                        <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
                                        <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Group</th>
                                        <th style="color:#0553a1;font-weight: 500;font-size: 15px;">CID</th>
                                        <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Name</th>
                                        <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Email</th>
                                        <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Mobile No.</th>
                                        <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Gender</th>
                                        <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Average Score</th>
                                        <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Schedule Interview</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i = 1;
                                        @endphp
                                        @foreach($allapplication as $app)
                                          <tr>
                                            <td style="font-size: 14px;">{{$i}}</td>
                                            <td style="font-size: 14px;">{{$app->opencohort}} {{$app->opencohortno}}</td>
                                            <td style="font-size: 14px;"><a href="{{ route('interview_app_details', array($app->id)) }}">{{$app->cid}}</a></td>
                                            <td style="font-size: 14px;">{{$app->name}}</td>
                                            <td style="font-size: 14px;">{{$app->email}}</td>
                                            <td style="font-size: 14px;">{{$app->mobileno}}</td>
                                            <td style="font-size: 14px;">{{$app->sex}}</td>
                                            <td style="font-size: 14px; text-align: right;">
                                                @if($app->avg_score != 0.00)
                                                {{$app->avg_score}}
                                                @endif
                                            </td>
                                            <td style="font-size: 14px; text-align: right;">
                                            @php 
                                            $interview_schedule = App\Models\InterviewDateTime::where('appID', $app->id)->first();
                                            @endphp
                                            @if($interview_schedule =='')
                                            <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#Modal" onclick='addSchedule({{$app->id}})'>Schedule</button>
                                            @else 
                                            {{$interview_schedule->interview_date}} {{$interview_schedule->interview_time}}<br>
                                            <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#editModal" onclick='fun_edit({{$interview_schedule->id}},"{{$interview_schedule->interview_date}}","{{$interview_schedule->interview_time}}")'><font color="blue">Reschedule</font></button>
                                            @endif
                                            </td>
                                          </tr>
                                        @php $i++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- <input type="hidden" name="hidden_view_add" id="hidden_view_add" value="{{url('interview/add')}}"> -->
                            <!-- <input type="hidden" name="hidden_view_edit" id="hidden_view_edit" value="{{url('interview/edit')}}"> -->
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
      <h5 class="modal-title" id="myModalLabel">Add Interview Date and Time</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" role="form" method="POST" action="{{ route('idateadd') }}" id="interviewAddForm">
      <input type="hidden" name="appid" id='app_id'>
      <input type="hidden" name="sid" value="0">
      {{ csrf_field() }}
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Training Date<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="date" class="form-control form-control-sm" id="interviewdate" name="interviewdate" required>
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Training Time<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="time" class="form-control form-control-sm" id="interviewtime" name="interviewtime" required>
        </div>
        </div>
      </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm" onclick='return validateAndConfirm("interviewAddForm")' >Save</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
        </div>
      </form>
</div>
</div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
        <div class="modal-header"><h5 class="modal-title" id="myModalLabel">Update Interview Date and Time</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ route('interviewupdate') }}" id="interviewUpdateForm">
          {{ csrf_field() }}
          <input type="hidden" name="edit_id" id='edit_id'>
          <input type="hidden" name="sid" value="0">
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Training Date<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="date" class="form-control form-control-sm" id="einterviewdate" name="interviewdate" required>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Training Time<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="time" class="form-control form-control-sm" id="einterviewtime" name="interviewtime" required>
        </div>
        </div>
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-xs" onclick='return validateAndConfirm("interviewUpdateForm")'>Update</button>
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
        <form class="form-horizontal" method="POST" action="{{ route('sendinterviewmail') }}" accept-charset="utf-8" enctype="multipart/form-data" >
          {{ csrf_field() }}
            <div class="form-group">
                  <label class="col-md-4 control-label">Select Training<font color="red">*</font></label>
                <div class="col-md-6">
                  <select id="form_name"  name="tid" class="form-control" required>
                  <option value="">Select</option>
                    @foreach($training as $t)
                    <option value="{{$t->id}}">{{$t->training_title}}</option>
                    @endforeach
                  </select>
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

function fun_edit(id, inv_date, inv_time){
  $("#edit_id").val(id);
  $("#einterviewdate").val(inv_date);
  $("#einterviewtime").val(inv_time);

  // var view_url = $("#hidden_view_edit").val();
  // $.ajax({
  //   url: view_url,
  //   type:"GET",
  //   data: {"id":id},
  //   success: function(result){
  //     $("#edit_id").val(result.id);
  //     $("#einterviewdate").val(result.interview_date);
  //     $("#einterviewtime").val(result.interview_time);

  //   }
  // });
}

$(document).ready(function() {
  $('#example').DataTable();
});

$(window).load(function(){
   setTimeout(function(){ $('.alert-success').fadeOut() }, 5000);
});

</script>
<script src="jquery.js"></script>
<script src="jquery_tables.js"></script>
<link href="{{ asset('css/app_tables.css') }}" rel="stylesheet">


