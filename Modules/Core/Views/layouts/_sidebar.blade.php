<div class="sidebar">
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard.index') }}">
                    <i class="nav-icon fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="{{ route('roles.index', ['status' => 'active']) }}">
                    <i class="nav-icon fa fa-users"></i> <span>Roles</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index', ['status' => 'active']) }}">
                    <i class="nav-icon fa fa-users"></i> <span>Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('permissions.index', ['status' => 'active']) }}">
                    <i class="nav-icon fa fa-thumbs-o-up"></i> <span>Permissions</span>
                </a>
            </li>




        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
