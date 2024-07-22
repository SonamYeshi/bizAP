<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand-sm bg-light navbar-light">
<div class="container-fluid">
<!-- menu -->
<div class="collapse navbar-collapse" id="collapsibleNavbar" style="margin-left: 350px;">
 <div class="container-fluid">
  <div class="collapse navbar-collapse" id="main_nav">
  <ul class="navbar-nav">
  
    <li class="nav-item active"><a class="nav-link" href="{{ route('dashboardadmin') }}"><i class='fas fa-fw fa-home'style="color: #3a74ae;"></i>&nbsp;Home </a> </li>
&nbsp;&nbsp;
    <li class="nav-item dropdown">
    <a class="nav-link " href="{{route('view_role')}}"><p style="color: #3a74ae; ">User Role</p></a>
    </li>
&nbsp;&nbsp;
    <li class="nav-item dropdown">
    <a class="nav-link " href="{{route('view_user')}}"><p style="color: #3a74ae; ">User</p></a>
    </li>
&nbsp;&nbsp;
    <li class="nav-item dropdown">
    <a class="nav-link" href="{{route('view_ictemail')}}"><p style="color: #3a74ae; ">DHI ICT Email</p></a>
    </li>
&nbsp;&nbsp;
    <li class="nav-item dropdown">
    <a class="nav-link" href="{{route('view_dhiceo')}}"><p style="color: #3a74ae; ">DHI CEO</p></a>
    </li>
&nbsp;&nbsp;
    <li class="nav-item dropdown">
    <a class="nav-link" href="{{route('view_bank')}}"><p style="color: #3a74ae; ">Bank Focal</p></a>
    </li>


  </ul>
  </div> <!-- navbar-collapse.// -->
 </div> <!-- container-fluid.// -->


    </div>
<!-- menu end -->
  </div>
</nav>
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




