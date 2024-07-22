<x-app-layout>
    @include('top_nav_bar_applicant')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-5">
                        @include('flash-message')
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h5>Repayment</h5>
                                </div>
                            </div>

                            <div class="table-responsive">
                            <table id="example" class="table table-sm table-striped">
                            <thead class="thead-light">
                                        <tr>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Group</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Business</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Location</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Fund Disbursement Date</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($allapplication as $app) :
                                        ?>
                                                <tr>
                                                    <td style="font-size: 14px;"><?php echo $i; ?></td>
                                                    <td style="font-size: 14px;"><?php echo App\Models\FundingApplication::where('id', $app->fundappid)->value('cohortopen'); ?>&nbsp;
                                                    <?php echo App\Models\FundingApplication::where('id', $app->fundappid)->value('cohortopenno'); ?>
                                                     </td>
                                                    <td style="font-size: 14px;"><?php echo App\Models\FundingApplication::where('id', $app->fundappid)->value('business_name'); ?></td>
                                                    <td style="font-size: 14px;"><?php echo App\Models\FundingApplication::where('id', $app->fundappid)->value('business_location'); ?></td>
                                                    <td style="font-size: 14px;"><?php  $fdate = App\Models\FundingApplication::where('id', $app->fundappid)->value('disbursed_date');
                                                    $original_date = $fdate;
                                                    $timestamp = strtotime($original_date);
                                                    echo date("d-m-Y", $timestamp);
                                                    ?></td>
                                                    <td style="font-size: 14px;">
                                                        <?php
                                                        $cid = App\Models\FundingApplication::where('id', $app->fundappid)->value('cid');
                                                        $db = App\Models\FundingApplication::where('id', $app->fundappid)->value('actual_disbursed');

                                                        ?>
                                                    <a href="{{route('allrepayment', array($app->fundappid, $cid, $db))}}" style="text-decoration:none">Proceed Repayment</a>

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
</x-app-layout>

