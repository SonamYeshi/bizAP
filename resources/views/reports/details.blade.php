<x-app-layout>
    @include('top_nav_bar')
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-1 lg:px-">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-5">
                            @include('flash-message')
			    <div class="row">

                            <a  href="{{ url()->previous() }}">
                                 <button type="button" class="btn btn-warning" data-dismiss="modal" style="float: right;">Back</button>
			     </a>


                                    <div class="row">
                                        <?php
                                        foreach ($allapplication as $app) :  ?>
                                            <div class="col-md-4">

                                            <table style="table-layout: fixed; width:700px;">
                                                       <tr>
                                                        <td>
                                                            <div class="form-group"> <label style="float: left;"><b>COHORT/OPEN: </b></label>
                                                                <?php $opencohort = App\Models\Funding::where('id', $app->fid)->value('opencohort');
                                                                $opencohortno = App\Models\Funding::where('id', $app->fid)->value('opencohortno');
                                                                ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                        @if($opencohort == '1') COHORT @else OPEN @endif {{ $opencohortno }}
                                                        </td>

                                                        <td rowspan="3">
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
                                                        <td>
                                                            <div class="form-group"> <label style="float:left;"><b>Name: </b></label>
                                                            </div>
                                                        </td>
                                                        <td style="width: 100%;">
                                                        <left>{{ $app->name }}</left>
                                                        </td>

                                                        </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group"> <label style="float: left;"><b>CID: </b></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                        <left>{{ $app->cid }}</left>
                                                        </td>
                                                        </tr>
                                                    <tr>
                                                    <tr>
                                                        <td width="30%">
                                                            <div class="form-group"> <label style="float: left;"><b>Mobile: </b></label>
                                                            </div>
                                                        </td>
                                                        <td colspan="2">
                                                        <left>{{ $app->mobileno }}</left>
                                                        </td>
                                                        </tr>
                                                    <tr>
                                                    <tr>
                                                        <td width="30%">
                                                            <div class="form-group"> <label style="float: left;"><b>Email: </b></label>
                                                            </div>
                                                        </td>
                                                        <td colspan="2">
                                                        <left>{{ $app->email }}</left>
                                                        </td>
                                                        </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group"> <label style="float: left;"><b>Business Name: </b></label>
                                                             </div>
                                                        </td>
                                                        <td width="100%" colspan="2">
                                                        <left>{{ $app->business_name }}</left>
                                                        </td>
                                                        </tr>
                                                    <tr>
                                                    <td style="width: 100%;">
                                                            <div class="form-group"> <label style="float: left;"><b>Amount Sanctioned: </b></label>
                                                             </div>
                                                        </td>
                                                        <td colspan="2">Nu.
                                                        <left><?php echo number_format($totaldisbursed); ?></left>
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                        <td>
                                                            <div class="form-group"> <label style="float: left;"><b>Balance: </b></label>
                                                               </div>
                                                            </td>
                                                            <td colspan="2">
                                                        <left>Nu.
                                                        <?php $totalemi = App\Models\Repayments::where('cid', $app->cid)->sum('emi_amount');
                                                              echo number_format($totaldisbursed - $totalemi);
                                                        ?>
                                                        </left>
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                        <td>
                                                            <div class="form-group"> <label style="float: left;"><b>Status: </b></label>
                                                            </div>
                                                        </td>
                                                        <td colspan="2">
                                                        <b><left style="color: green;">ACTIVE</left></b>
                                                        </td>

                                                    </tr>
                                                </table>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <br />


                            </div>
                            <div class="table-responsive">
                            <table id="example" class="table table-bordered table-sm table-striped">
                                <thead class="thead-light">
                                        <tr>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Amount Disbursed</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Amount Refunded</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Amount Repaid</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Outstanding</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                         ?>
                                                <tr class="table-primary">
                                                    <td style="font-size: 14px; text-align: right;"><?php echo number_format($totaldisbursed); ?></td>
                                                    <td style="font-size: 14px; text-align: right;">{{ $totalrefund }}</td>
                                                    <td style="font-size: 14px; text-align: right;">{{ $totalrepayment}}</td>
                                                    <td style="font-size: 14px; text-align: right;">
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
                            <table id="example" class="table table-bordered table-sm table-striped">
                                <thead class="thead-light">
                                        <tr>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Request Date</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Request Amount</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Invoice/Bill</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Approval Date</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Disbursement Date</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($count != '0') {
                                            $i = 1;
                                            foreach ($disbursement as $db) :  ?>
                                                <tr class="table-primary">
                                                    <td style="font-size: 14px;"><?php echo $i; ?></td>
                                                    <td style="font-size: 14px;"><?php echo App\Models\FundRequest::where('fundid', $db->id)->value('created_on'); ?></td>
                                                    <td style="font-size: 14px;"><?php $rqid =  App\Models\FundRequest::where('fundid', $db->id)->value('id');
                                                              echo number_format(App\Models\FundRequestStatus::where('fundrequestid', $rqid)->value('approvedfund'));
                                                    ?></td>
						    <td>
                                                   <?php $filename = App\Models\FundRequest::where('id', $rqid)->value('proof'); ?>
                                                  @if($filename != '')
                                                   <a href="{{ url('/uploads/proof/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $filename; ?></a>
                                                     @else
                                                    No Document
                                                    @endif
                                                    </td>

                                                    <td style="font-size: 14px;"><?php echo App\Models\FundRequest::where('fundid', $db->id)->value('approval_date'); ?></td>
                                                    <td style="font-size: 14px;"><?php echo App\Models\FundRequest::where('fundid', $db->id)->value('disbursement_date'); ?></td>

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
                                         $count = count($repayment);
                                        foreach ($repayment as $index => &$app) :
                                        ?>
                                           <tr>
                                                    <td style="font-size: 14px; text-align: right;"><?php echo $i; ?></td>
                                                    <td style="font-size: 14px; text-align: right;"><?php echo number_format($app->principal, 2);?></td>
                                                    <td style="font-size: 14px; text-align: right;"><?php  echo number_format($app->administrative_fee, 2); ?></td>
                                                    <td style="font-size: 14px; text-align: right;"><?php  echo number_format($app->principal_repayment, 2);?></td>
                                                    <td style="font-size: 14px; text-align: right;"><?php  echo number_format($app->emi_amount, 2); ?></td>
                                                    <td style="font-size: 14px; text-align: right;"><?php  echo number_format($app->closing_balance, 2); ?></td>
                                                    <td style="font-size: 14px; text-align: right;">{{ $app->due_date }}</td>
                                                    <td style="font-size: 14px; text-align: right;">{{ $app->payment_date }}</td>
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
                            <table id="example" class="table table-bordered table-sm table-striped">
                                <thead class="thead-light">
                                        <tr>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Month</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Due Date</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">EMI Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                       foreach ($defaults as $df) :     ?>
                                        <tr class="table-primary">
                                        <td style="font-size: 14px;"><?php echo $i; ?></td>
                                        <td style="font-size: 14px;"><?php
                                        $date = strtotime($df->duedate);
                                        echo $month = date('M-Y', $date);?></td>
                                        <td style="font-size: 14px;"><?php echo $df->duedate;?></td>
                                        <td style="font-size: 14px;"><?php echo $df->emi;?></td>
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



