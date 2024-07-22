<link rel="stylesheet" href="{{ asset('css/custom_tables.css') }}">
<x-guest-layout>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BizAP</title>
    </head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <div class="card text-center">
    <div class="card-header" style="font-size: 18px;text-align: center;font-weight: 580;">
    DHI Entrepreneurship Training
    </div>
    <div class="card-body">
    <p class="card-text">The List of Entrepreneurship Training Programs.</p>
            @include('sweetalert::alert')
            <script type="text/javascript">window.setTimeout("document.getElementById('successMessage').style.display='none';", 2000); </script>
            <div style="overflow-x:auto;">
            <div class="table">
            <table class="styled-table">
            <thead>
            <tr class="table-secondary">
            <th style="white-space:nowrap;color: #484848;">Training Title</th>
            <th style="white-space:nowrap;color: #484848;">Details</th>
            <th style="white-space:nowrap;color: #484848;">Provider</th>
            <th style="white-space:nowrap;color: #484848;">Application Submission<p>Deadline Date</p></th>
            <th style="white-space:nowrap;color: #484848;">Application Submission <p>Deadline Time</p></th>
            <th style="white-space:nowrap;color: #484848;">Contact Email</th>
            <th style="white-space:nowrap;color: #484848;">Contact Phone No.</th>
            <th style="white-space:nowrap;color: #484848;">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($training as $t)
            @php
            $training__last_datetime = \Carbon\Carbon::parse($t->training_date . ' ' . $t->training_time);
            $current_datetime = \Carbon\Carbon::now();
            @endphp
            <tr>
                <td>{{$t->training_title}}</td>
                <td>{{$t->announcement_details}}</td>
                <td>{{App\Models\TrainingProvider::where('id', $t->training_provider)->value('name')}}</td>
                <td>{{$t->training_date}}</td>
                <td>{{$t->training_time}}</td>
                <td>{{$t->email}}</td>
                <td>{{$t->phone}}</td>
                <td>
                @if($current_datetime <= $training__last_datetime)
                <font color="#9bb6d0;"><a href="{{route('tapplication',['id'=>$t->id])}}" >Apply</a></font>
                @else
                <font color="#d62940">Submission time is over</font>
                @endif
                </td>
            </tr>
            @endforeach
            </tbody>
            </table>
            </div>
            </div>
    </div>
    </div>
</x-guest-layout>



