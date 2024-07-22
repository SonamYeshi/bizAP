<x-app-layout>
    @include('top_nav_bar')
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-1 lg:px-">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-5">
                            @include('flash-message')
                            <div class="row">
                                <div class="col-md-12 text-center">
				    <div class="row">
                                            <a  href="{{ url()->previous() }}">
                                 <button type="button" class="btn btn-warning" data-dismiss="modal" style="float: right;">Back</button>
                             </a>

                                        <?php
                                        foreach ($allapplication as $app) :  ?>
                                            <div class="col-md-4">
                                                <table style="table-layout: fixed; width:1000px;">
                                                    <tr>
                                                        <td width="30%">
                                                            <div class="form-group"> <label style="float: left;"><b>COHORT/OPEN/BATCH: </b></label>
                                                            </div>
                                                        </td>
                                                        <td align="left" width="30%">
                                                        {{ $app->opencohort }} {{ $app->opencohortno }}
                                                        </td>
                                                        <td width="40%" rowspan="3">
                                                        <?php $docs = App\Models\ApplicationDocs::where('appid', $app->id)->where('filecat', 'passport')->get();
                                                        $dcount = count(App\Models\ApplicationDocs::where('appid', $app->id)->where('filecat', 'passport')->get()); ?>
                                                        @if($dcount == 0)
                                                        <img style="border:2px solid black;" src="" width="140" height="120" alt="No Photo" />
                                                           @else
                                                         <?php $did = 1; ?>
                                                        @foreach($docs as $d)
                                                        <?php $filename = $d->file_name; ?>
                                                        <img src="{{ url('/uploads/applicationdocs/'.$filename) }}" alt="" height=120 width=140></img>
                                                         @endforeach
                                                        @endif

                                                     </td>
						    </tr>
                                                    <tr>
                                                        <td width="30%">
                                                            <div class="form-group"> <label style="float: left;"><b>Training Title: </b></label>
                                                            </div>
                                                        </td>
                                                        <td align="left" width="30%">
							<left>
							<?php $tid = App\Models\TrainingApplication::where('id', $app->id)->value('trainingid');
                                                        echo  App\Models\Training::where('id', $tid)->value('training_title')
                                                          ?>
                                                          </left>
                                                        </td>

                                                        </tr>
                                                    <tr>
                                                        <td width="30%">
                                                            <div class="form-group"> <label style="float: left;"><b>Trainee Name: </b></label>
                                                            </div>
                                                        </td>
                                                        <td align="left" width="30%">
                                                        <left>{{ $app->name }}</left>
                                                        </td>

                                                        </tr>
                                                        <tr>
                                                        <td width="30%">
                                                            <div class="form-group"> <label style="float: left;"><b>Trainee Gender: </b></label>
                                                            </div>
                                                        </td>
                                                        <td align="left" width="30%">
                                                        <left><?php echo App\Models\tbl_gender::where('id', $app->gender)->value('gender'); ?></left>
                                                        </td>

                                                        </tr>
                                                    <tr>
                                                        <td width="30%">
                                                            <div class="form-group"> <label style="float: left;"><b>Trainee CID: </b></label>
                                                            </div>
                                                        </td>
                                                        <td align="left" width="30%">
                                                        <left>{{ $app->cid }}</left>
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                        <td width="30%">
                                                            <div class="form-group"> <label style="float: left;"><b>Trainee Phone No.: </b></label>
                                                            </div>
                                                        </td>
                                                        <td align="left" width="30%">
                                                        <left>{{ $app->mobileno }}</left>
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                        <td width="30%">
                                                            <div class="form-group"> <label style="float: left;"><b>Trainee Email: </b></label>
                                                            </div>
                                                        </td>
                                                        <td align="left" width="30%">
                                                        <left>{{ $app->email }}</left>
                                                        </td>
                                                        </tr>
                                                    <tr>
                                                        <td width="30%">
                                                            <div class="form-group"> <label style="float: left;"><b>Business Name / Qualification: </b></label>
                                                             </div>
                                                        </td>
                                                        <td align="left" width="30%">
                                                        <left><?php if($app->qualification != ''){
                                                echo App\Models\Qualification::where('id', $app->qualification)->value('qualification');
                                                } else {
                                                    echo $app->businessanme_qualification;
                                                } ?></left>
                                                        </td>
                                                        </tr>
                                                    <tr>
                                                        <td width="30%">
                                                            <div class="form-group"> <label style="float: left;"><b>Post Training: </b></label>
                                                              </div>
                                                        </td>
                                                        <td align="left" width="30%">
								<left><?php echo $pstatus = App\Models\PosttrainingStatus::where('appID', $app->id)->value('status'); ?>
                                                        </left>
                                                        </td>
                                                        </tr>


                                                </table>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <br />

                                </div>
                            </div>
                            <div style="text-align: left;"><b><font color = 'blue'>Interview Scores</font></b></div>
                            <br>
                            <div class="table-responsive">
                            <table id="example" class="table table-bordered table-sm table-striped">
                                <thead class="thead-light">
                                        <tr>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Panel Member</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Designation</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Role</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Score</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($pannels as $pl) : ?>
                                            <tr>
                                                <td style="font-size: 14px;"><?php echo $i; ?>
                                                <input type="hidden" name="rowss[steps][3][]" value="<?php echo $pl->id; ?>">
                                                </td>
                                                <td style="font-size: 14px;"><?php echo $pl->name; ?></td>
                                                <td style="font-size: 14px;"><?php echo $pl->designation; ?></td>
                                                <td style="font-size: 14px;"><?php echo App\Models\Panelrole::where('id', $pl->role)->value('rolename');?></td>
                                                <td style="font-size: 14px; text-align: right;">
                                                 <?php
                                                 echo App\Models\InterviewStatus::where('appID', $appid)->where('pannelID', $pl->id)->value('score');
                                                 ?>
                                                </td>
                                                <td style="font-size: 14px;">
                                                <?php
                                                 echo App\Models\InterviewStatus::where('appID', $appid)->where('pannelID', $pl->id)->value('remarks');
                                                 ?>
                                                </td>

                                            </tr>
                                        <?php $i++; endforeach; ?>
                                        <tr>
                                            <td colspan="4">Average Score</td>
                                            <td style="font-size: 14px; text-align: right;"><b>
                                            <?php
                                                        $sum = 0;
                                                        $count = 0;
                                                        $scores = App\Models\InterviewStatus::where('appID', $appid)->get();
                                                        foreach ($scores as $sc) :
                                                            $sum = $sum + $sc->score;
                                                            $count++;
                                                        endforeach;
                                                        echo $average = round($sum/$count, 2);
                                                        ?>
                                            </b></td>
                                            <td>


                                            </td>
                                        </tr>
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
