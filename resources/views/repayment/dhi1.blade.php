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
                              <br>
                            <div class="table-responsive">
                            <table id="example" class="table table-bordered table-sm table-striped">
                                    <thead class="thead-dark">
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
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Action  <a class='bbtn btn-primary btn-sm' data-toggle='modal' data-target="#addRoleModel" style="text-decoration: none; float: right;">Upload Excel</a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($allapplication as $app) :
                                            $dcount = count(App\Models\DelayCount::where('cid', $app->cid)->where('active', '0')->get());
                                        ?>
                                            <tr
                                            <?php if($dcount == '0') { } else { ?>
                                               style="background-color: #E84933;"
                                            <?php } ?>
                                            >
                                                <td style="font-size: 14px;"><?php echo $i; ?></td>
                                                <td style="font-size: 14px;"><?php $fundid = App\Models\FundingApplication::where('id', $app->fundid)->value('fundid');
                                                     echo App\Models\Funding::where('id', $fundid)->value('opencohort');
                                                     ?>&nbsp;
                                                    <?php echo App\Models\Funding::where('id', $fundid)->value('opencohortno') ?>
                                                    </td>
                                                <td style="font-size: 14px;">{{ $app->name }}</td>
                                                <td style="font-size: 14px;">{{ $app->cid }}</td>
                                                <td style="font-size: 14px;">{{ $app->business_name }}</td>
                                                <td style="font-size: 14px;">{{ $app->mobileno }}</td>
                                                <td style="font-size: 14px;"><?php echo number_format($app->totaldisbursed); ?></td>
                                                <td style="font-size: 14px;" align="center"><font color="green"><b>
                                                    <?php echo count(App\Models\Repayments::where('cid', $app->cid)->get()); ?></b>
                                                    </font>
                                                </td>
                                                <td style="font-size: 14px;"><?php echo $dcount; ?></td>
                                                <td style="font-size: 14px;">
                                                    <a href="{{route('allrepaymentdhi', array($app->fundid, $app->cid, $key))}}" style="text-decoration:none">View Repayment</a><br>
                                                </td>
                                            </tr>
                                        <?php
                                            $i++;
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
<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:weight@100;200;300;400;500;600;700;800&display=swap");

body {
    background-color: #eee;
    font-family: "Poppins", sans-serif;
    font-weight: 300
}

.search {
    position: relative;
    box-shadow: 0 0 40px rgba(51, 51, 51, .1)
}

.search input {
    height: 60px;
    text-indent: 25px;
    border: 2px solid #d6d4d4
}

.search input:focus {
    box-shadow: none;
    border: 2px solid blue
}

.search .fa-search {
    position: absolute;
    top: 40px;
    left: 16px
}

.search button {
    position: absolute;
    top: 5px;
    right: 5px;
    height: 50px;
    width: 110px;
    background: green
}
</style>
