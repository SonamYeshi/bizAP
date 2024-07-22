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


<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-5">
                            @if(Session::has('message'))
                            <div class="alert alert-{{Session::get('class')}} alert-dismissible fade show w-100 ml-auto alert-custom" role="alert">
                                {{ Session::get('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h5 style="font-size: 17px;">DHI Fund Request Applications</h5>
                                </div>
                            </div>
                        <div class="table-responsive">
                        <table id="example" class="table table-sm table-striped">
                        <thead class="thead-light">
                        <tr>
                        <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
                        <th style="color:#0553a1;font-weight: 500;font-size: 15px;">CID of Applicant</th>
                        <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Name</th>
                        <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Mobile No.</th>
                        <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Name of Business</th>
                        <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Business Location</th>
                        <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Applied On</th>
                        <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Reviewed On</th>
                        <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Action</th>
                        <th style="color:#0553a1;font-weight: 500;font-size: 15px;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $allapplication = App\Models\FundRequest::where('review', '1')->where('approve_ach', '0')->orderBy('id', 'desc')->get();
                        $i = 1;
                        foreach ($allapplication as $app) :  ?>
                        <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo App\Models\FundingApplication::where('id', $app->fundid)->value('cid'); ?></td>
                        <td><?php echo App\Models\FundingApplication::where('id', $app->fundid)->value('name'); ?></td>

                        <td><?php echo App\Models\FundingApplication::where('id', $app->fundid)->value('mobileno'); ?></td>
                        <td><?php echo App\Models\FundingApplication::where('id', $app->fundid)->value('business_name'); ?></td>
                        <td><?php echo App\Models\FundingApplication::where('id', $app->fundid)->value('business_location'); ?></td>
                        <td>{{$app->created_on}}</td>
                        <td><?php $frid = App\Models\FundRequest::where('fundid', $app->fundid)->value('id');
                        echo App\Models\FundRequestStatus::where('fundrequestid', $frid)->value('review_date');
                        ?></td>
                        <td>
                        <?php $status = App\Models\FundRequestStatus::where('fundrequestid', $app->id)->value('approved_status_ach'); ?>
                        @if($status =='0')
                        <a href="{{route('reviewach',['id'=>$app->id])}}" style="text-decoration:none;color: #0e5296;">Approve</a><br>
                        @else
                        <font color ="blue">Approved</font>
                        @endif
                        </td>
                        <td>
                        <a href="{{route('viewdetailasd',['id'=>$app->id])}}" style="text-decoration:none;color: #0e5296;">View</a>
                        </td>
                        </tr>
                        <?php
                        $i++;
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





</div>
</div>
</div>
</body>
</html>
