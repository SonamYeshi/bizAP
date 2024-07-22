<x-app-layout>
    @include('top_nav_bar')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                    <nav class="navbar navbar-light bg-light">
                    <strong>Presentation Scores</strong>
                    </nav>
                    <form class="row g-3" role="form" method="POST" action="{{ route('interviewupdate') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="appid" value="<?php echo $appid; ?>">
                            <input type="hidden" name="fundid" value="<?php echo $fundid; ?>">
                            <div class="form-group col-md-10">
                                <label for="name" class="form-label"><strong>Screening Status:&nbsp;</strong></label>
                                <?php if ($sstatus == '1') { ?><b><font color = 'green'>Accepted</font></b> <?php } ?> &nbsp;&nbsp;{{$ssdate}}
                            </div>
                            <br>
                            <div class="form-group col-md-10">
                                <label for="name" class="form-label"><strong>Shortlist Status:&nbsp;</strong></label>
                                <?php if ($slstatus == '1') { ?><b><font color = 'green'>Accepted</font></b> <?php } ?> &nbsp;&nbsp;{{$sldate}}
                            </div>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered table-sm table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Sl.No</th>
                                            <th>Panel Member</th>
                                            <th>Designation</th>
                                            <th>Role</th>
                                            <th>Score</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($pannels as $pl) : ?>
                                            <tr>
                                                <td><?php echo $i; ?>
                                                <input type="hidden" name="rowss[steps][3][]" value="<?php echo $pl->id; ?>">
                                                </td>
                                                <td><?php echo $pl->name; ?></td>
                                                <td><?php echo $pl->designation; ?></td>
                                                <td><?php echo App\Models\Panelrole::where('id', $pl->role)->value('rolename');?></td>
                                                <td>
                                                 <?php
                                                 echo App\Models\PresentationStatus::where('appID', $appid)->where('pannelID', $pl->id)->value('score');
                                                 ?>
                                                </td>
                                                <td>
                                                <?php
                                                 echo App\Models\PresentationStatus::where('appID', $appid)->where('pannelID', $pl->id)->value('remarks');
                                                 ?>
                                                </td>

                                            </tr>
                                        <?php $i++; endforeach; ?>
                                        <tr>
                                            <td colspan="4">Average Score</td>
                                            <td><b>
                                            <?php
                                                        $sum = 0;
                                                        $count = 0;
                                                        $scores = App\Models\PresentationStatus::where('appID', $appid)->get();
                                                        foreach ($scores as $sc) :
                                                            $sum = $sum + $sc->score;
                                                            $count++;
                                                        endforeach;
                                                        echo $average = round($sum / $count, 2);
                                                        ?>
                                            </b></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <br>
                    <div class="row">
                    <p class="text-end"><a href="{{route('fapp_pdf',$appid)}}" style="text-decoration:none"><i class="fas fa-file-pdf"></i> Download PDF </a></p>
                            <div class="form-group col-md-12">
                                <label for="cid" class="form-label"><strong>Fund Applied for:&nbsp;
                                <?php $fid =  App\Models\FundingApplication::where('id', $appid)->value('fundid');
                                echo App\Models\Funding::where('id', $fid)->value('title');
                                ?></strong></label>
                            </div>
                         <hr>
                        <?php foreach ($application as $app) : ?>
                            <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"> <label for="form_message"><strong> Personal Information </strong></label></div>
                            </div>
                            <p></p>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name"><strong>CID:&nbsp;</strong></label>{{$app->cid}}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name"><strong>Mr / Mrs / Ms:&nbsp;</strong></label>{{$app->initial}}
                                    </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name"><strong>Name:&nbsp;</strong></label>{{$app->name}}
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name"><strong>Date of Birth:&nbsp;</strong></label>{{$app->dob}}
                                    </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name"><strong>Mobile No:&nbsp;</strong></label>{{$app->mobileno}}
                                    </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name"><strong>EMail:&nbsp;</strong></label>{{$app->email}}
                                     </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Current Address:&nbsp;</strong></label>{{$app->current_address}}
                                    </div>
                            </div>
                        </div>
                         <p></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"> <label for="form_message"><strong>Primary Source of Income </strong></label></div>
                            </div>
                            <?php $Source = explode(',', $app->source_of_income); ?>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Employment</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="1" <?php foreach ($Source as $rslt1) : if ($rslt1 == '1') { ?> checked <?php } endforeach; ?> >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Private Business</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="2" <?php foreach ($Source as $rslt2) : if ($rslt2 == '2') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Others</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="3" <?php foreach ($Source as $rslt3) : if ($rslt3 == '3') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message">Please Specify if Others:&nbsp;</label>{{$app->source_of_income_others}}
                                    </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name"><strong>Name of Business:&nbsp;</strong></label>{{$app->business_name}}
                                   </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name"><strong>Business Location:&nbsp;</strong></label>{{$app->business_location}}
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Description of business (maximum of 250 words)</strong></label>
                                    <textarea id="form_message" class="form-control" rows="4" disabled>{{$app->business_description}}</textarea>
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Select the sector that your business currently operating</strong></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <?php $sector = explode(',', $app->business_sector); ?>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Agriculture and Forestry</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="1" <?php foreach ($sector as $rslt1) : if ($rslt1 == '1') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Consctruction and Real Estate</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="2" <?php foreach ($sector as $rslt2) : if ($rslt2 == '2') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Consumer packaged goods</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="3" <?php foreach ($sector as $rslt3) : if ($rslt3 == '3') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Dairy and / or cooperatives</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="4" <?php foreach ($sector as $rslt4) : if ($rslt4 == '4') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Education</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="5" <?php foreach ($sector as $rslt5) : if ($rslt5 == '5') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Environmental Services</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="6" <?php foreach ($sector as $rslt6) : if ($rslt6 == '6') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Financial Services</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="7" <?php foreach ($sector as $rslt7) : if ($rslt7 == '7') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Food and culinary</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="8" <?php foreach ($sector as $rslt8) : if ($rslt8 == '8') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Health</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="9" <?php foreach ($sector as $rslt9) : if ($rslt9 == '9') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Information Technology</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="10" <?php foreach ($sector as $rslt10) : if ($rslt10 == '10') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Paper / Packaging</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="11" <?php foreach ($sector as $rslt11) : if ($rslt11 == '11') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Transportation</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="12" <?php foreach ($sector as $rslt12) : if ($rslt12 == '12') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Textiles</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="13" <?php foreach ($sector as $rslt13) : if ($rslt13 == '13') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Tourism</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="14" <?php foreach ($sector as $rslt14) : if ($rslt14 == '14') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Waste Management and Sanitation</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="15" <?php foreach ($sector as $rslt15) : if ($rslt15 == '15') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Others</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="16" <?php foreach ($sector as $rslt16) : if ($rslt16 == '16') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Please Specify if Others:&nbsp;</label>{{$app->business_sector_others}}
                                  </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Explain the specific problem or opportunity your business was created to address (Maximum of 250 words)</strong></label>
                                    <textarea id="form_message" class="form-control" rows="4" required="required" disabled>{{$app->business_to_address}}</textarea>
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>What stage is your business activity / service in?</strong></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <?php $activity = explode(',', $app->business_activity); ?>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Research</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="1" <?php foreach ($activity as $rslt1) : if ($rslt1 == '1') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Proven Concept</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="2" <?php foreach ($activity as $rslt2) : if ($rslt2 == '2') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Initial prototype / early market testing</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="3" <?php foreach ($activity as $rslt3) : if ($rslt3 == '3') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Advanced prototype / Obtained market testing results</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="4" <?php foreach ($activity as $rslt4) : if ($rslt4 == '4') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Testing and certification completed for commercial use</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="5" <?php foreach ($activity as $rslt5) : if ($rslt5 == '5') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Being sold in the market</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="6" <?php foreach ($activity as $rslt6) : if ($rslt6 == '6') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>What is the status of your business? (You can select more than One)</strong></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <?php $status = explode(',', $app->business_status); ?>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Already in the market (obtained business license)</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="1" <?php foreach ($status as $rslt1) : if ($rslt1 == '1') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Expect to commercially launch in the next 6 months</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="2" <?php foreach ($status as $rslt2) : if ($rslt2 == '2') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Expect to commercially launch in 7-12 Months</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="3" <?php foreach ($status as $rslt3) : if ($rslt3 == '3') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Expect to commercially launch more than 12 months</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="4" <?php foreach ($status as $rslt4) : if ($rslt4 == '4') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Not Yet Decided</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="5" <?php foreach ($status as $rslt5) : if ($rslt5 == '5') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Additional Information about your business</strong></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">What is your revenue for the last three months (in Ngulturm)?</label>
                                    <input id="form_name" type="number" disabled class="form-control" value="<?php echo $app->revenue; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Who is your current customer target segment?</label>
                                    <input id="form_name" type="text" disabled class="form-control" value="<?php echo $app->customer_target; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Number of current customers</label>
                                    <input id="form_name" type="number" disabled class="form-control" value="<?php echo $app->no_of_current_customer; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">When did you start your company (specify date)?</label>
                                    <input id="form_name" type="date" disabled class="form-control" value="<?php echo $app->company_start_date; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">How much money have you already invested in your business so far?</label>
                                    <input id="form_name" type="number" disabled class="form-control" value="<?php echo $app->money_invested; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">How did you raise finance for your business?</label>
                                    <input id="form_name" type="text" disabled class="form-control" value="<?php echo $app->raise_finance; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">How many employees have you hired?</label>
                                    <input id="form_name" type="number" disabled class="form-control" value="<?php echo $app->employees_hired; ?>">
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Who is on your team? (You can select more than one)</strong></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <?php $team = explode(',', $app->team); ?>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Accountant</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="1" <?php foreach ($team as $rslt1) : if ($rslt1 == '1') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Marketing and sales expert</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="2" <?php foreach ($team as $rslt2) : if ($rslt2 == '2') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Technical Expert</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="3" <?php foreach ($team as $rslt3) : if ($rslt3 == '3') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Others</label>
                                    <input id="form_name" type="checkbox" disabled class="form-check-input" value="4" <?php foreach ($team as $rslt4) : if ($rslt4 == '4') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Please Specify if Others:&nbsp;</label>{{$app->team_others}}
                                    </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>What is the biggest challenge you are currently facing to the successful commercialization of your business? (Maximum of

                                            150 words)</strong></label>
                                    <textarea id="form_message" name="biggest_challenge" class="form-control" rows="4" disabled>{{$app->biggest_challenge}}</textarea>
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>What specific resources do you require in ordr to expand / grow your business? (Maximum 150 words)</strong></label>
                                    <textarea id="form_message" name="specific_resources" class="form-control" rows="4" disabled>{{$app->specific_resources}}</textarea>
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Is there anything else you would like us to know about your business opportunity? (Maximum 150 words)</strong></label>
                                    <textarea id="form_message" name="business_opportunity" class="form-control" rows="4" disabled >{{$app->business_opportunity}}</textarea>
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Declaration</strong></label>
                                    <div class="form-group"> <label for="form_name">By submitting this application, I affirm that the information provided are true and complete to the best of my knowledge. Any false statements, omission of any fac and misrepresentation in my resume, application or any other material, may result in my immediate dismissal from the DHI funding Process.<br>I hereby authorize DHI to verify the above information.</label></div>
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Attach the following</strong></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Passport size Photo:&nbsp;</label>
                            <?php $docs = App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'photo')->get();
                            $dcount = count(App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'photo')->get()); ?>
                            @if($dcount == 0)
                            <font color="red">No Documents Found </font>
                            @else
                            <?php $did = 1; ?>
                            @foreach($docs as $d)
                            <?php $pathid = $d->doc_path; ?>
                            <a href="{{ asset("storage/$pathid") }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $d->file_name; ?></a><br>
                            @endforeach
                            @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">CV:&nbsp;</label>
                                <?php $docs = App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'cv')->get();
                              $dcount = count(App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'cv')->get()); ?>
                            @if($dcount == 0)
                            <font color="red">No Documents Found </font>
                            @else
                            <?php $did = 1; ?>
                            @foreach($docs as $d)
                            <?php $pathid = $d->doc_path; ?>
                            <a href="{{ asset("storage/$pathid") }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $d->file_name; ?></a><br>
                            @endforeach
                            @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Business Proposal:&nbsp;</label>
                                <?php $docs = App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'businessproposal')->get();
                            $dcount = count(App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'businessproposal')->get()); ?>
                            @if($dcount == 0)
                            <font color="red">No Documents Found </font>
                            @else
                            <?php $did = 1; ?>
                            @foreach($docs as $d)
                            <?php $pathid = $d->doc_path; ?>
                            <a href="{{ asset("storage/$pathid") }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $d->file_name; ?></a><br>
                            @endforeach
                            @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Professional Recommendation:&nbsp;</label>
                                <?php $docs = App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'recommendation')->get();
                            $dcount = count(App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'recommendation')->get()); ?>
                            @if($dcount == 0)
                            <font color="red">No Documents Found </font>
                            @else
                            <?php $did = 1; ?>
                            @foreach($docs as $d)
                            <?php $pathid = $d->doc_path; ?>
                            <a href="{{ asset("storage/$pathid") }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $d->file_name; ?></a><br>
                            @endforeach
                            @endif
                                </div>
                                <br>
                            </div>

                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script type="text/javascript">
    $('#test').on('change', function() {
        if (this.value == "0") {
            $('#yesno').show();
        } else {
            $('#yesno').hide();
        }
    });
</script>
