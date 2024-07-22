
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
<x-guest-layout>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BizAP</title>
    </head>
    <div class="container-fluid">
      <div class="row text-center" style="background-color: #fb9b04;">
          <img class="img-responsive" src="{{URL::asset('/header.png')}}">
      </div>
    </div>

    <br>
    <div class="container">
            <div class="row">
                <div style="height: 450px;" class="col-md-10 offset-md-1 text-left">
                <strong><center>DHI Business Acceleration Fund</center></strong>
                <br>
                            <?php foreach($funding as $t): echo $t->details;?><?php endforeach; ?>
                            <a href="{{route('fapplication',['id'=>$aid])}}" class="btn btn-info btn-sm">Apply</a>
                        </div>

            </div>

        </div>

</x-guest-layout>



