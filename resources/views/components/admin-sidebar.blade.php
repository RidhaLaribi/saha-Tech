@auth
@php
    $user = Auth::user();
    $role = $user->role; // 'admin', 'doctor', etc.
@endphp

<div class="admin-sidebar">
    <div class="sidebar-header">
        <a href="#" class="admin-logo">
            <div class="logo-circle">
                <i class="fas fa-university "></i>
            </div>
            <span class="fs-5 fw-bold"> HeyDoc</span>
        </a>
    </div>

    <nav class="sidebar-nav">
        {{-- Dashboard --}}
        @if($role === 'admin')
            <a href="{{ route('admindash') }}" class="nav-link {{ request()->routeIs('admindash') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
            </a>
        @elseif($role === 'doctor')
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt me-2"></i>  Dashboard
            </a>
            @endif


        @if($role === 'admin')
            <a href="{{ route('rendadmin') }}" class="nav-link {{ request()->routeIs('rendadmin') ? 'active' : '' }}">
                <i class="fas fa-file-alt me-2"></i> Manage Doctors Request
            </a>
        @elseif($role === 'doctor')
            <a href="{{ route('rend') }}" class="nav-link {{ request()->routeIs('rend') ? 'active' : '' }}">
                <i class="fas fa-file-alt me-2"></i> Manage Doctors appointements
            </a>
            <a href="{{ route('rendconfirme') }}" class="nav-link {{ request()->routeIs('rendconfirme') ? 'active' : '' }}">
                <i class="fas fa-file-alt me-2"></i>
                <span>confirmed doctor appointements</span>
            </a>
        @endif

        {{-- Users list (only admin) --}}
        @if($role === 'admin')
            <a href="{{ route('users') }}" class="nav-link {{ request()->routeIs('users') ? 'active' : '' }}">
                <i class="fas fa-users me-2"></i> Users
            </a>
        @endif

        {{-- You can add doctor‑specific links here: --}}
        @if($role === 'doctor')
            <a href="{{ route('avbl') }}" class="nav-link {{ request()->routeIs('avbl') ? 'active' : '' }}">
                <i class="fas fa-procedures me-2"></i> My options
            </a>
        @endif
    </nav>
</div>
@endauth
