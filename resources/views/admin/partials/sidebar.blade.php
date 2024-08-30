<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
            <i class="bi bi-house"></i>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="/users">
            <i class="bi bi-people"></i>
            Users
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('rooms*') ? 'active' : '' }}" href="/rooms">
            <i class="bi bi-building"></i>
            Rooms
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('services*') ? 'active' : '' }}" href="/services">
            <i class="bi bi-grid-3x3-gap"></i>
            Services
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('orders*') ? 'active' : '' }}" href="#">
            <i class="bi bi-cart"></i>
            Orders
          </a>
        </li>
      </ul>

      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <a class="link-secondary" href="#" aria-label="Add a new report">
        </a>
      </h6>
      <ul class="nav flex-column mb-2">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('current-month') ? 'active' : '' }}" href="#">
            Current month
          </a>
      </ul>
    </div>
  </nav>