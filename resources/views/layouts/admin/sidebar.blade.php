<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ Route('admin.dashboard') }}">
        <div class="sidebar-brand-icon">
                <img src="{{ asset('img/logo-tittle.png') }}" alt="Logo" style="height: 50px;">
        </div>
        <div class="sidebar-brand-text mx-3">Cinema</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ Route ('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('Dashboard') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.movies.index') }}">
            <i class="fas fa-fw fa-film" aria-hidden="true"></i>
            <span>{{ __('Movies') }}</span></a>
    </li>

    <hr class="sidebar-divider my-0">
    
    <li class="nav-item my-o" >
        <a class="nav-link" href="{{ route('admin.iklans.index') }}">
            <i class="fas fa-fw fa-ad" aria-hidden="true"></i>
            <span>{{ __('Iklans') }}</span></a>
    </li>
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Theaters -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.theaters.index') }}">
            <i class="fas fa-fw fa-theater-masks" aria-hidden="true"></i>
            <span>{{ __('Theaters') }}</span></a>
    </li>

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.schedules.index') }}">
            <i class="fas fa-fw fa-theater-masks" aria-hidden="true"></i>
            <span>{{ __('Schedules') }}</span></a>
    </li>

    <hr class="sidebar-divider my-0">

    
    <!-- Heading -->
    {{-- <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="#">Buttons</a>
                <a class="collapse-item" href="#">Cards</a>
            </div>
        </div>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>