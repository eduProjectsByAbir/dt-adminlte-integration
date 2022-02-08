<li class="nav-item dropdown user-menu">
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <img src="{{ asset(Auth::user()->dpicture) }}"
            class="user-image img-circle elevation-2" alt="User Image">
        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- User image -->
        <li class="user-header bg-primar">
            <img src="{{ asset(Auth::user()->dpicture) }}"
                class="img-circle elevation-2" alt="User Image">

            <p>
                {{ Auth::user()->name }} - Web Developer
                <small>Member since {{ Auth::user()->created_at }}</small>
            </p>
            <br>
        </li>

        <!-- Menu Footer-->
        <li class="user-footer">
            <a href="{{ route('profile.index')}}"
                class="btn btn-default btn-flat">Profile</a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
    document.getElementById('logout-form').submit();"
                class="btn btn-default btn-flat float-right">{{ __('Logout') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</li>
