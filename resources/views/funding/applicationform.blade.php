<x-app-layout>
  @include('top_nav_bar')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
  <div class="container">
   <div class="row">
        <div class="col-md-12 mt-5">
        @include('flash-message')
  <p>
  <strong>Applicants are advised to CAREFULLY READ and ensure they FULLY UNDERSTAND all related  instructions before completing the application form. Please note that INCOMPLETE APPLICATION FORMS, FALSE INFORMATION AND FALSE SUPPORTING
  DOCUMENTS will not be processed.</strong>
  </p>
         <!-- from start -->
<form class="row g-3" role="form" method="POST" action="{{ route('applytraining') }}" enctype="multipart/form-data">
      {{ csrf_field() }}
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
    <label for="name" class="form-label"><strong>8. Dzongkhag<font color="red">*</font></strong></label>
    <select class='form-control' id="ecountry" name="dzongkhag" required="required">
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
    <select class='form-control' id="ecountry" name="job_status" required="required">
           <option value="">Select</option>
           <?php
           foreach($jobstatus as $j):
           ?>
           <option value="{{$j->id}}">{{$j->status}}</option>
          <?php endforeach ?>
          </select>
  </div>

  <div class="col-12">
    <label for="address" class="form-label"><strong>10. If Selected, can you commit 6-8 hours a week for training from 45 Hours<font color="red">*</font></strong></label>
    <select class='form-control' id="commit_hr" required="required" name="commit_hr">
           <option value="1">Yes</option>
           <option value="0">No</option>
          </select>
  </div>
  <div class="col-12">
    <label for="address2" class="form-label"><strong>11. There will be an aftercare program to ensure the maximum potential for real world success to the participants.
It will entail two week internship followed by opportunities to work with Bhutanese Professional freelancers (contingent
on selection by them). DHI will also provide infrastructure support such as workspace and internet for a period of 6
months. Will you be able to commit to this period?<font color="red">*</font></strong></label>
<select class='form-control' id="commit_period" required="required" name="commit_period">
           <option value="1">Yes</option>
           <option value="0">No</option>
          </select>
  </div>

  <div class="col-12">
    <label for="address2" class="form-label"><strong>12. Decribe a hard challenge you faced and how you overcame it. (Maximum 100 words)<font color="red">*</font></strong></label>
    <textarea class="form-control" id="challenge" name="challenge" rows="5" required></textarea>
  </div>

  <div class="col-12">
    <label for="address2" class="form-label"><strong>13. Please share the YouTube link of a 1 minute video of yourself describing who you are and why you are exited for this
program. Be creative and have fun!.<font color="red">*</font></strong>
<p>
Make sure to give a correct link. The clip will be assessed for shortlisting as well as the final interview. Instructions on how to submit the video
are provided in the tutorial provided in the website announcement. (All videos are confidential and will not be available to the public.
</p>
</label>
<input type="text" class="form-control" id="password" name="youtubelink">
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
            <td>Problem Solving Skills</td>
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
            <td>Team Work Skills</td>
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
            <td>Marketing Skills</td>
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
    <label for="address2" class="form-label"><strong>15. Rate your Hard Skills<font color="red">*</font></strong></label>
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
            <td>Website Desgn</td>
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
    <label for="address2" class="form-label"><strong>16. If you answered "Other" in the previous questions, please provide more details.<font color="red">*</font></strong></label>
    <textarea class="form-control" id="oteherdetails" name="oteherdetails" rows="5" ></textarea>
  </div>

  <div class="col-12">
    <label for="address2" class="form-label"><strong>17. Please provide contact details of two referees for your application.<font color="red">*</font></strong></label>
  </div>
  <div class="col-12">
    <label for="address2" class="form-label"><i>Referee 1</i></label>
  </div>

  <div class="form-group col-md-4">
    <label for="cid" class="form-label">Name<font color="red">*</font></label>
    <input type="text" class="form-control" id="email" name="rfname1">
  </div>
  <div class="form-group col-md-4">
    <label for="name" class="form-label">Position<font color="red">*</font></label>
    <input type="text" class="form-control" id="password" name="rfposition1">
  </div>

  <div class="form-group col-md-4">
    <label for="email" class="form-label">Organization<font color="red">*</font></label>
    <input type="text" class="form-control" id="email" name="rforg1">
  </div>
  <div class="form-group col-md-4">
    <label for="name" class="form-label">Relationship<font color="red">*</font></label>
    <input type="text" class="form-control" id="password" name="rfrelation1">
  </div>

  <div class="form-group col-md-4">
    <label for="name" class="form-label">Mobile No.<font color="red">*</font></label>
    <input type="number" class="form-control" id="password" name="rfmobileno1">
  </div>

  <div class="form-group col-md-4">
    <label for="name" class="form-label">Email Address<font color="red">*</font></label>
    <input type="email" class="form-control" id="password" name="rfemail1">
  </div>

  <div class="col-12">
    <label for="address2" class="form-label"><i>Referee 2</i></label>
  </div>

  <div class="form-group col-md-4">
    <label for="cid" class="form-label">Name<font color="red">*</font></label>
    <input type="text" class="form-control" id="email" name="rfname2">
  </div>
  <div class="form-group col-md-4">
    <label for="name" class="form-label">Position<font color="red">*</font></label>
    <input type="text" class="form-control" id="password" name="rfposition2">
  </div>

  <div class="form-group col-md-4">
    <label for="email" class="form-label">Organization<font color="red">*</font></label>
    <input type="text" class="form-control" id="email" name="rforg2">
  </div>
  <div class="form-group col-md-4">
    <label for="name" class="form-label">Relationship<font color="red">*</font></label>
    <input type="text" class="form-control" id="password" name="rfrelation2">
  </div>

  <div class="form-group col-md-4">
    <label for="name" class="form-label">Mobile No.<font color="red">*</font></label>
    <input type="number" class="form-control" id="password" name="rfmobileno2">
  </div>

  <div class="form-group col-md-4">
    <label for="name" class="form-label">Email Address<font color="red">*</font></label>
    <input type="email" class="form-control" id="password" name="rfemail2">
  </div>

  <div class="col-12">
    <label for="address2" class="form-label"><strong>18. Documents to Be Submitted.<font color="red">*</font></strong></label>
  </div>

  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">Passport Size Photo (jpg/pdf)<font color="red">*</font></label>
  <input type="file" class="form-control" id="customFile" name="passport[]" />
  </div>
  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">CID (jpg/pdf)<font color="red">*</font></label>
  <input type="file" class="form-control" id="customFile" name="cid[]"/>
  </div>
  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">No Objection Certificate (NOC) (jpg/pdf)<font color="red">*</font></label>
  <input type="file" class="form-control" id="customFile" name="noc[]"/>
  </div>
  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">CV(jpg/pdf)<font color="red">*</font></label>
  <input type="file" class="form-control" id="customFile" name="cv[]"/>
  </div>
  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">Qualification: Degree / Diploma / Certification (jpg/pdf)<font color="red">*</font></label>
  <input type="file" class="form-control" id="customFile" name="certification[]"/>
  </div>
  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">Other Supporting Documents (jpg/pdf)<font color="red">*</font></label>
  <input type="file" class="form-control" id="customFile" name="otherdoc[]"/>
  </div>
  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">Examples of your work that may Demonstrate your skills<font color="red">*</font></label>
  <input type="file" class="form-control" id="customFile" name="workexample[]"/>
  </div>

  <div class="col-12">
    <label for="address2" class="form-label"><strong>19. Please upload ONLY 1-2 examples of your work that may demostrate your skills that could be applied to freelancing or
commission work (if any). These can be samples of artwork, graphic design, writing, audio, etc. the you have created.<font color="red">*</font></strong></label>
  </div>
  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">Attach Sample 1<font color="red">*</font></label>
  <input type="file" class="form-control" id="customFile" name="sample1[]"/>
  </div>
  <div class="form-group col-md-6">
  <label class="form-label" for="customFile">Attach Sample 2<font color="red">*</font></label>
  <input type="file" class="form-control" id="customFile" name="sample2[]"/>
  </div>

  <div class="col-12">
    <label for="address2" class="form-label"><strong>20. How did you find about this program ?<font color="red">*</font></strong></label>
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
    <label class="form-check-label" for="flexCheckDefault"> Friend / Word of Mouth
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
      <input class="form-check-input" type="checkbox" id="agree">
      <label class="form-check-label" for="agree">
        <b>I agree <font color="red">*</font></b>
      </label>
    </div>
  </div>
  <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm" onclick='return confirm("Are you sure to Apply ?")' >Submit</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
        </div>
</form>
<!-- from end -->
        </div>
    </div>
  </div>

</div>
</div>
</div>
</x-app-layout>






