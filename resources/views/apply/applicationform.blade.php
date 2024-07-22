<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

<x-guest-layout>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BizAP</title>
    </head>
    <div style="width: 100%; height: 30px; border-bottom: 1px solid black; text-align: center">
       <span style="font-size: 20px; background-color: #F3F5F6; padding: 0 10px;">
         DHI Entrepreneurship Training Application Form
       </span>
    </div>
  <div class="container">
   <div class="row">
        <div class="col-md-12 mt-5">
  <p>
  <strong>Applicants are advised to CAREFULLY READ and ensure they FULLY UNDERSTAND all related  instructions before completing the application form. Please note that INCOMPLETE APPLICATION FORMS, FALSE INFORMATION AND FALSE SUPPORTING
  DOCUMENTS will not be processed.</strong>
  </p>
  <hr><br>
         <!-- from start -->
<form class="row g-3" role="form" method="POST" action="{{ route('applytraining') }}" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="hidden" name="trainingid" value="<?php echo $trainingid;?>">
 <div class="form-group col-md-4">
    <label for="cid" class="form-label"><strong>1. CID<font color="red">*</font></strong></label>
    <input type="text" class="form-control" id="email" name="cidd" required="required">
  </div>
  <div class="form-group col-md-4">
    <label for="name" class="form-label"><strong>2. Name<font color="red">*</font></strong></label>
    <input type="text" class="form-control" id="password" name="name" required="required">
  </div>

  <div class="form-group col-md-4">
    <label for="email" class="form-label"><strong>3.Email<font color="red">*</font></strong></label>
    <input type="email" class="form-control" id="email" name="email" required="required">
  </div>
  <div class="form-group col-md-4">
    <label for="name" class="form-label"><strong>4. Mobile No.<font color="red">*</font></strong></label>
    <input type="number" class="form-control" id="password" name="mobileno" required="required">
  </div>

  <div class="form-group col-md-4">
    <label for="name" class="form-label"><strong>5. Date of Birth<font color="red">*</font></strong></label>
    <input type="date" class="form-control" id="password" name="dob" required="required">
  </div>

  <div class="form-group col-md-4">
    <label for="name" class="form-label"><strong>6. Gender<font color="red">*</font></strong></label>
    <select class='form-control' id="ecountry" name="gender" required="required">
           <option value="">Select</option>
           <?php
           foreach($gender as $g):
           ?>
           <option value="{{$g->id}}">{{$g->gender}}</option>
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
           <option value="{{$q->id}}">{{$q->qualification}}</option>
          <?php endforeach ?>
          </select>
  </div>

  <div class="form-group col-md-4">
    <label for="name" class="form-label"><strong>8. Present Address<font color="red">*</font></strong></label>
    <select class='form-control' id="ecountry" name="dzongkhag" required>
           <option value="">Select</option>
           <?php
           foreach($dzongkhag as $d):
           ?>
           <option value="{{$d->dzongkhag_id}}">{{$d->dzongkhag_name}}</option>
          <?php endforeach ?>
          </select>
  </div>

  <div class="form-group col-md-4">
    <label for="name" class="form-label"><strong>9. Current Job Status<font color="red">*</font></strong></label>
    <select class='form-control' id="test"" name="job_status" required>
           <option value="">Select</option>
           <?php
           foreach($jobstatus as $j):
           ?>
           <option value="{{$j->id}}">{{$j->status}}</option>
          <?php endforeach ?>
          </select>
          <div id="yesno" style="display:none;">
          <br>
          <input type="text" class="form-control" placeholder="Specify if Other" name="job_status_other" id="job_status_other" />
          </div>
  </div>
  <div class="col-12">
    <label for="address2" class="form-label"><strong>10. There will be an aftercare program to ensure maximum potential for real world success to the participants.
It will entail two week internship followed by opportunities to work with Bhutanese professional freelancers (contingent
on selection by them). DHI will also provide infrastructure support such as workspace and internet for a period of 6
months. Will you be able to commit to this period?</strong></label>
<select class='form-control' id="commit_period" name="commit_period">
           <option value="1">Yes</option>
           <option value="0">No</option>
          </select>
  </div>

  <div class="col-12">
    <label for="address" class="form-label"><strong>11. It is mandatory to have laptop for this program. Do you have your own laptop/can you manage a laptop for this program?</strong></label>
    <select class='form-control' id="laptop" name="laptop">
           <option value="1">Yes</option>
           <option value="0">No</option>
          </select>
  </div>

  <div class="col-12">
    <label for="address" class="form-label"><strong>12. If selected, can you commit minimum 6-9 hours a week for training? Please make sure no other commitments are made during training weeks</strong></label>
    <select class='form-control' id="commit_hr" name="commit_hr">
           <option value="1">Yes</option>
           <option value="0">No</option>
          </select>
  </div>

  <div class="col-12">
    <label for="address2" class="form-label"><strong>13. Describe a hard challenge you faced and how you overcame it. (Maximum 100 words)</strong></label>
    <textarea class="form-control" id="challenge" name="challenge" rows="5" ></textarea>
  </div>

  <div class="col-12">
    <label for="address2" class="form-label"><strong>14. Please share the YouTube link of 1 minute video of yourself, describing who you are and why you are excited for this
program. Be creative and have fun!.<font color="red">*</font></strong>
<p>
Make sure to give a correct link. The clip will be assessed for shortlisting as well as the final interview. Instructions on how to submit the video
are provided in the tutorial provided in the website announcement. (All videos are confidential and will not be available to the public).
</p>
<p><a href = "{{ url('/uploads/youtube/HOW_TO_UPLOAD_YOUR_VIDEO_ON_YouTube.pdf') }}" target="_blank" >HOW TO UPLOAD YOUR VIDEO ON YouTube GUIDE</a></p>
</label>
<input type="text" class="form-control" id="password" name="youtubelink" required>
</div>

<div class="col-12">
    <label for="address2" class="form-label"><strong>15. Rate your Soft Skills</strong></label>
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
            <td><input class="form-check-input" type="radio" name="communication" value="1"></td>
            <td><input class="form-check-input" type="radio" name="communication" value="2"></td>
            <td><input class="form-check-input" type="radio" name="communication" value="3"></td>
            <td><input class="form-check-input" type="radio" name="communication" value="4"></td>
        </tr>
        <tr>
            <td>2</td>
            <td>Negotiation</td>
            <td><input class="form-check-input" type="radio" name="negotiation" value="1"></td>
            <td><input class="form-check-input" type="radio" name="negotiation" value="2"></td>
            <td><input class="form-check-input" type="radio" name="negotiation" value="3"></td>
            <td><input class="form-check-input" type="radio" name="negotiation" value="4"></td>
        </tr>
        <tr>
            <td>3</td>
            <td>Time Management</td>
            <td><input class="form-check-input" type="radio" name="management" value="1"></td>
            <td><input class="form-check-input" type="radio" name="management" value="2"></td>
            <td><input class="form-check-input" type="radio" name="management" value="3"></td>
            <td><input class="form-check-input" type="radio" name="management" value="4"></td>
        </tr>
        <tr>
            <td>4</td>
            <td>Problem solving skills</td>
            <td><input class="form-check-input" type="radio" name="roblem_solving_skills" value="1"></td>
            <td><input class="form-check-input" type="radio" name="roblem_solving_skills" value="2"></td>
            <td><input class="form-check-input" type="radio" name="roblem_solving_skills" value="3"></td>
            <td><input class="form-check-input" type="radio" name="roblem_solving_skills" value="4"></td>
        </tr>
        <tr>
            <td>5</td>
            <td>Punctuality</td>
            <td><input class="form-check-input" type="radio" name="Punctuality" value="1"></td>
            <td><input class="form-check-input" type="radio" name="Punctuality" value="2"></td>
            <td><input class="form-check-input" type="radio" name="Punctuality" value="3"></td>
            <td><input class="form-check-input" type="radio" name="Punctuality" value="4"></td>
        </tr>
        <tr>
            <td>6</td>
            <td>Teamwork skills</td>
            <td><input class="form-check-input" type="radio" name="Team_Work_Skills" value="1"></td>
            <td><input class="form-check-input" type="radio" name="Team_Work_Skills" value="2"></td>
            <td><input class="form-check-input" type="radio" name="Team_Work_Skills" value="3"></td>
            <td><input class="form-check-input" type="radio" name="Team_Work_Skills" value="4"></td>
        </tr>
        <tr>
            <td>7</td>
            <td>Flexibility</td>
            <td><input class="form-check-input" type="radio" name="flexibility" value="1"></td>
            <td><input class="form-check-input" type="radio" name="flexibility" value="2"></td>
            <td><input class="form-check-input" type="radio" name="flexibility" value="3"></td>
            <td><input class="form-check-input" type="radio" name="flexibility" value="4"></td>
        </tr>
        <tr>
            <td>8</td>
            <td>Ability to accept and learn from criticism</td>
            <td><input class="form-check-input" type="radio" name="criticism" value="1"></td>
            <td><input class="form-check-input" type="radio" name="criticism" value="2"></td>
            <td><input class="form-check-input" type="radio" name="criticism" value="3"></td>
            <td><input class="form-check-input" type="radio" name="criticism" value="4"></td>
        </tr>
        <tr>
            <td>9</td>
            <td>Marketing skills</td>
            <td><input class="form-check-input" type="radio" name="marketingSkills" value="1"></td>
            <td><input class="form-check-input" type="radio" name="marketingSkills" value="2"></td>
            <td><input class="form-check-input" type="radio" name="marketingSkills" value="3"></td>
            <td><input class="form-check-input" type="radio" name="marketingSkills" value="4"></td>
        </tr>
        <tr>
            <td>10</td>
            <td>Passion to learn</td>
            <td><input class="form-check-input" type="radio" name="passiontolearn" value="1"></td>
            <td><input class="form-check-input" type="radio" name="passiontolearn" value="2"></td>
            <td><input class="form-check-input" type="radio" name="passiontolearn" value="3"></td>
            <td><input class="form-check-input" type="radio" name="passiontolearn" value="4"></td>
        </tr>
        <tr>
            <td>11</td>
            <td>Persistency</td>
            <td><input class="form-check-input" type="radio" name="persistency" value="1"></td>
            <td><input class="form-check-input" type="radio" name="persistency" value="2"></td>
            <td><input class="form-check-input" type="radio" name="persistency" value="3"></td>
            <td><input class="form-check-input" type="radio" name="persistency" value="4"></td>
        </tr>

    </tbody>
    </table>
  </div>
  </div>


  <div class="col-12">
    <label for="address2" class="form-label"><strong>16. Rate your Hard Skills</strong></label>
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
            <td>Graphic Design</td>
            <td><input class="form-check-input" type="radio" name="GraphicDesign" value="1"></td>
            <td><input class="form-check-input" type="radio" name="GraphicDesign" value="2"></td>
            <td><input class="form-check-input" type="radio" name="GraphicDesign" value="3"></td>
            <td><input class="form-check-input" type="radio" name="GraphicDesign" value="4"></td>
        </tr>
        <tr>
            <td>2</td>
            <td>Website Design</td>
            <td><input class="form-check-input" type="radio" name="WebsiteDesgn" value="1"></td>
            <td><input class="form-check-input" type="radio" name="WebsiteDesgn" value="2"></td>
            <td><input class="form-check-input" type="radio" name="WebsiteDesgn" value="3"></td>
            <td><input class="form-check-input" type="radio" name="WebsiteDesgn" value="4"></td>
        </tr>
        <tr>
            <td>3</td>
            <td>Photoshop</td>
            <td><input class="form-check-input" type="radio" name="Photoshop" value="1"></td>
            <td><input class="form-check-input" type="radio" name="Photoshop" value="2"></td>
            <td><input class="form-check-input" type="radio" name="Photoshop" value="3"></td>
            <td><input class="form-check-input" type="radio" name="Photoshop" value="4"></td>
        </tr>
        <tr>
            <td>4</td>
            <td>Mobile Development</td>
            <td><input class="form-check-input" type="radio" name="MobileDevelopment" value="1"></td>
            <td><input class="form-check-input" type="radio" name="MobileDevelopment" value="2"></td>
            <td><input class="form-check-input" type="radio" name="MobileDevelopment" value="3"></td>
            <td><input class="form-check-input" type="radio" name="MobileDevelopment" value="4"></td>
        </tr>
        <tr>
            <td>5</td>
            <td>Data Entry</td>
            <td><input class="form-check-input" type="radio" name="DataEntry" value="1"></td>
            <td><input class="form-check-input" type="radio" name="DataEntry" value="2"></td>
            <td><input class="form-check-input" type="radio" name="DataEntry" value="3"></td>
            <td><input class="form-check-input" type="radio" name="DataEntry" value="4"></td>
        </tr>
        <tr>
            <td>6</td>
            <td>Digital Marketing</td>
            <td><input class="form-check-input" type="radio" name="DigitalMarketing" value="1"></td>
            <td><input class="form-check-input" type="radio" name="DigitalMarketing" value="2"></td>
            <td><input class="form-check-input" type="radio" name="DigitalMarketing" value="3"></td>
            <td><input class="form-check-input" type="radio" name="DigitalMarketing" value="4"></td>
        </tr>
        <tr>
            <td>7</td>
            <td>Writing and Translation</td>
            <td><input class="form-check-input" type="radio" name="WritingandTranslation" value="1"></td>
            <td><input class="form-check-input" type="radio" name="WritingandTranslation" value="2"></td>
            <td><input class="form-check-input" type="radio" name="WritingandTranslation" value="3"></td>
            <td><input class="form-check-input" type="radio" name="WritingandTranslation" value="4"></td>
        </tr>
        <tr>
            <td>8</td>
            <td>Video and Animation</td>
            <td><input class="form-check-input" type="radio" name="VideoandAnimation" value="1"></td>
            <td><input class="form-check-input" type="radio" name="VideoandAnimation" value="2"></td>
            <td><input class="form-check-input" type="radio" name="VideoandAnimation" value="3"></td>
            <td><input class="form-check-input" type="radio" name="VideoandAnimation" value="4"></td>
        </tr>
        <tr>
            <td>9</td>
            <td>Music and Audio</td>
            <td><input class="form-check-input" type="radio" name="MusicandAudio" value="1"></td>
            <td><input class="form-check-input" type="radio" name="MusicandAudio" value="2"></td>
            <td><input class="form-check-input" type="radio" name="MusicandAudio" value="3"></td>
            <td><input class="form-check-input" type="radio" name="MusicandAudio" value="4"></td>
        </tr>
        <tr>
            <td>10</td>
            <td>Finance</td>
            <td><input class="form-check-input" type="radio" name="Finance" value="1"></td>
            <td><input class="form-check-input" type="radio" name="Finance" value="2"></td>
            <td><input class="form-check-input" type="radio" name="Finance" value="3"></td>
            <td><input class="form-check-input" type="radio" name="Finance" value="4"></td>
        </tr>
        <tr>
            <td>11</td>
            <td>Health and Fitness</td>
            <td><input class="form-check-input" type="radio" name="HealthandFitness" value="1"></td>
            <td><input class="form-check-input" type="radio" name="HealthandFitness" value="2"></td>
            <td><input class="form-check-input" type="radio" name="HealthandFitness" value="3"></td>
            <td><input class="form-check-input" type="radio" name="HealthandFitness" value="4"></td>
        </tr>
        <tr>
            <td>12</td>
            <td>Others</td>
            <td><input class="form-check-input" type="radio" name="Others" value="1"></td>
            <td><input class="form-check-input" type="radio" name="Others" value="2"></td>
            <td><input class="form-check-input" type="radio" name="Others" value="3"></td>
            <td><input class="form-check-input" type="radio" name="Others" value="4"></td>
        </tr>
    </tbody>
    </table>
  </div>
  </div>

  <div class="col-12">
    <label for="address2" class="form-label"><strong>17. If you answered "Others" in the previous questions, please provide more details.</strong></label>
    <textarea class="form-control" id="oteherdetails" name="oteherdetails" rows="5" ></textarea>
  </div>

  <div class="col-12">
    <label for="address2" class="form-label"><strong>18. Please provide contact details of two referees for your application.</strong></label>
  </div>
  <div class="col-12">
    <label for="address2" class="form-label"><i>Referee 1</i></label>
  </div>

  <div class="form-group col-md-4">
    <label for="cid" class="form-label">Name</label>
    <input type="text" class="form-control" id="email" name="rfname1">
  </div>
  <div class="form-group col-md-4">
    <label for="name" class="form-label">Position</label>
    <input type="text" class="form-control" id="password" name="rfposition1">
  </div>

  <div class="form-group col-md-4">
    <label for="email" class="form-label">Organization</label>
    <input type="text" class="form-control" id="email" name="rforg1">
  </div>
  <div class="form-group col-md-4">
    <label for="name" class="form-label">Relationship</label>
    <input type="text" class="form-control" id="password" name="rfrelation1">
  </div>

  <div class="form-group col-md-4">
    <label for="name" class="form-label">Mobile No.</label>
    <input type="number" class="form-control" id="password" name="rfmobileno1">
  </div>

  <div class="form-group col-md-4">
    <label for="name" class="form-label">Email address</label>
    <input type="email" class="form-control" id="password" name="rfemail1">
  </div>

  <div class="col-12">
    <label for="address2" class="form-label"><i>Referee 2</i></label>
  </div>

  <div class="form-group col-md-4">
    <label for="cid" class="form-label">Name</label>
    <input type="text" class="form-control" id="email" name="rfname2">
  </div>
  <div class="form-group col-md-4">
    <label for="name" class="form-label">Position</label>
    <input type="text" class="form-control" id="password" name="rfposition2">
  </div>

  <div class="form-group col-md-4">
    <label for="email" class="form-label">Organization</label>
    <input type="text" class="form-control" id="email" name="rforg2">
  </div>
  <div class="form-group col-md-4">
    <label for="name" class="form-label">Relationship</label>
    <input type="text" class="form-control" id="password" name="rfrelation2">
  </div>

  <div class="form-group col-md-4">
    <label for="name" class="form-label">Mobile No.</label>
    <input type="number" class="form-control" id="password" name="rfmobileno2">
  </div>

  <div class="form-group col-md-4">
    <label for="name" class="form-label">Email address</label>
    <input type="email" class="form-control" id="password" name="rfemail2">
  </div>

  <div class="col-12">
    <label for="address2" class="form-label"><strong>19. Documents to be submitted.</strong></label>
  </div>

  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">Passport size photo<font color="red">*</font> (jpg/pdf)</label>
  <input type="file" class="form-control" id="customFile" name="passport[]" required />
  </div>
  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">CID <font color="red">*</font>(jpg/pdf)</label>
  <input type="file" class="form-control" id="customFile" name="cid[]" required />
  </div>
  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">Security clearance<font color="red">*</font>(jpg/pdf)</label>
  <input type="file" class="form-control" id="customFile" name="noc[]" required />
  </div>
  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">CV <font color="red">*</font>(jpg/pdf)</label>
  <input type="file" class="form-control" id="customFile" name="cv[]" required />
  </div>
  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">Qualification: Degree / Diploma / Certificate <font color="red">*</font>(jpg/pdf)</label>
  <input type="file" class="form-control" id="customFile" name="certification[]" required />
  </div>
  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">Other supporting documents <font color="red">*</font>(jpg/pdf)</label>
  <input type="file" class="form-control" id="customFile" name="otherdoc[]" required />
  </div>
  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">Examples of your work that may demonstrate your skills<font color="red">*</font></label>
  <input type="file" class="form-control" id="customFile" name="workexample[]" required />
  </div>

  <div class="col-12">
    <label for="address2" class="form-label"><strong>20. Please upload ONLY 1-2 examples of your work that may demonstrate your skills that could be applied to freelancing or
commission of work (if any). These can be samples of artwork, graphic design, writing, audio, etc. that you have created.<font color="red">*</font></strong></label>
  </div>
  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">Attach Sample 1</label>
  <input type="file" class="form-control" id="customFile" name="sample1[]"/>
  </div>
  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">Attach Sample 2</label>
  <input type="file" class="form-control" id="customFile" name="sample2[]"/>
  </div>

  <div class="col-12">
    <label for="address2" class="form-label"><strong>21. How did you find about this program ?</strong></label>
  </div>
  <div class="form-group col-md-6">
    <div class="form-check">
    <input class="form-check-input" type="checkbox" value="fb" id="findprogram" name="findprogram[]"/>
    <label class="form-check-label" for="flexCheckDefault"> Facebook
    </label>
    </div>
  </div>
  <div class="form-group col-md-6">
    <div class="form-check">
    <input class="form-check-input" type="checkbox" value="fw" id="findprogram" name="findprogram[]" />
    <label class="form-check-label" for="flexCheckDefault"> Friend/Word of Mouth
    </label>
    </div>
  </div>
  <div class="form-group col-md-6">
    <div class="form-check">
    <input class="form-check-input" type="checkbox" value="bbs" id="findprogram" name="findprogram[]" />
    <label class="form-check-label" for="flexCheckDefault"> BBS
    </label>
    </div>
  </div>
  <div class="form-group col-md-6">
    <div class="form-check">
    <input class="form-check-input" type="checkbox" value="k" id="findprogram" name="findprogram[]" />
    <label class="form-check-label" for="flexCheckDefault"> Kuensel
    </label>
    </div>
  </div>
  <div class="form-group col-md-6">
    <div class="form-check">
    <input class="form-check-input" type="checkbox" value="dhi" id="findprogram" name="findprogram[]" />
    <label class="form-check-label" for="flexCheckDefault"> DHI Website
    </label>
    </div>
  </div>

  <div class="col-12">
    <label for="address2" class="form-label"><strong>22. I understand and agree that: The information I have provided in this application is true and complete to the best of my
knowledge. Any misrepresentation or omission of any fact in my application, video clip, or any other material(s), or during
interviews, can justify the refusal of my application, or if accepted, the termination from the program. I hereby authorize DHI
to verify the above information.</strong></label>
  </div>

  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="agree" value="1" required="required">
      <label class="form-check-label" for="agree">
        <b>I agree <font color="red">*</font></b>
      </label>
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
<!-- from end -->
</div>
</div>
</div>
</x-app-layout>
<script type="text/javascript">
    $('#test').on('change', function() {
      $('#job_status_other').val('');
        if (this.value == "3") {
            $('#yesno').show();
            $('#job_status_other').prop('required', true);
        }else{
          $('#yesno').hide();
          $('#job_status_other').prop('required', false);
        }
    });
</script>

