<x-app-layout>
    @include('top_nav_bar_edd')
    <div class="py-2">
        <div class="max-w-12xl mx-auto sm:px-1 lg:px-">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            @include('flash-message')

                            <div class="table-responsive">
                                <table id="example" class="table table-sm table-striped table-light">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th style="white-space:nowrap">Ent.Name</th>
                                            <th style="white-space:nowrap">CID</th>
                                            <th style="white-space:nowrap">Business Name</th>
                                            <th style="white-space:nowrap">Mobile No.</th>
                                            <th style="white-space:nowrap">Fund Sanctioned</th>
                                            <th style="white-space:nowrap">Fund Disbursed</th>
                                            <th style="white-space:nowrap">Fund Refunded</th>
                                            <th style="white-space:nowrap">Fund Repaid</th>
                                            <th style="white-space:nowrap">Installment Defaulted</th>
                                            <th style="white-space:nowrap">Penalty Paid</th>
                                            <th style="white-space:nowrap">Outstanding</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($allapplication as $app) :  ?>
                                            <tr class="table-primary">
                                                <td><?php echo $i; ?></td>
                                                <td><a href="{{route('repaydetailsedd',['id'=>$app->fundid])}}" style="text-decoration: none;"><?php echo $app->name; ?></a></td>
                                                <td><?php echo $app->cid; ?></td>
                                                <td><?php echo $app->business_name; ?></td>
                                                <td><?php echo $app->mobileno;?></td>
                                                <td><?php echo number_format($app->totaldisbursed);?></td>
                                                <td><?php echo number_format($app->actual_disbursed); ?></td>
                                                <td>
                                                <?php echo number_format(App\Models\Repayments::where('emi_refund', '1')->where('cid', $app->cid)->sum('emi_amount'));?>
                                                </td>
                                                <td><?php echo number_format(App\Models\Repayments::where('emi_refund', '0')->where('cid', $app->cid)->sum('emi_amount'));?></td>
                                                <td>
                                                <?php echo number_format(count(App\Models\PaymentDefaults::where('cid', $app->cid)->get()));?>
                                                </td>
                                                <td>
                                                <?php echo number_format(App\Models\Repayments::where('cid', $app->cid)->sum('penalty'));?>
                                                </td>
                                                <td>
                                                <?php
                                                    $totalrefund = App\Models\Repayments::where('emi_refund', '1')->where('cid', $app->cid)->sum('emi_amount');
                                                    $totalrepayment = App\Models\Repayments::where('emi_refund', '0')->where('cid', $app->cid)->sum('emi_amount');
                                                    $penalty = App\Models\Repayments::where('cid', $app->cid)->sum('penalty');
                                                    $totaldisbursed = $app->actual_disbursed;
                                                    $toatlpaid = ($totalrefund + $totalrepayment + $penalty);
                                                    echo number_format($totaldisbursed - $toatlpaid);
                                                        ?>
                                                </td>
                                            </tr>
                                        <?php $i++;
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
