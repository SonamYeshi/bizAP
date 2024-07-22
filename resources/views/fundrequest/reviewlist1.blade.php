<x-app-layout>
    @include('top_nav_bar')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-5">
                        @include('sweetalert::alert')
                        @include('flash-message')
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h5>DHI Fund Request Applications</h5>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                    <div class="row">
                                        <form class="row g-3" role="form" method="POST" action="{{ route('fundrequest_search') }}" enctype="multipart/form-data">
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
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered table-sm table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Name</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">CID</th>

                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Email</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Mobile</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Business</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Location</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Applied On</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Status</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($allapplication as $app) :  ?>
                                                <tr>
                                                    <td style="font-size: 14px;"><?php echo $i; ?></td>
                                                    <td style="font-size: 14px;"><?php echo App\Models\FundingApplication::where('id', $app->fundid)->value('name'); ?></td>
                                                    <td style="font-size: 14px;"><?php echo App\Models\FundingApplication::where('id', $app->fundid)->value('cid'); ?></td>

                                                    <td style="font-size: 14px;"><?php echo App\Models\FundingApplication::where('id', $app->fundid)->value('email'); ?></td>
                                                    <td style="font-size: 14px;"><?php echo App\Models\FundingApplication::where('id', $app->fundid)->value('mobileno'); ?></td>
                                                    <td style="font-size: 14px;"><?php echo App\Models\FundingApplication::where('id', $app->fundid)->value('business_name'); ?></td>
                                                    <td style="font-size: 14px;"><?php echo App\Models\FundingApplication::where('id', $app->fundid)->value('business_location'); ?></td>
                                                    <td style="font-size: 14px;">
                                                    <?php
                                                        $original_date = $app->created_on;
                                                        $timestamp = strtotime($original_date);
                                                        echo date("d-m-Y", $timestamp);
                                                        ?>
                                                    </td>
                                                    <td style="font-size: 14px;">
                                                    <?php
                                                    $asd = App\Models\FundRequestStatus::where('fundrequestid', $app->id)->value('approve_status_asd');
                                                    $ach = App\Models\FundRequestStatus::where('fundrequestid', $app->id)->value('approved_status_ach');
                                                    $dir = App\Models\FundRequestStatus::where('fundrequestid', $app->id)->value('approved_status_dir');
                                                    $status = App\Models\FundRequestStatus::where('fundrequestid', $app->id)->value('review_status');
                                                    $count = count(App\Models\FundRequestStatus::where('fundrequestid', $app->id)->get());
                                                    if($asd == '0' || $ach == '0' || $dir == '0') {
                                                    ?>
                                                    @if($status == '1')
                                                    <font color = "green">Reviewed</font>
                                                    @endif
                                                    @if($status == '2')
                                                    <font color = "red">Rejected</font>
                                                    @endif
                                                    @if($status == '')
                                                    <font color = "orange">Pending</font>
                                                    @endif
                                                    <?php }
                                                     if($asd == '1' || $ach == '1' || $dir == '1') { ?>
                                                    <font color = "green">Approved</font>
                                                    <?php }
                                                    if($asd == '2' || $ach == '2' || $dir == '2') { ?>
                                                    <font color = "red">Rejected</font>
                                                    <?php } ?>
                                                    </td>
                                                    <td style="font-size: 14px;">
                                                    <?php $count = count(App\Models\FundRequestStatus::where('fundrequestid', $app->id)->get()); ?>

                                                     @if($count =='0')
                                                      <a href="{{route('fundappreview',['id'=>$app->id, 'key'=>$key])}}" style="text-decoration:none">Review</a><br>
                                                     @else

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
<script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<script src="jquery.js"></script>
<script src="jquery_tables.js"></script>
<link href="{{ asset('css/app_tables.css') }}" rel="stylesheet">



