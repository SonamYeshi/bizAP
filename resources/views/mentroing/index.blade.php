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
                                    <h5>Mentroing Sessions</h5>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="{{route('adnewmentoring')}}" class="btn btn-primary btn-sm" role="button">Add New Session</a>
                            </div>
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered table-sm table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Duration</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Mentor</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Objective</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Requirement</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Eligible Cohorts</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($allapplication as $app) :
                                        ?>
                                                <tr>
                                                    <td style="font-size: 14px;"><?php echo $i; ?></td>
                                                    <td style="font-size: 14px;">
                                                    <?php
                                                    $original_date = $app->StartDate;
                                                    $timestamp = strtotime($original_date);
                                                    echo date("d-m-Y", $timestamp);
                                                    ?>
                                                    &nbsp;
                                                    <font color="blue">To</font>&nbsp;
                                                    <?php
                                                    $original_date = $app->EndDate;
                                                    $timestamp = strtotime($original_date);
                                                    echo date("d-m-Y", $timestamp);
                                                    ?>
                                                    </td>
                                                    <td style="font-size: 14px;">{{$app->Mentor}}</td>
                                                    <td style="font-size: 14px;">{{$app->Objective}}</td>
                                                    <td style="font-size: 14px;">{{$app->Requirements}}</td>
                                                    <td style="font-size: 14px;">
                                                    <?php $iid = $app->id;
                                                    ?>
                                                    @if($app->TrainingFunding == '')
                                                    <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#addactivity" onclick='addSchedule({{$iid}})'>Add Group</button>
                                                    <br>
                                                    @endif
                                                    <?php if($app->TrainingFunding == 't'){
                                                     echo App\Models\Training::where('id', $app->EligibleCohorts)->value('opencohort'); ?>&nbsp;<?php
                                                     echo App\Models\Training::where('id', $app->EligibleCohorts)->value('opencohortno');
                                                    }?>
                                                    <?php if($app->TrainingFunding == 'f'){
                                                     echo App\Models\Funding::where('id', $app->EligibleCohorts)->value('opencohort'); ?>&nbsp;<?php
                                                     echo App\Models\Funding::where('id', $app->EligibleCohorts)->value('opencohortno');
                                                    }?>
                                                    &nbsp;&nbsp;
                                                    <a href="{{route('mentoringmail',['id'=>$app->id])}}">
                                                    <button type="button" class="btn btn-link btn-sm">Send Mail</button>
                                                    </a>
                                                    </td>
                                                    <td style="font-size: 14px;"><a href="{{route('mentoringview',['id'=>$app->id])}}" style="text-decoration:none">View</a>
                                                    <a href="{{ route('deletementor', $app->id ) }}" onclick='return confirm("Are you sure to Remove ?")'>
                                                     <font color="red"><i class="fa fa-trash" aria-hidden="true"></i></font></a>
                                                    </td>
                                                    </tr>
                                        <?php $i++; endforeach; ?>
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

<div class="modal fade" id="addactivity" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
        <div class="modal-header"><h5 class="modal-title" id="myModalLabel">Update Site Visit Activity</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
	  <form class="form-horizontal" role="form" method="POST" action="{{ route('addmentorgrp') }}" enctype="multipart/form-data">
            <input type="hidden" name="mid" id='siteid' value="">
          {{ csrf_field() }}

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Training/Funding<font color="red">*</font></label>
        <div class="col-xs-6">
        <select id = "ddlPassport" class="form-control form-control-sm" name="torf" required>
         <option value="">-- Select One --</option>
         <option value="t">Training</option>
         <option value="f">Funding</option>
        </select>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">COHORT/OPEN/BATCH<font color="red">*</font></label>
        <div class="col-xs-6">
        <select id = "ddlPassport" onchange = "ShowHideDiv()" class="form-control form-control-sm" name="group" required>
         <option value="">-- Select One --</option>
         <option value="COHORT">COHORT</option>
         <option value="OPEN">OPEN</option>
         <option value="BATCH">BATCH</option>
        </select>
        </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">COHORT/OPEN/BATCH No.<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="text" class="form-control form-control-sm" id="esvtime" name="no" required>
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
