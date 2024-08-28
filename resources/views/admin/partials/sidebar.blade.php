<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
            <span data-feather="home"></span>
            <i class="bi bi-house"></i>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('users') ? 'active' : '' }}" href="/users">
            <span data-feather="file"></span>
            <i class="bi bi-people"></i>
            Users
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('rooms') ? 'active' : '' }}" href="#">
            <span data-feather="shopping-cart"></span>
            <i class="bi bi-building"></i>
            Rooms
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('services') ? 'active' : '' }}" href="/services">
            <span data-feather="users"></span>
            <i class="bi bi-grid-3x3-gap"></i>
            Services
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('orders') ? 'active' : '' }}" href="#">
            <span data-feather="bar-chart-2"></span>
            <i class="bi bi-cart"></i>
            Orders
          </a>
        </li>
      </ul>

      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Saved reports</span>
        <a class="link-secondary" href="#" aria-label="Add a new report">
          <span data-feather="plus-circle"></span>
        </a>
      </h6>
      <ul class="nav flex-column mb-2">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('current-month') ? 'active' : '' }}" href="#">
            <span data-feather="file-text"></span>
            Current month
          </a>
      </ul>
    </div>
  </nav>