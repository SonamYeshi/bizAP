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
                                    <p><h5>Repayment for <font color = "blue">{{ $name }}</font></h5></p>
                                    <h5>Total Fund Disbursed:&nbsp;<font color="blue"><b> Nu.&nbsp;
                                   <?php
                                   $tfd = App\Models\FundingApplication::where('id', $fundid)->sum('actual_disbursed');
				   echo number_format($tfd); ?></b></font></h5>
                                   <h6>Effective Date:&nbsp;<font color="blue">
                                    <?php
                                    $original_date = $effectivedate;
                                    $timestamp = strtotime($original_date);
                                    echo date("d-m-Y", $timestamp);
                                    ?></font></h6>
				</div>

                            </div>
                                <br>
                            <div class="table-responsive">
                            <a href="{{ route('updatepaymentdhi', array($fundid, $cid, $tfd)) }}" class='bbtn btn-primary btn-sm' style="text-decoration: none; float: left;">New EMI Payment</a>
                            &nbsp;&nbsp;&nbsp;
                            <a href="{{ route('refund', array($fundid, $cid, $tfd)) }}" class='bbtn btn-primary btn-sm' style="text-decoration: none; float: right;">Refund</a>
                            <br /><br />

                                <table id="example" class="table table-bordered table-sm table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Principal</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Administrative fee</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Principal Repayment</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">EMI</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Closing Balance</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Repayment Date</th>
                                            <th style="color: red;" style="color:#0553a1;font-weight: 500;font-size: 15px;">Due Date</th>
                                            <th style="color: red;" style="color:#0553a1;font-weight: 500;font-size: 15px;">Penalty(2%)</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1;
                                         $count = count($allapplication);
                                        foreach ($allapplication as $index => &$app) :
                                        $status = $app->review_status;
                                        ?>
                                           <tr>
                                                    <td style="font-size: 14px;"><?php echo $i; ?></td>
                                                    <td style="font-size: 14px;" style="color: blue;"><?php if($status != '0' and $status != '2') { echo number_format($app->principal, 2); } ?></td>
                                                    <td style="font-size: 14px;"><?php  if($status != '0' and $status != '2') { echo number_format($app->administrative_fee, 2); } ?></td>
                                                    <td style="font-size: 14px;"><?php  if($status != '0' and $status != '2') { echo number_format($app->principal_repayment, 2); } ?></td>
                                                    <td style="font-size: 14px;"><?php  echo number_format($app->emi_amount, 2); ?></td>
                                                    <td style="font-size: 14px;"><?php  if($status != '0' and $status != '2') { echo number_format($app->closing_balance, 2); } ?></td>
                                                    <td style="font-size: 14px;">
                                                        <?php
                                                        $original_date = $app->payment_date;
                                                        $timestamp = strtotime($original_date);
                                                        echo date("d-m-Y", $timestamp);
                                                        ?>
                                                    </td>
                                                    <td style="font-size: 14px;">
                                                    <?php
                                                        $original_date = $app->due_date;
                                                        $timestamp = strtotime($original_date);
                                                        echo date("d-m-Y", $timestamp);
                                                        ?>
                                                    </td>
                                                    <td style="font-size: 14px;">@if($status != '0' and $status != '2'){{ $app->penalty }} @endif</td>
                                                    <td style="font-size: 14px;">
                                                    <?php
                                                     $status = App\Models\Repayments::where('id', $app->id)->value('review_status');
                                                    if($status == '0') { ?>
                                                    <a href="{{ route('viewpaymentdhi', array($app->id, $fundid, $cid)) }}" style="text-decoration:none"><font color='green'>Review</font></a>
                                                    <?php }else
                                                        {
                                                            $status = App\Models\Repayments::where('id', $app->id)->value('review_status');

                                                            if($status == '1')
                                                            { echo "<font color = 'green'>Accepted</font>";}
                                                            if($status == '2')
                                                            { echo "<font color = 'red'>Rejected</font>";}
                                                        } ?>
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

