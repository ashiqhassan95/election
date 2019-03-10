<div class="main-navbar sticky-top bg-white">
    <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
        <div class="main-navbar__search page-header w-100 d-none d-md-flex d-lg-flex container px-4">
            <h3 class="page-title" style="font-size: 20px">
                @stack('page-content-title')
            </h3>
        </div>
        <ul class="navbar-nav border-left flex-row ">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-nowrap px-3 h-100 align-content-center" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="true" aria-expanded="false" style="min-width: 160px; line-height: 40px">
                    <span><i class="material-icons">person</i></span>
                    <span class="d-none d-md-inline-block">{{ Auth::user()->name ?? 'not login' }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-small">
                    <a class="dropdown-item" href="user-profile"><i class="material-icons">&#xE7FD;</i> Profile</a>
                    <a class="dropdown-item" href="edit-user-profile"><i class="material-icons">&#xE8B8;</i> Edit
                        Profile</a>
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="material-icons text-danger">&#xE879;</i> {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        <nav class="nav">
            <a href="#" class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left"
               data-toggle="collapse" data-target=".header-navbar" aria-expanded="false" aria-controls="header-navbar">
                <i class="material-icons">&#xE5D2;</i>
            </a>
        </nav>
    </nav>
</div>