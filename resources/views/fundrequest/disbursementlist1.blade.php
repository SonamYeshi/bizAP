<x-app-layout>

    @include('top_nav_bar')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-5">
                        @include('sweetalert::alert')
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h5>Disbursement List</h5>
                                </div>
                            </div>

                            <div class="col-md-12 text-center">
                                    <div class="row">
                                        <form class="row g-3" role="form" method="POST" action="{{ route('disburse_search') }}" enctype="multipart/form-data">
                                          {{ csrf_field() }}
                                            <div class="col-md-4">
                                                <div class="form-group"> <label style="float: left;"><b>Filter By</b></label>
                                                    <select id="save" name="key" class="form-control" onchange="this.form.submit();">
                                                    <option value="" selected disabled>-- Select --</option>
                                                    <?php $training = App\Models\Funding::all();
                                                    foreach($training as $t){ ?>
                                                    <option value="<?php echo $t->id; ?>"><?php echo $t->opencohort; ?>&nbsp;<?php echo $t->opencohortno; ?></option>
                                                    <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            <!-- <a href = "{{route('disbursed')}}"><right><font color = "blue">View Disbursed List</font></center></a> -->
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered table-sm table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Group</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">CID</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Name</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Mobile</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Business</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Approved Fund</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Disbursement</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Action
                                            <a class='bbtn btn-primary btn-sm' data-toggle='modal' data-target="#addRoleModel" style="text-decoration: none; float: right;">Upload Excel</a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if($count != '0')
                                        {
                                        $i = 1;
                                        foreach ($allapplication as $app) :  ?>
                                                <tr>
                                                    <td style="font-size: 14px;"><?php echo $i; ?></td>
                                                    <td style="font-size: 14px;"><?php $fundid = App\Models\FundingApplication::where('id', $app->fundid)->value('fundid');
                                                     echo App\Models\Funding::where('id', $fundid)->value('opencohort');
                                                     ?>&nbsp;
                                                    <?php echo App\Models\Funding::where('id', $fundid)->value('opencohortno') ?>
                                                    </td>
                                                    <td style="font-size: 14px;"><?php echo App\Models\FundingApplication::where('id', $app->fundid)->value('cid'); ?></td>
                                                    <td style="font-size: 14px;"><?php echo App\Models\FundingApplication::where('id', $app->fundid)->value('name'); ?></td>
                                                    <td style="font-size: 14px;"><?php echo App\Models\FundingApplication::where('id', $app->fundid)->value('mobileno'); ?></td>
                                                    <td style="font-size: 14px;"><?php echo App\Models\FundingApplication::where('id', $app->fundid)->value('business_name'); ?></td>
                                                    <td style="font-size: 14px; text-align: right;"><?php echo App\Models\FundingApplication::where('id', $app->fundid)->value('total_disbursed'); ?></td>
                                                    <td style="font-size: 14px;">
                                                    <?php
                                                          $docs = App\Models\DisbursementDocs::where('appid', $app->fundid)->get();
                                                          $dcount = count(App\Models\DisbursementDocs::where('appid', $app->fundid)->get()); ?>
                                                          @if($dcount == 0)
                                                    <a href="{{route('disbursementview',['id'=>$app->fundid, 'key'=>$key])}}" target = "_blank" style="text-decoration:none">Generate</a>
                                                    @else
                                                    <?php $did = 1; ?>
                                                          @foreach($docs as $d)
                                                          <?php $pathid = $d->doc_path;
                                                          $filename = $d->file_name;
                                                          ?>
                                                          <a href="{{ url('/uploads/contractdocs/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $d->file_name; ?></a><br>
                                                           @endforeach
                                                    @endif

                                                    </td>
                                                    <td style="font-size: 14px;">
                                                          @if($dcount == 0)
                                                          <button type="button" class="btn btn-link btn" data-toggle="modal" data-target="#Modal" onclick='addSchedule({{$app->fundid}})'>Upload<i class="fas fa-file-upload"></i></button>
                                                          @else
                                                          <font color="green">&nbsp; &nbsp;Disbursed </font>
                                                          @endif

                                                    </td>
                                                    </tr>
                                        <?php
                                            $i++;
                                        endforeach;
                                        }
                                        else
                                        { ?>
                                        <tr>
                                            <td colspan="9">
                                                <p><center><font color = "red">No Disbursements !</font></center></p>
                                                <p>
                                                    <a href = "{{route('disbursed')}}"><center><font color = "green">View Disbursed List</font></center></a>
                                                </p>
                                            </td>
                                        </tr>
                                       <?php }
                                        ?>

                                    </tbody>
                                </table>
                                <input type="hidden" name="hidden_view_add" id="hidden_view_add" value="{{url('ppt/add')}}">
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

<div class="modal fade" id="addRoleModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Import Disbursements</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="{{ route('disburseimport') }}" accept-charset="utf-8" enctype="multipart/form-data" >
          {{ csrf_field() }}
          <input type="hidden" name="key" value="{{ $key }}">
            <div class="form-group">
                  <label class="col-md-4 control-label"></label>
                   <div class="col-md-6">
                  <input type="file" id="exampleInputFile" name="file" class="form-control"><font color="red">(xlsx)</font>
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
</script>
<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="myModalLabel">Upload Disbursement</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" role="form" method="POST" action="{{ route('upload_disbursement') }}" enctype="multipart/form-data">

      {{ csrf_field() }}
      <input type="hidden" name="fundid" id='app_id'>
      <input type="hidden" name="key" value="{{ $key }}">
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Upload Disbursement<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="file" class="form-control" id="contract" name="disbursement[]" />
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
<script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<script src="jquery.js"></script>
<script src="jquery_tables.js"></script>
<link href="{{ asset('css/app_tables.css') }}" rel="stylesheet">

