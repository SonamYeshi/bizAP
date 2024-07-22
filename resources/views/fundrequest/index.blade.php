<x-app-layout>
    @include('top_nav_bar_applicant')
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
                                    <h5>Fund Disbursement Request</h5>
                                </div>
                            </div>

                            <div class="table-responsive">
                            <table id="example" class="table table-sm table-striped">
                            <thead class="thead-light">
                                        <tr>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Business</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Location</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Agreement Date</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($allapplication as $app) :
                                        ?>
                                                <tr>
                                                    <td style="font-size: 14px;"><?php echo App\Models\FundingApplication::where('id', $app->fundappid)->value('business_name'); ?></td>
                                                    <td style="font-size: 14px;"><?php echo App\Models\FundingApplication::where('id', $app->fundappid)->value('business_location'); ?></td>
                                                    <td style="font-size: 14px;"><?php echo App\Models\ContractDateTime::where('appID', $app->fundappid)->value('sign_date'); ?></td>
                                                    <td style="font-size: 14px;">
                                                <a href="{{route('fundapp',['id'=>$app->fundappid])}}" style="text-decoration:none">New Fund Request</a><br>
                                                    </td>
                                                    </tr>
                                        <?php
                                            $i++;
                                        endforeach; ?>

                                    </tbody>
                                </table>
                            </div>


                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h5>Approved Funding Applications</h5>
                                </div>
                            </div>

                            <div class="table-responsive">
                            <table id="example" class="table table-sm table-striped">
                            <thead class="thead-light">
                                        <tr>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Tranche No.</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Amount Disbursed</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Usage</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Invoice</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Status</th>
					                        <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Date</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Cash Receipt</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($FundRequest as $app) :
                                            $fundappid = $app->fundappid;
                                               ?>
                                                <tr>
                                                    <td style="font-size: 14px;"><?php echo $i; ?></td>
                                                    <td style="font-size: 14px;"><?php echo $app->trancheno; ?></td>
                                                    <td style="font-size: 14px;"><?php echo $app->tranche; ?></td>
                                                    <td style="font-size: 14px;"><?php echo $app->usage; ?></td>
                                                    <td style="font-size: 14px;"><?php $filename = App\Models\FundRequest::where('id', $app->id)->value('proof'); ?>
                                                      @if($filename != '')
                                                      <a href="{{ url('/uploads/proof/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $filename; ?></a>
                                                      @else
                                                      No Document
                                                      @endif</td>
                                                    <td>
						                            <?php
                                                    $status = App\Models\FundRequestStatus::where('fundrequestid', $app->id)->value('review_status'); ?>
                                                    @if($status == '1')
                                                    <font color = "green">Approved</font><br>
                                                    <?php echo App\Models\FundRequestStatus::where('fundrequestid', $app->id)->value('review_date'); ?>
                                                    @endif
                                                    @if($status == '2')
                                                    <font color = "red">Rejected</font>
                                                    <br>
                                                    <?php echo App\Models\FundRequestStatus::where('fundrequestid', $app->id)->value('review_date'); ?>
                                                    @endif
                                                    </td>
                                                    <td style="font-size: 14px;">
                                                    <?php $applydate = App\Models\FundRequest::where('fundid', $fundid)->value('created_on'); ?>
                                                    <font color="green"> <?php
                                                    $original_date = $applydate;
                                                     $timestamp = strtotime($original_date);
                                                      echo date("d-m-Y", $timestamp);
                                                     ?>
                                                    </font>
						    </td>
                                                     <td style="font-size: 14px;">
                                                     <?php $filename = App\Models\FundRequest::where('id', $app->id)->value('receipt'); ?>
                                                      @if($filename != '')
                                                      <a href="{{ url('/uploads/receipts/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $filename; ?></a>
                                                      @else
                                                     <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#addactivity"
                                                      onclick='addSchedule({{$app->id}})'>Upload</button>
                                                    @endif
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
<div class="modal fade" id="addactivity" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
        <div class="modal-header"><h5 class="modal-title" id="myModalLabel">Upload Cash Receipt</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
	  <form class="form-horizontal" role="form" method="POST" action="{{ route('upload_receipt') }}" enctype="multipart/form-data">
            <input type="text" name="rid" id='siteid' value="">
          {{ csrf_field() }}

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Receipt<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="file" class="form-control" id="contract" name="Receipt[]" />
        </div>
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-xs" onclick='return confirm("Are you sure to Update?")'>Upload</button>
        <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
        </div>
        </form>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <link href="{{ asset('css/app_tables.css') }}" rel="stylesheet">
<script>
     $(document).ready(function() {
    $('#example').DataTable();
} );
    function addSchedule(str) {
            if (str.length == 0) {
                document.getElementById("siteid").value = "";
                return;
            }
            else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 &&
                            this.status == 200) {
                        var myObj = JSON.parse(this.responseText);
                        document.getElementById
                            ("siteid").value = myObj[0];
                    }
                };
                xmlhttp.open("GET", "http://127.0.0.1:8000/gfg.php?id=" + str, true);
                xmlhttp.send();
            }
        }

</script>

