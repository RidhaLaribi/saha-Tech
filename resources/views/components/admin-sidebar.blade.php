<div class="admin-sidebar">
    <div class="sidebar-header">
        <a href="#" class="admin-logo">
            <div class="logo-circle">
                <i class="fas fa-university"></i>
            </div>

            <span class="fs-5 fw-bold"> HeyDoc</span>
        </a>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ route('admindash') }}" class="nav-link @if(request()->routeIs('dashboard')) active @endif">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <a href="{{ route('rendadmin') }}" class="nav-link @if(request()->routeIs('rend')) active @endif">
            <i class="fas fa-file-alt"></i> Manage doctors Request
        </a>
        <a href="{{ route('avbl') }}" class="nav-link @if(request()->routeIs('avbl')) active @endif">
            <i class="fas fa-users"></i> Users
        </a>
    </nav>
</div>