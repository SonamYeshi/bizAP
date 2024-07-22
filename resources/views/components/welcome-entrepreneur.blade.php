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
      <div class="card-body"><a href="{{route('updateinfo')}}" style="text-decoration: none;color: #484848; ">
      <h5 class="card-title" style="color: #5b5b5b;font-size: 18px;">Update Business Information</h5>
      <img class="card-img-top" src="{{URL::asset('/training.png')}}"style="height:100px;width:100px;margin-left: 50px;"><br>
          <p class="card-text">Click here to update your business information.</p><br>
          <a href="{{route('updateinfo')}}" class="btn btn-outline-primary">UPDATE</a>
          </a>
      </div>
      </div>
      <div class="card text-center">
      <div class="card-body"><a href="{{route('fundrequest')}}" style="text-decoration: none;color: #484848; ">
      <h5 class="card-title" style="color: #5b5b5b;font-size: 18px;">Submit Fund Release Request</h5>
      <img class="card-img-top" src="{{URL::asset('/training1.jpg')}}"style="height:100px;width:100px;margin-left: 50px;"><br>
          <p class="card-text">Click here to request for fund release.</p><br>
          <a href="{{route('fundrequest')}}" class="btn btn-outline-primary">APPLY HERE</a>
          </a>
      </div>
      </div>
      <div class="card text-center">
      <div class="card-body">
      <h5 class="card-title" style="color: #5b5b5b;font-size: 18px;">Submit Repayment Information</h5>
      <img class="card-img-top" src="{{URL::asset('/repay.png')}}"style="height:100px;width:100px;margin-left: 50px;"><br>
          <p class="card-text">Click here to submit information on repayments.</p><br>
          <a href="{{route('repayment')}}" class="btn btn-outline-primary">APPLY HERE</a>
      </div>
      </div>

      <div class="card text-center">
      <div class="card-body">
      <h5 class="card-title" style="color: #5b5b5b;font-size: 18px;">Site Visit Information</h5>
      <img class="card-img-top" src="{{URL::asset('/visit.jpg')}}"style="height:100px;width:100px;margin-left: 50px;"><br><br>
          <p class="card-text">Information of Site Visits.</p><br><br>
          <a href="sitevisit" class="btn btn-outline-primary">CLICK HERE</a>
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

