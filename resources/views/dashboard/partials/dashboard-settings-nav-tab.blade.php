<ul class="nav nav-tabs border-0 mt-auto mx-4 pt-2">
    <li class="nav-item">
        <a class="nav-link{{ (isset($selected_nav) && $selected_nav == 'settings.general') ? ' active' : '' }}"
           href="{{ route('dashboard.settings.general') }}">General</a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ (isset($selected_nav) && $selected_nav == 'settings.institute') ? ' active' : '' }}"
           href="{{ route('dashboard.settings.institute') }}">Institute</a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ (isset($selected_nav) && $selected_nav == 'settings.appearance') ? ' active' : '' }}"
           href="{{ route('dashboard.settings.appearance') }}">Appearance</a>
    </li>
</ul>