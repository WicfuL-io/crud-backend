<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">CRUD Web CCTV</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/crude') }}">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/viewdata') }}">View data</a>
        </li>
      </ul>
    </div>
  </div>
</nav>