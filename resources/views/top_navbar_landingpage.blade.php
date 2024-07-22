<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>


<nav class="navbar navbar-expand-sm "style="background-color: #131d2d;">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('dashboard') }}">
      <svg xmlns="http://www.w3.org/2000/svg" color="white" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/><path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
      </svg>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar"style="color: #e2e2e2;">
    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
    </button>
    <div class="collapse navbar-collapse flex flex-col sm:justify-center items-cente" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#"style="color: #e2e2e2;">&nbsp;&nbsp;&nbsp;About AD</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"style="color: #e2e2e2;">&nbsp;&nbsp;&nbsp;Publications</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"style="color: #e2e2e2;">&nbsp;&nbsp;&nbsp;Download Forms</a>
        </li> 
        <li class="nav-item">
          <a class="nav-link" href="#"style="color: #e2e2e2;">&nbsp;&nbsp;&nbsp;Frequently Asked Questions</a>
        </li> 
        <li class="nav-item">
          <a class="nav-link" href="#"style="color: #e2e2e2;">&nbsp;&nbsp;&nbsp;Contact Us</a>
        </li>  
      </ul>
    </div>
  </div>
</nav>
