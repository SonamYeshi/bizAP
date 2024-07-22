<x-app-layout>
  @include('admin_nav_bar')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
  <div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="row">
            <div id="successMessage">
             @include('flash-message')
             </div>

                <div class="col-md-12 text-center">
                    <h5>User Management - List of Users</h5>
                    <a class='btn btn-warning  btn-sm pull-right' data-toggle='modal' data-target="#addCountryModal">Add Users</a>
                </div>
            </div>

            <div class="table-responsive">
            <table id="example" class="table table-bordered table-sm table-striped">
               <thead class="thead-dark">
                <tr>
                    <th>Sl.No</th>
                    <th>Name</th>
                    <th>e-Mail/Username</th>
                    <th>User Role</th>
                    <th style='width:15%'>Action</th>
                </tr>
               </thead>
               <tbody>
               <?php $i = 1;
                foreach($users as $user):
                ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $user->name;?></td>
                    <td><?php echo $user->email;?></td>
                    <td><?php echo $role = App\Models\tbl_role::where('id', $user->role_id)->value('role_name');?></td>
                    <td>
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" onclick='fun_edit({{$user->id}})'><span class="glyphicon glyphicon-edit"></span>Edit
                    </button>
                    <a href="{{route('delete_user',['id'=>$user->id])}}" onclick='return confirm("Are you sure?")' class="btn btn-danger btn-sm">Delete</a>
                    </td>
                    </tr>
                    <?php $i++;
                    endforeach;
                    ?>
             </tbody>
             </table>
             </div>
             <input type="hidden" name="hidden_view" id="hidden_view" value="{{url('user/view')}}">
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
      <h5 class="modal-title" id="myModalLabel">Add User</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" role="form" method="POST" action="{{ route('insert_user') }}">
      {{ csrf_field() }}
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Name<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="uname" type="input" class="form-control" name="uname" required>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">User Role<font color="red">*</font></label>
        <div class="col-xs-6">
          <select  name="role_id" id="role_id"  class="form-control" required="required">
          <option value="">Select User Role</option>
          <?php
          $roles = App\Models\tbl_role::all();
          foreach($roles as $r):
          ?>
          <option value="{{$r->id}}">{{$r->role_name}}</option>
          <?php endforeach;?>
          </select>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Email<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="email" id="email" class="form-control" name="email" required="required">
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

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
        <div class="modal-header"><h5 class="modal-title" id="myModalLabel">Update User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ route('update_user') }}">
          {{ csrf_field() }}
          <div class="form-group">
          <label for="ename" class="col-xs-4 control-label">Name<font color="red">*</font></label>
          <div class="col-xs-6">
          <input id="ename" type="text" class="form-control" name="uname" required="required">
          </div>
          </div>

          <div class="form-group">
          <label for="user_role" class="col-xs-4 control-label">User Role<font color="red">*</font></label>
          <div class="col-xs-6">
          <select  name="role_id" id="erole_id" class="col-xs-6 form-control" required="required">
          <option value="">Select the User Role</option>
           <?php $roles = App\Models\tbl_role::all();
          foreach($roles as $role):?>
          <option value="{{$role->id}}">{{$role->role_name}}</option>
          <?php endforeach;?>
          </select>
          </div>
          </div>

          <div class="form-group">
          <label for="description" class="col-xs-4 control-label">Email<font color="red">*</font></label>
          <div class="col-xs-6">
          <input type="email" id="eemail" class="form-control" name="email" required="required">
          </div>
          </div>



        <input type="hidden" name="edit_id" id='edit_id'>
        </div>

        <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-xs">Update</button>
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
    $(document).ready(function() {
        $("#successMessage").delay(2500).slideUp(300);
    });
</script>
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
          $("#ename").val(result.name);
          $("#eemail").val(result.email);
          $("#eworking_agency").val(result.working_agency);
          $("#erole_id").val(result.role_id);
        }
      });
    }
     $(document).ready(function() {
    $('#example').DataTable();
} );
</script>





