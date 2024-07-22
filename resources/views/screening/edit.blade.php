<x-app-layout>
    @include('top_nav_bar')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container" >
                    <br>
                    <div class="row">
                            <div class="form-group col-md-4">
                                <label for="cid" class="form-label"><strong>Training Applied for:&nbsp;
                                <?php $tid =  App\Models\TrainingApplication::where('id', $appid)->value('trainingid');
                                echo App\Models\Training::where('id', $tid)->value('training_title');
                                ?></strong></label>
                            </div>
                         <hr>
                        <?php foreach ($application as $app) : ?>
<form class="row g-3" role="form" method="POST" action="{{ route('updatetraining') }}" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="hidden" name="trainingid" value="<?php echo $tid;?>">
      <input type="hidden" name="appid" value="<?php echo $appid;?>">
 <div class="form-group col-md-4">
    <label for="cid" class="form-label"><strong>1. CID<font color="red">*</font></strong></label>
    <input type="text" class="form-control" id="email" name="cidd" required="required" value="{{$app->cid}}">
  </div>
  <div class="form-group col-md-4">
    <label for="name" class="form-label"><strong>2. Name<font color="red">*</font></strong></label>
    <input type="text" class="form-control" id="password" name="name" required="required" value="{{$app->name}}">
 </div>

  <div class="form-group col-md-4">
    <label for="email" class="form-label"><strong>3.Email<font color="red">*</font></strong></label>
    <input type="email" class="form-control" id="email" name="email" required="required" value="{{$app->email}}">
  </div>
  <div class="form-group col-md-4">
    <label for="name" class="form-label"><strong>4. Mobile No.<font color="red">*</font></strong></label>
    <input type="number" class="form-control" id="password" name="mobileno" required="required" value="{{$app->mobileno}}">
  </div>

  <div class="form-group col-md-4">
    <label for="name" class="form-label"><strong>5. Date of Birth<font color="red">*</font></strong></label>
    <input type="date" class="form-control" id="password" name="dob" required="required" value="{{$app->dob}}">
  </div>

  <div class="form-group col-md-4">
    <label for="name" class="form-label"><strong>6. Gender<font color="red">*</font></strong></label>
    <select class='form-control' id="ecountry" name="gender" required="required">
           <option value="">Select</option>
           <?php
           foreach($gender as $g):
           ?>
           <option value="{{$g->id}}" <?php if($app->gender == $g->id) { ?>selected<?php } ?>>{{$g->gender}}</option>
          <?php endforeach ?>
          </select>
  </div>

  <div class="form-group col-md-4">
    <label for="name" class="form-label"><strong>7. Qualification<font color="red">*</font></strong></label>
    <select class='form-control' id="ecountry" name="qualification" required="required">
           <option value="">Select</option>
           <?php
           foreach($qualification as $q):
           ?>
           <option value="{{$q->id}}" <?php if($app->qualification == $q->id) { ?>selected<?php } ?>>{{$q->qualification}}</option>
          <?php endforeach ?>
          </select>
  </div>

  <div class="form-group col-md-4">
    <label for="name" class="form-label"><strong>8. Dzongkhag<font color="red">*</font></strong></label>
    <select class='form-control' id="ecountry" name="dzongkhag" >
           <option value="">Select</option>
           <?php
           foreach($dzongkhag as $d):
           ?>
           <option value="{{$d->dzongkhag_id}}" <?php if($app->dzongkhag == $d->dzongkhag_id) { ?>selected<?php } ?>>{{$d->dzongkhag_name}}</option>
          <?php endforeach ?>
          </select>
  </div>

  <div class="form-group col-md-4">
    <label for="name" class="form-label"><strong>9. Current Job Status<font color="red">*</font></strong></label>
    <select class='form-control' id="ecountry" name="job_status" >
           <option value="">Select</option>
           <?php
           foreach($jobstatus as $j):
           ?>
           <option value="{{$j->id}}" <?php if($app->job_status == $j->id) { ?>selected<?php } ?>>{{$j->status}}</option>
          <?php endforeach ?>
          </select>
  </div>

  <div class="col-12">
    <label for="address" class="form-label"><strong>10. If Selected, can you commit 6-8 hours a week for training from 45 Hours<font color="red">*</font></strong></label>
    <select class='form-control' id="commit_hr" name="commit_hr">
           <option value="1" <?php if($app->commit_hr == '1') { ?>selected<?php } ?>>Yes</option>
           <option value="0" <?php if($app->commit_hr == '0') { ?>selected<?php } ?>>No</option>
          </select>
  </div>
  <div class="col-12">
    <label for="address2" class="form-label"><strong>11. There will be an aftercare program to ensure the maximum potential for real world success to the participants.
It will entail two week internship followed by opportunities to work with Bhutanese Professional freelancers (contingent
on selection by them). DHI will also provide infrastructure support such as workspace and internet for a period of 6
months. Will you be able to commit to this period?</strong></label>
<select class='form-control' id="commit_period" name="commit_period">
           <option value="1" <?php if($app->commit_period == '1') { ?>selected<?php } ?>>Yes</option>
           <option value="0" <?php if($app->commit_period == '0') { ?>selected<?php } ?>>No</option>
          </select>
  </div>

  <div class="col-12">
    <label for="address2" class="form-label"><strong>12. Decribe a hard challenge you faced and how you overcame it. (Maximum 100 words)</strong></label>
    <textarea class="form-control" id="challenge" name="challenge" rows="5" >{{ $app->challenge}}</textarea>
  </div>

  <div class="col-12">
    <label for="address2" class="form-label"><strong>13. Please share the YouTube link of a 1 minute video of yourself describing who you are and why you are exited for this
program. Be creative and have fun!.<font color="red">*</font></strong>
<p>
Make sure to give a correct link. The clip will be assessed for shortlisting as well as the final interview. Instructions on how to submit the video
are provided in the tutorial provided in the website announcement. (All videos are confidential and will not be available to the public.
</p>
<p><a href = "{{ url('/uploads/youtube/HOW_TO_UPLOAD_YOUR_VIDEO_ON_YouTube.pdf') }}" target="_blank" >HOW TO UPLOAD YOUR VIDEO ON YouTube GUIDE</a></p>
</label>
<input type="text" class="form-control" id="password" name="youtubelink" value="{{$app->youtubelink}}">
</div>

<div class="col-12">
    <label for="address2" class="form-label"><strong>14. Rate your Soft Skills</strong></label>
    <div class="table-responsive">
    <?php foreach ($softskill as $ss) : ?>
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
                                                    <td><input name="communication" class="form-check-input" type="radio" value="1" <?php if ($ss->Communication == '1') { ?>checked<?php } ?>></td>
                                                    <td><input name="communication" class="form-check-input" type="radio" value="2" <?php if ($ss->Communication == '2') { ?>checked<?php } ?>></td>
                                                    <td><input name="communication" class="form-check-input" type="radio" value="3" <?php if ($ss->Communication == '3') { ?>checked<?php } ?>></td>
                                                    <td><input name="communication" class="form-check-input" type="radio" value="4" <?php if ($ss->Communication == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Negotiation</td>
                                                    <td><input name="negotiation" class="form-check-input" type="radio" value="1" <?php if ($ss->Negotiation == '1') { ?>checked<?php } ?>></td>
                                                    <td><input name="negotiation" class="form-check-input" type="radio" value="2" <?php if ($ss->Negotiation == '2') { ?>checked<?php } ?>></td>
                                                    <td><input name="negotiation" class="form-check-input" type="radio" value="3" <?php if ($ss->Negotiation == '3') { ?>checked<?php } ?>></td>
                                                    <td><input name="negotiation" class="form-check-input" type="radio" value="4" <?php if ($ss->Negotiation == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Time Management</td>
                                                    <td><input name="management" class="form-check-input" type="radio" value="1" <?php if ($ss->TimeManagement == '1') { ?>checked<?php } ?>></td>
                                                    <td><input name="management"class="form-check-input" type="radio" value="2" <?php if ($ss->TimeManagement == '2') { ?>checked<?php } ?>></td>
                                                    <td><input name="management" class="form-check-input" type="radio" value="3" <?php if ($ss->TimeManagement == '3') { ?>checked<?php } ?>></td>
                                                    <td><input name="management" class="form-check-input" type="radio" value="4" <?php if ($ss->TimeManagement == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Problem Solving Skills</td>
                                                    <td><input name="roblem_solving_skills" class="form-check-input" type="radio" value="1" <?php if ($ss->ProblemSolvingSkills == '1') { ?>checked<?php } ?>></td>
                                                    <td><input name="roblem_solving_skills" class="form-check-input" type="radio" value="2" <?php if ($ss->ProblemSolvingSkills == '2') { ?>checked<?php } ?>></td>
                                                    <td><input name="roblem_solving_skills" class="form-check-input" type="radio" value="3" <?php if ($ss->ProblemSolvingSkills == '3') { ?>checked<?php } ?>></td>
                                                    <td><input name="roblem_solving_skills" class="form-check-input" type="radio" value="4" <?php if ($ss->ProblemSolvingSkills == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Punctuality</td>
                                                    <td><input name="Punctuality" class="form-check-input" type="radio" value="1" <?php if ($ss->Punctuality == '1') { ?>checked<?php } ?>></td>
                                                    <td><input name="Punctuality" class="form-check-input" type="radio" value="2" <?php if ($ss->Punctuality == '2') { ?>checked<?php } ?>></td>
                                                    <td><input name="Punctuality" class="form-check-input" type="radio" value="3" <?php if ($ss->Negotiation == '3') { ?>checked<?php } ?>></td>
                                                    <td><input name="Punctuality" class="form-check-input" type="radio" value="4" <?php if ($ss->Punctuality == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>Team Work Skills</td>
                                                    <td><input name="Team_Work_Skills" class="form-check-input" type="radio" value="1" <?php if ($ss->TeamWorkSkills == '1') { ?>checked<?php } ?>></td>
                                                    <td><input name="Team_Work_Skills" class="form-check-input" type="radio" value="2" <?php if ($ss->TeamWorkSkills == '2') { ?>checked<?php } ?>></td>
                                                    <td><input name="Team_Work_Skills" class="form-check-input" type="radio" value="3" <?php if ($ss->TeamWorkSkills == '3') { ?>checked<?php } ?>></td>
                                                    <td><input name="Team_Work_Skills" class="form-check-input" type="radio" value="4" <?php if ($ss->TeamWorkSkills == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>7</td>
                                                    <td>Flexibility</td>
                                                    <td><input name="flexibility" class="form-check-input" type="radio" value="1" <?php if ($ss->Flexibility == '1') { ?>checked<?php } ?>></td>
                                                    <td><input name="flexibility" class="form-check-input" type="radio" value="2" <?php if ($ss->Flexibility == '2') { ?>checked<?php } ?>></td>
                                                    <td><input name="flexibility" class="form-check-input" type="radio" value="3" <?php if ($ss->Flexibility == '3') { ?>checked<?php } ?>></td>
                                                    <td><input name="flexibility" class="form-check-input" type="radio" value="4" <?php if ($ss->Flexibility == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>8</td>
                                                    <td>Ability to accept and learn from criticism</td>
                                                    <td><input name="criticism" class="form-check-input" type="radio" value="1" <?php if ($ss->Abilitytoacceptandlearnfromcriticism == '1') { ?>checked<?php } ?>></td>
                                                    <td><input name="criticism" class="form-check-input" type="radio" value="2" <?php if ($ss->Abilitytoacceptandlearnfromcriticism == '2') { ?>checked<?php } ?>></td>
                                                    <td><input name="criticism" class="form-check-input" type="radio" value="3" <?php if ($ss->Abilitytoacceptandlearnfromcriticism == '3') { ?>checked<?php } ?>></td>
                                                    <td><input name="criticism" class="form-check-input" type="radio" value="4" <?php if ($ss->Abilitytoacceptandlearnfromcriticism == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>9</td>
                                                    <td>Marketing Skills</td>
                                                    <td><input name="marketingSkills" class="form-check-input" type="radio" value="1" <?php if ($ss->MarketingSkills == '1') { ?>checked<?php } ?>></td>
                                                    <td><input name="marketingSkills" class="form-check-input" type="radio" value="2" <?php if ($ss->MarketingSkills == '2') { ?>checked<?php } ?>></td>
                                                    <td><input name="marketingSkills" class="form-check-input" type="radio" value="3" <?php if ($ss->MarketingSkills == '3') { ?>checked<?php } ?>></td>
                                                    <td><input name="marketingSkills" class="form-check-input" type="radio" value="4" <?php if ($ss->MarketingSkills == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>10</td>
                                                    <td>Passion to learn</td>
                                                    <td><input name="passiontolearn" class="form-check-input" type="radio" value="1" <?php if ($ss->Passiontolearn == '1') { ?>checked<?php } ?>></td>
                                                    <td><input name="passiontolearn" class="form-check-input" type="radio" value="2" <?php if ($ss->Passiontolearn == '2') { ?>checked<?php } ?>></td>
                                                    <td><input name="passiontolearn" class="form-check-input" type="radio" value="3" <?php if ($ss->Passiontolearn == '3') { ?>checked<?php } ?>></td>
                                                    <td><input name="passiontolearn" class="form-check-input" type="radio" value="4" <?php if ($ss->Passiontolearn == '4') { ?>checked<?php } ?>></td>
                                                </tr>
                                                <tr>
                                                    <td>11</td>
                                                    <td>Persistency</td>
                                                    <td><input name="persistency" class="form-check-input" type="radio" value="1" <?php if ($ss->Persistency == '1') { ?>checked<?php } ?>></td>
                                                    <td><input name="persistency" class="form-check-input" type="radio" value="2" <?php if ($ss->Persistency == '2') { ?>checked<?php } ?>></td>
                                                    <td><input name="persistency" class="form-check-input" type="radio" value="3" <?php if ($ss->Persistency == '3') { ?>checked<?php } ?>></td>
                                                    <td><input name="persistency" class="form-check-input" type="radio" value="4" <?php if ($ss->Persistency == '4') { ?>checked<?php } ?>></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    <?php endforeach; ?>
  </div>
  </div>


  <div class="col-12">
    <label for="address2" class="form-label"><strong>15. Rate your Hard Skills</strong></label>
    <div class="table-responsive">
    <?php foreach ($hardskill as $hs) : ?>
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
            <td><input class="form-check-input" type="radio" name="GraphicDesign" value="1" <?php if ($hs->GraphicDesign == '1') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="GraphicDesign" value="2" <?php if ($hs->GraphicDesign == '2') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="GraphicDesign" value="3" <?php if ($hs->GraphicDesign == '3') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="GraphicDesign" value="4" <?php if ($hs->GraphicDesign == '4') { ?>checked<?php } ?>></td>
        </tr>
        <tr>
            <td>2</td>
            <td>Website Desgn</td>
            <td><input class="form-check-input" type="radio" name="WebsiteDesgn" value="1" <?php if ($hs->WebsiteDesgn == '1') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="WebsiteDesgn" value="2" <?php if ($hs->WebsiteDesgn == '2') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="WebsiteDesgn" value="3" <?php if ($hs->WebsiteDesgn == '3') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="WebsiteDesgn" value="4" <?php if ($hs->WebsiteDesgn == '4') { ?>checked<?php } ?>></td>
        </tr>
        <tr>
            <td>3</td>
            <td>Photoshop</td>
            <td><input class="form-check-input" type="radio" name="Photoshop" value="1" <?php if ($hs->Photoshop == '1') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="Photoshop" value="2" <?php if ($hs->Photoshop == '2') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="Photoshop" value="3" <?php if ($hs->Photoshop == '3') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="Photoshop" value="4" <?php if ($hs->Photoshop == '4') { ?>checked<?php } ?>></td>
        </tr>
        <tr>
            <td>4</td>
            <td>Mobile Development</td>
            <td><input class="form-check-input" type="radio" name="MobileDevelopment" value="1" <?php if ($hs->MobileDevelopment == '1') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="MobileDevelopment" value="2" <?php if ($hs->MobileDevelopment == '2') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="MobileDevelopment" value="3" <?php if ($hs->MobileDevelopment == '3') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="MobileDevelopment" value="4" <?php if ($hs->MobileDevelopment == '4') { ?>checked<?php } ?>></td>
        </tr>
        <tr>
            <td>5</td>
            <td>Data Entry</td>
            <td><input class="form-check-input" type="radio" name="DataEntry" value="1" <?php if ($hs->DataEntry == '1') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="DataEntry" value="2" <?php if ($hs->DataEntry == '2') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="DataEntry" value="3" <?php if ($hs->DataEntry == '3') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="DataEntry" value="4" <?php if ($hs->DataEntry == '4') { ?>checked<?php } ?>></td>
        </tr>
        <tr>
            <td>6</td>
            <td>Digital Marketing</td>
            <td><input class="form-check-input" type="radio" name="DigitalMarketing" value="1" <?php if ($hs->DigitalMarketing == '1') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="DigitalMarketing" value="2" <?php if ($hs->DigitalMarketing == '2') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="DigitalMarketing" value="3" <?php if ($hs->DigitalMarketing == '3') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="DigitalMarketing" value="4" <?php if ($hs->DigitalMarketing == '4') { ?>checked<?php } ?>></td>
        </tr>
        <tr>
            <td>7</td>
            <td>Writing and Translation</td>
            <td><input class="form-check-input" type="radio" name="WritingandTranslation" value="1" <?php if ($hs->WritingandTranslation == '1') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="WritingandTranslation" value="2" <?php if ($hs->WritingandTranslation == '2') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="WritingandTranslation" value="3" <?php if ($hs->WritingandTranslation == '3') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="WritingandTranslation" value="4" <?php if ($hs->WritingandTranslation == '4') { ?>checked<?php } ?>></td>
        </tr>
        <tr>
            <td>8</td>
            <td>Video and Animation</td>
            <td><input class="form-check-input" type="radio" name="VideoandAnimation" value="1" <?php if ($hs->VideoandAnimation == '1') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="VideoandAnimation" value="2" <?php if ($hs->VideoandAnimation == '2') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="VideoandAnimation" value="3" <?php if ($hs->VideoandAnimation == '3') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="VideoandAnimation" value="4" <?php if ($hs->VideoandAnimation == '4') { ?>checked<?php } ?>></td>
        </tr>
        <tr>
            <td>9</td>
            <td>Music and Audio</td>
            <td><input class="form-check-input" type="radio" name="MusicandAudio" value="1" <?php if ($hs->MusicandAudio == '1') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="MusicandAudio" value="2" <?php if ($hs->MusicandAudio == '2') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="MusicandAudio" value="3" <?php if ($hs->MusicandAudio == '3') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="MusicandAudio" value="4" <?php if ($hs->MusicandAudio == '4') { ?>checked<?php } ?>></td>
        </tr>
        <tr>
            <td>10</td>
            <td>Finance</td>
            <td><input class="form-check-input" type="radio" name="Finance" value="1" <?php if ($hs->Finance == '1') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="Finance" value="2" <?php if ($hs->Finance == '2') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="Finance" value="3" <?php if ($hs->Finance == '3') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="Finance" value="4" <?php if ($hs->Finance == '4') { ?>checked<?php } ?>></td>
        </tr>
        <tr>
            <td>11</td>
            <td>Health and Fitness</td>
            <td><input class="form-check-input" type="radio" name="HealthandFitness" value="1" <?php if ($hs->HealthandFitness == '1') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="HealthandFitness" value="2" <?php if ($hs->HealthandFitness == '2') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="HealthandFitness" value="3" <?php if ($hs->HealthandFitness == '3') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="HealthandFitness" value="4" <?php if ($hs->HealthandFitness == '4') { ?>checked<?php } ?>></td>
        </tr>
        <tr>
            <td>12</td>
            <td>Others</td>
            <td><input class="form-check-input" type="radio" name="Others" value="1" <?php if ($hs->Others == '1') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="Others" value="2" <?php if ($hs->Others == '2') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="Others" value="3" <?php if ($hs->Others == '3') { ?>checked<?php } ?>></td>
            <td><input class="form-check-input" type="radio" name="Others" value="4" <?php if ($hs->Others == '4') { ?>checked<?php } ?>></td>
        </tr>
    </tbody>
    </table>
    <?php endforeach; ?>
  </div>
  </div>

  <div class="col-12">
    <label for="address2" class="form-label"><strong>16. If you answered "Other" in the previous questions, please provide more details.</strong></label>
    <textarea class="form-control" id="oteherdetails" name="oteherdetails" rows="5" ></textarea>
  </div>

  <div class="col-12">
    <label for="address2" class="form-label"><strong>17. Please provide contact details of two referees for your application.</strong></label>
  </div>
  <div class="col-12">
    <label for="address2" class="form-label"><i>Referee 1</i></label>
  </div>

  <div class="form-group col-md-4">
    <label for="cid" class="form-label">Name</label>
    <input type="text" class="form-control" id="email" name="rfname1" value="{{$app->rfname1}}">
  </div>
  <div class="form-group col-md-4">
    <label for="name" class="form-label">Position</label>
    <input type="text" class="form-control" id="password" name="rfposition1" value="{{$app->rfposition1}}">
  </div>

  <div class="form-group col-md-4">
    <label for="email" class="form-label">Organization</label>
    <input type="text" class="form-control" id="email" name="rforg1" value="{{$app->rforg1}}">
  </div>
  <div class="form-group col-md-4">
    <label for="name" class="form-label">Relationship</label>
    <input type="text" class="form-control" id="password" name="rfrelation1" value="{{$app->rfrelation1}}">
  </div>

  <div class="form-group col-md-4">
    <label for="name" class="form-label">Mobile No.</label>
    <input type="number" class="form-control" id="password" name="rfmobileno1" value="{{$app->rfmobileno1}}">
  </div>

  <div class="form-group col-md-4">
    <label for="name" class="form-label">Email Address</label>
    <input type="email" class="form-control" id="password" name="rfemail1" value="{{$app->rfemail1}}">
  </div>

  <div class="col-12">
    <label for="address2" class="form-label"><i>Referee 2</i></label>
  </div>

  <div class="form-group col-md-4">
    <label for="cid" class="form-label">Name</label>
    <input type="text" class="form-control" id="email" name="rfname2" value="{{$app->rfname2}}">
  </div>
  <div class="form-group col-md-4">
    <label for="name" class="form-label">Position</label>
    <input type="text" class="form-control" id="password" name="rfposition2" value="{{$app->rfposition2}}">
  </div>

  <div class="form-group col-md-4">
    <label for="email" class="form-label">Organization</label>
    <input type="text" class="form-control" id="email" name="rforg2" value="{{$app->rforg2}}">
  </div>
  <div class="form-group col-md-4">
    <label for="name" class="form-label">Relationship</label>
    <input type="text" class="form-control" id="password" name="rfrelation2" value="{{$app->rfrelation2}}">
  </div>

  <div class="form-group col-md-4">
    <label for="name" class="form-label">Mobile No.</label>
    <input type="number" class="form-control" id="password" name="rfmobileno2" value="{{$app->rfmobileno2}}">
  </div>

  <div class="form-group col-md-4">
    <label for="name" class="form-label">Email Address</label>
    <input type="email" class="form-control" id="password" name="rfemail2" value="{{$app->rfemail2}}">
  </div>

  <div class="col-12">
    <label for="address2" class="form-label"><strong>18. Documents to Be Submitted.</strong></label>
  </div>

  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">Passport Size Photo (jpg/pdf)</label>
  <?php $docs = App\Models\ApplicationDocs::where('appid', $appid)->where('filecat', 'passport')->get();
                            $dcount = count(App\Models\ApplicationDocs::where('appid', $appid)->where('filecat', 'passport')->get()); ?>
                            @if($dcount == 0)
                            <font color="red">No Documents Found </font>
                            @else
                            <?php $did = 1; ?>
                            @foreach($docs as $d)
                            <?php $filename = $d->file_name; ?>
                            <a href="{{ url('/uploads/applicationdocs/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $d->file_name; ?></a><br>
                            @endforeach
                            @endif
  <input type="file" class="form-control" id="customFile" name="passport[]" />
  </div>
  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">CID (jpg/pdf)</label>
  <?php $docs = App\Models\ApplicationDocs::where('appid', $appid)->where('filecat', 'cid')->get();
                            $dcount = count(App\Models\ApplicationDocs::where('appid', $appid)->where('filecat', 'cid')->get()); ?>
                            @if($dcount == 0)
                            <font color="red">No Documents Found </font>
                            @else
                            <?php $did = 1; ?>
                            @foreach($docs as $d)
                            <?php $filename = $d->file_name;; ?>
                            <a href="{{ url('/uploads/applicationdocs/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $d->file_name; ?></a><br>
                            @endforeach
                            @endif
  <input type="file" class="form-control" id="customFile" name="cid[]"/>
  </div>
  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">No Objection Certificate (NOC) (jpg/pdf)</label>
  <?php $docs = App\Models\ApplicationDocs::where('appid', $appid)->where('filecat', 'noc')->get();
                            $dcount = count(App\Models\ApplicationDocs::where('appid', $appid)->where('filecat', 'noc')->get()); ?>
                            @if($dcount == 0)
                            <font color="red">No Documents Found </font>
                            @else
                            <?php $did = 1; ?>
                            @foreach($docs as $d)
                            <?php $filename = $d->file_name; ?>
                            <a href="{{ url('/uploads/applicationdocs/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $d->file_name; ?></a><br>
                            @endforeach
                            @endif
  <input type="file" class="form-control" id="customFile" name="noc[]"/>
  </div>
  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">CV(jpg/pdf)</label>
  <?php $docs = App\Models\ApplicationDocs::where('appid', $appid)->where('filecat', 'cv')->get();
                            $dcount = count(App\Models\ApplicationDocs::where('appid', $appid)->where('filecat', 'cv')->get()); ?>
                            @if($dcount == 0)
                            <font color="red">No Documents Found </font>
                            @else
                            <?php $did = 1; ?>
                            @foreach($docs as $d)
                            <?php $filename = $d->file_name; ?>
                            <a href="{{ url('/uploads/applicationdocs/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $d->file_name; ?></a><br>
                            @endforeach
                            @endif
  <input type="file" class="form-control" id="customFile" name="cv[]"/>
  </div>
  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">Qualification: Degree / Diploma / Certification (jpg/pdf)</label>
  <?php $docs = App\Models\ApplicationDocs::where('appid', $appid)->where('filecat', 'certificate')->get();
                            $dcount = count(App\Models\ApplicationDocs::where('appid', $appid)->where('filecat', 'certificate')->get()); ?>
                            @if($dcount == 0)
                            <font color="red">No Documents Found </font>
                            @else
                            <?php $did = 1; ?>
                            @foreach($docs as $d)
                            <?php $filename = $d->file_name; ?>
                            <a href="{{ url('/uploads/applicationdocs/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $d->file_name; ?></a><br>
                            @endforeach
                            @endif
  <input type="file" class="form-control" id="customFile" name="certification[]"/>
  </div>
  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">Other Supporting Documents (jpg/pdf)</label>
  <?php $docs = App\Models\ApplicationDocs::where('appid', $appid)->where('filecat', 'supporting')->get();
                            $dcount = count(App\Models\ApplicationDocs::where('appid', $appid)->where('filecat', 'supporting')->get()); ?>
                            @if($dcount == 0)
                            <font color="red">No Documents Found </font>
                            @else
                            <?php $did = 1; ?>
                            @foreach($docs as $d)
                            <?php $filename = $d->file_name; ?>
                            <a href="{{ url('/uploads/applicationdocs/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $d->file_name; ?></a><br>
                            @endforeach
                            @endif
  <input type="file" class="form-control" id="customFile" name="otherdoc[]"/>
  </div>
  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">Examples of your work that may Demonstrate your skills<font color="red">*</font></label>
  <?php $docs = App\Models\ApplicationDocs::where('appid', $appid)->where('filecat', 'workexample')->get();
                            $dcount = count(App\Models\ApplicationDocs::where('appid', $appid)->where('filecat', 'workexample')->get()); ?>
                            @if($dcount == 0)
                            <font color="red">No Documents Found </font>
                            @else
                            <?php $did = 1; ?>
                            @foreach($docs as $d)
                            <?php $filename = $d->file_name; ?>
                            <a href="{{ url('/uploads/applicationdocs/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $d->file_name; ?></a><br>
                            @endforeach
                            @endif
  <input type="file" class="form-control" id="customFile" name="workexample[]"/>
  </div>

  <div class="col-12">
    <label for="address2" class="form-label"><strong>19. Please upload ONLY 1-2 examples of your work that may demostrate your skills that could be applied to freelancing or
commission work (if any). These can be samples of artwork, graphic design, writing, audio, etc. the you have created.<font color="red">*</font></strong></label>
  </div>
  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">Attach Sample 1</label>
  <?php $docs = App\Models\ApplicationDocs::where('appid', $appid)->where('filecat', 'sample1')->get();
                            $dcount = count(App\Models\ApplicationDocs::where('appid', $appid)->where('filecat', 'sample1')->get()); ?>
                            @if($dcount == 0)
                            <font color="red">No Documents Found </font>
                            @else
                            <?php $did = 1; ?>
                            @foreach($docs as $d)
                            <?php $filename = $d->file_name; ?>
                            <a href="{{ url('/uploads/applicationdocs/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $d->file_name; ?></a><br>
                            @endforeach
                            @endif
  <input type="file" class="form-control" id="customFile" name="sample1[]"/>
  </div>
  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">Attach Sample 2</label>
  <?php $docs = App\Models\ApplicationDocs::where('appid', $appid)->where('filecat', 'sample2')->get();
                            $dcount = count(App\Models\ApplicationDocs::where('appid', $appid)->where('filecat', 'sample2')->get()); ?>
                            @if($dcount == 0)
                            <font color="red">No Documents Found </font>
                            @else
                            <?php $did = 1; ?>
                            @foreach($docs as $d)
                            <?php $filename = $d->file_name; ?>
                            <a href="{{ url('/uploads/applicationdocs/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $d->file_name; ?></a><br>
                            @endforeach
                            @endif
  <input type="file" class="form-control" id="customFile" name="sample2[]"/>
  </div>

  <div class="col-12">
    <label for="address2" class="form-label"><strong>20. How did you find about this program ?</strong></label>
  </div>
  <?php $list = explode(',', $app->awareness); ?>
  <div class="form-group col-md-6">
    <div class="form-check">
    <input class="form-check-input" type="checkbox" value="fb" id="findprogram" name="findprogram[]" <?php foreach ($list as $rslt1) : if ($rslt1 == 'fb') { ?> checked <?php } endforeach; ?>/>
    <label class="form-check-label" for="flexCheckDefault"> Facebook
    </label>
    </div>
  </div>
  <div class="form-group col-md-6">
    <div class="form-check">
    <input class="form-check-input" type="checkbox" value="fw" id="findprogram" name="findprogram[]" <?php foreach ($list as $rslt2) : if ($rslt2 == 'fw') { ?> checked <?php } endforeach; ?>/>
    <label class="form-check-label" for="flexCheckDefault"> Friend / Word of Mouth
    </label>
    </div>
  </div>
  <div class="form-group col-md-6">
    <div class="form-check">
    <input class="form-check-input" type="checkbox" value="bbs" id="findprogram" name="findprogram[]" <?php foreach ($list as $rslt3) : if ($rslt3 == 'bbs') { ?> checked <?php } endforeach; ?>/>
    <label class="form-check-label" for="flexCheckDefault"> BBS
    </label>
    </div>
  </div>
  <div class="form-group col-md-6">
    <div class="form-check">
    <input class="form-check-input" type="checkbox" value="k" id="findprogram" name="findprogram[]" <?php foreach ($list as $rslt4) : if ($rslt4 == 'k') { ?> checked <?php } endforeach; ?>/>
    <label class="form-check-label" for="flexCheckDefault"> Kuensel
    </label>
    </div>
  </div>
  <div class="form-group col-md-6">
    <div class="form-check">
    <input class="form-check-input" type="checkbox" value="dhi" id="findprogram" name="findprogram[]" <?php foreach ($list as $rslt5) : if ($rslt5 == 'dhi') { ?> checked <?php } endforeach; ?>/>
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
      <input class="form-check-input" type="checkbox" name="agree" value="1" required="required" <?php if ($app->agree = '1') { ?> checked <?php } ?>>
      <label class="form-check-label" for="agree">
        <b>I agree <font color="red">*</font></b>
      </label>
    </div>
  </div>
  <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm" onclick='return confirm("Are you sure to Update ?")' >Update</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
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
