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
                                    <h5>Completion</h5>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                    <div class="row">
                                        <form class="row g-3" role="form" method="POST" action="{{ route('completionsearch') }}" enctype="multipart/form-data">
                                          {{ csrf_field() }}
                                            <div class="col-md-4">
                                                <div class="form-group"> <label style="float: left;"><b>Filter By</b></label>
                                                    <select id="save" name="key" class="form-control" onchange="this.form.submit();">
                                                    <option value="" selected disabled>-- Select --</option>
                                                    
                                                    @foreach($training as $t)
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
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Group</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">CID</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Name</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Email</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Mobile No.</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Gender</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Total Score</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Post Training Activity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1; @endphp
                                        @foreach ($allapplication as $app)
                                            @php 
                                            $pstatus = App\Models\PosttrainingStatus::where('appID', $app->id)->value('status');
                                            @endphp
                                            
                                            <tr>
                                                <td style="font-size: 14px;">{{$i}}</td>
                                                <td style="font-size: 14px;">{{$app->opencohort}} {{$app->opencohortno}}</td>
                                                <td style="font-size: 14px;"><a href="{{ route('ranking_details', array($app->id)) }}">{{$app->cid}}</a></td>
                                                <td style="font-size: 14px;">{{$app->name}}</td>
                                                <td style="font-size: 14px;">{{$app->email}}</td>
                                                <td style="font-size: 14px;">{{$app->mobileno}}</td>
                                                <td style="font-size: 14px;">{{$app->sex}}</td>
                                                <td style="font-size: 14px; text-align: right;"><font color="blue">
                                                {{$app->avg_score}}
                                                </font>
                                                </td>
                                                <td>
                                                @if(is_null($pstatus))
                                                <form id='myform' action="{{ route('posttraining_update') }}" method="post">
                                                {{ csrf_field() }}
                                                    <!-- <input type="hidden" name="key" value=""> -->
                                                    <input type="hidden" name="rowss[steps][1][]" value="{{$app->id}}">
                                                   
                                                    <select id="status" class="form-control input-sm" name="rowss[steps][2][]" onchange="this.form.submit();">
                                                        <option value="">Select</option>
                                                        <option value="Internship">Internship</option>
                                                        <option value="Self Employed">Self Employed</option>
                                                        <option value="After Care Program">After Care Program</option>
                                                        <option value="Withdrawn">Withdrawn</option>
                                                    </select>
                                                </form>
                                                @else
                                                <font color="green">
                                                {{$pstatus}}
                                                </font>

                                                @endif
                                                </td>
                                            </tr>
                                        @php $i++; @endphp
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

