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
                    <h5>Create Funding Announcement</h5>
                    <a class='btn btn-primary  btn-sm pull-right' data-toggle='modal' data-target="#addCountryModal">Create New</a>
                </div>
            </div>

            <div class="table-responsive">
            <table id="example" class="table table-bordered table-sm table-striped">
            <thead class="thead-light">
		<tr>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Group</th>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Tenure (Months)</th>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">EMI (%)</th>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Administrative Charges (%)</th>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Title</th>
                    <th colspan="2" style="color:#0553a1;font-weight: 500;font-size: 15px;">Application Submission Deadline</th>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Action</th>
                </tr>
                <tr>
                    <td style="color:#0553a1;font-weight: 500;font-size: 15px;"></td>
                    <td style="color:#0553a1;font-weight: 500;font-size: 15px;"></td>
                    <td style="color:#0553a1;font-weight: 500;font-size: 15px;"></td>
                    <td style="color:#0553a1;font-weight: 500;font-size: 15px;"></td>
                    <td style="color:#0553a1;font-weight: 500;font-size: 15px;"></td>
                    <td style="color:#0553a1;font-weight: 500;font-size: 15px;"></td>
                    <td style="color:#0553a1;font-weight: 500;font-size: 15px;">Date</td>
                    <td style="color:#0553a1;font-weight: 500;font-size: 15px;">Time</td>
                    <td style="color:#0553a1;font-weight: 500;font-size: 15px;"></td>
                </tr>
               </thead>
               <tbody>
               <?php $i = 1; foreach($funding as $t): ?>
		<tr>
                    <td style="font-size: 14px;"><?php echo $i;?></td>
                    <td style="font-size: 14px;"><?php echo $t->opencohort;?>&nbsp;<?php echo $t->opencohortno;?></td>
                    <td style="font-size: 14px;"><?php echo $t->tenure;?></td>
                    <td style="font-size: 14px;"><?php echo $t->emiintres_rate;?></td>
                    <td style="font-size: 14px;"><?php echo $t->intres_rate;?></td>
                    <td style="font-size: 14px;"><?php echo $t->title;?></td>
                    <td style="font-size: 14px;"><?php echo $t->submission_date;?></td>
                    <td style="font-size: 14px;"><?php echo $t->submission_time; ?></td>
                    <td style="font-size: 14px;">
                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#editModal" onclick='fun_edit({{$t->id}})'><span class="glyphicon glyphicon-edit"></span>Edit
                    </button>
                    <a href="{{route('delete_funding',['id'=>$t->id])}}" onclick='return confirm("Are you sure to Delete?")' class="btn btn-outline-danger btn-sm">Delete</a>
                    </td>
                    </tr>
                    <?php $i++; endforeach; ?>
               </tbody>
             </table>
             </div>
             <input type="hidden" name="hidden_view" id="hidden_view" value="{{url('announcement/edit')}}">
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
      <h5 class="modal-title" id="myModalLabel">Add Funding Announcement</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" role="form" method="POST" action="{{ route('fundingadd') }}" id="fundingForm">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="description" class="col-xs-4 control-label">COHORT/OPEN<font color="red">*</font></label>
        <div class="col-xs-6">
        <select class="form-control" name="opencohort" required>
         <option value="">-- Select One --</option>
         <option value="COHORT">COHORT</option>
         <option value="OPEN">OPEN</option>
        </select>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">COHORT/OPEN NO.<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="number" class="form-control form-control-sm" id="training_date" name="opencohortno" required >
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Tenure (Months)<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="training_title" type="number" class="form-control form-control-sm" name="tenure" value="60" required>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">EMI (%)<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="training_title" type="decimal" class="form-control form-control-sm" name="emi_fee" value="5" required>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Administrative Charges (%)<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="training_title" type="decimal" class="form-control form-control-sm" name="administrative_fee" value="5" required>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Announcement Title<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="training_title" type="text" class="form-control form-control-sm" name="title" required>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Announcement Detail<font color="red">*</font></label>
        <div class="col-xs-6">
        <textarea class="form-control form-control-sm" id="announcement_details" name="details" rows="3" required></textarea>
        </div>
        </div>
       <b>Application Submission Deadline</b>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Date<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="date" class="form-control form-control-sm" id="training_date" name="date" required>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Time<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="time" class="form-control form-control-sm" id="training_time" name="time" required>
        </div>
        </div>
        <b>Contact Information</b>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Email<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="email" id="email" class="form-control form-control-sm" name="email" required>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Phone<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="number" id="phone" class="form-control form-control-sm" name="phone" required>
        </div>
        </div>

      </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm" onclick='return validateAndConfirm("fundingForm")' >Save</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
        </div>
      </form>
</div>
</div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
        <div class="modal-header"><h5 class="modal-title" id="myModalLabel">Update Funding Announcement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ route('update_funding') }}" id="fundingUpdateForm">
          {{ csrf_field() }}
          <div class="form-group">
        <label for="description" class="col-xs-4 control-label">COHORT/OPEN/BATCH<font color="red">*</font></label>
        <div class="col-xs-6">
        <select id='eopencohort' class="form-control" name="opencohort" required>
         <option value="">-- select one --</option>
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
        <label for="description" class="col-xs-4 control-label">Tenure (Months)<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="etenure" type="number" class="form-control" name="tenure" value="" required>
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">EMI(%)<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="emi" type="decimal" class="form-control form-control-sm" name="emi_fee" value="5" required>
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Administrative Charges (%)<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="eadministrative_fee" type="decimal" class="form-control" name="administrative_fee" value="5" required>
        </div>
        </div>

          <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Announcement Title<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="etitle" type="textarea" class="form-control" name="title" required>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Announcement Detail<font color="red">*</font></label>
        <div class="col-xs-6">
        <textarea class="form-control" id="edetails" name="details" rows="3" required></textarea>
        </div>
        </div>

          <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Application Submission Date<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="date" class="form-control form-control-sm" id="edate" name="date" required>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Application Submission Time<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="time" class="form-control form-control-sm" id="etime" name="time" required>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Email<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="email" id="eemail" class="form-control" name="email" required>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Phone<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="number" id="ephone" class="form-control" name="phone" required>
        </div>
        </div>

        <input type="hidden" name="edit_id" id='edit_id'>
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-xs" onclick='return validateAndConfirm("fundingUpdateForm")'>Update</button>
        <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
        </div>
        </form>
</div>
</div>
</div>

<script src="jquery.js"></script>
<script src="jquery_tables.js"></script>
<link href="{{ asset('css/app_tables.css') }}" rel="stylesheet">
<script>
  // function validateAndConfirm(){
  //   var isValid = true;
  //   // Validate all required fields
  //   $('#fundingForm :input[required], #fundingForm select[required]').each(function() {
  //     if (!$(this).val().trim()) {
  //         isValid = false;
  //         return false; // Exit each loop early if any field is invalid
  //     }
  //   });

  //   if(!isValid) {
  //       alert("Please fill in all required fields.");
  //     } else {
  //       return confirm("Are you sure you want to save the funding notification?");
  //     }
  // }

  function validateAndConfirm(formId){
    var isValid = true;
    var $form = $('#' + formId);

    $form.find(':input[required], select[required]').each(function() {
      if (!$(this).val().trim()) {
          isValid = false;
          return false; // Exit each loop early if any field is invalid
      }
    });

    if(!isValid) {
        alert("Please fill in all required fields.");
      } else {
        if(formId == "fundingForm"){
          return confirm("Are you sure you want to save the funding notification?");
        }else{
          return confirm("Are you sure you want to update the funding notification?");
        }
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
        $("#etenure").val(result.tenure);
        $("#emi").val(result.emiintres_rate);
        $("#eadministrative_fee").val(result.intres_rate);
        $("#etitle").val(result.title);
        $("#edetails").val(result.details);
        $("#edate").val(result.submission_date);
        $("#etime").val(result.submission_time);
        $("#eemail").val(result.email);
        $("#ephone").val(result.phone);
      }
    });
}

$(document).ready(function() {
    $('#example').DataTable();
});

$(window).load(function(){
   setTimeout(function(){ $('.alert-success').fadeOut() }, 5000);
});
</script>






