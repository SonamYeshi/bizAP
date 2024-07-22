
<div class="py-2">
<div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        @if(Session::has('message'))
        <div class="alert alert-{{Session::get('class')}} alert-dismissible fade show w-100 ml-auto alert-custom" role="alert">
        {{ Session::get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        @endif   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <div class="card text-center">
    <div class="card-header" style="font-size: 18px;text-align: center;font-weight: 580;">
    DHI Fund Disbursement Applications
    </div>
    <div class="card-body">
    <p class="card-text">The List of DHI Fund Disbursement Applications.</p>
            @include('sweetalert::alert')
            <script type="text/javascript">window.setTimeout("document.getElementById('successMessage').style.display='none';", 2000); </script>
            <div class="table-responsive">
            <table id="example" class="table table-sm table-striped">
            <thead class="thead-light">
            <tr class="table-secondary">
            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">CID of Applicant</th>
            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Name</th>
            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Email</th>
            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Mobile No.</th>
            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Name of Business</th>
            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Business Location</th>
            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Disbursement Date</th>
            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $allapplication = App\Models\FundRequest::where('review', '1')->where('approve_ach', '1')->where('approve_asd', '1')->orderBy('id', 'desc')->get();
            $i = 1;
            foreach ($allapplication as $app) :  ?>
            <tr>

            <td><?php echo $i; ?></td>
            <td><?php echo App\Models\FundingApplication::where('id', $app->fundid)->value('cid'); ?></td>
            <td><?php echo App\Models\FundingApplication::where('id', $app->fundid)->value('name'); ?></td>
            <td><?php echo App\Models\FundingApplication::where('id', $app->fundid)->value('email'); ?></td>
            <td><?php echo App\Models\FundingApplication::where('id', $app->fundid)->value('mobileno'); ?></td>
            <td><?php echo App\Models\FundingApplication::where('id', $app->fundid)->value('business_name'); ?></td>
            <td><?php echo App\Models\FundingApplication::where('id', $app->fundid)->value('business_location'); ?></td>
            <td><?php echo App\Models\FundingApplication::where('id', $app->fundid)->value('disbursed_date'); ?></td>
            <td>
            <a href="{{route('bankview',['id'=>$app->id])}}" style="text-decoration:none" class="btn btn-outline-primary btn-sm">View Detail</a>
            </td>
            </tr>
            <?php $i++; endforeach; ?>
            </tbody>
            </table>
            </div>
    </div>
    </div>

</div>
</div>
</div>
