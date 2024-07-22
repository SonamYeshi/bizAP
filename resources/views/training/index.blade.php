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
                    <h5>Create Training Notification</h5>
                    <a class='btn btn-primary  btn-sm pull-right' data-toggle='modal' data-target="#addCountryModal">Create New</a>
                </div>
            </div>

            <div class="table-responsive">
            <table id="example" class="table table-sm table-striped">
               <thead class="thead-light">
                <tr>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Group</th>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Title</th>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Provider</th>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Deadline</th>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Time</th>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Action</th>
                </tr>
               </thead>
               <tbody>
               <?php $i = 1; foreach($training as $t): ?>
                <tr>
                    <td style="font-size: 14px;"><?php echo $i;?></td>
                    <td style="font-size: 14px;"><?php echo $t->opencohort;?>&nbsp;<?php echo $t->opencohortno;?></td>
                    <td style="font-size: 14px;"><?php echo $t->training_title;?></td>
                    <td style="font-size: 14px;"><?php echo App\Models\TrainingProvider::where('id', $t->training_provider)->value('name');?></td>
                    <td style="font-size: 14px;"><?php echo $t->training_date;?></td>
                    <td style="font-size: 14px;"><?php echo $t->training_time; ?></td>
                    <td style="font-size: 14px;">
                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#editModal" onclick='fun_edit({{$t->id}})' style="color: #0e5296;">Edit
                    </button>
                    <a href="{{route('delete_training',['id'=>$t->id])}}" onclick='return confirm("Are you sure to Delete ?")' class="btn btn-outline-danger btn-sm" style="color: #0e5296;">Delete</a>
                    </td>
                    </tr>
                    <?php $i++; endforeach; ?>
             </tbody>
             </table>
             </div>
             <input type="hidden" name="hidden_view" id="hidden_view" value="{{url('training/edit')}}">
        </div>
    </div>
  </div>

</div>
</div>
</div>
</x-app-layout>

<!-- Add country modal begins-->
<div class="modal fade" id="addCountryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="myModalLabel" style="font-size: 17px;">Add Training</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" role="form" method="POST" action="{{ route('trainingadd') }}" id="trainingForm">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Cohort/Open/Batch<font color="red">*</font></label>
        <div class="col-xs-6">
        <select id='opencohort' class="form-control form-control-sm" name="opencohort" required>
         <option value="" selected="true">Please select one</option>
         <option value="COHORT">COHORT</option>
         <option value="OPEN">OPEN</option>
         <option value="BATCH">BATCH</option>
        </select>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Cohort/Open No.<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="text" class="form-control form-control-sm" id="opencohortno" name="opencohortno" required >
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Training Title<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="training_title" type="textarea" class="form-control form-control-sm" name="training_title" required>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Announcement Detail<font color="red">*</font></label>
        <div class="col-xs-6">
        <textarea class="form-control form-control-sm" id="announcement_details" name="announcement_details" rows="3" required></textarea>
        </div>
        </div>

        <div class='form-group'>
        <label for='type' class='col-xs-4 control-label'>Training Provider<font color="red">*</font></label>
          <select class='form-control form-control-sm' id="training_provider" name="training_provider" required="required">
           <option value="" selected="true">Please select one</option>
           <?php
           $tp=App\Models\TrainingProvider::all();
           foreach($tp as $tps):
           ?>
           <option value="{{$tps->id}}">{{$tps->name}}</option>
          <?php endforeach ?>
          </select>
        <div class='col-xs-6'>
        </div>
        </div>
         <b>Application Submission Deadline</b>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Date<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="date" class="form-control form-control-sm" id="training_date" name="training_date" required>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Time<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="time" class="form-control form-control-sm" id="training_time" name="training_time" required>
        </div>
        </div>
        <b>Contact Information</b>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Email<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="email" id="email" class="form-control form-control-sm" name="email" required="required">
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Phone<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="number" id="phone" class="form-control form-control-sm" name="phone" required="required">
        </div>
        </div>

      </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary btn-sm" onclick='return validateAndConfirm()' >Save</button>
        <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Cancel</button>
        </div>
      </form>
</div>
</div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
        <div class="modal-header"><h5 class="modal-title" id="myModalLabel" style="font-size: 17px;">Update Training</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ route('update_training') }}">
          {{ csrf_field() }}
          <div class="form-group">
        <label for="description" class="col-xs-4 control-label">COHORT/OPEN/BATCH<font color="red">*</font></label>
        <div class="col-xs-6">
        <select id='eopencohort' class="form-control" name="opencohort" required>
         <option selected="true">Please select one</option>
         <option value="COHORT">COHORT</option>
         <option value="OPEN">OPEN</option>
         <option value="BATCH">BATCH</option>
        </select>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">COHORT/OPEN NO.<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="text" class="form-control form-control-sm" id="eopencohortno" name="opencohortno" required >
        </div>
        </div>

          <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Training Title<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="etraining_title" type="textarea" class="form-control" name="training_title" required>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Announcement Detail<font color="red">*</font></label>
        <div class="col-xs-6">
        <textarea class="form-control" id="eannouncement_details" name="announcement_details" rows="3" required></textarea>
        </div>
        </div>

          <div class='form-group'>
          <label for='type' class='col-xs-4 control-label'>Training Provider<font color="red">*</font></label>
          <select class='form-control' id="etraining_provider" name="training_provider" required="required">
          <option value="">Please select one</option>
           <?php
           $tp=App\Models\TrainingProvider::all();
           foreach($tp as $tps):
           ?>
           <option value="{{$tps->id}}">{{$tps->name}}</option>
          <?php endforeach ?>
          </select>
          <div class='col-xs-6'>
          </div>
          </div>

          <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Training Date<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="date" class="form-control form-control-sm" id="etraining_date" name="training_date" required>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Training Time<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="time" class="form-control form-control-sm" id="etraining_time" name="training_time" required>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Email<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="email" id="eemail" class="form-control" name="email" required="required">
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Phone<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="number" id="ephone" class="form-control" name="phone" required="required">
        </div>
        </div>

        <input type="hidden" name="edit_id" id='edit_id'>
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary btn-sm" onclick='return confirm("Are you sure to Update?")'>Update</button>
        <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
        </div>
        </form>
</div>
</div>
</div>

<script src="jquery.js"></script>
<script src="jquery_tables.js"></script>
<link href="{{ asset('css/app_tables.css') }}" rel="stylesheet">
<script>
  function validateAndConfirm(){
    var isValid = true;
    // Validate all required fields
    $('#trainingForm :input[required], #trainingForm select[required]').each(function() {
      if (!$(this).val().trim()) {
          isValid = false;
          return false; // Exit each loop early if any field is invalid
      }
    });

    if(!isValid) {
        alert("Please fill in all required fields.");
      } else {
        return confirm("Are you sure you want to save the training notification?");
      }
  }

  function fun_edit(id){
    var view_url = $("#hidden_view").val();
    $.ajax({
      url: view_url,
      type:"GET",
      data: {"id":id},
      success: function(result){
        $("#edit_id").val(result.id);
        $("#eopencohort").val(result.opencohort);
        $("#eopencohortno").val(result.opencohortno);
        $("#etraining_title").val(result.training_title);
        $("#eannouncement_details").val(result.announcement_details);
        $("#etraining_provider").val(result.training_provider);
        $("#etraining_date").val(result.training_date);
        $("#etraining_time").val(result.training_time);
        $("#eemail").val(result.email);
        $("#ephone").val(result.phone);
      }
    });
  }

  $(document).ready(function(){
    $('#example').DataTable();
  });
  $(window).load(function(){
    setTimeout(function(){ $('.alert-success').fadeOut() }, 5000);
  });
</script>





