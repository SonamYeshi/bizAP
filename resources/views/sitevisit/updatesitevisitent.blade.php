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
                                    <h5>Site Visit Schedule</h5>
                                </div>
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
                                    <thead class="thead-dark">
                                    <tr>
                                            <th colspan="6">Site Visit Schedule</th>
                                            <th colspan="6" align="center">Site Visit Activities</th>

                                        </tr>
                                        <tr>
                                            <th>Sl.No</th>
                                            <th>Mode</th>
                                            <th>Visit Date</th>
                                            <th>Visit Time</th>
                                            <th>Agenda</th>
                                            <th>Virtual Form</th>
                                            <th>Observations</th>
                                            <th>Instructions</th>
                                            <th>Site Visit Report</th>
                                            <th>Performance</th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($allapplication as $app) : ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td>@if($app->mode == 'inperson')In Person @endif
                                                        @if($app->mode == 'virtual') Virtual @endif
                                                    </td>
                                                    <td><?php echo $app->date;?></td>
                                                    <td><?php echo $app->time; ?></td>
                                                    <td><?php echo $app->agenda; ?></td>
                                                    <td><?php $filename = $app->virtual_form_ent;?>
                                                    @if($filename != '')
                                                    <a href="{{ url('/uploads/virtualforment/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $filename; ?></a>
                                                    @endif
                                                    </td>
                                                    <td><?php echo $app->observations;?></td>
                                                    <td><?php echo $app->instructions;?></td>
                                                    <td><?php $filename = $app->filename;?>
                                                    @if($filename != '')
                                                    <a href="{{ url('/uploads/sitevisitreport/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $filename; ?></a>
                                                    @endif
                                                    </td>
                                                    <?php $status = $app->status;
                                                    if($status == 'y' || $status == '')
                                                    { ?>  <td style="background:yellow"></td> <?php }
                                                    if($status == 'r')
                                                    { ?>  <td style="background:red"></td> <?php }
                                                    if($status == 'g')
                                                    { ?>  <td style="background:green"></td> <?php } ?>

                                                    <td><?php $iid = $app->id; ?>
                                                    @if($app->mode == 'virtual')
                                                    <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#addactivity" onclick='addSchedule({{$iid}})'>Upload Virtual Form</button>
                                                    @endif
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


<div class="modal fade" id="addactivity" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
        <div class="modal-header"><h5 class="modal-title" id="myModalLabel">Upload Site Visit Virtual Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ route('virtualforment') }}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <input type="hidden" name="siteid" id='siteid' value="">
        <input type="hidden" name="fundid" id='fundid' value="{{ $fundid }}">
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Virtual Form<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="file" class="form-control form-control-sm" id="ereport" name="VirtualForm[]" required>
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
                xmlhttp.open("GET", "https://bizap.dhi.bt/gfg.php?id=" + str, true);
                xmlhttp.send();
            }
        }

</script>
