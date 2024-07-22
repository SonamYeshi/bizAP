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
                                    <form class="row g-3" role="form" method="POST" action="{{ route('reportsearch') }}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="col-md-4">
                                            <div class="form-group"> <label style="float: left;"><b>COHORT/OPEN/ALL</b></label>
                                                 <select id="form_name"  name="cohortopenall" class="form-control" >
                                                    <option value="" selected disabled>-- Select One --</option>
                                                    <option value="all">All</option>
                                                    <option value="COHORT">COHORT</option>
                                                    <option value="OPEN">OPEN</option>
                                                 </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group"> <label style="float: left;"><b>COHORT/OPEN NO.</b></label>
                                                <input id="form_name" type="number" name="cohortopenno" class="form-control" placeholder="Enter COHORT/OPEN NO" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group"> <label style="float: left;"><b>Business Type</b></label>
                                            <select id="form_name"  name="business_type" class="form-control">
                                            <option value="">-- Select one --</option>
                                             <?php $businesstype = App\Models\BusinessType::all(); foreach($businesstype as $bt):?>
                                                <option value="{{$bt->id}}">{{$bt->business_type}}</option>
                                                <?php endforeach ?>

                                                 </select>
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
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Cohort</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">CID</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Type Of Business</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Business</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Amount Disbursed</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Amount Repaid</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; $sum = '0'; $sum1 = '0';
                                        foreach ($allapplication as $app) :  ?>
                                            <tr class="table-primary">
                                                <td style="font-size: 14px;"><?php echo $i; ?></td>
                                                <td style="font-size: 14px;"><a href="{{route('repaydetails',['id'=>$app->fundid])}}" style="text-decoration: none;"><?php echo $app->name; ?></a></td>
                                                <td style="font-size: 14px;">{{ $app->cohortopen }} {{ $app->cohortopenno }}</td>
                                                <td style="font-size: 14px;"><?php echo $app->cid; ?></td>
                                                <td style="font-size: 14px;"><?php echo App\Models\BusinessType::where('id', $app->business_type)->value('business_type');?></td>
                                                <td style="font-size: 14px;"><?php echo $app->business_name; ?></td>
                                                <td style="font-size: 14px; text-align: right;"><font color="blue"><b><?php echo number_format($app->actual_disbursed); ?></b></font></td>
                                                <td style="font-size: 14px; text-align: right;"><font color="green"><b><?php echo number_format(App\Models\Repayments::where('cid', $app->cid)->sum('emi_amount'));
                                                $pay = App\Models\Repayments::where('cid', $app->cid)->sum('emi_amount');
                                                ?></b></font></td>
                                            </tr>
                                        <?php
                                        $sum = $sum + $app->actual_disbursed;
                                        $sum1 = $sum1 + $pay;
                                        $i++;
                                        endforeach;
                                        $total = number_format($sum);
                                        $total1 = number_format($sum1);
                                        ?>
                                        <tr>
                                            <td colspan="6" ><b>Total</b></td>
                                            <td style="text-align: right;"><b><?php echo $total; ?></b></td><td style="text-align: right;"><b><?php echo $total1; ?></b></td>
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

