<x-app-layout>
@include('top_nav_bar_applicant')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-5">
                        @include('flash-message')
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h5>Monitoring and Evaluation</h5>
                                </div>
                            </div>

                            <div class="table-responsive">
                            <table id="example" class="table table-sm table-striped">
                            <thead class="thead-light">
                                        <tr>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Name</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">CID</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Business</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Total Visit</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Last Visit</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Next Visit</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Status</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($allapplication as $app) :
                                        ?>
                                                <tr>
                                                    <td style="font-size: 14px;"><?php echo $i; ?></td>
                                                    <td style="font-size: 14px;"><?php echo App\Models\FundingApplication::where('id', $app->fundappid)->value('name'); ?></td>
                                                    <td style="font-size: 14px;"><?php echo App\Models\FundingApplication::where('id', $app->fundappid)->value('cid');?></td>
                                                    <td style="font-size: 14px;"><?php echo App\Models\FundingApplication::where('id', $app->fundappid)->value('business_name'); ?></td>
                                                    <td style="font-size: 14px;"><?php $count = count(App\Models\SitevisitDateTime::where('fundid', $app->fundappid)->get());?>
                                                    <font color='blue'><?php echo $count; ?></font>
                                                     </td>
                                                    <td style="font-size: 14px;"><?php echo $lvd = App\Models\SitevisitDateTime::where('fundid', $app->fundappid)->orderBy('id', 'desc')->value('actualdate');;
                                                    ?></td>
                                                    <td style="font-size: 14px;"><?php
                                                    $status = App\Models\SitevisitDateTime::where('fundid', $app->fundappid)->orderBy('id', 'desc')->value('status');
                                                    if($status == 'y'){
                                                    $date = new DateTime($lvd);
                                                    $date->modify('+3 month');
                                                    $date = $date->format('Y-m-d');
                                                    echo $date; }

                                                    if($status == 'r'){
                                                        $date = new DateTime($lvd);
                                                        $date->modify('+1 month');
                                                        $date = $date->format('Y-m-d');
                                                        echo $date; }

                                                        if($status == 'g'){
                                                            $date = new DateTime($lvd);
                                                            $date->modify('+6 month');
                                                            $date = $date->format('Y-m-d');
                                                            echo $date; }
                                                      ?>
                                                    </td>
                                                    <?php
                                                    if($status == 'y' || $status == '')
                                                    { ?>  <td style="background:#fabd08;"></td> <?php }
                                                    if($status == 'r')
                                                    { ?>  <td style="background:#326abf;"></td> <?php }
                                                    if($status == 'g')
                                                    { ?>  <td style="background:#fa6508;"></td> <?php } ?>

                                                    <td style="font-size: 14px;">
                                                <a href="{{ route('scheduleindient', array($app->fundappid, $key)) }}" style="text-decoration:none"><font color='green'>view</font></a>

                                                </td>
                                                    </tr>
                                        <?php $i++; endforeach; ?>
                                    </tbody>
                                </table>
                                <table>
                                    <tr>
                                    <td style="background:#326abf;" width="50"></td><td>Poor: Monthly visit&nbsp;&nbsp;</td>
                                        <td style="background:#fabd08;" width="50"></td><td>Good: Quarterly visit&nbsp;&nbsp;</td>
                                        <td style="background:#fa6508;" width="50"></td><td>Excellent: Half yearly Visit&nbsp;&nbsp;</td>
                                    </tr>
                                </table><br />
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
<script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
$(window).load(function(){
   setTimeout(function(){ $('.alert-success').fadeOut() }, 5000);
});
</script>
