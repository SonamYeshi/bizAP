<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<x-app-layout>
    @include('top_nav_bar')

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
                            <form id="contact-form" role="form" method="POST" action="{{ route('editdhifunding') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="appid" value="<?php echo $appid;?>">
                        <input type="hidden" name="fundid" value="<?php echo $fundid;?>">
                            <div class="controls">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"> <label for="form_message"><strong>Personal Information </strong></label></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">CID <font color="red">*</font></label>
                                    <input id="form_name" type="number" name="cid" value="{{$app->cid}}" class="form-control" placeholder="Please Eenter your CID" required="required" data-error="Firstname is required.">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Mr / Mrs / Ms <font color="red">*</font></label>
                                    <input id="form_name" type="text" name="initial" value="{{$app->initial}}" class="form-control" placeholder="Please Eenter Mr / Mrs / Ms" required="required" data-error="Firstname is required.">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Name <font color="red">*</font></label>
                                    <input type="text" name="name" class="form-control" value="{{$app->name}}" placeholder="Please Eenter your Name" required="required" data-error="Firstname is required.">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Date of Birth <font color="red">*</font></label>
                                    <input id="form_name" type="date" name="dob" value="{{$app->dob}}" class="form-control" placeholder="Please Eenter your DOB" required="required" data-error="Firstname is required.">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Mobile No <font color="red">*</font></label>
                                    <input id="form_name" type="number" name="mobileno" value="{{$app->mobileno}}" class="form-control" placeholder="Please Eenter your Mobile No" required="required" data-error="Firstname is required.">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">EMail<font color="red">*</font></label>
                                    <input id="form_name" type="email" name="email" value="{{$app->email}}" class="form-control" placeholder="Please Eenter your EMail" required="required" data-error="Firstname is required.">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message">Current Address</label>
                                    <input id="form_name" type="text" name="current_address" value="{{$app->current_address}}" class="form-control" placeholder="Please Eenter current Address"  data-error="Firstname is required.">
                                </div>
                            </div>
                        </div>
                        <?php $Source = explode(',', $app->source_of_income); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"> <label for="form_message"><strong>Primary Source of Income </strong></label></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Employment</label>
                                    <input id="form_name" type="checkbox" name="source_of_income[]" value="1" <?php foreach ($Source as $rslt1) : if ($rslt1 == '1') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Private Business</label>
                                    <input id="form_name" type="checkbox" name="source_of_income[]" value="2" <?php foreach ($Source as $rslt2) : if ($rslt2 == '2') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Others</label>
                                    <input id="form_name" type="checkbox" name="source_of_income[]" value="3" <?php foreach ($Source as $rslt3) : if ($rslt3 == '3') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message">Please Specify if Others</label>
                                    <input id="form_name" type="text" name="source_of_income_others" value="{{$app->source_of_income_others}}" class="form-control" data-error="Firstname is required.">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name"><strong>Name of Business</strong></label>
                                    <input id="form_name" type="text" name="business_name" value="{{$app->business_name}}" class="form-control" placeholder="Please Eenter Name of the Business"  data-error="Firstname is required.">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name"><strong>Business Location</strong>
                                        <font color="red">*</font>
                                    </label>
                                    <input id="form_name" type="text" name="business_location" value="{{$app->business_location}}" class="form-control" placeholder="Please Eenter Business Location"  data-error="Firstname is required.">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name"><strong>Business Type</strong></label><font color="red">*</font>
                                  <select class='form-control' id="business_type" name="business_type" required="required">
                                    <option value="">Select</option>
                                    <?php
                                    $businesstype= App\Models\BusinessType::all();
                                     foreach($businesstype as $g):
                                    ?>
                                    <option value="{{$g->id}}" <?php if($g->id == $app->business_type) { ?>selected<?php } ?>)>{{$g->business_type}}</option>
                                   <?php endforeach ?>
                                  </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Description of business (maximum of 250 words)</strong></label>
                                    <textarea id="form_message" name="business_description" class="form-control form-control-sm" rows="4"  data-error="Please, leave us a message.">{{$app->business_description}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Select the sector that your business currently operating</strong></label>
                                </div>
                            </div>
                        </div>
                        <?php $sector = explode(',', $app->business_sector); ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Agriculture and Forestry</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]"  value="1" <?php foreach ($sector as $rslt1) : if ($rslt1 == '1') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Consctruction and Real Estate</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" value="2" <?php foreach ($sector as $rslt2) : if ($rslt2 == '2') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Consumer packaged goods</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" value="3" <?php foreach ($sector as $rslt3) : if ($rslt3 == '3') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Dairy and / or cooperatives</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" value="4" <?php foreach ($sector as $rslt4) : if ($rslt4 == '4') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Education</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" value="5" <?php foreach ($sector as $rslt5) : if ($rslt5 == '5') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Environmental Services</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" value="6" <?php foreach ($sector as $rslt6) : if ($rslt6 == '6') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Financial Services</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" value="7" <?php foreach ($sector as $rslt7) : if ($rslt7 == '7') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Food and culinary</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" value="8" <?php foreach ($sector as $rslt8) : if ($rslt8 == '8') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Health</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" value="9" <?php foreach ($sector as $rslt9) : if ($rslt9 == '9') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Information Technology</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" value="10" <?php foreach ($sector as $rslt10) : if ($rslt10 == '10') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Paper / Packaging</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" value="11" <?php foreach ($sector as $rslt11) : if ($rslt11 == '11') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Transportation</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" value="12" <?php foreach ($sector as $rslt12) : if ($rslt12 == '12') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Textiles</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" value="13" <?php foreach ($sector as $rslt13) : if ($rslt13 == '13') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Tourism</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" value="14" <?php foreach ($sector as $rslt14) : if ($rslt14 == '14') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Waste Management and Sanitation</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" value="15" <?php foreach ($sector as $rslt15) : if ($rslt15 == '15') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Others</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" value="16" <?php foreach ($sector as $rslt16) : if ($rslt16 == '16') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Please Specify if Others</label>
                                    <input id="form_name" type="text" name="business_sector_others" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Explain the specific problem or opportunity your business was created to address (Maximum of 250 words)</strong></label>
                                    <textarea id="form_message" name="business_to_address" class="form-control" rows="4">{{$app->business_to_address}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>What stage is your business activity / service in?</strong></label>
                                </div>
                            </div>
                        </div>
                        <?php $activity = explode(',', $app->business_activity); ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Research</label>
                                    <input id="form_name" type="checkbox" name="business_activity[]" value="1" <?php foreach ($activity as $rslt1) : if ($rslt1 == '1') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Proven Concept</label>
                                    <input id="form_name" type="checkbox" name="business_activity[]" value="2" <?php foreach ($activity as $rslt2) : if ($rslt2 == '2') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Initial prototype / early market testing</label>
                                    <input id="form_name" type="checkbox" name="business_activity[]" value="3" <?php foreach ($activity as $rslt3) : if ($rslt3 == '3') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Advanced prototype / Obtained market testing results</label>
                                    <input id="form_name" type="checkbox" name="business_activity[]" value="4" <?php foreach ($activity as $rslt4) : if ($rslt4 == '4') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Testing and certification completed for commercial use</label>
                                    <input id="form_name" type="checkbox" name="business_activity[]" value="5" <?php foreach ($activity as $rslt5) : if ($rslt5 == '5') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Being sold in the market</label>
                                    <input id="form_name" type="checkbox" name="business_activity[]" value="6" <?php foreach ($activity as $rslt6) : if ($rslt6 == '6') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>What is the status of your business? (You can select more than One)</strong></label>
                                </div>
                            </div>
                        </div>
                        <?php $status = explode(',', $app->business_status); ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Already in the market (obtained business license)</label>
                                    <input id="form_name" type="checkbox" name="business_status[]" value="1" <?php foreach ($status as $rslt1) : if ($rslt1 == '1') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Expect to commercially launch in the next 6 months</label>
                                    <input id="form_name" type="checkbox" name="business_status[]" value="2" <?php foreach ($status as $rslt2) : if ($rslt2 == '2') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Expect to commercially launch in 7-12 Months</label>
                                    <input id="form_name" type="checkbox" name="business_status[]"  value="3" <?php foreach ($status as $rslt3) : if ($rslt3 == '3') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Expect to commercially launch more than 12 months</label>
                                    <input id="form_name" type="checkbox" name="business_status[]" value="4" <?php foreach ($status as $rslt4) : if ($rslt4 == '4') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Not Yet Decided</label>
                                    <input id="form_name" type="checkbox" name="business_status[]" value="5" <?php foreach ($status as $rslt5) : if ($rslt5 == '5') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Additional Information about your business</strong></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">What is your revenue for the last three months (in Ngulturm)?</label>
                                    <input id="form_name" type="number" name="revenue" value="<?php echo $app->revenue; ?>" class="form-control"  data-error="Firstname is required.">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Who is your current customer target segment?</label>
                                    <input id="form_name" type="text" name="customer_target" value="<?php echo $app->customer_target; ?>" class="form-control"  data-error="Firstname is required.">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Number of current customers</label>
                                    <input id="form_name" type="number" name="no_of_current_customer" value="<?php echo $app->no_of_current_customer; ?>" class="form-control" data-error="Firstname is required.">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">When did you start your company (specify date)?</label>
                                    <input id="form_name" type="date" name="company_start_date" value="<?php echo $app->company_start_date; ?>" class="form-control"  data-error="Firstname is required.">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">How much money have you already invested in your business so far?</label>
                                    <input id="form_name" type="number" name="money_invested" value="<?php echo $app->money_invested; ?>" class="form-control" data-error="Firstname is required.">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">How did you raise finance for your business?</label>
                                    <input id="form_name" type="text" name="raise_finance" value="<?php echo $app->raise_finance; ?>" class="form-control"  data-error="Firstname is required.">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">How many employees have you hired?</label>
                                    <input id="form_name" type="number" name="employees_hired" value="<?php echo $app->employees_hired; ?>" class="form-control"  data-error="Firstname is required.">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Who is on your team? (You can select more than one)</strong></label>
                                </div>
                            </div>
                        </div>
                        <?php $team = explode(',', $app->team); ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Accountant</label>
                                    <input id="form_name" type="checkbox" name="team[]" value="1" <?php foreach ($team as $rslt1) : if ($rslt1 == '1') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Marketing and sales expert</label>
                                    <input id="form_name" type="checkbox" name="team[]" value="2" <?php foreach ($team as $rslt2) : if ($rslt2 == '2') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Technical Expert</label>
                                    <input id="form_name" type="checkbox" name="team[]" value="3" <?php foreach ($team as $rslt3) : if ($rslt3 == '3') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Others</label>
                                    <input id="form_name" type="checkbox" name="team[]" value="4" <?php foreach ($team as $rslt4) : if ($rslt4 == '4') { ?> checked <?php } endforeach; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Please Specify if Others</label>
                                    <input id="form_name" type="text" name="team_others" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>What is the biggest challenge you are currently facing to the successful commercialization of your business? (Maximum of

                                            150 words)</strong></label>
                                    <textarea id="form_message" name="biggest_challenge" class="form-control"  rows="4" >{{$app->biggest_challenge}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>What specific resources do you require in ordr to expand / grow your business? (Maximum 150 words)</strong></label>
                                    <textarea id="form_message" name="specific_resources" class="form-control" rows="4" >{{$app->specific_resources}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Is there anything else you would like us to know about your business opportunity? (Maximum 150 words)</strong></label>
                                    <textarea id="form_message" name="business_opportunity" class="form-control" rows="4" >{{$app->business_opportunity}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Declaration</strong></label>
                                    <div class="form-group"> <label for="form_name">By submitting this application, I affirm that the information provided are true and complete to the best of my knowledge. Any false statements, omission of any fac and misrepresentation in my resume, application or any other material, may result in my immediate dismissal from the DHI funding Process.<br>I hereby authorize DHI to verify the above information.</label></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Attach the following</strong></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Passport size Photo</label>
                                <?php $docs = App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'photo')->get();
                            $dcount = count(App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'photo')->get()); ?>
                            @if($dcount == 0)
                            <font color="red">No Documents Found </font>
                            @else
                            <?php $did = 1; ?>
                            @foreach($docs as $d)
                            <?php $filename = $d->file_name; ?>
                            <a href="{{ url('/uploads/dhifundingapplicationdocs/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $d->file_name; ?></a><br>
                            @endforeach
                            @endif
                                    <input type="file" class="form-control" id="customFile" name="passport_photo[]" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">CV</label>
                                <?php $docs = App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'cv')->get();
                              $dcount = count(App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'cv')->get()); ?>
                            @if($dcount == 0)
                            <font color="red">No Documents Found </font>
                            @else
                            <?php $did = 1; ?>
                            @foreach($docs as $d)
                            <?php $filename = $d->file_name; ?>
                            <a href="{{ url('/uploads/dhifundingapplicationdocs/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $d->file_name; ?></a><br>
                            @endforeach
                            @endif
                                    <input type="file" class="form-control" id="customFile" name="cv[]" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">CID</label>
                                <?php $docs = App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'CID')->get();
                              $dcount = count(App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'CID')->get()); ?>
                            @if($dcount == 0)
                            <font color="red">No Documents Found </font>
                            @else
                            <?php $did = 1; ?>
                            @foreach($docs as $d)
                            <?php $filename = $d->file_name; ?>
                            <a href="{{ url('/uploads/dhifundingapplicationdocs/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $d->file_name; ?></a><br>
                            @endforeach
                            @endif
                                    <input type="file" class="form-control" id="customFile" name="CID[]" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Business License</label>
                                <?php $docs = App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'BusinessLicense')->get();
                              $dcount = count(App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'BusinessLicense')->get()); ?>
                            @if($dcount == 0)
                            <font color="red">No Documents Found </font>
                            @else
                            <?php $did = 1; ?>
                            @foreach($docs as $d)
                            <?php $filename = $d->file_name; ?>
                            <a href="{{ url('/uploads/dhifundingapplicationdocs/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $d->file_name; ?></a><br>
                            @endforeach
                            @endif
                                    <input type="file" class="form-control" id="customFile" name="BusinessLicense[]" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">CIB Report</label>
                                <?php $docs = App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'CIBReport')->get();
                              $dcount = count(App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'CIBReport')->get()); ?>
                            @if($dcount == 0)
                            <font color="red">No Documents Found </font>
                            @else
                            <?php $did = 1; ?>
                            @foreach($docs as $d)
                            <?php $filename = $d->file_name; ?>
                            <a href="{{ url('/uploads/dhifundingapplicationdocs/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $d->file_name; ?></a><br>
                            @endforeach
                            @endif
                                    <input type="file" class="form-control" id="customFile" name="CIBReport[]" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">NOC</label>
                                <?php $docs = App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'NOC')->get();
                              $dcount = count(App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'NOC')->get()); ?>
                            @if($dcount == 0)
                            <font color="red">No Documents Found </font>
                            @else
                            <?php $did = 1; ?>
                            @foreach($docs as $d)
                            <?php $filename = $d->file_name; ?>
                            <a href="{{ url('/uploads/dhifundingapplicationdocs/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $d->file_name; ?></a><br>
                            @endforeach
                            @endif
                                    <input type="file" class="form-control" id="customFile" name="NOC[]" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Account statement of past two years</label>
                                <?php $docs = App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'ACCSMT')->get();
                              $dcount = count(App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'ACCSMT')->get()); ?>
                            @if($dcount == 0)
                            <font color="red">No Documents Found </font>
                            @else
                            <?php $did = 1; ?>
                            @foreach($docs as $d)
                            <?php $filename = $d->file_name; ?>
                            <a href="{{ url('/uploads/dhifundingapplicationdocs/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $d->file_name; ?></a><br>
                            @endforeach
                            @endif
                                    <input type="file" class="form-control" id="customFile" name="ACCSMT[]" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Tax Clearance</label>
                                <?php $docs = App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'TaxClearance')->get();
                              $dcount = count(App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'TaxClearance')->get()); ?>
                            @if($dcount == 0)
                            <font color="red">No Documents Found </font>
                            @else
                            <?php $did = 1; ?>
                            @foreach($docs as $d)
                            <?php $filename = $d->file_name; ?>
                            <a href="{{ url('/uploads/dhifundingapplicationdocs/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $d->file_name; ?></a><br>
                            @endforeach
                            @endif
                                    <input type="file" class="form-control" id="customFile" name="TaxClearance[]" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Business Proposal</label>
                                <?php $docs = App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'businessproposal')->get();
                            $dcount = count(App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'businessproposal')->get()); ?>
                            @if($dcount == 0)
                            <font color="red">No Documents Found </font>
                            @else
                            <?php $did = 1; ?>
                            @foreach($docs as $d)
                            <?php $filename = $d->file_name; ?>
                            <a href="{{ url('/uploads/dhifundingapplicationdocs/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $d->file_name; ?></a><br>
                            @endforeach
                            @endif
                                    <input type="file" class="form-control" id="customFile" name="business_proposal[]" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Professional Recommendation</label>
                                <?php $docs = App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'recommendation')->get();
                            $dcount = count(App\Models\DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', 'recommendation')->get()); ?>
                            @if($dcount == 0)
                            <font color="red">No Documents Found </font>
                            @else
                            <?php $did = 1; ?>
                            @foreach($docs as $d)
                            <?php $filename = $d->file_name; ?>
                            <a href="{{ url('/uploads/dhifundingapplicationdocs/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $d->file_name; ?></a><br>
                            @endforeach
                            @endif
                                    <input type="file" class="form-control" id="customFile" name="recommendation[]" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12"> <input type="submit" onclick='return confirm("Are you sure to Apply ?")' class="btn btn-success btn-send pt-2 btn-block " value="Update"> </div>
                            <div class="col-md-12"> <input type="submit" class="btn btn-danger btn-send pt-2 btn-block " value="Cancel"> </div>
                        </div>
                        </form>
                        </div>
                            </div>
                        </form>
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
