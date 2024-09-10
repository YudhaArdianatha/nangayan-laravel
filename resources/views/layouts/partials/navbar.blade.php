<nav class="navbar navbar-expand-lg navbar-dark fixed-top py-0 mx-0" style="width: 100vw">
    <div class="container">
      <a class="navbar-brand mt-0 py-0" href="#">
        <img class="rounded-bottom" src="/img/assets/logo2.png" alt="NangAyan Hotel" width="120" style="height: 100%" />
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('suites*') ? 'active' : '' }}" href="/suites">Rooms</a>
          </li>
          @if (auth()->user())
          @auth
          <li class="nav-item">
            <a class="nav-link" href="#">
              {{ auth()->user()->name }}
            </a>
          </li>
          <li class="nav-item">
            {{-- @if(auth()->user()->latestBooking) --}}
                <a class="nav-link" href="/status">
                    Status
                </a>
            {{-- @else
                <a class="nav-link" href="#">
                    No Active Booking
                </a>
            @endif --}}
          </li>
          <li>
            <form action="/logout" method="POST">
              @csrf
              <button type="submit" class="dropdown-item">
                Logout
                <i class="bi bi-box-arrow-in-right"></i> 
              </button>
            </form>
          </li>
          @endauth
          @else
          <li class="nav-item">
            <a class="nav-link" href="/login">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/register">Register</a>
          </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>