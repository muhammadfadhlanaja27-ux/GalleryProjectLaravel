<header id="header" class="header d-flex align-items-center sticky-top header-transparent">
  <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <a href="{{ route('home') }}" class="logo d-flex align-items-center">
      <i class="bi bi-camera"></i>
      <h1 class="sitename">Gallery</h1>
    </a>

    <nav id="navmenu" class="navmenu ms-4 me-auto">
      <ul>
        <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
        <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
        <li class="dropdown"><a href="{{ route('gallery') }}" class="{{ request()->routeIs('gallery*') ? 'active' : '' }}"><span>Gallery</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
          <ul>
            <li><a href="{{ route('gallery') }}">Sendiri</a></li>
            <li><a href="{{ route('gallery') }}">Berdua</a></li>
          </ul>
        </li>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

  </div>
</header>