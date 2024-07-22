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
                                                    @foreach($funding as $t)
                                                    <option value="{{$t->id}}">{{$t->opencohort}} {{$t->opencohortno}}</option>
                                                    @endforeach
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
                                        @php $i = 1;
                                        $sstatus = 1;
                                        $slstatus = 1;
                                        @endphp
                                        @foreach ($allapplication as $app)
                                        <tr>
                                            <td style="font-size: 14px;">{{$i}}</td>
                                            <td style="font-size: 14px;">{{$app->cohortopen}} {{$app->cohortopenno}}</td>
                                            <td style="font-size: 14px;"><a href="{{ route('score_details', array($app->id)) }}">{{$app->cid}}</a></td>
                                            <td style="font-size: 14px;">{{$app->name}}</td>
                                            <td style="font-size: 14px;">{{$app->email}}</td>
                                            <td style="font-size: 14px;">{{$app->mobileno}}</td>
                                            <td style="font-size: 14px;">{{$app->business_name}}</td>
                                            <td style="font-size: 14px;">
                                                @if(is_null($app->contract_id))
                                                <a href="{{ route('gcontract', array($app->id, $sstatus, $slstatus)) }}" target = "_blank"><font color="green">Generate</font></a>
                                                @else
                                                <a href="{{ url($app->doc_path.'/'.$app->file_name) }}" target="_blank"><i class="bi bi-file-pdf"></i>{{$app->file_name}}</a><br>
                                                @endif
                                            </td>
                                            <td style="font-size: 14px;">   
                                            @if(is_null($app->contract_id))
                                                <button type="button" class="btn btn-link btn" data-toggle="modal" data-target="#Modal" onclick='addSchedule({{$app->id}})'>Upload<i class="fas fa-file-upload"></i></button>
                                            @endif
                                            </td>
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- <input type="hidden" name="hidden_view_add" id="hidden_view_add" value="{{url('ppt/add')}}"> -->
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

function addSchedule(id){
    $("#app_id").val(id);
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
      <input type="hidden" name="app_id" id='app_id'>
      {{ csrf_field() }}
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

