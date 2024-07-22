<x-app-layout>
    @include('top_nav_bar')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                    <nav class="navbar navbar-light">
                    <strong>Shortlisting Status <font color="blue">{{ $application->name }}</font></strong>
                    </nav>
                        <form class="row g-3" role="form" method="POST" action="{{ route('shortlistupdate') }}" enctype="multipart/form-data" id="scoreForm">
                            {{ csrf_field() }}
                            <input type="hidden" name="appid" value="<?php echo $appid; ?>">

                            <!-- <div class="form-group col-md-10">
                                <label for="name" class="form-label"><strong>Screening Status<font color="red">*</font></strong></label>
                                <select class='form-control' required name="screeningstatus" disabled>
                                    <option value="1" >Yes</option>
                                    <option value="0" >No</option>
                                </select>
                            </div> -->

                             <br>

                             <!--
                            <div class="form-group col-md-4">
                                <label for="name" class="form-label"><strong>Shortlist Status<font color="red">*</font></strong></label>
                                <select class='form-control' id="test" required name="shortliststatus">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <div id="yesno" style="display:none;">
                                <div class="form-group col-md-4">
                                    <label for="name" class="form-label"><strong>Reason</strong></label>
                                    <textarea class="form-control" id="challenge" name="shortlistreason" rows="3"></textarea>
                                </div>
                            </div>
-->
                            <div class="form-group col-md-10">
                                <label for="name" class="form-label"><strong>Shortlist Scores:&nbsp;</strong></label>
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
                                        @php 
                                         $i = 1;
                                        @endphp
                                        @foreach($pannels as $pl)
                                        <tr>
                                            <td>{{$i}}
                                            <input type="hidden" name="rowss[steps][3][]" value="{{$pl->id}}">
                                            <input type="hidden" name="rowss[steps][4][]" value="{{$pl->score_id}}">
                                            </td>
                                            <td>{{$pl->name}}</td>
                                            <td>{{$pl->designation}}</td>
                                            <td>{{$pl->rolename}}</td>
                                            <td><input type="decimal" name='rowss[steps][1][]' value="{{$pl->score}}" class='form-control txtCal' required
                                            @if(!is_null($application->shortlist_status))
                                            readOnly
                                            @endif
                                            ></td>
                                            <td><textarea name="rowss[steps][2][]" rows="1" class='form-control' required
                                            @if(!is_null($application->shortlist_status))
                                            readOnly
                                            @endif
                                            >{{$pl->remark}}</textarea></td>

                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach
                                        <tr>
                                            <td colspan="4">Average Score</td>
                                            <td><b><span id="total_sum_value"></span></td>
                                              <td>
                                              @if($avg_score != 0.00)
                                            {{$avg_score}}
                                            @endif
                                              </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="modal-footer">
                                @if(is_null($application->shortlist_status))
                                <button type="submit" class="btn btn-primary btn-sm" onclick='return validateAndConfirm()'>Save</button>
                                @endif
                                <!-- <a  href="{{ url()->previous() }}"> -->
                                <a  href="{{ route('shortlist') }}">
                                <button type="button" class="btn btn-info btn-sm" data-dismiss="modal"><i class="fas fa-arrow-left"></i> Back</button>
                                </a>
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
                    <p class="text-end"><a href="{{route('app_pdf',$appid)}}" style="text-decoration:none"><i class="fas fa-file-pdf"></i> Download PDF </a></p>
                            <div class="form-group col-md-4">
                                <label for="cid" class="form-label"><strong>Training Applied for:&nbsp;
                                {{$application->training_name}}</strong></label>
                            </div>
                         <hr>
                        
                            <div class="form-group col-md-4">
                                <label for="cid" class="form-label"><strong>1. CID:&nbsp;</strong></label>{{$application->cid}}
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name" class="form-label"><strong>2. Name:&nbsp;</strong></label>{{$application->name}}
                            </div>

                            <div class="form-group col-md-4">
                                <label for="email" class="form-label"><strong>3. Email:&nbsp;</strong></label>{{$application->email}}
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name" class="form-label"><strong>4. Mobile No.:&nbsp;</strong></label>{{$application->mobileno}}
                            </div>

                            <div class="form-group col-md-4">
                                <label for="name" class="form-label"><strong>5. Date of Birth:&nbsp;</strong></label>{{$application->dob}}
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name" class="form-label"><strong>6. Gender:&nbsp;</strong></label>
                                {{$application->sex}}
                            </div>

                            <div class="form-group col-md-4">
                                <label for="name" class="form-label"><strong>7. Qualification:&nbsp;</strong></label>
                                {{$application->quali}}
                            </div>

                            <div class="form-group col-md-4">
                                <label for="name" class="form-label"><strong>8. Dzongkhag:&nbsp;</strong></label>
                                {{$application->dzo}}
                            </div>

                            <div class="form-group col-md-4">
                                <label for="name" class="form-label"><strong>9. Current Job Status:&nbsp;</strong></label>
                                {{$application->job}}
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label"><strong>10. If Selected, can you commit 6-8 hours a week for training from 45 Hours:&nbsp;</strong></label>
                                @if($application->commit_hr == '1') Yes @else NO @endif
                            </div>
                            <div class="col-12">
                                <label for="address2" class="form-label"><strong>11. There will be an aftercare program to ensure the maximum potential for real world success to the participants.
                                        It will entail two week internship followed by opportunities to work with Bhutanese Professional freelancers (contingent
                                        on selection by them). DHI will also provide infrastructure support such as workspace and internet for a period of 6
                                        months. Will you be able to commit to this period?:&nbsp;</strong></label>
                                @if($application->commit_period == '1') Yes @else NO @endif
                            </div>

                            <div class="col-12">
                                <label for="address2" class="form-label"><strong>12. Decribe a hard challenge you faced and how you overcame it. (Maximum 100 words):&nbsp;</strong></label>
                                <textarea class="form-control" id="challenge" disabled="disabled" rows="5" required>{{ $application->challenge}}</textarea>
                            </div>

                            <div class="col-12">
                                <label for="address2" class="form-label"><strong>13. Please share the YouTube link of a 1 minute video of yourself describing who you are and why you are exited for this
                                        program. Be creative and have fun!.</strong>
                                    Make sure to give a correct link. The clip will be assessed for shortlisting as well as the final interview. Instructions on how to submit the video
                                    are provided in the tutorial provided in the website announcement. (All videos are confidential and will not be available to the public.
                                </label>
                                <input type="text" class="form-control" id="password" disabled="disabled" value="{{$application->youtubelink}}">
                            </div>

                            <div class="col-12">
                                <label for="address2" class="form-label"><strong>14. Rate your Soft Skills<font color="red">*</font></strong></label>
                                <div class="table-responsive">
                                        <table id="example" class="table table-bordered table-sm table-striped">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Sl.No</th>
                                                    <th>Skills</th>
                                                    <th>Advanced</th>
                                                    <th>Good</th>
                                                    <th>Basic</th>
                                                    <th>Poor</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>1</td>
                                                    <td>Communication</td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Communication == '1') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Communication == '2') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Communication == '3') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Communication == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Negotiation</td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Negotiation == '1') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Negotiation == '2') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Negotiation == '3') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Negotiation == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Time Management</td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->TimeManagement == '1') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->TimeManagement == '2') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->TimeManagement == '3') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->TimeManagement == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Problem Solving Skills</td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->ProblemSolvingSkills == '1') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->ProblemSolvingSkills == '2') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->ProblemSolvingSkills == '3') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->ProblemSolvingSkills == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Punctuality</td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Punctuality == '1') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Punctuality == '2') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Negotiation == '3') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Punctuality == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>Team Work Skills</td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->TeamWorkSkills == '1') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->TeamWorkSkills == '2') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->TeamWorkSkills == '3') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->TeamWorkSkills == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>7</td>
                                                    <td>Flexibility</td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Flexibility == '1') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Flexibility == '2') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Flexibility == '3') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Flexibility == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>8</td>
                                                    <td>Ability to accept and learn from criticism</td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Abilitytoacceptandlearnfromcriticism == '1') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Abilitytoacceptandlearnfromcriticism == '2') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Abilitytoacceptandlearnfromcriticism == '3') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Abilitytoacceptandlearnfromcriticism == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>9</td>
                                                    <td>Marketing Skills</td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->MarketingSkills == '1') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->MarketingSkills == '2') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->MarketingSkills == '3') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->MarketingSkills == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>10</td>
                                                    <td>Passion to learn</td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Passiontolearn == '1') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Passiontolearn == '2') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Passiontolearn == '3') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Passiontolearn == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>11</td>
                                                    <td>Persistency</td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Persistency == '1') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Persistency == '2') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Persistency == '3') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Persistency == '4') { ?>checked<?php } ?>></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                </div>
                            </div>


                            <div class="col-12">
                                <label for="address2" class="form-label"><strong>15. Rate your Hard Skills<font color="red">*</font></strong></label>
                                <div class="table-responsive">hardskill
                                        <table id="example" class="table table-bordered table-sm table-striped">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Sl.No</th>
                                                    <th>Skills</th>
                                                    <th>Advanced</th>
                                                    <th>Good</th>
                                                    <th>Basic</th>
                                                    <th>Poor</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Graphic Design</td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->GraphicDesign == '1') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->GraphicDesign == '2') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->GraphicDesign == '3') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->GraphicDesign == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Website Desgn</td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->WebsiteDesgn == '1') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->WebsiteDesgn == '2') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->WebsiteDesgn == '3') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->WebsiteDesgn == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Photoshop</td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Photoshop == '1') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Photoshop == '2') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Photoshop == '3') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Photoshop == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Mobile Development</td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->MobileDevelopment == '1') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->MobileDevelopment == '2') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->MobileDevelopment == '3') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->MobileDevelopment == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Data Entry</td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->DataEntry == '1') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->DataEntry == '2') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->DataEntry == '3') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->DataEntry == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>Digital Marketing</td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->DigitalMarketing == '1') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->DigitalMarketing == '2') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->DigitalMarketing == '3') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->DigitalMarketing == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>7</td>
                                                    <td>Writing and Translation</td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->WritingandTranslation == '1') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->WritingandTranslation == '2') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->WritingandTranslation == '3') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->WritingandTranslation == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>8</td>
                                                    <td>Video and Animation</td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->VideoandAnimation == '1') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->VideoandAnimation == '2') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->VideoandAnimation == '3') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->VideoandAnimation == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>9</td>
                                                    <td>Music and Audio</td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->MusicandAudio == '1') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->MusicandAudio == '2') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->MusicandAudio == '3') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->MusicandAudio == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>10</td>
                                                    <td>Finance</td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Finance == '1') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Finance == '2') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Finance == '3') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Finance == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>11</td>
                                                    <td>Health and Fitness</td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->HealthandFitness == '1') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->HealthandFitness == '2') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->HealthandFitness == '3') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->HealthandFitness == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>12</td>
                                                    <td>Others</td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Others == '1') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Others == '2') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Others == '3') { ?>checked<?php } ?>></td>
                                                    <td><input class="form-check-input" type="radio" disabled <?php if ($application->Others == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                </div>
                            </div>

                            <div class="col-12">
                                <label for="address2" class="form-label"><strong>16. If you answered "Other" in the previous questions, please provide more details.<font color="red">*</font></strong></label>
                                <textarea class="form-control" id="oteherdetails" disabled rows="5">{{$application->oteherdetails}}</textarea>
                            </div>

                        <div class="col-12">
                            <label for="address2" class="form-label"><strong>17. Please provide contact details of two referees for your application.<font color="red">*</font></strong></label>
                        </div>
                        <div class="col-12">
                            <label for="address2" class="form-label"><i>Referee 1</i></label>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="cid" class="form-label">Name:&nbsp;</label>{{$application->rfname1}}
                        </div>
                        <div class="form-group col-md-4">
                            <label for="name" class="form-label">Position:&nbsp;</label>{{$application->rfposition1}}
                        </div>

                        <div class="form-group col-md-4">
                            <label for="email" class="form-label">Organization:&nbsp;</label>{{$application->rforg1}}
                        </div>
                        <div class="form-group col-md-4">
                            <label for="name" class="form-label">Relationship:&nbsp;</label>{{$application->rfrelation1}}
                        </div>

                        <div class="form-group col-md-4">
                            <label for="name" class="form-label">Mobile No.:&nbsp;</label>{{$application->rfmobileno1}}
                        </div>

                        <div class="form-group col-md-4">
                            <label for="name" class="form-label">Email Address:&nbsp;</label>{{$application->rfemail1}}
                        </div>

                        <div class="col-12">
                            <label for="address2" class="form-label"><i>Referee 2</i></label>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="cid" class="form-label">Name:&nbsp;</label>{{$application->rfname2}}
                        </div>
                        <div class="form-group col-md-4">
                            <label for="name" class="form-label">Position:&nbsp;</label>{{$application->rfposition2}}
                        </div>

                        <div class="form-group col-md-4">
                            <label for="email" class="form-label">Organization:&nbsp;</label>{{$application->rforg2}}
                        </div>
                        <div class="form-group col-md-4">
                            <label for="name" class="form-label">Relationship:&nbsp;</label>{{$application->rfrelation2}}
                        </div>

                        <div class="form-group col-md-4">
                            <label for="name" class="form-label">Mobile No.:&nbsp;</label>{{$application->rfmobileno2}}
                        </div>

                        <div class="form-group col-md-4">
                            <label for="name" class="form-label">Email Address:&nbsp;</label>{{$application->rfemail2}}
                        </div>

                        <div class="col-12">
                            <label for="address2" class="form-label"><strong>18. Documents to Be Submitted.</strong></label>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="form-label" for="customFile">Passport Size Photo (jpg/pdf):&nbsp;</label>
                            @if($application->passport == null)
                            <font color="red">No Documents Found </font>
                            @else
                            <a href="{{ url($application->doc_path.'/'.$application->passport) }}" target="_blank"><i class="bi bi-file-pdf"></i>{{$application->passport}}</a><br>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="customFile">CID (jpg/pdf):&nbsp;</label>
                            @if($application->cid_attatch == null)
                            <font color="red">No Documents Found </font>
                            @else
                            <a href="{{ url($application->doc_path.'/'.$application->cid_attatch) }}" target="_blank"><i class="bi bi-file-pdf"></i>{{$application->cid_attatch}}</a><br>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="customFile">No Objection Certificate (NOC) (jpg/pdf):&nbsp;</label>
                            @if($application->noc == null)
                            <font color="red">No Documents Found </font>
                            @else
                            <a href="{{ url($application->doc_path.'/'.$application->noc) }}" target="_blank"><i class="bi bi-file-pdf"></i>{{$application->noc}}</a><br>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="customFile">CV(jpg/pdf):&nbsp;</label>
                            @if($application->cv == null)
                            <font color="red">No Documents Found </font>
                            @else
                            <a href="{{ url($application->doc_path.'/'.$application->cv) }}" target="_blank"><i class="bi bi-file-pdf"></i>{{$application->cv}}</a><br>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="customFile">Qualification: Degree / Diploma / Certification (jpg/pdf):&nbsp;</label>
                            @if($application->certificate == null)
                            <font color="red">No Documents Found </font>
                            @else
                            <a href="{{ url($application->doc_path.'/'.$application->certificate) }}" target="_blank"><i class="bi bi-file-pdf"></i>{{$application->certificate}}</a><br>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="customFile">Other Supporting Documents (jpg/pdf):&nbsp;</label>
                            @if($application->supporting == null)
                            <font color="red">No Documents Found </font>
                            @else
                            <a href="{{ url($application->doc_path.'/'.$application->supporting) }}" target="_blank"><i class="bi bi-file-pdf"></i>{{$application->supporting}}</a><br>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="customFile">Examples of your work that may Demonstrate your skills:&nbsp;</label>
                            @if($application->workexample == null)
                            <font color="red">No Documents Found </font>
                            @else
                            <a href="{{ url($application->doc_path.'/'.$application->workexample) }}" target="_blank"><i class="bi bi-file-pdf"></i>{{$application->workexample}}</a><br>
                            @endif
                        </div>

                        <div class="col-12">
                            <label for="address2" class="form-label"><strong>19. Please upload ONLY 1-2 examples of your work that may demostrate your skills that could be applied to freelancing or
                                    commission work (if any). These can be samples of artwork, graphic design, writing, audio, etc. the you have created.:&nbsp;</strong></label>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="customFile">Sample 1:&nbsp;</label>
                            @if($application->sample1 == null)
                            <font color="red">No Documents Found </font>
                            @else
                            <a href="{{ url($application->doc_path.'/'.$application->sample1) }}" target="_blank"><i class="bi bi-file-pdf"></i>{{$application->sample1}}</a><br>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="customFile">Sample 2:&nbsp;</label>
                            @if($application->sample2 == null)
                            <font color="red">No Documents Found </font>
                            @else
                            <a href="{{ url($application->doc_path.'/'.$application->sample2) }}" target="_blank"><i class="bi bi-file-pdf"></i>{{$application->sample2}}</a><br>
                            @endif
                        </div>

                        <div class="col-12">
                            <label for="address2" class="form-label"><strong>20. How did you find about this program ?<font color="red">*</font></strong></label>
                        </div>
                        <?php $list = explode(',', $application->awareness); ?>
                        <div class="form-group col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="fb" id="findprogram" name="findprogram[]" <?php foreach ($list as $rslt1) : if ($rslt1 == 'fb') { ?> checked <?php }
                                                                                                                                                                                            endforeach; ?> />
                                <label class="form-check-label" for="flexCheckDefault"> Facebook
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="fw" id="findprogram" name="findprogram[]" <?php foreach ($list as $rslt2) : if ($rslt2 == 'fw') { ?> checked <?php }
                                                                                                                                                                                            endforeach; ?> />
                                <label class="form-check-label" for="flexCheckDefault"> Friend / Word of Mouth
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="bbs" id="findprogram" name="findprogram[]" <?php foreach ($list as $rslt3) : if ($rslt3 == 'bbs') { ?> checked <?php }
                                                                                                                                                                                                endforeach; ?> />
                                <label class="form-check-label" for="flexCheckDefault"> BBS
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="k" id="findprogram" name="findprogram[]" <?php foreach ($list as $rslt4) : if ($rslt4 == 'k') { ?> checked <?php }
                                                                                                                                                                                            endforeach; ?> />
                                <label class="form-check-label" for="flexCheckDefault"> Kuensel
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="dhi" id="findprogram" name="findprogram[]" <?php foreach ($list as $rslt5) : if ($rslt5 == 'dhi') { ?> checked <?php }
                                                                                                                                                                                                endforeach; ?> />
                                <label class="form-check-label" for="flexCheckDefault"> DHI Wensite
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="address2" class="form-label"><strong>21. I understand and Agree that: The information I have provided on this application is true and complete to the best of my
                                    knowledge. Any misrepresentation or omission of any fact in my application, video clip, or any other material, or during
                                    interviews, can be justify the refusal of my application, or it accepted, the termination from the progra. I hereby authorize DHI
                                    to verify the above information.</strong></label>
                        </div>

                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="agree" <?php if ($application->agree = '1') { ?> checked <?php } ?>>
                                <label class="form-check-label" for="agree">
                                    <b>I agree <font color="red">*</font></b>
                                </label>
                            </div>
                        </div>
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
<script>
    $(document).ready(function() {
        $("#successMessage").delay(2500).slideUp(300);
    });
</script>
<script type="text/javascript">

function validateAndConfirm(){
    var isValid = true;
    // Validate all required fields
    $('#scoreForm :input[required]').each(function() {
      if (!$(this).val().trim()) {
          isValid = false;
          return false; // Exit each loop early if any field is invalid
      }
    });

    if(!isValid) {
        alert("Please fill in all required fields.");
      } else {
        return confirm("Are you sure you want to save the scores?");
      }
}

$(document).ready(function () {
    $("#myTable").on('input', '.txtCal', function () {
        var calculated_total_sum = 0;
        var i =0;
        var avg_score = 0;
        $("#myTable .txtCal").each(function () {
            var get_textbox_value = $(this).val();
            if ($.isNumeric(get_textbox_value)) {
                calculated_total_sum += parseFloat(get_textbox_value);
            }
            i++;
        });
        avg_score = calculated_total_sum/i;
        $("#total_sum_value").html(avg_score);

    });

});
</script>