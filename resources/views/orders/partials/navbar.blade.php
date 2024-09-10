<nav class="navbar navbar-expand-lg navbar-dark py-0 mx-0 navbar-rd" style="width: 100vw">
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
            <a class="nav-link" href="/status">
              Status
            </a>
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
          @endif
        </ul>
      </div>
    </div>
  </nav>