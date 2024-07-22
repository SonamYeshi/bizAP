<x-app-layout>
  @include('top_nav_bar')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
  <div class="container">
   <div class="row">
        <div class="col-md-12 mt-5">

         <div id="app">
        @include('flash-message')

    </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h5>Expense Head</h5>
                    <a class='btn btn-warning  btn-sm pull-right' data-toggle='modal' data-target="#addCountryModal">Add Budget Details</a>
                </div>
            </div>
            <form id='myform' action="{{ route('budgetyear') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group col-md-5">
            <?php $currently_selected = date('Y');
            $earliest_year = 2020;
            $latest_year = date('Y'); ;
            ?>
            <label for="name" class="form-label"><strong>Select Year</strong></label>
            <select class='form-control' required name="budgetyear" onchange="this.form.submit();">
            <?php foreach ( range( $latest_year, $earliest_year ) as $i ) {
            print '<option value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$i.'</option>';
            } ?>
            </select>
            </div>
            </form>
            <div class="table-responsive">
            <table id="example" class="table table-bordered table-sm table-striped">
               <thead class="thead-dark">
                <tr>
                    <th>Sl.No</th>
                    <th>Financial Year</th>
                    <th>Budget Head</th>
                    <th>Activity</th>
                    <th>Amount</th>
                    <th style='width:15%'>Action</th>
                </tr>
               </thead>
               <tbody>
               <?php $i = 1; foreach($BudgetDetails as $bh): ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $bh->FinancialYear;?></td>
                    <td><?php echo App\Models\BudgetHead::where('id', $bh->BudgetHeadID)->value('HeadName');?></td>
                    <td><?php echo $bh->Activity;?></td>
                    <td><?php echo $bh->BudgetAmount; ?></td>
                    <td>
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" onclick='fun_edit({{$bh->id}})'><span class="glyphicon glyphicon-edit"></span>Edit
                    </button>
                    <a href="{{route('deleteBudgetDetail',['id'=>$bh->id])}}" onclick='return confirm("Are you sure to Delete ?")' class="btn btn-danger btn-sm">Delete</a>
                    </td>
                    </tr>
                    <?php $i++; endforeach; ?>
               </tbody>
             </table>
             </div>
             <input type="hidden" name="hidden_view" id="hidden_view" value="{{url('bgdetail/edit')}}">
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
      <h5 class="modal-title" id="myModalLabel">Add Budget Details</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" role="form" method="POST" action="{{ route('budgetdetailadd') }}">
      {{ csrf_field() }}
      <div class='form-group'>
            <?php $currently_selected = date('Y');
            $earliest_year = 2020;
            $latest_year = date('Y'); ;
            ?>
            <label for='type' class='col-xs-4 control-label'>Financial Year<font color="red">*</font></label>
            <select class='form-control' required name="FinancialYear" >
            <?php foreach ( range( $latest_year, $earliest_year ) as $i ) {
            print '<option value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$i.'</option>';
            } ?>
            </select>
            </div>
      <div class='form-group'>
        <label for='type' class='col-xs-4 control-label'>Budget Head<font color="red">*</font></label>
        <div class='col-xs-6'>
          <select class='form-control' id="HeadName" name="BHeadName" required="required">
           <option value="">Select</option>
           <?php
           $training=App\Models\BudgetHead::all();
           foreach($training as $tr):
           ?>
           <option value="{{$tr->id}}">{{$tr->HeadName}}</option>
          <?php endforeach ?>
          </select>
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Activity<font color="red">*</font></label>
        <div class="col-xs-6">
        <textarea class="form-control" id="announcement_details" name="Activity" rows="3" required="required"></textarea>
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Budget Amount<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="training_title" type="number" class="form-control" name="BudgetAmount" required>
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
        <div class="modal-header"><h5 class="modal-title" id="myModalLabel">Update Budget Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ route('update_budgetdetails') }}">
          {{ csrf_field() }}
          <div class='form-group'>
            <?php $currently_selected = date('Y');
            $earliest_year = 2020;
            $latest_year = date('Y'); ;
            ?>
            <label for='type' class='col-xs-4 control-label'>Financial Year<font color="red">*</font></label>
            <select class='form-control' required name="FinancialYear" id="eFinancialYear">
            <?php foreach ( range( $latest_year, $earliest_year ) as $i ) {
            print '<option value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$i.'</option>';
            } ?>
            </select>
            </div>
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
        <label for="description" class="col-xs-4 control-label">Activity<font color="red">*</font></label>
        <div class="col-xs-6">
        <textarea class="form-control" id="eActivity" name="Activity" rows="3" required="required"></textarea>
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Budget Amount<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="eBudgetAmount" type="number" class="form-control" name="BudgetAmount" required >
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
          $("#eFinancialYear").val(result.FinancialYear);
          $("#eBHeadName").val(result.BudgetHeadID);
          $("#eActivity").val(result.Activity);
          $("#eBudgetAmount").val(result.BudgetAmount);
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





