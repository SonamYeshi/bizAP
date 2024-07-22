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
                                    <h5>Approved Business Applications</h5>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row height d-flex justify-content-center align-items-center">
                                    <div class="col-md-8">
                                        <div class="search"> <i class="fa fa-search"></i>
                                        <form class="row g-3" role="form" method="POST" action="{{ route('cidsearch') }}" enctype="multipart/form-data">
                                         {{ csrf_field() }}
                                        <input type="number" name="cid" class="form-control" placeholder="Enter CID" required>
                                         <button class="btn btn-info" type="submit" id="save">Search</button>
                                        </form>
                                         </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div id="loading" style="text-align: center;"></div>
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered table-sm table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Sl.No</th>
                                            <th>Entrepreneur Name</th>
                                            <th>CID</th>
                                            <th>Business Name</th>
                                            <th>Mobile No.</th>
                                            <th>Disbursed Fund</th>
                                            <th>No. of Installments Paid</th>
                                            <th>No. of Defaults</th>
                                            <th style='width:20%'>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if($count != '0'){
                                        $i = 1;
                                        foreach ($allapplication as $app) :
                                            $dcount = count(App\Models\DelayCount::where('cid', $app->cid)->where('active', '0')->get());
                                        ?>
                                            <tr <?php if($dcount == '0') { } else { ?>
                                               style="background-color: #E84933;"
                                            <?php } ?>>
                                                <td><?php echo $i; ?></td>
                                                <td>{{ $app->name }}</td>
                                                <td>{{ $app->cid }}</td>
                                                <td>{{ $app->business_name}}</td>
                                                <td>{{ $app->mobileno}}</td>
                                                <td><?php echo number_format($app->totaldisbursed); ?></td>
                                                <td align="center"><font color="green"><b>
                                                    <?php echo count(App\Models\Repayments::where('cid', $app->cid)->get()); ?></b>
                                                    </font>
                                                </td>
                                                <td><?php echo $dcount; ?></td>
                                                <td>
                                                    <a href="{{route('allrepaymentdhi', array($app->fundid, $app->cid, $app->totaldisbursed))}}" style="text-decoration:none">Payment</a><br>
                                                </td>
                                            </tr>
                                        <?php
                                            $i++;
                                        endforeach;
                                    }
                                    else
                                    { ?>
                                    <tr>
                                        <td colspan="7" align="center"><font Color="red">No Result Found !. Try again</font></td>
                                    </tr>
                                    <?php } ?>

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
        $("#successMessage").delay(2500).slideUp(300);
    });
</script>
<script type="text/javascript">
    $('#save').click(function() {
        $('#loading').html('<center><img src="{{ asset("/loading_gif/search.gif") }}" height="100" width="100" a></center>');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "https://api.github.com/users/jveldboom",
            success: function(d) {
                setTimeout(function() {
                    $('#loading');
                }, 2000);
            }
        });
    });
</script>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:weight@100;200;300;400;500;600;700;800&display=swap");

body {
    background-color: #eee;
    font-family: "Poppins", sans-serif;
    font-weight: 300
}

.search {
    position: relative;
    box-shadow: 0 0 40px rgba(51, 51, 51, .1)
}

.search input {
    height: 60px;
    text-indent: 25px;
    border: 2px solid #d6d4d4
}

.search input:focus {
    box-shadow: none;
    border: 2px solid blue
}

.search .fa-search {
    position: absolute;
    top: 40px;
    left: 16px
}

.search button {
    position: absolute;
    top: 5px;
    right: 5px;
    height: 50px;
    width: 110px;
    background: green
}
</style>
