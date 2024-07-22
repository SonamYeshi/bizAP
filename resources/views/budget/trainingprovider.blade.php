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
                    <h5>Training Provider</h5>
                    <a class='btn btn-warning  btn-sm pull-right' data-toggle='modal' data-target="#addCountryModal">Add New Training Provider</a>
                </div>
            </div>

            <div class="table-responsive">
            <table id="example" class="table table-bordered table-sm table-striped">
               <thead class="thead-dark">
                <tr>
                    <th>Sl.No</th>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Address</th>
                    <th>Contact Person</th>
                    <th>email</th>
                    <th>phone</th>
                    <th style='width:15%'>Action</th>
                </tr>
               </thead>
               <tbody>
               <?php $i = 1;
                foreach($provider as $t):
                ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $t->name;?></td>
                    <td><?php echo App\Models\Country::where('id', $t->country)->value('country_name');?></td>
                    <td><?php echo $t->address;?></td>
                    <td><?php echo $t->contact_person; ?></td>
                    <td><?php echo $t->email; ?></td>
                    <td><?php echo $t->phone; ?></td>
                    <td>
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" onclick='fun_edit({{$t->id}})'><span class="glyphicon glyphicon-edit"></span>Edit
                    </button>
                    <a href="{{route('delete_tp',['id'=>$t->id])}}" onclick='return confirm("Are you sure to Delete ?")' class="btn btn-danger btn-sm">Delete</a>
                    </td>
                    </tr>
                    <?php $i++;
                    endforeach;
                    ?>
             </tbody>
             </table>
             </div>
             <input type="hidden" name="hidden_view" id="hidden_view" value="{{url('trainingprovider/edit')}}">
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
      <h5 class="modal-title" id="myModalLabel">Add Training Provider</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" role="form" method="POST" action="{{ route('trainingprovideradd') }}">
      {{ csrf_field() }}
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Name<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="name" type="text" class="form-control" name="name" required>
        </div>
        </div>

        <div class='form-group'>
        <label for='type' class='col-xs-4 control-label'>Country<font color="red">*</font></label>
          <select class='form-control' id="country" name="country" required="required">
           <option value="">Select</option>
           <?php
           $country=App\Models\Country::all();
           foreach($country as $c):
           ?>
           <option value="{{$c->id}}">{{$c->country_name}}</option>
          <?php endforeach ?>
          </select>
        <div class='col-xs-6'>
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Address<font color="red">*</font></label>
        <div class="col-xs-6">
        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Contact Person<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="text" class="form-control form-control-sm" id="contact_person" name="contact_person" >
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Email<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="email" id="email" class="form-control" name="email" required="required">
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Phone<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="number" id="phone" class="form-control" name="phone" required="required">
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
        <div class="modal-header"><h5 class="modal-title" id="myModalLabel">Update Training Provider</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ route('update_trainingprovider') }}">
          {{ csrf_field() }}
          <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Name<font color="red">*</font></label>
        <div class="col-xs-6">
        <input id="ename" type="text" class="form-control" name="name" required>
        </div>
        </div>

        <div class='form-group'>
        <label for='type' class='col-xs-4 control-label'>Country<font color="red">*</font></label>
          <select class='form-control' id="ecountry" name="country" required="required">
           <option value="">Select</option>
           <?php
           $country=App\Models\Country::all();
           foreach($country as $c):
           ?>
           <option value="{{$c->id}}">{{$c->country_name}}</option>
          <?php endforeach ?>
          </select>
        <div class='col-xs-6'>
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Address<font color="red">*</font></label>
        <div class="col-xs-6">
        <textarea class="form-control" id="eaddress" name="address" rows="3" required></textarea>
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Contact Person<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="text" class="form-control form-control-sm" id="econtact_person" name="contact_person" >
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Email<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="eemail" id="eemail" class="form-control" name="email" required="required">
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
          $("#ename").val(result.name);
          $("#ecountry").val(result.country);
          $("#econtact_person").val(result.contact_person);
          $("#eaddress").val(result.address);
          $("#eemail").val(result.email);
          $("#ephone").val(result.phone);
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





