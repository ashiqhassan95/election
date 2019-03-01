<div class="main-navbar">
    <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
        <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
            <div class="d-table m-auto">
                <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;"
                     src="/images/shards/shards-dashboards-logo.svg" alt="Shards Dashboard">
                <span class="d-none d-md-inline ml-1">CVS Dashboard</span>
            </div>

        </a>
        <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
            <i class="material-icons">&#xE5C4;</i>
        </a>
    </nav>
</div>
<form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
    <div class="input-group input-group-seamless ml-3">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="fas fa-search"></i>
            </div>
        </div>
        <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search">
    </div>
</form>
<div class="nav-wrapper">
    {{--<ul class="nav nav--no-borders flex-column">--}}
    <ul class="nav flex-column">

        {{--<li class="nav-item">--}}
        {{--<a class="nav-link{{ (isset($selected_nav) && $selected_nav == 'institutes') ? ' active' : '' }}"--}}
        {{--href="{{ route('dashboard.institutes.index') }}">--}}
        {{--<i class="material-icons">&#xE917;</i>--}}
        {{--<span>Institutes</span>--}}
        {{--</a>--}}
        {{--</li>--}}
        <li class="nav-item">
            <a class="nav-link{{ (isset($selected_nav) && $selected_nav == 'standards') ? ' active' : '' }}"
               href="{{ route('dashboard.standards.index') }}">
                <i class="material-icons">school</i>
                <span>Standards</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link{{ (isset($selected_nav) && $selected_nav == 'voters') ? ' active' : '' }}"
               href="{{ route('dashboard.voters.index') }}">
                <i class="material-icons">people</i>
                <span>Voters</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link{{ (isset($selected_nav) && $selected_nav == 'positions') ? ' active' : '' }}"
               href="{{ route('dashboard.positions.index') }}">
                <i class="material-icons">layers</i>
                <span>Positions</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link{{ (isset($selected_nav) && $selected_nav == 'elections') ? ' active' : '' }}"
               href="{{ route('dashboard.elections.index') }}">
                <i class="material-icons">poll</i>
                <span>Elections</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link{{ (isset($selected_nav) && $selected_nav == 'candidates') ? ' active' : '' }}"
               href="{{ route('dashboard.candidates.index') }}">
                <i class="material-icons">people</i>
                <span>Candidates</span>
            </a>
        </li>
        {{--<li class="nav-item">--}}
            {{--<a class="nav-link{{ (isset($selected_nav) && $selected_nav == 'users') ? ' active' : '' }}"--}}
               {{--href="{{ route('dashboard.users.index') }}">--}}
                {{--<i class="material-icons">person</i>--}}
                {{--<span>Users</span>--}}
            {{--</a>--}}
        {{--</li>--}}
        {{--<li class="nav-item dropdown">--}}
            {{--<a class="nav-link dropdown-toggle{{ (isset($selected_nav) && str_contains($selected_nav, 'settings')) ? ' active' : '' }}"--}}
               {{--href="#" data-toggle="dropdown" role="button" aria-haspopup="true"--}}
               {{--aria-expanded="true">--}}
                {{--<i class="material-icons">&#xE7FD;</i>--}}
                {{--<span>Settings</span>--}}
            {{--</a>--}}
            {{--<div class="dropdown-menu dropdown-menu-small">--}}
                {{--<a class="dropdown-item{{ (isset($selected_nav) && $selected_nav == 'settings.general') ? ' active' : '' }}" href="{{ route('dashboard.settings.general') }}">General</a>--}}
                {{--<a class="dropdown-item{{ (isset($selected_nav) && $selected_nav == 'settings.institute') ? ' active' : '' }}" href="{{ route('dashboard.settings.institute') }}">Institute</a>--}}
            {{--</div>--}}
        {{--</li>--}}
    </ul>
</div>