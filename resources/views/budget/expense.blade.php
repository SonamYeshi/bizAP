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
                    <h5>Expense Head</h5>
                    <a class='btn btn-warning  btn-sm pull-right' data-toggle='modal' data-target="#addCountryModal">Add Expense Head</a>
                </div>
            </div>

            <div class="table-responsive">
            <table id="example" class="table table-bordered table-sm table-striped">
               <thead class="thead-dark">
                <tr>
                    <th>Sl.No</th>
                    <th>Budget Head</th>
                    <th>Expense Head Name</th>
                    <th>Expense Head Code</th>
                    <th>Expense Head Description</th>
                    <th style='width:15%'>Action</th>
                </tr>
               </thead>
               <tbody>
               <?php $i = 1; foreach($ExpenseHead as $bh): ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo App\Models\BudgetHead::where('id', $bh->BudgetHeadID)->value('HeadName');?></td>
                    <td><?php echo $bh->ExpenseHeadName;?></td>
                    <td><?php echo $bh->ExpenseHeadCode;?></td>
                    <td><?php echo $bh->ExpenseHeadDescription; ?></td>
                    <td>
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" onclick='fun_edit({{$bh->id}})'><span class="glyphicon glyphicon-edit"></span>Edit
                    </button>
                    <a href="{{route('delete_exphead',['id'=>$bh->id])}}" onclick='return confirm("Are you sure to Delete ?")' class="btn btn-danger btn-sm">Delete</a>
                    </td>
                    </tr>
                    <?php $i++; endforeach; ?>
               </tbody>
             </table>
             </div>
             <input type="hidden" name="hidden_view" id="hidden_view" value="{{url('exphead/edit')}}">
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
      <h5 class="modal-title" id="myModalLabel">Add Expense Head</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" role="form" method="POST" action="{{ route('expenseheadadd') }}">
      {{ csrf_field() }}
      <div class='form-group'>
        <label for='type' class='col-xs-4 control-label'>Budget Head<font color="red">*</font></label>
          <select class='form-control' id="HeadName" name="BHeadName" required="required">
           <option value="">Select</option>
           <?php
           $training=App\Models\BudgetHead::all();
           foreach($training as $tr):
           ?>
           <option value="{{$tr->id}}">{{$tr->HeadName}}</option>
          <?php endforeach ?>
          </select>
        <div class='col-xs-6'>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Expense Head Name<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="training_title" type="textarea" class="form-control" name="HeadName" required>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Expense Head Code<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="training_title" type="textarea" class="form-control" name="HeadCode" required>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Expense Head Description</label>
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
        <div class="modal-header"><h5 class="modal-title" id="myModalLabel">Update Expense Head</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ route('update_exphead') }}">
          {{ csrf_field() }}
          <div class='form-group'>
        <label for='type' class='col-xs-4 control-label'>Budget Head<font color="red">*</font></label>
          <select class='form-control' id="eBHeadName" name="BHeadName" required="required">
           <option value="">Select</option>
           <?php
           $training=App\Models\BudgetHead::all();
           foreach($training as $tr):
           ?>
           <option value="{{$tr->id}}">{{$tr->HeadName}}</option>
          <?php endforeach ?>
          </select>
        <div class='col-xs-6'>
        </div>
        </div>

          <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Expense Head Name<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="eHeadName" type="textarea" class="form-control" name="HeadName" required>
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Expense Head Code<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="eHeadCode" type="textarea" class="form-control" name="HeadCode" required>
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Expense Head Description</label>
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
          $("#eBHeadName").val(result.BudgetHeadID);
          $("#eHeadName").val(result.ExpenseHeadName);
          $("#eHeadCode").val(result.ExpenseHeadCode);
          $("#eHeadDescription").val(result.ExpenseHeadDescription);
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





