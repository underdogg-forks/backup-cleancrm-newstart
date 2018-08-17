<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a href="{{ route('dashboard.index')}}" class="navbar-brand">
        <span class="navbar-brand-full">{{ config('fi.headerTitleText') }}</span>
        &nbsp;
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="nav navbar-nav ml-left d-md-down-none">
        <li class="nav-item dropdown px-3">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Customer Menu
            </a>
            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Customers</a>
                <a class="dropdown-item" href="{{ route('employees.index') }}">Employees</a>
                <a class="dropdown-item" href="#">Projects</a>


                {{--<a class="dropdown-item" href="{{ route('customers.index') }}">Customers</a>
                <a class="dropdown-item" href="{{ route('employees.index') }}">Employees</a>
                <a class="dropdown-item" href="{{ route('projects.index') }}">Projects</a>--}}
            </div>
        </li>
    </ul>


    <ul class="nav navbar-nav ml-auto d-md-down-none">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle pr-3" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="true" aria-expanded="false">
                @if (config('fi.displayProfileImage'))
                    <img src="{{ $profileImageUrl }}" alt="User Image"/>
                @else
                    {{ Auth::user()->name }}
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>Account</strong>
                </div>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-bell-o"></i> Updates
                    <span class="badge badge-info">42</span>
                </a>
                <div class="divider"></div>

                <a class="dropdown-item" href="{{ route('session.logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                    Logout
                </a>
                <form id="frm-logout" action="{{ route('session.logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </li>
    </ul>


</header>
