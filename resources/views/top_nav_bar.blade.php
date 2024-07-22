<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>



<center>
<div class="dropdown">
  <button type="button" class="btn btn-outline-primary dropdown-toggle btn-sm" data-bs-toggle="dropdown">
  Training Master
  </button>
  <ul class="dropdown-menu">
        <li style="font-size: 14px;"><a class="dropdown-item" href="{{route('training')}}">Create Training Notification</a></li>
        <li style="font-size: 14px;"><a class="dropdown-item" href="{{route('trainingprovider')}}">Training Provider</a></li>
        <li style="font-size: 14px;"><a class="dropdown-item" href="{{route('shortpanels')}}">Short List Panel Members</a></li>
        <li style="font-size: 14px;"><a class="dropdown-item" href="{{route('interviewpanels')}}">Interview Panel Members</a></li>

  </ul>

  <button type="button" class="btn btn-outline-primary dropdown-toggle btn-sm" data-bs-toggle="dropdown">
  Training Application
  </button>
  <ul class="dropdown-menu">
        <li style="font-size: 14px;"><a class="dropdown-item" href="{{route('screening')}}">Screening</a></li>
        <li style="font-size: 14px;"><a class="dropdown-item" href="{{route('shortlist')}}">Short Listing</a></li>
        <li style="font-size: 14px;"><a class="dropdown-item" href="{{route('interview')}}">Interview</a></li>
        <li style="font-size: 14px;"><a class="dropdown-item" href="{{route('ranking')}}">Final Result</a></li>
        <li style="font-size: 14px;"><a class="dropdown-item" href="{{route('completion')}}">Post Training Status</a></li>
   </ul>

   <button type="button" class="btn btn-outline-primary dropdown-toggle btn-sm" data-bs-toggle="dropdown">
   Fund Master
  </button>
  <ul class="dropdown-menu">
        <li style="font-size: 14px;"><a class="dropdown-item" href="{{route('funding')}}">Announcement</a></li>
        <li style="font-size: 14px;"><a class="dropdown-item" href="{{route('fshortpanels')}}">Short List Panel Members</a></li>
        <li style="font-size: 14px;"><a class="dropdown-item" href="{{route('pptpanels')}}">Presentation Panel Members</a></li>
   </ul>

   <button type="button" class="btn btn-outline-primary dropdown-toggle btn-sm" data-bs-toggle="dropdown">
   Fund Application
  </button>
  <ul class="dropdown-menu">
        <li style="font-size: 14px;"><a class="dropdown-item" href="{{route('screeningfund')}}">Screening</a></li>
        <li style="font-size: 14px;"><a class="dropdown-item" href="{{route('shortlistfund')}}">Short Listing</a></li>
        <li style="font-size: 14px;"><a class="dropdown-item" href="{{route('presentation')}}">Presentation</a></li>
        <li style="font-size: 14px;"><a class="dropdown-item" href="{{route('presentationscore')}}">Presentation Result</a></li>
        <li style="font-size: 14px;"><a class="dropdown-item" href="{{route('contractschedule')}}">Contract Signing Schedule</a></li>
        <li style="font-size: 14px;"><a class="dropdown-item" href="{{route('contractsign')}}">Contract Signing</a></li>
   </ul>

   <button type="button" class="btn btn-outline-primary dropdown-toggle btn-sm" data-bs-toggle="dropdown">
   Fund Release Request
  </button>
  <ul class="dropdown-menu">
        <li style="font-size: 14px;"><a class="dropdown-item" href="{{route('fundreview')}}">Review</a></li>
        <li style="font-size: 14px;"><a class="dropdown-item" href="{{route('disbursement')}}">Disbursement Order</a></li>
   </ul>

   <button type="button" class="btn btn-outline-primary dropdown-toggle btn-sm" data-bs-toggle="dropdown">
   Repayment
  </button>
  <ul class="dropdown-menu">
        <li style="font-size: 14px;"><a class="dropdown-item" href="{{route('repaymentdhi')}}">Review</a></li>
   </ul>

   <button type="button" class="btn btn-outline-primary dropdown-toggle btn-sm" data-bs-toggle="dropdown">
   Site Visit
  </button>
  <ul class="dropdown-menu">
        <li style="font-size: 14px;"><a class="dropdown-item" href="{{route('sitevisit')}}">Schedule</a></li>
   </ul>

   <button type="button" class="btn btn-outline-primary dropdown-toggle btn-sm" data-bs-toggle="dropdown">
   Mentoring
  </button>
  <ul class="dropdown-menu">
        <li style="font-size: 14px;"><a class="dropdown-item" href="{{route('mentoring')}}">New Session</a></li>
   </ul>

   <button type="button" class="btn btn-outline-primary dropdown-toggle btn-sm" data-bs-toggle="dropdown">
   Report
  </button>
  <ul class="dropdown-menu">
        <li style="font-size: 14px;"><a class="dropdown-item" href="{{route('reporttraining')}}">Training</a></li>
        <li style="font-size: 14px;"><a class="dropdown-item" href="{{route('reportfunding')}}">Funding</a></li>
   </ul>
</div>
</center>


