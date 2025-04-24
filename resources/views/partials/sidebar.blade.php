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
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ url('dashboard') }}">
                    <i class="material-symbols-rounded opacity-5">dashboard</i>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            
            <!-- Portfolio Section -->
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Portfolio</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('portfolio.index') }}">
                    <i class="material-symbols-rounded opacity-5">view_list</i>
                    <span class="nav-link-text ms-1">View All</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('portfolio.create') }}">
                    <i class="material-symbols-rounded opacity-5">add_circle</i>
                    <span class="nav-link-text ms-1">Add New</span>
                </a>
            </li>

            <!-- Music Section -->
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Music</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('music.index') }}">
                    <i class="material-symbols-rounded opacity-5">library_music</i>
                    <span class="nav-link-text ms-1">View Songs</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('music.create') }}">
                    <i class="material-symbols-rounded opacity-5">add_circle</i>
                    <span class="nav-link-text ms-1">Add New Song</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('music.index') }}">
                    <i class="material-symbols-rounded opacity-5">album</i>
                    <span class="nav-link-text ms-1">View Albums</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('music.create') }}">
                    <i class="material-symbols-rounded opacity-5">add_circle</i>
                    <span class="nav-link-text ms-1">Add New Album</span>
                </a>
            </li>

            <!-- Settings Section -->
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Settings</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ url('settings') }}">
                    <i class="material-symbols-rounded opacity-5">settings</i>
                    <span class="nav-link-text ms-1">Site Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ url('profile') }}">
                    <i class="material-symbols-rounded opacity-5">person</i>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0">
        <div class="mx-3">
            <a class="btn btn-outline-dark mt-4 w-100" href="{{ url('/') }}" type="button">View Website</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn bg-gradient-dark w-100 mt-2">Logout</button>
            </form>
        </div>
    </div>
</aside>