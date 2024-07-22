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
                                    <h5>Contract Signing</h5>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                    <div class="row">
                                        <form class="row g-3" role="form" method="POST" action="{{ route('contractsignsearch') }}" enctype="multipart/form-data">
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
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Contract</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($allapplication as $app) :
                                            $sstatus = App\Models\FundScreeningStatus::where('appid', $app->id)->value('status');
                                            $slstatus = App\Models\FundShortlistStatus::where('appid', $app->id)->value('status');
                                            if ($slstatus == '1') {
                                        ?>
                                                <tr>
                                                    <td style="font-size: 14px;"><?php echo $i; ?></td>
                                                    <td style="font-size: 14px;"><?php echo $app->cohortopen; ?>&nbsp;<?php echo $app->cohortopenno; ?></td>
                                                    <td style="font-size: 14px;"><a href="{{ route('score_details', array($app->id, $sstatus, $slstatus)) }}"><?php echo $app->cid; ?></a></td>
                                                    <td style="font-size: 14px;"><?php echo $app->name; ?></td>
                                                    <td style="font-size: 14px;"><?php echo $app->email; ?></td>
                                                    <td style="font-size: 14px;"><?php echo $app->mobileno; ?></td>
                                                    <td style="font-size: 14px;"><?php echo $app->business_name; ?></td>
                                                    <td style="font-size: 14px;">
                                                    <?php $docs = App\Models\DhiFundingContractDocs::where('appid', $app->id)->get();
                                                          $dcount = count(App\Models\DhiFundingContractDocs::where('appid', $app->id)->get()); ?>
                                                          @if($dcount == 0)
                                                          <a href="{{ route('gcontract', array($app->id, $sstatus, $slstatus)) }}" ><font color="green">Generate</font></a>
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
                                                    <td style="font-size: 14px;">   @if($dcount == 0)
                                                            <button type="button" class="btn btn-link btn" data-toggle="modal" data-target="#Modal" onclick='addSchedule({{$app->id}})'>Upload<i class="fas fa-file-upload"></i></button>
                                                            @endif
                                                            </td>
                                                    </tr>
                                        <?php } $i++; endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <input type="hidden" name="hidden_view_add" id="hidden_view_add" value="{{url('ppt/add')}}">
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
    $(document).ready(function() {
    $('#example').DataTable();
} );
$(window).load(function(){
   setTimeout(function(){ $('.alert-success').fadeOut() }, 5000);
});
</script>
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
      <h5 class="modal-title" id="myModalLabel">Upload Contract</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" role="form" method="POST" action="{{ route('uploadcontract') }}" enctype="multipart/form-data">
      <input type="hidden" name="fundid" id='app_id'>
      {{ csrf_field() }}
      <input type="hidden" name="key" value="{{ $key }}">
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Upload Contract<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="file" class="form-control" id="contract" name="contract[]" />
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Effective Date<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="date" class="form-control" id="effectivedate" name="effectivedate" />
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

