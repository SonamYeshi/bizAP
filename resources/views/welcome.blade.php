<x-guest-layout>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BizAP</title>
    </head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="py-12" style="background-color: #f3f6f7;">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="container">
<div class="col-md-12 mt-5">



<div class="card-deck">
  <div class="card text-center">

    <div class="card-body">
      <h5 class="card-title">Training Application</h5><br>
      <img class="card-img-top" src="{{URL::asset('/training.png')}}"style="height:150px;width:150px;margin-left: 70px;"><br>
      <p class="card-text">Apply here for Trainings.</p><br>
      <a href="{{route('apply')}}" class="btn btn-outline-primary">CLICK HERE</a>
    </div>

  </div>
  <div class="card text-center">

    <div class="card-body">
      <h5 class="card-title">Funding Application</h5><br>
      <img class="card-img-top" src="{{URL::asset('/training1.jpg')}}"style="height:150px;width:150px;margin-left: 70px;"><br>
      <p class="card-text">Apply here for Fundings.</p><br>
      <a href="{{route('applyfund')}}" class="btn btn-outline-primary">CLICK HERE</a>
    </div>

  </div>
  <div class="card text-center">

    <div class="card-body">
      <h5 class="card-title">Training & Funding Results</h5><br>
      <img class="card-img-top" src="{{URL::asset('/training1.jpg')}}"style="height:150px;width:150px;margin-left: 70px;"><br>
      <p class="card-text">See Training & Funding Results.</p><br>
      <a href="#" class="btn btn-outline-primary">CLICK HERE</a>
    </div>
  </div>
</div>


<br>
<div class="jumbotron jumbotron-fluid">
  <div class="container"><p style="color:#727272;font-weight: 450;font-size: 18px; ">Contact For Support</p>
  <div class="row">
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title" style="color:#727272;">For Training Information</h5>
        <p class="card-text" style="color:#727272;">Mr. Thukten Sherab <br>
                                    Associate Analyst <br>
                                    Enterprise Development Division <br>
                                    Email: thuktensherab@dhi.bt <br>
                                    Mobile: 17550344 <br>
                                    Tel: +975 -02- 336257 / 258</p>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title" style="color:#727272;">For Funding Information</h5>
        <p class="card-text" style="color:#727272;">Ms. Dorji Pelden <br>
                                    Analyst<br>
                                    Enterprise Development Division <br>
                                    Email: dorjipeldon@dhi.bt <br>
                                    Mobile: 16929276 <br>
                                    Tel: +975 -02- 336257 / 258</p>
      </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title" style="color:#727272;">Downloads</h5>
        <p class="card-text" style="color:#727272;">
        <?php $filename = "DHI_BizAPP_Database_System_User_Manual.docx";?>
        <a href="{{ url('/manual/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i>User Manual</a>
        <br><br><br><br><br><br>
                                    </p>
      </div>
    </div>
  </div>


</div>
  </div>
</div>



</div>
</div>
</div>
</div>

</x-guest-layout>
