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
                    <a class='btn btn-primary btn-sm pull-right' data-toggle='modal' data-target="#addCountryModal">Add New Training Provider</a>
                </div>
            </div>

            <div class="table-responsive">
            <table id="example" class="table table-sm table-striped">
               <thead class="thead-light">
                <tr>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Name</th>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Country</th>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Address</th>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Contact Person</th>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">email</th>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">phone</th>
                    <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Action</th>
                </tr>
               </thead>
               <tbody>
               <?php $i = 1;
                foreach($provider as $t):
                ?>
                <tr>
                    <td style="font-size: 14px;"><?php echo $i;?></td>
                    <td style="font-size: 14px;"><?php echo $t->name;?></td>
                    <td style="font-size: 14px;"><?php echo App\Models\Country::where('id', $t->country)->value('country_name');?></td>
                    <td style="font-size: 14px;"><?php echo $t->address;?></td>
                    <td style="font-size: 14px;"><?php echo $t->contact_person; ?></td>
                    <td style="font-size: 14px;"><?php echo $t->email; ?></td>
                    <td style="font-size: 14px;"><?php echo $t->phone; ?></td>
                    <td style="font-size: 14px;">
                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#editModal" onclick='fun_edit({{$t->id}})' style="color: #0e5296;">Edit
                    </button>
                    <a href="{{route('delete_tp',['id'=>$t->id])}}" onclick='return confirm("Are you sure to Delete ?")' class="btn btn-outline-danger btn-sm" style="color: #0e5296;">Delete</a>
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
      <h5 class="modal-title" id="myModalLabel"  style="font-size: 17px;">Add Training Provider</h5>
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
           <option selected="true" disabled="disabled">Select</option>
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
        <button type="submit" class="btn btn-outline-primary btn-sm" onclick='return confirm("Are you sure to Save ?")' >Save</button>
        <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Cancel</button>
        </div>
      </form>
</div>
</div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
        <div class="modal-header"><h5 class="modal-title" id="myModalLabel"  style="font-size: 17px;">Update Training Provider</h5>
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
           <option selected="true" disabled="disabled">Select</option>
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





