<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BizAP</title>
    </head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="py-2" style="background-color: #f3f6f7;">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="container">
<div class="col-md-12 mt-5">



<div class="card-deck">
      <div class="card text-center">
      <div class="card-body"><a href="{{route('screening')}}" style="text-decoration: none;color: #484848; ">
      <h5 class="card-title">Training Application</h5>
      <img class="card-img-top" src="{{URL::asset('/training.png')}}"style="height:150px;width:150px;margin-left: 70px;"><br>
          <p>Total Submitted:&nbsp;&nbsp;
          <?php echo count(App\Models\TrainingApplication::all());?>
          <br>Total Approved:&nbsp;&nbsp;
          <b><?php
          echo count(DB::table('tb_training_applications')
          ->join('tbl_ranking_statuses', 'tb_training_applications.id', '=', 'tbl_ranking_statuses.appID')
          ->select('tb_training_applications.*')
          ->get());
          ?>
          </b>
          </p>
          <br>
          <a href="{{route('screening')}}" class="btn btn-outline-primary">TRAINING</a>
          <a href="{{route('reporttraining')}}" class="btn btn-outline-primary">VIEW</a>
          </a>
      </div>
      </div>
      <div class="card text-center">
      <div class="card-body"><a href="{{route('screeningfund')}}" style="text-decoration: none;color: #484848; ">
      <h5 class="card-title">Funding Application</h5>
      <img class="card-img-top" src="{{URL::asset('/training1.jpg')}}"style="height:150px;width:150px;margin-left: 70px;"><br>
          <p>Total Submitted:&nbsp;&nbsp;
          <?php $total = DB::table('tb_dhifund_applications')
          ->select(DB::raw('count(*) as num'))
          ->groupBy('cid')
          ->get();
          echo count($total); ?>
          <br>Total Approved:&nbsp;&nbsp;
          <b><?php
          $total = DB::table('tb_dhifund_applications')
          ->where('disbursement', '1')
          ->select(DB::raw('count(*) as num'))
          ->groupBy('cid')
          ->get();
          echo count($total);
          ?>
          </b>
          </p>
          <br>
          <a href="{{route('screening')}}" class="btn btn-outline-primary">APPLY HERE</a>
          <a href="{{route('reportfunding')}}" class="btn btn-outline-primary">VIEW</a>
          </a>
      </div>
      </div>
                <?php
                $count = '0';
                $count = count(App\Models\DelayCount::where('active', '0')->orderBy('id', 'desc')->get());
                ?>
      <div class="card text-center">
      <div class="card-body">
      <h5 class="card-title">Delayed Repayment</h5>
      <img class="card-img-top" src="{{URL::asset('/funds.png')}}"style="height:130px;width:160px;margin-left: 75px;"><br><br>
          <p
                <?php if($count == '0') { ?>
                <?php } else { ?>
                style="color: #d62940;"
                <?php } ?>>Delayed monthly installment Payment.
          Total Delayed Payment:&nbsp;&nbsp;
          <b><?php echo $count; ?></b>
          </p>
          <br>
          <a href="{{route('delayall')}}" class="btn btn-outline-primary">VIEW</a>
      </div>
      </div>
</div>

<br>

<div class="card-deck">
      <div class="card text-center">
      <div class="card-body">
      <h5 class="card-title">Fund Release Requests</h5>
      <img class="card-img-top" src="{{URL::asset('/repay.png')}}"style="height:140px;width:140px;margin-left: 70px;"><br>
          <p>Total Fund Released:&nbsp;&nbsp;
          <?php
          echo count(App\Models\FundRequest::where('disbursement', '1')->get());
          ?>
          </p>
          <br>
          <a href="{{route('disbursed')}}" class="btn btn-outline-primary">VIEW</a>
          </a>
      </div>
      </div>
      <div class="card text-center">
      <div class="card-body">
      <h5 class="card-title">EMI Deposits</h5>
      <img class="card-img-top" src="{{URL::asset('/training1.jpg')}}"style="height:150px;width:150px;margin-left: 70px;"><br>
          <p>Total EMI Deposited:&nbsp;&nbsp;
          <?php
          echo count(App\Models\Repayments::all());
          ?>
          </p>
          <p class="card-text">View the list of EMI Deposited.</p><br>
          <a href="{{route('repaymentdhi')}}" class="btn btn-outline-primary">VIEW</a>
          </a>
      </div>
      </div>
      <div class="card text-center">
      <div class="card-body">
      <h5 class="card-title">Site Visit Activities Schedule</h5>
      <img class="card-img-top" src="{{URL::asset('/visit.jpg')}}"style="height:135px;width:175px;margin-left: 70px;"><br><br>
          <p>Total Planned Activities:&nbsp;&nbsp;
          <?php echo $sitevisit  = count(App\Models\SitevisitDateTime::All());?>
          </p>
          <br>
          <a href="sitevisit" class="btn btn-outline-primary">VIEW</a>
          </a>
      </div>
      </div>
</div>

<br><br><br>




</div>
</div>
</div>
</div>
</html>

