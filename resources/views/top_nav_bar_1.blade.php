<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand-sm bg-white navbar-white">
  <div class="container-fluid">
<!-- menu -->
<div class="collapse navbar-collapse" id="collapsibleNavbar" style="margin-left: 10px;">
 <div class="container-fluid">
  <div class="collapse navbar-collapse" id="main_nav">
  <ul class="navbar-nav">
  <li class="nav-item active"> <a class="nav-link" href="{{ route('dashboard') }}"><i class='fas fa-fw fa-home'style="color: green;"></i></a> </li>
    <li class="nav-item dropdown">
       <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="fas fa-chalkboard-teacher" style="color: green;"></i>&nbsp;Training</a>
        <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{route('training')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Create Training Notification</a></li>
        <li><a class="dropdown-item" href="{{route('trainingprovider')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Training Provider</a></li>
        <li><a class="dropdown-item" href="{{route('shortpanels')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Short List Panel Members</a></li>
        <li><a class="dropdown-item" href="{{route('interviewpanels')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Interview Panel Members</a></li>
        <li><a class="dropdown-item" href="{{route('pptpanels')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Presentation Panel Members</a></li>

        </ul>
    </li>

    <li class="nav-item dropdown">
       <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="fas fa-folder" style="color: green;"></i>&nbsp;Training Application</a>
        <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{route('screening')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Screening</a></li>
        <li><a class="dropdown-item" href="{{route('shortlist')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Short Listing</a></li>
        <li><a class="dropdown-item" href="{{route('interview')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Interview</a></li>
        <li><a class="dropdown-item" href="{{route('ranking')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Final Result</a></li>
        <li><a class="dropdown-item" href="{{route('completion')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Post Training Status</a></li>
        <!-- <li><a class="dropdown-item" href="#"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Training Evaluation</a></li> -->
        </ul>
    </li>

    <li class="nav-item dropdown">
       <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="fas fa-folder" style="color: green;"></i>&nbsp;DHI Business Acceleration Fund</a>
        <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{route('funding')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Announcement</a></li>
        <li><a class="dropdown-item" href="{{route('fshortpanels')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Short List Panel Members</a></li>
        <li><a class="dropdown-item" href="{{route('screeningfund')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Screening</a></li>
        <li><a class="dropdown-item" href="{{route('shortlistfund')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Short Listing</a></li>
        <li><a class="dropdown-item" href="{{route('presentation')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Presentation</a></li>
        <li><a class="dropdown-item" href="{{route('presentationscore')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Presentation Result</a></li>
        <li><a class="dropdown-item" href="{{route('contractschedule')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Contract Signing Schedule</a></li>
        <li><a class="dropdown-item" href="{{route('contractsign')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Contract Signing</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
       <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="fas fa-folder" style="color: green;"></i>&nbsp;Fund Application</a>
        <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{route('fundreview')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Review</a></li>
        <li><a class="dropdown-item" href="{{route('disbursement')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Disbursement Order</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
       <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="fas fa-folder" style="color: green;"></i>&nbsp;Repayments</a>
        <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{route('repaymentdhi')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Review</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
       <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="fas fa-folder" style="color: green;"></i>&nbsp;Site Visits</a>
        <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{route('sitevisit')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Schedule</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
       <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="fas fa-folder" style="color: green;"></i>&nbsp;Mentoring</a>
        <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{route('mentoring')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;New Session</a></li>

        </ul>
    </li>
   <!--
    <li class="nav-item dropdown">
       <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="fas fa-folder" style="color: green;"></i>&nbsp;Budget</a>
        <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{route('budgethead')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Budget Head</a></li>
        <li><a class="dropdown-item" href="{{route('expenseheads')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Expense Heads</a></li>
        <li><a class="dropdown-item" href="{{route('budgetdetails')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Update Budget Detail</a></li>
        <li><a class="dropdown-item" href="{{route('expensedetails')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Update Expenses Detail</a></li>
        </ul>
    </li>
  -->
    <li class="nav-item dropdown">
       <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="fas fa-folder" style="color: green;"></i>&nbsp;Report</a>
        <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{route('reporttraining')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Training</a></li>
        <li><a class="dropdown-item" href="{{route('reportfunding')}}"><i class="fas fa-file-alt" style="color: green;"></i>&nbsp;Funding</a></li>
        </ul>
    </li>
  </ul>
  </div> <!-- navbar-collapse.// -->
 </div> <!-- container-fluid.// -->

<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function(){
// make it as accordion for smaller screens
if (window.innerWidth > 992) {

  document.querySelectorAll('.navbar .nav-item').forEach(function(everyitem){

    everyitem.addEventListener('mouseover', function(e){

      let el_link = this.querySelector('a[data-bs-toggle]');

      if(el_link != null){
        let nextEl = el_link.nextElementSibling;
        el_link.classList.add('show');
        nextEl.classList.add('show');
      }

    });
    everyitem.addEventListener('mouseleave', function(e){
      let el_link = this.querySelector('a[data-bs-toggle]');

      if(el_link != null){
        let nextEl = el_link.nextElementSibling;
        el_link.classList.remove('show');
        nextEl.classList.remove('show');
      }


    })
  });

}
// end if innerWidth
});
// DOMContentLoaded  end
</script>
    </div>
<!-- menu end -->
  </div>
</nav>



