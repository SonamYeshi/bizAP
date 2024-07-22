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
                                    <h5>Disbursement List</h5>
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
                                            <th>Due Date</th>
                                            <th>Repayment Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($allapplication as $app) :  ?>
                                                <tr>
                                                <td><?php echo $i; ?></td>
                                                    <td><?php echo $app->cid; ?></td>
                                                    <td><?php echo App\Models\FundingApplication::where('cid', $app->cid)->value('name'); ?></td>
                                                    <td><?php echo App\Models\FundingApplication::where('cid', $app->cid)->value('mobileno'); ?></td>
                                                    <td><?php echo App\Models\FundingApplication::where('cid', $app->cid)->value('business_name'); ?></td>
                                                    <td><?php echo $app->duedate; ?></td>
                                                    <td><?php echo $app->paymentdate; ?></td>
                                                    </tr>
                                        <?php
                                            $i++;
                                        endforeach;

                                        ?>

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

