<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<x-guest-layout>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BizAP</title>
    </head>

    <div class="container"> <div class="text-center mt-5">
        <h1>Application for DHI Business Acceleration Fund</h1>
    </div>
    <div class="row ">
        <div class="col-lg-12 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">

                        <form id="contact-form" role="form" method="POST" action="{{ route('applydhifunding') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="fundid" value="{{$fundid}}">
                            <div class="controls">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"> <label for="form_message"><strong>Personal Information </strong></label></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">CID <font color="red">*</font></label>
                                    <input id="form_name" type="number" name="cid" class="form-control" placeholder="Please Enter your CID" required data-error="Firstname is required.">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Mr / Mrs / Ms <font color="red">*</font></label>
                                    <input id="form_name" type="text" name="initial" class="form-control" placeholder="Please Enter Mr / Mrs / Ms" required data-error="Firstname is required.">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Name <font color="red">*</font></label>
                                    <input type="text" name="name" class="form-control" placeholder="Please Enter your Name" required data-error="Firstname is required.">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Date of Birth <font color="red">*</font></label>
                                    <input id="form_name" type="date" name="dob" class="form-control" placeholder="Please Enter your DOB" required data-error="Firstname is required.">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Mobile No <font color="red">*</font></label>
                                    <input id="form_name" type="number" name="mobileno" class="form-control" placeholder="Please Enter your Mobile No" required data-error="Firstname is required.">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">EMail<font color="red">*</font></label>
                                    <input id="form_name" type="email" name="email" class="form-control" placeholder="Please Enter your EMail" required data-error="Firstname is required.">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message">Current Address<font color="red">*</font></label>
                                    <input id="form_name" type="text" name="current_address" class="form-control" placeholder="Please Enter current Address"  data-error="Firstname is required." required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"> <label for="form_message"><strong>Primary Source of Income </strong></label></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Employment</label>
                                    <input id="form_name" type="checkbox" name="source_of_income[]" class="form-control" value="1">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Private Business</label>
                                    <input id="form_name" type="checkbox" name="source_of_income[]" class="form-control" value="2">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Others</label>
                                    <input id="form_name" type="checkbox" name="source_of_income[]" class="form-control" value="3">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message">Please Specify if Others</label>
                                    <input id="form_name" type="text" name="source_of_income_others" class="form-control" data-error="Firstname is required.">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name"><strong>Name of Business</strong></label>
                                    <input id="form_name" type="text" name="business_name" class="form-control" placeholder="Please Enter Name of the Business"  data-error="Firstname is required." required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name"><strong>Business Location</strong>
                                        <font color="red">*</font>
                                    </label>
                                    <input id="form_name" type="text" name="business_location" class="form-control" placeholder="Please Enter Business Location"  data-error="Firstname is required." required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name"><strong>Business Type</strong></label><font color="red">*</font>
                                  <select class='form-control' id="business_type" name="business_type" required>
                                    <option value="">Select</option>
                                    <?php
                                    $businesstype= App\Models\BusinessType::all();
                                     foreach($businesstype as $g):
                                    ?>
                                    <option value="{{$g->id}}">{{$g->business_type}}</option>
                                   <?php endforeach ?>
                                  </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Description of business (maximum of 250 words)</strong><font color="red">*</font></label>
                                    <textarea id="form_message" name="business_description" class="form-control" placeholder="Write your Description here." rows="4"  data-error="Please, leave us a message." required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Select the sector that your business currently operating</strong></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Agriculture and Forestry</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" class="form-control" value="1">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Construction and Real Estate</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" class="form-control" value="2">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Consumer packaged goods</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" class="form-control" value="3">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Dairy and / or cooperatives</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" class="form-control" value="4">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Education</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" class="form-control" value="5">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Environmental Services</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" class="form-control" value="6">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Financial Services</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" class="form-control" value="7">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Food and culinary</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" class="form-control" value="8">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Health</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" class="form-control" value="9">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Information Technology</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" class="form-control" value="10">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Paper / Packaging</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" class="form-control" value="11">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Transportation</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" class="form-control" value="12">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Textiles</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" class="form-control" value="13">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Tourism</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" class="form-control" value="14">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Waste Management and Sanitation</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" class="form-control" value="15">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Others</label>
                                    <input id="form_name" type="checkbox" name="business_sector[]" class="form-control" value="16">
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
                                <div class="form-group"><label for="form_message"><strong>Explain the specific problem or opportunity your business was created to address (Maximum of 250 words)</strong><font color="red">*</font></label>
                                    <textarea id="form_message" name="business_to_address" class="form-control" placeholder="Write your Description here." rows="4" data-error="Please, leave us a message." required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>What stage is your business activity / service in?</strong></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Research</label>
                                    <input id="form_name" type="checkbox" name="business_activity[]" class="form-control" value="1">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Proven Concept</label>
                                    <input id="form_name" type="checkbox" name="business_activity[]" class="form-control" value="2">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Initial prototype / early market testing</label>
                                    <input id="form_name" type="checkbox" name="business_activity[]" class="form-control" value="3">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Advanced prototype / Obtained market testing results</label>
                                    <input id="form_name" type="checkbox" name="business_activity[]" class="form-control" value="4">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Testing and certification completed for commercial use</label>
                                    <input id="form_name" type="checkbox" name="business_activity[]" class="form-control" value="5">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Being sold in the market</label>
                                    <input id="form_name" type="checkbox" name="business_activity[]" class="form-control" value="6">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>What is the status of your business? (You can select more than One)</strong></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Already in the market (obtained business license)</label>
                                    <input id="form_name" type="checkbox" name="business_status[]" class="form-control" value="1">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Expect to commercially launch in the next 6 months</label>
                                    <input id="form_name" type="checkbox" name="business_status[]" class="form-control" value="2">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Expect to commercially launch in 7-12 Months</label>
                                    <input id="form_name" type="checkbox" name="business_status[]" class="form-control" value="3">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Expect to commercially launch more than 12 months</label>
                                    <input id="form_name" type="checkbox" name="business_status[]" class="form-control" value="4">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Not Yet Decided</label>
                                    <input id="form_name" type="checkbox" name="business_status[]" class="form-control" value="5">
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
                                    <input id="form_name" type="number" name="revenue" class="form-control"  data-error="Firstname is required.">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Who is your current customer target segment?</label>
                                    <input id="form_name" type="text" name="customer_target" class="form-control"  data-error="Firstname is required.">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Number of current customers</label>
                                    <input id="form_name" type="number" name="no_of_current_customer" class="form-control" data-error="Firstname is required.">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">When did you start your company (specify date)?</label>
                                    <input id="form_name" type="date" name="company_start_date" class="form-control"  data-error="Firstname is required.">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">How much money have you already invested in your business so far?</label>
                                    <input id="form_name" type="number" name="money_invested" class="form-control" data-error="Firstname is required.">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">How did you raise finance for your business?</label>
                                    <input id="form_name" type="text" name="raise_finance" class="form-control"  data-error="Firstname is required.">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">How many employees have you hired?</label>
                                    <input id="form_name" type="number" name="employees_hired" class="form-control"  data-error="Firstname is required.">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Who is on your team? (You can select more than one)</strong></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Accountant</label>
                                    <input id="form_name" type="checkbox" name="team[]" class="form-control" value="1">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Marketing and sales expert</label>
                                    <input id="form_name" type="checkbox" name="team[]" class="form-control" value="2">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Technical Expert</label>
                                    <input id="form_name" type="checkbox" name="team[]" class="form-control" value="3">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group"> <label for="form_name">Others</label>
                                    <input id="form_name" type="checkbox" name="team[]" class="form-control" value="4">
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

                                            150 words)</strong><font color="red">*</font></label>
                                    <textarea id="form_message" name="biggest_challenge" class="form-control" placeholder="Write here..." rows="4"  data-error="Please, leave us a message." required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>What specific resources do you require in order to expand / grow your business? (Maximum 150 words)</strong><font color="red">*</font></label>
                                    <textarea id="form_message" name="specific_resources" class="form-control" placeholder="Write here..." rows="4"  data-error="Please, leave us a message." required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Is there anything else you would like us to know about your business opportunity? (Maximum 150 words)</strong><font color="red">*</font></label>
                                    <textarea id="form_message" name="business_opportunity" class="form-control" placeholder="Write here..." rows="4"  data-error="Please, leave us a message." required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="form_message"><strong>Declaration</strong></label>
                                    <div class="form-group"> <label for="form_name">By submitting this application, I affirm that the information provided are true and complete to the best of my knowledge. Any false statements, omission of any fact and misrepresentation in my resume, application or any other material, may result in my immediate dismissal from the DHI funding Process.<br>I hereby authorize DHI to verify the above information.</label></div>
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
                                <div class="form-group"> <label for="form_name">Passport size Photo<font color="red">*</font></label>
                                    <input type="file" class="form-control" id="customFile" name="passport_photo[]" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">CV<font color="red">*</font></label>
                                    <input type="file" class="form-control" id="customFile" name="cv[]" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">CID<font color="red">*</font></label>
                                    <input type="file" class="form-control" id="customFile" name="CID[]" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Business License<font color="red">*</font></label>
                                    <input type="file" class="form-control" id="customFile" name="BusinessLicense[]" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">CIB Report<font color="red">*</font></label>
                                    <input type="file" class="form-control" id="customFile" name="CIBReport[]" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Security clearance<font color="red">*</font></label>
                                    <input type="file" class="form-control" id="customFile" name="NOC[]" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Account statement of past two years<font color="red">*</font></label>
                                    <input type="file" class="form-control" id="customFile" name="ACCSMT[]" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Tax Clearance<font color="red">*</font></label>
                                    <input type="file" class="form-control" id="customFile" name="TaxClearance[]" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Business Proposal<font color="red">*</font></label>
                                    <input type="file" class="form-control" id="customFile" name="business_proposal[]" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="form_name">Professional Recommendation<font color="red">*</font></label>
                                    <input type="file" class="form-control" id="customFile" name="recommendation[]" required />
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
        <div class="flex">
  <span class="inline-flex rounded-md shadow-sm">
                        <button
                            type="submit"
                            class="
                                inline-flex
                                items-center
                                px-4
                                py-2
                                text-base
                                font-medium
                                leading-6
                                text-white
                                transition
                                duration-150
                                ease-in-out
                                bg-blue-600
                                border border-transparent
                                rounded-md
                                hover:bg-blue-500
                                focus:border-blue-700
                                active:bg-blue-700
                                btn btn-primary btn-sm
                            "
                        >
                            <svg
                                wire:loading
                                wire:target="storePost"
                                class="
                                    w-5
                                    h-5
                                    mr-3
                                    -ml-1
                                    text-white
                                    animate-spin
                                "
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <circle
                                    class="opacity-25"
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="4"
                                ></circle>
                                <path
                                    class="opacity-75"
                                    fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                ></path>
                            </svg>
                            Submit
                        </button>
                    </span>
           </div>
           <a  href="{{ url()->previous() }}">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
           </a>
        </div>
                        </form>
                        </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- /.8 -->
        </div> <!-- /.row-->
    </div>
</div>
        </x-app-layout>

