<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="our-services">
  <div class="container">
    <div class="row">

    <div class="col-md-4">
        <div class="service-box" style="background-color: #008000; box-shadow: 5px 15px #888888; color: white;">
          <div class="row">
            <div class="col-12">
              <h5><a href="{{route('screening')}}" style="text-decoration: none; color: orange;">Training Application Submissions
              </a></h5>
              <p><stong>Total Submitted:&nbsp;&nbsp;</stong>
              <?php echo count(App\Models\TrainingApplication::all());?>
              </p>
              <p><stong>Total Approved:&nbsp;&nbsp;</stong>
             <b> <?php
              echo count(DB::table('tb_training_applications')
              ->join('tbl_ranking_statuses', 'tb_training_applications.id', '=', 'tbl_ranking_statuses.appID')
              ->select('tb_training_applications.*')
              ->get());
              ?>
             </b>
            </p>
              <p><a href="{{route('reporttraining')}}" style="text-decoration: none; color: orange;">Click here to view the list of submitted Applications.</a></p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="service-box" style="background-color: #FFA500; box-shadow: 5px 15px #888888; color: white;">
          <div class="row">
            <div class="col-12">
              <h5><a href="{{route('screeningfund')}}" style="text-decoration: none; color:black;">BizAP Application Submissions</a></h5>
              <p style="color: white;"><stong>Total Submitted:&nbsp;&nbsp;</stong>
              <?php $total = DB::table('tb_dhifund_applications')
                                          ->select(DB::raw('count(*) as num'))
                                          ->groupBy('cid')
                                          ->get();
                                          echo count($total); ?>
              </p>
              <p style="color: white;"><stong>Total Approved:&nbsp;&nbsp;</stong>
              <?php
              $total = DB::table('tb_dhifund_applications')
              ->where('disbursement', '1')
              ->select(DB::raw('count(*) as num'))
              ->groupBy('cid')
              ->get();
              echo count($total);
              ?>

            </p>
              <p><a href="{{route('reportfunding')}}" style="text-decoration: none; color:black;">Click here to view the list of submitted Applications.</a></p></div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
      <?php
              $count = '0';
              $count = count(App\Models\DelayCount::where('active', '0')->orderBy('id', 'desc')->get());
              ?>
        <div class="service-box"
        <?php if($count == '0') { ?>
        style="background-color: #033E3E; box-shadow: 5px 15px #888888; color: white;"
        <?php } else { ?>
        style="background-color: #E84933; box-shadow: 5px 15px #888888; color: white;"
        <?php } ?>
        >
          <div class="row">

            <div class="col-12">
              <h5><a href="#" style="text-decoration: none;">Delayed Repayment</a></h5>
              <p>
                  Delayed monthly installment Payment.</p>
              <p><stong>Total Delayed Payment:&nbsp;&nbsp;</stong>
              <?php echo $count; ?>
              </p>
              <p><a href="{{route('delayall')}}" style="text-decoration: none;">Click here to view the list of Delayed Payment.</a></p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="service-box" style="background-color: #4E5180; box-shadow: 5px 15px #888888; color:whitesmoke; ">
          <div class="row">

            <div class="col-12">
              <h5><a href="#" style="color:#00d600;">Fund Release Requests</a></h5>
              <p></p>
              <p><stong>Total Fund Released:&nbsp;&nbsp;</stong>
              <?php
              echo count(App\Models\FundRequest::where('disbursement', '1')->get());
              ?>
              </p>
              <p><a href="{{route('disbursed')}}" style="text-decoration: none; color:#00d600;">Click here to view the list Fund Disbursed.</a></p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="service-box" style="background-color: #342D7E; box-shadow: 5px 15px #888888; color: white;">
          <div class="row">
            <div class="col-12">
              <h5><a href="#" style="color:#FF9800;">EMI Deposits</a></h5>
              <p style="color:#FF9800;"></p>
              <p style="color:white;"><stong>Total EMI Deposited:&nbsp;&nbsp;</stong>
              <?php
              echo count(App\Models\Repayments::all());
              ?>
              </p>
              <p><a href="{{route('repaymentdhi')}}" style="text-decoration: none; color:#FF9800">Click here to view the list of EMI Deposited.</a></p>

            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="service-box" style="background-color: #00d1d1; box-shadow: 5px 15px #888888; color: black;">
          <div class="row">

            <div class="col-12">
              <h5><a href="#" style="color: black;">Site Visit Activities Schedule</a></h5>
              <p style="color: white;"><stong>Total Planned Activities:&nbsp;&nbsp;</stong>
              <?php echo $sitevisit  = count(App\Models\SitevisitDateTime::All());

              ?>
              </p>
              <p><a href="sitevisit" style="text-decoration: none; color:black;">Click here to view the list of Site Visits.</a></p>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<style type="text/css">
.our-services {
    background-color: #b2b2b2;
    padding: 50px 0px;
}
.service-box {
    background-color: #fff;
    padding: 10px 15px;
    border-radius: 8px;
    margin: 10px 0px 10px;
    transition: 0.5s;
    border: 1px solid transparent;
}
.service-box:hover {
    background-color: #f9f9f9;
    border-radius: 40px;
    border: 1px solid #ddd;
}
.service-box:hover h3 a{
  color: #00bcd4;
}
.service-box i {
    font-size: 30px;
    align-items: center;
    display: flex;
    position: absolute;
    height: 100%;
    width: 100%;
    color: #989898;
}
.service-box h3 a {
    text-decoration: none;
    color: #FF9800;
    font-size: 24px;
}
.service-box :before {
    margin: 0 auto;
    display: block;
    float: none;
}
</style>
