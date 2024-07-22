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
                                    <form class="row g-3" role="form" method="POST" action="{{ route('reporttsearch') }}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="col-md-4">
                                            <div class="form-group"> <label style="float: left;"><b>COHORT/OPEN/ALL</b></label>
                                                 <select id="form_name"  name="cohortopenall" class="form-control" >
                                                    <option value="" selected disabled>-- Select One --</option>
                                                    <option value="all">All</option>
                                                    <option value="COHORT">COHORT</option>
                                                    <option value="OPEN">OPEN</option>
                                                    <option value="BATCH">BATCH</option>
                                                 </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group"> <label style="float: left;"><b>COHORT/OPEN NO.</b></label>
                                                <input id="form_name" type="number" name="cohortopenno" class="form-control" placeholder="Enter COHORT/OPEN NO" >
                                            </div>
                                        </div>
                                    </div>

                                    <br />
                                    <div class="row">
                                    <div class="col-md-4">
                                            <div class="form-group"> <label for="form_name"></label>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group"> <label for="form_name"></label>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group"> <label for="form_name"></label>
                                                <input type="submit" name="submit" id="save" class="btn btn-success" value="Search" style="float: right;">
                                            </div>
                                        </div>
                                    </div>
                                 </form>
                                    <br />
                                </div>
                            </div>
                            <div id="loading" style="text-align: center;"></div>
                            <div class="table-responsive">
                            <table id="example" class="table table-bordered table-sm table-striped">
                                <thead class="thead-light">
                                        <tr>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Name</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Group</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">CID</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Email</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Mobile</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Gender</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Business / Qualification</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Total Score</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($allapplication as $app) :  ?>
                                            <tr class="table-primary">
                                                <td style="font-size: 14px;"><?php echo $i; ?></td>
                                                <td style="font-size: 14px;"><a href="{{route('tdetails',['id'=>$app->id])}}" style="text-decoration: none;"><?php echo $app->name; ?></a></td>
                                                <td style="font-size: 14px;">{{ $app->opencohort }} {{ $app->opencohortno }}</td>
                                                <td style="font-size: 14px;"><?php echo $app->cid; ?></td>
                                                <td style="font-size: 14px;"><?php echo $app->email;?></td>
                                                <td style="font-size: 14px;"><?php echo $app->mobileno;?></td>
                                                <td style="font-size: 14px;"><?php echo App\Models\tbl_gender::where('id', $app->gender)->value('gender'); ?></td>
                                                <td style="font-size: 14px;"><?php if($app->qualification != ''){
                                                echo App\Models\Qualification::where('id', $app->qualification)->value('qualification');
                                                } else {
                                                    echo $app->businessanme_qualification;
                                                } ?></td>
                                                <td style="font-size: 14px; text-align: right;">
                                                <?php
							                    $sum = 0;
                                                $count = count(App\Models\Shortlistpanel::where('trainingid', $app->trainingid)->get());
					                            $scores = App\Models\InterviewStatus::where('appID', $app->id)->get();
                                                foreach ($scores as $sc) :
                                                    $sum = $sum + $sc->score;
                                                    $count++;
                                                    endforeach;
                                                  if($sum != '0'){
                                                    $average = round($sum/$count, 2);
                                                    echo number_format(floatval($average), 2);
                                                  }
                                                 ?>
                                                </td>
                                                </tr>
                                        <?php $i++;
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
