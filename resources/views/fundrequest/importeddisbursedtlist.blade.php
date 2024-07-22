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
                                    <h5>Imported Disbursed List</h5>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="example" class="table table-bordered table-sm table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Sl.No</th>
                                            <th>CID of Applicant</th>
                                            <th>Name</th>
                                            <th>Mobile No.</th>
                                            <th>Name of Business</th>
                                            <th>Approved Fund</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($allapplication as $app) :  ?>
                                                <tr>
                                                <td><?php echo $i; ?></td>
                                                    <td>{{ $app->cid }}</td>
                                                    <td>{{ $app->name }}</td>
                                                    <td>{{ $app->mobileno }}</td>
                                                    <td>{{ $app->business_name }}</td>
                                                    <td>{{ $app->total_disbursed }}</td>
                                                    <td>
                                                      <font color="red">Disbursed On:&nbsp;{{ $app->disbursed_date }} </font>
                                                    </td>
                                                    </tr>
                                        <?php
                                            $i++;
                                        endforeach;

                                        ?>
                                        <tr>
                                            <td colspan="8">
                                            <a href="{{ route('saveimportdisburse')}}" class='bbtn btn-primary btn-sm' style="text-decoration: none; float: right;">Save</a>
                                            </td>
                                        </tr>

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

