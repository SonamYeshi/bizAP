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
                    <h5><strong>DHI ICT eMail</strong></h5>
                </div>
            </div><br>
            <div class="table-responsive">
              <table id="example" class="table table-bordered table-sm table-striped">
               <thead class="thead-dark">
                <tr>
                    <th width="10">No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th width="100px">Action</th>
                </tr>
               </thead>
               <tbody>
                <?php $id = 1;?>
                @foreach($ictemail as $role)
                <tr>
                  <td>{{$id++}}</td>
                  <td>{{$role->name}}</td>
                  <td>{{$role->email}}</td>
                  <td width='250px'>
                  <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" onclick='fun_edit({{$role->id}})'><span class="glyphicon glyphicon-edit"></span>Update
                    </button>
                </td>
                </tr>
                @endforeach
             </tbody>
             </table>
            </div>
            <input type="hidden" name="hidden_view" id="hidden_view" value="{{url('ict/view')}}">
        </div>
    </div>
  </div>

  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
        <div class="modal-header"><h5 class="modal-title" id="myModalLabel">Update ICT Email</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ route('update_ictmail') }}">
          {{ csrf_field() }}
          <div class="form-group">
          <label for="ename" class="col-xs-4 control-label">Name<font color="red">*</font></label>
          <div class="col-xs-6">
          <input id="ictname" type="text" class="form-control" name="uname" required="required">
          </div>
          </div>
          <div class="form-group">
          <label for="description" class="col-xs-4 control-label">Email<font color="red">*</font></label>
          <div class="col-xs-6">
          <input type="email" id="ictmail" class="form-control" name="email" required="required">
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
<script>
    $(document).ready(function() {
        $("#successMessage").delay(2500).slideUp(300);
    });
</script>
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
          $("#ictname").val(result.name);
          $("#ictmail").val(result.email);

        }
      });
    }
     $(document).ready(function() {
    $('#example').DataTable();
} );
</script>


            </div>
        </div>
    </div>
</x-app-layout>







