<div class="admin-sidebar">
    <div class="sidebar-header">
        <a href="#" class="admin-logo">
            <div class="logo-circle">
                <i class="fas fa-university"></i>
            </div>
            <span class="fs-5 fw-bold">Dashboard</span>
        </a>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>

        <a href="{{ route('doctor.appointments.index') }}"
            class="nav-link {{ request()->routeIs('doctor.appointments.index') ? 'active' : '' }}">
            <i class="fas fa-file-alt"></i> Manage Requests
        </a>

        <a href="{{ route('avbl') }}" class="nav-link {{ request()->routeIs('avbl') ? 'active' : '' }}">
            <i class="fas fa-users"></i> News
        </a>

        <a href="newadmine.php" class="nav-link {{ request()->is('newadmine.php') ? 'active' : '' }}">
            <i class="fas fa-user-graduate"></i> Users
        </a>
    </nav>
</div>