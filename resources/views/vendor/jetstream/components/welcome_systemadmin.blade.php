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
      <div class="card-body"><a href="{{route('view_role')}}" style="text-decoration: none;color: #484848; ">
      <h5 class="card-title">User Roles</h5>
      <img class="card-img-top" src="{{URL::asset('/training.png')}}"style="height:150px;width:150px;margin-left: 70px;"><br>
          <p class="card-text">View / Add User Roles.</p><br>
          <a href="{{route('view_role')}}" class="btn btn-outline-primary">CLICK TO ADD</a>
          </a>
      </div>
      </div>
      <div class="card text-center">
      <div class="card-body"><a href="{{route('view_user')}}" style="text-decoration: none;color: #484848; ">
      <h5 class="card-title">Users</h5>
      <img class="card-img-top" src="{{URL::asset('/training1.jpg')}}"style="height:150px;width:150px;margin-left: 70px;"><br>
          <p class="card-text">View / Add Users.</p><br>
          <a href="{{route('view_user')}}" class="btn btn-outline-primary">CLICK TO ADD</a>
          </a>
      </div>
      </div>

      <div class="card text-center">
      <div class="card-body">
      <h5 class="card-title">DHI ICT Email</h5>
      <img class="card-img-top" src="{{URL::asset('/funds.png')}}"style="height:130px;width:160px;margin-left: 75px;"><br><br>
          <p class="card-text">View /Add DHI ICT Email.</p><br>
          <a href="{{route('view_ictemail')}}" class="btn btn-outline-primary">CLICK TO ADD</a>
      </div>
      </div>
</div>

<br>
<br>




</div>
</div>
</div>
</div>
</html>

