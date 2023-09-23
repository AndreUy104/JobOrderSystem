<nav class="navbar sticky-top navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <img src="{{ asset('img/LogoTAS.jpg') }}" alt="Avatar">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="{{ @route('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ @route('create-customer') }}">Create Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ @route('view') }}">View Orders</a>
        </li>
        @if(auth()->user()->is_admin == true)
          <li class="nav-item">
              <a class="nav-link" href="{{ @route('admin') }}">Admin</a>
          </li>
        @endif
        <li class="nav-item">
          <a class="nav-link" href="{{ @route('logout') }}">Logout</a>
        </li>
      </ul>
        <span class="navbar-text">
            <p>Welcome {{ auth()->user()->name }}</p>
        </span>
    </div>
  </div>
</nav>

<style>
    img{
        border-radius: 50%;
        height: 100px;
    }
</style>
