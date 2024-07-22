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
                                    <h5>Screening</h5>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                    <div class="row">
                                    <form class="row g-3" role="form" method="POST" action="{{ route('tscreensearch') }}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="col-md-4">
                                            <div class="form-group"> <label style="float: left;"><b>Filter By</b></label>
                                                 <select id="form_name"  name="key" class="form-control" onchange="this.form.submit();">
                                                    <option value="" selected disabled>-- Select --</option>
                                                    <?php $training = App\Models\Training::all();
                                                    foreach($training as $t){ ?>
                                                    <option value="<?php echo $t->id; ?>"><?php echo $t->opencohort; ?>&nbsp;<?php echo $t->opencohortno; ?></option>
                                                    <?php } ?>
                                                 </select>
                                            </div>
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
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Group</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">CID of Applicant</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Name</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Email</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Mobile No.</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Gender</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Screening Status</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($allapplication as $app) :  ?>
                                            <tr>
                                                <td style="font-size: 14px;"><?php echo $i;?></td>
                                                <td style="font-size: 14px;"><?php echo $app->opencohort; ?>&nbsp;<?php echo $app->opencohortno; ?></td>
                                                <td style="font-size: 14px;"><a href="{{route('app_details',['id'=>$app->id, 'sid'=>$key])}}"><?php echo $app->cid; ?></a></td>
                                                <td style="font-size: 14px;"><?php echo $app->name; ?></td>
                                                <td style="font-size: 14px;"><?php echo $app->email; ?></td>
                                                <td style="font-size: 14px;"><?php echo $app->mobileno; ?></td>
                                                <td style="font-size: 14px;"><?php echo App\Models\tbl_gender::where('id', $app->gender)->value('gender'); ?></td>

                                                <td style="font-size: 14px;"><?php $status = App\Models\ScreeningStatus::where('appid', $app->id)->value('status'); ?>
                                                @if($status == '')
                                                    <form id='myform' action="{{ route('s_update') }}" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="sid" value="{{$key}}">
                                                            <input type="hidden" name="rowss[steps][1][]" value="<?php echo $app->id; ?>">
                                                            <?php $status = App\Models\ScreeningStatus::where('appid', $app->id)->value('status'); ?>
                                                            <select id="status" class="form-control input-sm" name="rowss[steps][2][]" onchange="this.form.submit();">
                                                                <option value="" <?php if($status == '') { ?> selected <?php } ?>>-- Select --</option>
                                                                <option value="1" <?php if($status == '1') { ?> selected <?php } ?>>Yes</option>
                                                                <option value="0" <?php if($status == '0') { ?> selected <?php } ?>>No</option>
                                                            </select>
                                                        <form>
                                                        @else
                                                @if($status == '1') <font color="green"><b>Selected </b></font>@endif
                                                @if($status == '0') <font color="red"><b> Not Selected </b></font>@endif
                                                @endif
                                                </td>
                                                <td style="font-size: 14px;">
                                                <a href="{{ route('appeditdhi',['appid'=>$app->id]) }}" class="btn btn-outline-primary btn-sm" role="button">Edit</a>
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
    $('#example').DataTable();
} );
</script>
<script src="jquery.js"></script>
<script src="jquery_tables.js"></script>
<link href="{{ asset('css/app_tables.css') }}" rel="stylesheet">


