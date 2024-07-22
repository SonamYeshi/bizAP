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
                    <h5>Budget Head</h5>
                    <a class='btn btn-warning  btn-sm pull-right' data-toggle='modal' data-target="#addCountryModal">Add Budget Head</a>
                </div>
            </div>

            <div class="table-responsive">
            <table id="example" class="table table-bordered table-sm table-striped">
               <thead class="thead-dark">
                <tr>
                    <th>Sl.No</th>
                    <th>Budget Head</th>
                    <th>Head Code</th>
                    <th>Head Description</th>
                    <th style='width:15%'>Action</th>
                </tr>
               </thead>
               <tbody>
               <?php $i = 1; foreach($BudgetHead as $bh): ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $bh->HeadName;?></td>
                    <td><?php echo $bh->HeadCode;?></td>
                    <td><?php echo $bh->HeadDescription; ?></td>
                    <td>
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" onclick='fun_edit({{$bh->id}})'><span class="glyphicon glyphicon-edit"></span>Edit
                    </button>
                    <a href="{{route('delete_bhead',['id'=>$bh->id])}}" onclick='return confirm("Are you sure to Delete ?")' class="btn btn-danger btn-sm">Delete</a>
                    </td>
                    </tr>
                    <?php $i++; endforeach; ?>
               </tbody>
             </table>
             </div>
             <input type="hidden" name="hidden_view" id="hidden_view" value="{{url('bdgethead/edit')}}">
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
      <h5 class="modal-title" id="myModalLabel">Add Budget Head</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" role="form" method="POST" action="{{ route('budgetheadadd') }}">
      {{ csrf_field() }}
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Head Name<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="training_title" type="textarea" class="form-control" name="HeadName" required>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Head Code<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="training_title" type="textarea" class="form-control" name="HeadCode" required>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Head Description</label>
        <div class="col-xs-6">
        <textarea class="form-control" id="announcement_details" name="HeadDescription" rows="3"></textarea>
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
        <div class="modal-header"><h5 class="modal-title" id="myModalLabel">Update Budget Head</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ route('update_bhead') }}">
          {{ csrf_field() }}
          <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Head Name<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="eHeadName" type="textarea" class="form-control" name="HeadName" required>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Head Code<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="eHeadCode" type="textarea" class="form-control" name="HeadCode" required>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Head Description</label>
        <div class="col-xs-6">
        <textarea class="form-control" id="eHeadDescription" name="HeadDescription" rows="3"></textarea>
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
          $("#eHeadName").val(result.HeadName);
          $("#eHeadCode").val(result.HeadCode);
          $("#eHeadDescription").val(result.HeadDescription);
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





