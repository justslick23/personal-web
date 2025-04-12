<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-music"></i>
        </div>
        <div class="sidebar-brand-text mx-3">My Portfolio</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Portfolio Section -->
    <div class="sidebar-heading">
        Portfolio
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePortfolio"
           aria-expanded="true" aria-controls="collapsePortfolio">
            <i class="fas fa-fw fa-briefcase"></i>
            <span>Portfolio Items</span>
        </a>
        <div id="collapsePortfolio" class="collapse" aria-labelledby="headingPortfolio" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('portfolio.index') }}">View All</a>
                <a class="collapse-item" href="{{ route('portfolio.create') }}">Add New</a>
            </div>
        </div>
        
        </div>
    </li>

    <!-- Music Section -->
    <div class="sidebar-heading">
        Music
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMusic"
           aria-expanded="true" aria-controls="collapseMusic">
            <i class="fas fa-fw fa-music"></i>
            <span>Songs & Albums</span>
        </a>
        <div id="collapseMusic" class="collapse" aria-labelledby="headingMusic" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Songs</h6>
                <a class="collapse-item" href="{{ url('songs') }}">View Songs</a>
                <a class="collapse-item" href="{{ url('songs/create') }}">Add New Song</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Albums</h6>
                <a class="collapse-item" href="{{ url('albums') }}">View Albums</a>
                <a class="collapse-item" href="{{ url('albums/create') }}">Add New Album</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Settings -->
    <div class="sidebar-heading">
        Settings
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('settings') }}">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Site Settings</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('profile') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Profile</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
