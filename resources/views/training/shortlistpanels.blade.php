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
                    <h5>Short List Panel Members</h5>
                    <a class='btn btn-primary  btn-sm pull-right' data-toggle='modal' data-target="#addCountryModal">Add Panel Member</a>
                </div>
            </div>

            <div class="table-responsive">
            <table id="example" class="table table-sm table-striped">
               <thead class="thead-light">
                <tr>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Training</th>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Name</th>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Designation</th>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Role</th>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Action</th>
                </tr>
               </thead>
               <tbody>
               <?php $i = 1;
                foreach($interview as $t):
                ?>
                <tr>
                    <td style="font-size: 14px;"><?php echo $i;?></td>
                    <td style="font-size: 14px;"><?php echo App\Models\Training::where('id', $t->trainingid)->value('training_title');?></td>
                    <td style="font-size: 14px;"><?php echo $t->name;?></td>
                    <td style="font-size: 14px;"><?php echo $t->designation;?></td>
                    <td style="font-size: 14px;"><?php echo App\Models\Panelrole::where('id', $t->role)->value('rolename');?></td>
                    <td style="font-size: 14px;">
                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#editModal" onclick='fun_edit({{$t->id}})'><span class="glyphicon glyphicon-edit"></span>Edit
                    </button>
                    <a href="{{route('delete_sl',['id'=>$t->id])}}" onclick='return confirm("Are you sure to Delete ?")' class="btn btn-outline-danger btn-sm">Delete</a>
                    </td style="font-size: 14px;">
                    </tr>
                    <?php $i++;
                    endforeach;
                    ?>
             </tbody>
             </table>
             </div>
             <input type="hidden" name="hidden_view" id="hidden_view" value="{{url('slpanel/edit')}}">
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
      <h5 class="modal-title" id="myModalLabel">Add Panel Member</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" role="form" method="POST" action="{{ route('shortpaneladd') }}">
      {{ csrf_field() }}
      <div class='form-group'>
        <label for='type' class='col-xs-4 control-label'>Training<font color="red">*</font></label>
          <select class='form-control' id="training" name="training" required="required">
           <option value="">Select</option>
           <?php
           $training=App\Models\Training::all();
           foreach($training as $tr):
           ?>
           <option value="{{$tr->id}}">{{$tr->training_title}}</option>
          <?php endforeach ?>
          </select>
        <div class='col-xs-6'>
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Name<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="name" type="text" class="form-control" name="name" required>
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Designation<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="designation" type="text" class="form-control" name="designation" required>
        </div>
        </div>

        <div class='form-group'>
        <label for='type' class='col-xs-4 control-label'>Role<font color="red">*</font></label>
          <select class='form-control' id="role" name="role" required="required">
           <option value="">Select</option>
           <?php
           $panelrole=App\Models\Panelrole::all();
           foreach($panelrole as $pr):
           ?>
           <option value="{{$pr->id}}">{{$pr->rolename}}</option>
          <?php endforeach ?>
          </select>
        <div class='col-xs-6'>
        </div>
           </div>
      </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm" onclick='return confirm("Are you sure to Save ?")' >Save</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
        </div>
      </form>
</div>
</div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
        <div class="modal-header"><h5 class="modal-title" id="myModalLabel">Update Interview Panel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ route('update_slmember') }}">
          {{ csrf_field() }}
          <div class='form-group'>
        <label for='type' class='col-xs-4 control-label'>Training<font color="red">*</font></label>
          <select class='form-control' id="etraining" name="training" required="required">
           <option value="">Select</option>
           <?php
           $training=App\Models\Training::all();
           foreach($training as $tr):
           ?>
           <option value="{{$tr->id}}">{{$tr->training_title}}</option>
          <?php endforeach ?>
          </select>
        <div class='col-xs-6'>
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Name<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="ename" type="text" class="form-control" name="name" required>
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Designation<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="edesignation" type="text" class="form-control" name="designation" required>
        </div>
        </div>

        <div class='form-group'>
        <label for='type' class='col-xs-4 control-label'>Role<font color="red">*</font></label>
          <select class='form-control' id="erole" name="role" required="required">
           <option value="">Select</option>
           <?php
           $panelrole=App\Models\Panelrole::all();
           foreach($panelrole as $pr):
           ?>
           <option value="{{$pr->id}}">{{$pr->rolename}}</option>
          <?php endforeach ?>
          </select>
        <div class='col-xs-6'>
        </div>
           </div>
        <input type="hidden" name="edit_id" id='edit_id'>
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-xs" onclick='return confirm("Are you sure to Update?")'>Update</button>
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
   function fun_edit(id)
    {
      var view_url = $("#hidden_view").val();
      $.ajax({
        url: view_url,
        type:"GET",
        data: {"id":id},
        success: function(result){
          $("#edit_id").val(result.id);
          $("#etraining").val(result.trainingid);
          $("#ename").val(result.name);
          $("#edesignation").val(result.designation);
          $("#erole").val(result.role)
        }
      });
    }
     $(document).ready(function() {
    $('#example').DataTable();
} );
$(window).load(function(){
   setTimeout(function(){ $('.alert-success').fadeOut() }, 5000);
});
</script>





