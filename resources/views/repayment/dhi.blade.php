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
                                    <h5>Repayments</h5>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                    <div class="row">
                                        <form class="row g-3" role="form" method="POST" action="{{ route('payment_search') }}" enctype="multipart/form-data">
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
                              <br>
                            <div class="table-responsive">
                            <table id="example" class="table table-bordered table-sm table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Group</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Name</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">CID</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Business</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Mobile</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Disbursed Fund</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">No. of Installments Paid</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">No. of Defaults</th>
                                            <th style='width:20%'>Action  <a class='bbtn btn-primary btn-sm' data-toggle='modal' data-target="#addRoleModel" style="text-decoration: none; float: right;">Upload Excel</a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1; @endphp
                                        @foreach ($allapplication as $app)
                                        @php
                                            $dcount = count(App\Models\DelayCount::where('cid', $app->cid)->where('active', '0')->get());
                                        @endphp
                                            <tr
                                            @if($dcount != 0)
                                               style="background-color: #E84933;"
                                            @endif
                                            >
                                                <td style="font-size: 14px;">{{$i}}</td>
                                                <td style="font-size: 14px;">{{$app->cohortopen}} {{$app->cohortopenno}}</td>
                                                <td style="font-size: 14px;">{{ $app->name }}</td>
                                                <td style="font-size: 14px;">{{ $app->cid }}</td>
                                                <td style="font-size: 14px;">{{ $app->business_name }}</td>
                                                <td style="font-size: 14px;">{{ $app->mobileno }}</td>
                                                <td style="font-size: 14px;">{{number_format($app->actual_disbursed)}}</td>
                                                <td style="font-size: 14px;"><font color="green"><b>
                                                    <?php echo count(App\Models\Repayments::where('cid', $app->cid)->get()); ?></b>
                                                    </font>
                                                </td>
                                                <td>{{$dcount}}</td>
                                                <td style="font-size: 14px;">
                                                    <a href="{{route('allrepaymentdhi', array($app->fundid, $app->cid))}}" style="text-decoration:none">View Repayment</a><br>
                                                </td>
                                            </tr>
                                        @php
                                            $i++;@endphp
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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Import Repayments</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="{{ route('paymentimport') }}" accept-charset="utf-8" enctype="multipart/form-data" >
          {{ csrf_field() }}
            <div class="form-group">
                  <label class="col-md-4 control-label"></label>
                   <div class="col-md-6">
                  <input type="file" id="exampleInputFile" name="file" class="form-control" required><font color="red">(xlsx)</font>
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
    $(document).ready(function() {
        $("#successMessage").delay(2500).slideUp(300);
    });
</script>
<script type="text/javascript">
    $('#save').click(function() {
        $('#loading').html('<center><img src="{{ asset("/loading_gif/search.gif") }}" height="100" width="100" a></center>');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "https://api.github.com/users/jveldboom",
            success: function(d) {
                setTimeout(function() {
                    $('#loading');
                }, 2000);
            }
        });
    });
</script>

