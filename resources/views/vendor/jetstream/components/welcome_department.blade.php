<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BizAP</title>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="py-2" style="background-color: #f3f6f7;">
    <div class="container">
        <div class="col-md-12 mt-2">

            <p class="text-center" style="color:#363636;font-weight: 450;font-size: 18px; ">EDD Statistics.</p>

            <div class="card-deck">

                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #5b5b5b;font-size: 18px;">Total Amount of Fund Disbursed (M)</h5>
                        <img class="card-img-top" src="{{URL::asset('/funds.png')}}" style="height:130px;width:150px;margin-left: 30px;"><br>
                        <p class="card-text" style="color: #3a74ae;font-weight: bold;font-size: 30px;">Nu
                            <?php
                            $total_disbursed = App\Models\FundingApplication::sum('actual_disbursed');
                            echo number_format(($total_disbursed / 1000000), 2)
                            ?></p><br>
                    </div>
                </div>
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #5b5b5b;font-size: 18px;">Total Number Entrepreneurs Trained</h5>
                        <img class="card-img-top" src="{{URL::asset('/report3.jpg')}}" style="height:130px;width:170px;margin-left: 25px;"><br>
                        <p class="card-text" style="color: #3a74ae;font-weight: bold;font-size: 30px;"><?php
                                                                                                        echo count(DB::table('tb_training_applications')
                                                                                                            ->join('tbl_ranking_statuses', 'tb_training_applications.id', '=', 'tbl_ranking_statuses.appID')
                                                                                                            ->select('tb_training_applications.*')
                                                                                                            ->get());
                                                                                                        ?></p><br>
                    </div>
                </div>

                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #5b5b5b;font-size: 17px;">Entrepreneurs Funded based on<br> M & E Report</h5>
                        <img class="card-img-top" src="{{URL::asset('/funds.png')}}" style="height:130px;width:150px;margin-left: 30px;"><br>
                        <p class="card-text" style="color: #3a74ae;font-weight: bold;font-size: 30px;">
                            <?php
                            $total = DB::table('tb_dhifund_applications')
                                ->where('disbursement', '1')
                                ->select(DB::raw('count(*) as num'))
                                ->groupBy('cid')
                                ->get();
                            echo count($total); ?></p><br>
                    </div>
                </div>

            </div>

            <br>
            <div class="jumbotron jumbotron-fluid" style="background-color: white;">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header border-info" style="color:#727272;font-weight: 450;font-size: 18px;text-align: center;">
                                    Training Provided
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Number of Trainings Organized:
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <b><?php $total = DB::table('tbl_trainings')->get();
                                            echo count($total); ?></b>
                                    </li>
                                    <li class="list-group-item">Total Number of Applicants:
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;
                                        <b><?php $total = DB::table('tb_training_applications')->get();
                                            echo count($total); ?></b>
                                    </li>
                                    <li class="list-group-item">Total Number Trained
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <b><?php echo count(DB::table('tb_training_applications')
                                                ->join('tbl_ranking_statuses', 'tb_training_applications.id', '=', 'tbl_ranking_statuses.appID')
                                                ->select('tb_training_applications.*')
                                                ->get());
                                            ?></b>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header border-info" style="color:#727272;font-weight: 450;font-size: 18px;text-align: center;">
                                    Entrepreneurs Funded
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Number of Financing Round
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;
                                        <b><?php $total = DB::table('tb_fund_annoucements')->get();
                                            echo count($total); ?></b>
                                    </li>
                                    <li class="list-group-item">Total Number of Applications
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <b><?php $total = DB::table('tb_dhifund_applications')
                                                ->select(DB::raw('count(*) as num'))
                                                ->groupBy('cid')
                                                ->get();
                                            echo count($total); ?></b>
                                    </li>
                                    <li class="list-group-item">Total Entrepreneurs Funded
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;
                                        <b><?php
                                            $total = DB::table('tb_dhifund_applications')
                                                ->where('disbursement', '1')
                                                ->select(DB::raw('count(*) as num'))
                                                ->groupBy('cid')
                                                ->get();
                                            echo count($total); ?></b>
                                    </li>
                                </ul>
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header border-info" style="color:#727272;font-weight: 450;font-size: 18px;text-align: center;">
                                    Fund Highlights(M)
                                </div>
                                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header border-info" style="color:#727272;font-weight: 450;font-size: 18px;text-align: center;">
                                    Entrepreneur's Performance
                                </div>
                                <div id="chartContainer1" style="height: 370px; width: 100%;"></div>
                                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header border-info" style="color:#727272;font-weight: 450;font-size: 18px;text-align: center;">
                                    Number of Site Visit Conducted
                                </div>
                                <p class="card-text" style="color: #3a74ae;font-weight: bold;font-size: 30px;text-align: center;"><?php echo $sitevisit  = count(App\Models\SitevisitDateTime::All()); ?></p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header border-info" style="color:#727272;font-weight: 450;font-size: 18px;text-align: center;">
                                    Total Amount of Repayment (M)
                                </div>
                                <p class="card-text" style="color: #3a74ae;font-weight: bold;font-size: 30px; text-align: center;">Nu <?php
                                                                                                                                    $total_disbursed = App\Models\Repayments::sum('emi_amount');
                                                                                                                                    echo number_format(($total_disbursed / 1000000), 2)
                                                                                                                                    ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</html>
<?php
$fund = DB::select('
SELECT year(disbursed_date) as year, sum(actual_disbursed) as total FROM db_dhidatabase.tb_dhifund_applications group by year(disbursed_date)');
$count = count($fund);

$yellow = count(DB::select('SELECT * FROM db_dhidatabase.tbl_sitevisit_schedules WHERE `status` = "y"'));
$green = count(DB::select('SELECT * FROM db_dhidatabase.tbl_sitevisit_schedules WHERE `status` = "g"'));
$red = count(DB::select('SELECT * FROM db_dhidatabase.tbl_sitevisit_schedules WHERE `status` = "r"'));


?>
<script>
   window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light1", // "light2", "dark1", "dark2"
	animationEnabled: false, // change to true
	data: [
	{
		// Change type to "bar", "area", "spline", "pie",etc.
		type: "column",
		dataPoints: [
			<?php foreach($fund as $f) { ?>{label: "<?php echo $f->year; ?>",  y: <?php echo number_format(($f->total / 1000000), 2); ?> }, <?php } ?>
		]
	}
	]
});
chart.render();

var chart = new CanvasJS.Chart("chartContainer1", {
            animationEnabled: true,

            data: [{
                type: "doughnut",
                startAngle: 30,
                innerRadius: 70,
                indexLabelFontSize: 17,
                indexLabel: "{label} #percent%",
                toolTipContent: "<b>{label}:</b> {y} (#percent%)",
                dataPoints: [{
                        y: <?php echo $green; ?>,
                        label: "Excellent",
                        color: "#3a74ae"
                    },
                    {
                        y: <?php echo $yellow; ?>,
                        label: "Good",
                        color: "#badbfa"
                    },
                    {
                        y: <?php echo $red; ?>,
                        label: "Bad",
                        color: "#69fffa"
                    }

                ]
            }]
        });
        chart.render();


    }
</script>
