<x-app-layout>
    @include('top_nav_bar')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-5">
                        @include('flash-message')
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h5>Mailing List for Interview</h5>
                                </div>
			                 </div> @include('sweetalert::alert')
                            @include('sweetalert::alert')
                            <form class="form-horizontal" method="POST" action="{{ route('sendmail_iselect') }}" accept-charset="utf-8" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered table-sm table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Sl.No</th>
                                            <th>CID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Interview Date</th>
                                            <th>Interview Time</th>
                                            <th>Action</th>
                                            <th>Select</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1; @endphp
                                        @foreach ($mailslist as $app)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$app->cid}}</td>
                                                <td>{{$app->name}}</td>
                                                <td>{{$app->email}}</td>
                                                <td>{{$app->interview_date}}</td>
                                                <td>{{$app->interview_time}}</td>
                                                <td>
                                                 @if($app->sent == 0)
						                        <a href="{{ route('sendmail_t',array($app->id,$app->appID))}}" class="btn btn-success btn-sm">Send Mail</a>

                                                 @endif
                                                 @if($app->sent == 1)
                                                 <font color = "red">Sent</font>
                                                 @endif
                                                </td>
                                                <td>
                                                @if($app->sent == 0) 
                                                <input type="checkbox" id="pmail" name="pmail[]" value="{{$app->appID}}" multiple="multiple" class="pmail">
                                                @endif
                                                </td>
                                            </tr>
                                        @php $i++; @endphp
                                        @endforeach
                                        <tr><td colspan="7"></td><td>
                                        @if(count($mailslist) != 0)
                                        <button type="submit" class="btn btn-primary btn-sm" onclick='return validateIfChecked()'>Send</button>
                                        @endif
                                        </td></tr>
                                    </tbody>
                                </table>
                            </div>
                           </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

<script src="jquery.js"></script>
<script src="jquery_tables.js"></script>
<link href="{{ asset('css/app_tables.css') }}" rel="stylesheet">
<script>
    $(document).ready(function() {
    $('#example').DataTable();
    });

    function validateIfChecked(){
        if ($('.pmail:checked').length > 0) {
            // At least one checkbox is selected
            return confirm('Are you sure to send the mails?');
        } else {
            alert('Please select at least one checkbox.');
            event.preventDefault(); // Prevent form submission
            return false;
        }
    }

    $(window).load(function(){
    setTimeout(function(){ $('.alert-success').fadeOut() }, 5000);
    });
</script>

