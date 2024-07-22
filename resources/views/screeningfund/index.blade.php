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
                                    <h5>Screening</h5>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                    <div class="row">
                                        <form class="row g-3" role="form" method="POST" action="{{ route('fs_search') }}" enctype="multipart/form-data">
                                          {{ csrf_field() }}
                                            <div class="col-md-4">
                                                <div class="form-group"> <label style="float: left;"><b>Filter By</b></label>
                                                    <select id="save" name="key" class="form-control" onchange="this.form.submit();">
                                                    <option value="" selected disabled>-- Select --</option>
                                                    <?php $funding = App\Models\Funding::all();
                                                    foreach($funding as $f){ ?>
                                                    <option value="<?php echo $f->id; ?>"><?php echo $f->opencohort; ?>&nbsp;<?php echo $f->opencohortno; ?></option>
                                                    <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            <div class="table-responsive">
                            <table id="example" class="table table-bordered table-sm table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Group</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">CID</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Name</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Email</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Mobile</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Business</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Location</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Status</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($allapplication as $app) :  ?>
                                            <tr>
                                                <td style="font-size: 14px;"><?php echo $i;?></td>
                                                <td style="font-size: 14px;"><?php echo $app->cohortopen; ?>&nbsp;<?php echo $app->cohortopenno; ?></td>
                                                <td style="font-size: 14px;"><a href="{{route('fapp_details',['id'=>$app->id, 'key'=>$key])}}"><?php echo $app->cid; ?></a></td>
                                                <td style="font-size: 14px;"><?php echo $app->name; ?></td>
                                                <td style="font-size: 14px;"><?php echo $app->email; ?></td>
                                                <td style="font-size: 14px;"><?php echo $app->mobileno; ?></td>
                                                <td style="font-size: 14px;"><?php echo $app->business_name; ?></td>
                                                <td style="font-size: 14px;"><?php echo $app->business_location;?></td>
                                                <td style="font-size: 14px;">
                                                    <?php
                                                     $sstatus = App\Models\FundScreeningStatus::where('appid', $app->id)->value('status');
                                                    ?>
                                                     @if($sstatus == '')
                                                    <form id='myform' action="{{ route('fs_update') }}" method="post">
                                                    {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ $key }}">
                                                            <input type="hidden" name="rowss[steps][1][]" value="<?php echo $app->id; ?>">
                                                            <?php $status = App\Models\FundScreeningStatus::where('appid', $app->id)->value('status'); ?>
                                                            <select id="status" class="form-control input-sm" name="rowss[steps][2][]" onchange="this.form.submit();">
                                                                <option value="" <?php if($status == '') { ?> selected <?php } ?>>Select</option>
                                                                <option value="1" <?php if($status == '1') { ?> selected <?php } ?>>Yes</option>
                                                                <option value="0" <?php if($status == '0') { ?> selected <?php } ?>>No</option>
                                                            </select>
                                                        <form>
                                                        @else
                                                @if($sstatus == '1') <font color="green"><b>Selected </b></font>@endif
                                                @if($sstatus == '0') <font color="red"><b> Not Selected </b></font>@endif
                                                @endif
                                                </td>
                                                <td style="font-size: 14px;">
                                                <a href="{{ route('fundeditdhi',['appid'=>$app->id]) }}" class="btn btn-primary  btn-sm pull-right" role="button">Edit</a>
                                                </td>
                                            </tr>
                                        <?php $i++;
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
<script src="jquery.js"></script>
<script src="jquery_tables.js"></script>
<link href="{{ asset('css/app_tables.css') }}" rel="stylesheet">
<script>

function addSchedule(id)
    {
      var view_url = $("#hidden_view_add").val();
      $.ajax({
        url: view_url,
        type:"GET",
        data: {"id":id},
        success: function(result){
            $("#app_id").val(result.id);
        }
      });
    }

   function fun_edit(id)
    {
      var view_url = $("#hidden_view_edit").val();
      $.ajax({
        url: view_url,
        type:"GET",
        data: {"id":id},
        success: function(result){
          $("#edit_id").val(result.id);
          $("#epptdate").val(result.ppt_date);
          $("#eppttime").val(result.ppt_time);

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

