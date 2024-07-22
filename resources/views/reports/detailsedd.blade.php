<x-app-layout>
    @include('top_nav_bar_edd')
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-1 lg:px-">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-5">
                            @include('flash-message')
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="row">
                                        <?php
                                        foreach ($allapplication as $app) :  ?>
                                            <div class="col-md-4">
                                                <table border = '1' width="100%">
                                                    <tr>
                                                        <td width="30%">
                                                            <div class="form-group"> <label style="float: left;"><b>COHORT/OPEN: </b></label>
                                                                <?php $opencohort = App\Models\Funding::where('id', $app->fid)->value('opencohort');
                                                                $opencohortno = App\Models\Funding::where('id', $app->fid)->value('opencohortno');
                                                                ?>
                                                            </div>
                                                        </td>
                                                        <td align="left" width="30%">
                                                        @if($opencohort == '1') COHORT @else OPEN @endif {{ $opencohortno }}
                                                        </td>
                                                        <td width="40%" rowspan="3">
                                                        <?php $docs = App\Models\DhiFundingApplicationDocs::where('appid', $fundid)->where('filecat', 'photo')->get();
                                                        $dcount = count(App\Models\DhiFundingApplicationDocs::where('appid', $fundid)->where('filecat', 'photo')->get()); ?>
                                                        @if($dcount == 0)
                                                        <img style="border:2px solid black;" src="" width="140" height="120" alt="No Photo" />
                                                           @else
                                                         <?php $did = 1; ?>
                                                        @foreach($docs as $d)
                                                        <?php $filename = $d->file_name; ?>
                                                        <img src="{{ url('/uploads/dhifundingapplicationdocs/'.$filename) }}" alt="" height=120 width=140 style="bacground"></img>
                                                         @endforeach
                                                        @endif

                                                     </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%">
                                                            <div class="form-group"> <label style="float: left;"><b>Enterpreneur Name: </b></label>
                                                            </div>
                                                        </td>
                                                        <td align="left" width="30%">
                                                        <left>{{ $app->name }}</left>
                                                        </td>

                                                        </tr>
                                                    <tr>
                                                        <td width="30%">
                                                            <div class="form-group"> <label style="float: left;"><b>Enterpreneur CID: </b></label>
                                                            </div>
                                                        </td>
                                                        <td align="left" width="30%">
                                                        <left>{{ $app->cid }}</left>
                                                        </td>
                                                        </tr>
                                                    <tr>
                                                        <td width="30%">
                                                            <div class="form-group"> <label style="float: left;"><b>Business Name: </b></label>
                                                             </div>
                                                        </td>
                                                        <td align="left" width="30%">
                                                        <left>{{ $app->business_name }}</left>
                                                        </td>
                                                        </tr>
                                                    <tr>
                                                        <td width="30%">
                                                            <div class="form-group"> <label style="float: left;"><b>Amount Sanctioned: </b></label>
                                                              </div>
                                                        </td>
                                                        <td align="left" width="30%">Nu.
                                                        <left><?php echo number_format($app->totaldisbursed); ?></left>
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                        <td width="30%">
                                                            <div class="form-group"> <label style="float: left;"><b>Balance: </b></label>
                                                               </div>
                                                            </td>
                                                            <td align="left" width="30%">
                                                        <left>Nu.
                                                        <?php $totalemi = App\Models\Repayments::where('cid', $app->cid)->sum('emi_amount');
                                                              echo number_format($app->totaldisbursed - $totalemi);
                                                        ?>
                                                        </left>
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                        <td width="30%">
                                                            <div class="form-group"> <label style="float: left;"><b>Status: </b></label>
                                                            </div>
                                                        </td>
                                                        <td align="left" width="30%">
                                                        <b><left style="color: green;">ACTIVE</left></b>
                                                        </td>

                                                    </tr>
                                                </table>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <br />

                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered table-sm table-striped table-danger">
                                    <thead>
                                        <tr>
                                            <th>Amount Disbursed</th>
                                            <th>Amount Refunded</th>
                                            <th>Amount Repaid</th>
                                            <th>Outstanding</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                         ?>
                                                <tr class="table-primary">
                                                    <td><?php echo number_format($totaldisbursed); ?></td>
                                                    <td>{{ $totalrefund }}</td>
                                                    <td>{{ $totalrepayment}}</td>
                                                    <td>
                                                        <?php
                                                        $toatlpaid = ($totalrefund + $totalrepayment);
                                                        echo number_format($totaldisbursed - $toatlpaid);
                                                        ?>
                                                    </td>
                                                </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div style="text-align: left;"><b><font color = 'blue'>Disbursement History</font></b></div>
                            <br>
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered table-sm table-striped table-danger">
                                    <thead>
                                        <tr>
                                            <th>Sl.No.</th>
                                            <th>Request Date</th>
                                            <th>Request Amount</th>
                                            <th>Invoice No.</th>
                                            <th>Approval Date</th>
                                            <th>Disbursement Date</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($count != '0') {
                                            $i = 1;
                                            foreach ($disbursement as $db) :  ?>
                                                <tr class="table-primary">
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo App\Models\FundRequest::where('fundid', $db->id)->value('created_on'); ?></td>
                                                    <td><?php $rqid =  App\Models\FundRequest::where('fundid', $db->id)->value('id');
                                                              echo number_format(App\Models\FundRequestStatus::where('fundrequestid', $rqid)->value('approvedfund'));
                                                    ?></td>
                                                    <td>{{ $db->business_description }}</td>

                                                    <td><?php echo App\Models\FundRequest::where('fundid', $db->id)->value('approval_date'); ?></td>
                                                    <td><?php echo App\Models\FundRequest::where('fundid', $db->id)->value('disbursement_date'); ?></td>

                                                </tr>
                                            <?php $i++;
                                            endforeach;
                                        } else { ?>
                                            <tr>
                                                <td colspan="9" align="center">
                                                    <font Color="red">No Result Found !. Try again</font>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <div style="text-align: left;"><b><font color = 'blue'>Repayment History</font></b></div>
                            <br>
                            <div class="table-responsive">
                            <table id="example" class="table table-bordered table-sm table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Sl.No</th>
                                            <th style="color: blue;">Principal</th>
                                            <th>Administrative fee</th>
                                            <th>Principal Repayment</th>
                                            <th>EMI</th>
                                            <th>Closing Balance</th>
                                            <th style="color: red;">Due Date</th>
                                            <th>Repayment Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1;
                                         $count = count($repayment);
                                        foreach ($repayment as $index => &$app) :
                                        ?>
                                           <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td style="color: blue;"><?php echo number_format($app->principal, 2);?></td>
                                                    <td><?php  echo number_format($app->administrative_fee, 2); ?></td>
                                                    <td><?php  echo number_format($app->principal_repayment, 2);?></td>
                                                    <td><?php  echo number_format($app->emi_amount, 2); ?></td>
                                                    <td><?php  echo number_format($app->closing_balance, 2); ?></td>
                                                    <td>{{ $app->due_date }}</td>
                                                    <td>{{ $app->payment_date }}</td>
                                            </tr>
                                        <?php
                                            $i++;
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <div style="text-align: left;"><b><font color = 'blue'>Payment Defaults</font></b></div>
                            <br>
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered table-sm table-striped table-danger">
                                    <thead>
                                        <tr>
                                            <th>Sl.No.</th>
                                            <th>Month</th>
                                            <th>Due Date</th>
                                            <th>EMI Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                       foreach ($defaults as $df) :     ?>
                                        <tr class="table-primary">
                                        <td><?php echo $i; ?></td>
                                        <td><?php
                                        $date = strtotime($df->duedate);
                                        echo $month = date('M-Y', $date);?></td>
                                        <td><?php echo $df->duedate;?></td>
                                        <td><?php echo $df->emi;?></td>
                                        </tr>
                                        <?php $i++; endforeach; ?>
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
