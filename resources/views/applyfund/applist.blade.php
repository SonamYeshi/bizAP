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
    DHI Entrepreneurship Funding
    </div>
    <div class="card-body">
    <p class="card-text">The List of Entrepreneurship Funding Programs.</p>
            @include('sweetalert::alert')
            <script type="text/javascript">window.setTimeout("document.getElementById('successMessage').style.display='none';", 2000); </script>
            <div style="overflow-x:auto;">
            <div class="table">
            <table class="styled-table">
            <thead>
            <tr class="table-secondary">
            <th style="white-space:nowrap;color: #484848;">Announcement Title</th>
            <th style="white-space:nowrap;color: #484848;">Details</th>
            <th style="white-space:nowrap;color: #484848;">Submission Date & Time</th>
            <th style="white-space:nowrap;color: #484848;">Email</p></th>
            <th style="white-space:nowrap;color: #484848;">Phone No.</p></th>
            <th style="white-space:nowrap;color: #484848;">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($funding as $t)
                @php
                $submission_last_datetime = \Carbon\Carbon::parse($t->submission_date . ' ' . $t->submission_time);
                $current_datetime = \Carbon\Carbon::now();
                @endphp
                <tr>
                    <td>{{$t->title}}</td>
                    <td>{{$t->details}}</td>
                    <td>{{$t->submission_date}}<br>{{$t->submission_time}}</td>
                    <td>{{$t->email}}</td>
                    <td>{{$t->phone}}</td>
                    <td>
                    @if($current_datetime <= $submission_last_datetime)
                        <font color="green"><a href="{{route('fapplication',['id'=>$t->id])}}">Apply</a></font>
                    @else
                    <font color="red">Submission time is over</font>
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



