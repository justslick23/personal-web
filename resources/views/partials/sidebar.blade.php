<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href="{{ url('/') }}" target="_blank">
            <img src="{{ asset('assets/img/logo-ct-dark.png') }}" class="navbar-brand-img" width="26" height="26" alt="main_logo">
            <span class="ms-1 text-sm text-dark">My Portfolio</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <!-- Dashboard -->
            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('dashboard') }}">
                    <i class="material-symbols-rounded opacity-5">dashboard</i>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <!-- Portfolio Section -->
            <div class="sidebar-heading">
                Portfolio
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePortfolio"
                   aria-expanded="false" aria-controls="collapsePortfolio">
                    <i class="material-symbols-rounded opacity-5">briefcase</i>
                    <span>Portfolio Items</span>
                </a>
                <div id="collapsePortfolio" class="collapse" aria-labelledby="headingPortfolio" data-bs-parent="#sidenav-collapse-main">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('portfolio.index') }}">View All</a>
                        <a class="collapse-item" href="{{ route('portfolio.create') }}">Add New</a>
                    </div>
                </div>
            </li>

            <!-- Music Section -->
            <div class="sidebar-heading">
                Music
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMusic"
                   aria-expanded="false" aria-controls="collapseMusic">
                    <i class="material-symbols-rounded opacity-5">music_note</i>
                    <span>Songs & Albums</span>
                </a>
                <div id="collapseMusic" class="collapse" aria-labelledby="headingMusic" data-bs-parent="#sidenav-collapse-main">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Songs</h6>
                        <a class="collapse-item" href="{{ route('music.index') }}">View Songs</a>
                        <a class="collapse-item" href="{{ route('music.create') }}">Add New Song</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Albums</h6>
                        <a class="collapse-item" href="{{ route('music.index') }}">View Albums</a>
                        <a class="collapse-item" href="{{ route('music.create') }}">Add New Album</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">

            <!-- Settings Section -->
            <div class="sidebar-heading">
                Settings
            </div>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('settings') }}">
                    <i class="material-symbols-rounded opacity-5">settings</i>
                    <span class="nav-link-text ms-1">Site Settings</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('profile') }}">
                    <i class="material-symbols-rounded opacity-5">person</i>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
    </div>
</aside>
