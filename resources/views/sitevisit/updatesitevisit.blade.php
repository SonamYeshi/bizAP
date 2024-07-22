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
                                    <h5>Site Visit Schedule <font color="blue">{{ $name }}</font></h5>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modal">Schedule Site Visit</button>
                            </div>
                            <table>
                                    <tr>
                                        <td style="background:red" width="50"></td><td>Poor: Monthly visit</td>
                                        <td style="background:yellow" width="50"></td><td>Good: Quarterly visit</td>
                                        <td style="background:green" width="50"></td><td>Excellent: Half yearly Visit</td>
                                    </tr>
                                </table><br />
                            <div class="table-responsive">
                            <table id="example" class="table table-bordered table-sm table-striped">
                                    <thead class="thead-light">
                                    <tr>
                                            <th colspan="6">Site Visit Schedule</th>
                                            <th colspan="6" align="center">Site Visit Activities</th>

                                        </tr>
                                        <tr>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Mode</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Visit Date</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Visit Time</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Agenda</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Action</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Observations</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Instructions</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Site Visit Report</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Virtual Form</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">performance</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($allapplication as $app) : ?>
                                                <tr>
                                                    <td style="font-size: 14px;"><?php echo $i; ?></td>
                                                    <td style="font-size: 14px;">@if($app->mode == 'inperson')In Person @endif
                                                        @if($app->mode == 'virtual') Virtual @endif
                                                    </td>
                                                    <td style="font-size: 14px;"><?php
                                                    $original_date = $app->date;
                                                    $timestamp = strtotime($original_date);
                                                    echo date("d-m-Y", $timestamp);
                                                    ?></td>
                                                    <td style="font-size: 14px;"><?php echo $app->time; ?></td>
                                                    <td style="font-size: 14px;"><?php echo $app->agenda; ?></td>
                                                    <td style="font-size: 14px;">
                                                    <a href="{{route('delete_sitevist',['id'=>$app->id, 'fundid'=>$app->fundid, $key])}}" onclick='return confirm("Are you sure to Remove ?")'>
                                                    <font color="red"><i class="fa fa-trash" aria-hidden="true"></i></font></a>
                                                    </td>
                                                    <td style="font-size: 14px;"><?php echo $app->observations;?></td>
                                                    <td style="font-size: 14px;"><?php echo $app->instructions;?></td>
                                                    <td style="font-size: 14px;"><?php $filename = $app->filename;?>
                                                    @if($filename != '')
                                                    <a href="{{ url('/uploads/sitevisitreport/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $filename; ?></a>

                                                    @endif
                                                    </td>
                                                    <td style="font-size: 14px;"><?php $filename = $app->virtual_form_ent;?>
                                                    @if($filename != '')
                                                    <a href="{{ url('/uploads/virtualforment/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $filename; ?></a>

                                                    @endif
                                                    </td>
                                                    <?php $status = $app->status;
                                                    if($status == 'y' || $status == '')
                                                    { ?>  <td style="background:yellow"></td> <?php }
                                                    if($status == 'r')
                                                    { ?>  <td style="background:red"></td> <?php }
                                                    if($status == 'g')
                                                    { ?>  <td style="background:green"></td> <?php } ?>

                                                    <td style="font-size: 14px;"><?php $iid = $app->id; ?>
                                                    <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#addactivity" onclick='addSchedule({{$iid}})'>Update</button>

                                                    <a href="{{route('delete_sitevistupdate',['id'=>$app->id, 'fundid'=>$app->fundid, $key])}}" onclick='return confirm("Are you sure to Remove ?")'>
                                                    <font color="red"><i class="fa fa-trash" aria-hidden="true"></i></font></a>
                                                </td>
                                                    </tr>
                                        <?php
                                        $i++; endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <input type="hidden" name="hidden_view_add" id="hidden_view_add" value="{{url('ctst/add')}}">
                            <input type="hidden" name="hidden_view_edit" id="hidden_view_edit" value="{{url('ctst/edit')}}">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="myModalLabel">Add Site Visit Date and Time</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" role="form" method="POST" action="{{ route('sitevisitadd') }}" enctype="multipart/form-data">
      <input type="hidden" name="fundid" id='app_id' value="{{$fundid}}">
      <input type="hidden" name="key" id='app_id' value="{{$key}}">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Mode<font color="red">*</font></label>
        <div class="col-xs-6">
        <select id = "ddlPassport" onchange = "ShowHideDiv()" class="form-control form-control-sm" name="mode" required>
         <option value="">-- Select One --</option>
         <option value="virtual">Virtual</option>
         <option value="inperson">In person</option>
        </select>
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Date<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="date" class="form-control form-control-sm" id="pptdate" name="svdate" />
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Time<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="time" class="form-control form-control-sm" id="ppttime" name="svtime" >
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Agenda</label>
        <div class="col-xs-6">
        <textarea id="form_message" name="Agencda" class="form-control form-control-sm" rows="4" ></textarea>
        </div>
        </div>
        <div id="dvPassport" style="display: none">
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Site Visit Virtual Form</label>
        <div class="col-xs-6">
        <input type="file" class="form-control form-control-sm" id="contract" name="SiteVisitVirtualForm[]" />
        </div>
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
<script type="text/javascript">
    function ShowHideDiv() {
        var ddlPassport = document.getElementById("ddlPassport");
        var dvPassport = document.getElementById("dvPassport");
        dvPassport.style.display = ddlPassport.value == "virtual" ? "block" : "none";
    }
</script>

<div class="modal fade" id="addactivity" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
        <div class="modal-header"><h5 class="modal-title" id="myModalLabel">Update Site Visit Activity</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
	  <form class="form-horizontal" role="form" method="POST" action="{{ route('addsitevisitactivity') }}" enctype="multipart/form-data">
            <input type="hidden" name="siteid" id='siteid' value="">
          {{ csrf_field() }}
          <input type="hidden" name="key" id='app_id' value="{{$key}}">
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Date<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="date" class="form-control form-control-sm" id="esvdate" name="svdate" />
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Time<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="time" class="form-control form-control-sm" id="esvtime" name="svtime" >
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Observations</label>
        <div class="col-xs-6">
        <textarea id="eObservations" name="Observations" class="form-control form-control-sm" rows="4" ></textarea>
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Instructions to the Entrepreneur</label>
        <div class="col-xs-6">
        <textarea id="eInstructions" name="Instructions" class="form-control form-control-sm" rows="4" ></textarea>
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Status</label>
        <div class="col-xs-6">
        <select class='form-control' required name="status">
                                    <option value="" >Select Status</option>
                                    <option value="y" style="background:yellow">Yellow</option>
                                    <option value="g" style="background:green">Green</option>
                                    <option value="r" style="background:red">Red</option>

                                </select>
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Site Visit Report</label>
        <div class="col-xs-6">
        <input type="file" class="form-control form-control-sm" id="ereport" name="report[]" >
        </div>
        </div>
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-xs" onclick='return confirm("Are you sure to Update?")'>Update</button>
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
