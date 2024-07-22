<x-app-layout>
    @include('top_nav_bar')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-5">
			            @include('flash-message')
                        @include('sweetalert::alert')
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h5>Shortlisting</h5>
                                </div>
                            </div>
                                <div class="col-md-12 text-center">
                                    <div class="row">
                                        <form class="row g-3" role="form" method="POST" action="{{ route('tshortsearch') }}" enctype="multipart/form-data">
                                          {{ csrf_field() }}
                                            <div class="col-md-4">
                                                <div class="form-group"> <label style="float: left;"><b>Filter By</b></label>
                                                    <select id="save" name="key" class="form-control" onchange="this.form.submit();">
                                                    <option value="" selected disabled>-- Select --</option>
                                                    @foreach($training as $t)
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
                                            <td colspan="8"><b>Generate Shortlisted List</b></td>
                                            <td>
                                                <a class='btn btn-primary btn-sm' target="_blank" data-toggle='modal' data-target="#addRoleModel" style="text-decoration: none; float:right;">Generate
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Group</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">CID of Applicant</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Name</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Email</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Mobile No.</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Gender</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Average Score</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Shortlist Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php 
                                        $i = 1;
                                        @endphp
                                        @foreach($allapplication as $app)
                                            <tr>
                                                <td style="font-size: 14px;">{{$i}}</td>
                                                <td style="font-size: 14px;">{{$app->opencohort}} {{$app->opencohortno}}</td>
                                                <td style="font-size: 14px;"><a href="{{ route('short_app_details', array($app->id)) }}">{{$app->cid}}</a></td>
                                                <td style="font-size: 14px;">{{$app->name}}</td>
                                                <td style="font-size: 14px;">{{$app->email}}</td>
                                                <td style="font-size: 14px;">{{$app->mobileno}}</td>
                                                <td style="font-size: 14px;">{{$app->sex}}</td>
                                                <td style="font-size: 14px; text-align: right;">
                                                    @if($app->avg_score != 0.00)
                                                    {{$app->avg_score}}
                                                    @endif
                                                </td>
                                                <td style="font-size: 14px;">
                                                @php
                                                $shortlist_score = count(App\Models\SLStatus::where('appID', $app->id)->get());
                                                @endphp
                                                @if(is_null($app->shortlist_status))
                                                <form id='myform' action="{{ route('sl_update') }}" method="post">
                                                    {{ csrf_field() }}
                                                            <input type="hidden" name="sid" value="0">
                                                            <input type="hidden" name="shortlist_score_exist" value="{{$shortlist_score}}">
                                                            <input type="hidden" name="rowss[steps][1][]" value="{{$app->id}}">
                                                            <select id="status" class="form-control input-sm status-select" name="rowss[steps][2][]">
                                                                <option value="">-- Select --</option>
                                                                <option value="1">Selected</option>
                                                                <option value="0">Not Selected</option>
                                                            </select>
                                                </form>
                                                @else
                                                @if($app->shortlist_status == 1) <font color="green"><b>Selected </b></font>@endif
                                                @if($app->shortlist_status == 0) <font color="red"><b> Not Selected </b></font>@endif
                                                @endif
                                                </td>
                                            </tr>
                                            @php $i++; @endphp
                                        @endforeach
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
<div class="modal fade" id="addRoleModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="{{ route('sl_update') }}" accept-charset="utf-8" enctype="multipart/form-data" >
          {{ csrf_field() }}
            <div class="form-group">
                  <label class="col-md-4 control-label">COHORT/BATCH</label>
                   <div class="col-md-6">
                   <select id="form_name"  name="cohortopen" class="form-control" required>
                                                    <option value="">-- Select One --</option>
                                                    <option value="COHORT">COHORT</option>
                                                    <option value="BATCH">BATCH</option>
                                                 </select>
                </div>
            </div>
            <div class="form-group">
                        <label class="col-md-6 control-label">COHORT/BATCH NO<font color="red">*</font></label>
                        <div class="col-md-6">
                            <input id="form_name" type="number" name="cohortopenno" class="form-control" placeholder="Eenter NO" required>
                        </div>
                    </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-sm">Submit</button>
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    $('#example').DataTable();
});

$(document).ready(function() {
    $('.status-select').on('change', function() {
        var shortlist_score_exist = $(this).closest('form').find('input[name="shortlist_score_exist"]').val();
        if(shortlist_score_exist > 0){
            $(this).closest('form').submit();
        }else{
            alert('Please complete with the shortlisting scores.');
            $(this).val('');
        }
        
    });
});
</script>
<script src="jquery.js"></script>
<script src="jquery_tables.js"></script>
<link href="{{ asset('css/app_tables.css') }}" rel="stylesheet">


