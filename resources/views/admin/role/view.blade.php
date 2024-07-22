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
                    <h5><strong>Create New Role</strong></h5>
                    <a class='btn btn-warning btn-sm pull-right' data-toggle='modal' data-target="#addRoleModel">Add Role</a>
                </div>
            </div><br>
            <div class="table-responsive">
              <table id="example" class="table table-bordered table-sm table-striped">
               <thead class="thead-dark">
                <tr>
                    <th width="10">No</th>
                    <th>Role Name</th>
                    <th>Description</th>
                    <th width="100px">Action</th>
                </tr>
               </thead>
               <tbody>
                <?php $id = 1;?>
                @foreach($roles as $role)
                <tr>
                  <td>{{$id++}}</td>
                  <td>{{$role->role_name}}</td>
                  <td>{{$role->description}}</td>
                  <td width='250px'>
                      @if($role->id != '7')
                  <a href="{{route('role.destroy',['id'=>$role->id])}}" class="btn btn-danger btn-sm" onclick='return confirm("Are you sure to Delete ?")'></span>Delete</a>
                  @endif
                </td>
                </tr>
                @endforeach
             </tbody>
             </table>
            </div>
             <input type="hidden" name="hidden_view" id="hidden_view" value="{{url('role/view')}}">
        </div>
    </div>
  </div>

<!-- Add role modal begins-->
<div class="modal fade" id="addRoleModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="myModalLabel" >Add Role</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('add_role') }}" method="post">
        {{csrf_field()}}
                <div class='form-group clearfix'>
                    <label for='section' class='col-xs-3'>Role Name:<font color="red">*</font></label>
                        <div class='col-xs-9 input-group'>
                            <input id="role_name" type="text" class="form-control" name="role_name" required autofocus>
                        </div>
                </div>
                <div class='form-group clearfix'>
                    <label for='description' class='col-xs-3'>Role Description:</label>
                        <div class='col-xs-9 input-group'>
                            <textarea id="description" type="description" class="form-control" name="description" placeholder="Enter description here" rows='2'></textarea>
                        </div>
                </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning btn-sm">Save</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Add role modal ends-->
<script>
    $(document).ready(function() {
        $("#successMessage").delay(2500).slideUp(300);
    });
</script>
  <script src="jquery.js"></script>
  <script src="jquery_tables.js"></script>
  <link href="{{ asset('css/app_tables.css') }}" rel="stylesheet">
<script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
     $(document).ready(function() {
    $('#example1').DataTable();
} );
</script>


            </div>
        </div>
    </div>
</x-app-layout>






