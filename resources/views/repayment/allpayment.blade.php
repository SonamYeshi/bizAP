<x-app-layout>
    @include('top_nav_bar_applicant')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-5">
                        @include('flash-message')
                        @include('sweetalert::alert')
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <p><h5>Repayment</h5></p>
				    <h5>Total Fund Disbursed:&nbsp;<font color="blue"><b> Nu.&nbsp;<?php echo number_format($tfd); ?></b></font></h5>
                                    <h6>Effective Date:&nbsp;<font color="blue">
                                        <?php //echo $effectivedate;

                                        $original_date = $effectivedate;
                                        $timestamp = strtotime($original_date);
                                        echo date("d-m-Y", $timestamp);
                                        ?>

                                    </font></h6>
                                </div>
                            </div>
                                <br>
                            <div class="table-responsive">
                            <a href="{{ route('updatepayment', array($fundid, $cid, $tfd)) }}" class='bbtn btn-primary btn-sm' style="text-decoration: none; float: left;">New EMI Payment</a>
                             <br /><br />

                             <table id="example" class="table table-sm table-striped">
                            <thead class="thead-light">
                                        <tr>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Principal</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Administrative fee</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Principal Repayment</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">EMI</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Closing Balance</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Due Date</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Repayment Date</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1;
                                         $count = count($allapplication);
                                        foreach ($allapplication as $index => &$app) :
                                        ?>
                                           <tr>
                                                    <td style="font-size: 14px;"><?php echo $i; ?></td>
                                                    <td style="font-size: 14px;"><?php echo number_format($app->principal, 2);?></td>
                                                    <td style="font-size: 14px;"><?php  echo number_format($app->administrative_fee, 2); ?></td>
                                                    <td style="font-size: 14px;"><?php  echo number_format($app->principal_repayment, 2);?></td>
                                                    <td style="font-size: 14px;"><?php  echo number_format($app->emi_amount, 2); ?></td>
                                                    <td style="font-size: 14px;"><?php  echo number_format($app->closing_balance, 2); ?></td>
                                                    <td style="font-size: 14px;">{{ $app->due_date }}</td>
                                                    <td style="font-size: 14px;">{{ $app->payment_date }}</td>

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
