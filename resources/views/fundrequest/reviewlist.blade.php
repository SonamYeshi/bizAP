<x-app-layout>
    @include('top_nav_bar')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" >
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-5">
                        @include('sweetalert::alert')
                        @include('flash-message')
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h5>DHI Fund Request Applications</h5>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                    <div class="row">
                                        <form class="row g-3" role="form" method="POST" action="{{ route('fundrequest_search') }}" enctype="multipart/form-data">
                                          {{ csrf_field() }}
                                            <div class="col-md-4">
                                                <div class="form-group"> <label style="float: left;"><b>Filter By</b></label>
                                                    <select id="save" name="key" class="form-control" onchange="this.form.submit();">
                                                    <option value="" selected disabled>-- Select --</option>
                                                    @foreach($funding as $t)
                                                    <option value="{{$t->id}}">{{$t->opencohort}} {{$t->opencohortno}}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered table-sm table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Name</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">CID</th>

                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Email</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Mobile</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Business</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Location</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Applied On</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Status</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1; @endphp
                                        @foreach ($allapplication as $app)
                                        <tr>
                                            <td style="font-size: 14px;">{{$i}}</td>
                                            <td style="font-size: 14px;">{{$app->name}}</td>
                                            <td style="font-size: 14px;">{{$app->cid}}</td>
                                            <td style="font-size: 14px;">{{$app->email}}</td>
                                            <td style="font-size: 14px;">{{$app->mobileno}}</td>
                                            <td style="font-size: 14px;">{{$app->business_name}}</td>
                                            <td style="font-size: 14px;">{{$app->business_location}}</td>
                                            <td style="font-size: 14px;">
                                                {{$app->created_on}}
                                            </td>
                                            <td style="font-size: 14px;">
                                            @if(is_null($app->review_status))
                                            <font color = "orange">Pending</font>
                                            @elseif($app->asd == 0 || $app->dir == 0 || $app->ach == 0)
                                                @if($app->review_status == 1)
                                                <font color = "green">Reviewed</font>
                                                @else
                                                <font color = "red">Rejected</font>
                                                @endif
                                            @else
                                                @if($app->asd == 1 || $app->dir == 1 || $app->ach == 1)
                                                <font color = "green">Approved</font>
                                                @else
                                                <font color = "red">Rejected</font>
                                                @endif
                                            @endif
                                            </td>
                                            <td>
                                                @if(is_null($app->review_status))
                                                <a href="{{route('fundappreview',['id'=>$app->id])}}" style="text-decoration:none">Review</a><br>
                                                @else
                                                @endif
                                            </td>
                                        </tr>
                                        @php
                                            $i++; @endphp
                                        @endforeach
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
<script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<script src="jquery.js"></script>
<script src="jquery_tables.js"></script>
<link href="{{ asset('css/app_tables.css') }}" rel="stylesheet">



