<!-- Main Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ url('/dashboard') }}">Admin</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ ucfirst(request()->segment(count(request()->segments()))) }}</li>
        </ol>
      </nav>
      
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <!-- Search Box -->
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          <div class="input-group input-group-outline">
            <label class="form-label">Search...</label>
            <input type="text" class="form-control">
          </div>
        </div>
        
        <!-- Right Nav Items -->
        <ul class="navbar-nav d-flex align-items-center justify-content-end">
          <!-- Hamburger Menu for Mobile -->
          <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </a>
          </li>
          
          <!-- Settings -->
          <li class="nav-item px-3 d-flex align-items-center">
            <a href="{{ url('settings') }}" class="nav-link text-body p-0">
              <i class="material-symbols-rounded fixed-plugin-button-nav">settings</i>
            </a>
          </li>
          
          <!-- Notifications Dropdown -->
          <li class="nav-item dropdown pe-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="material-symbols-rounded">notifications</i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
              @if(isset($notifications) && count($notifications) > 0)
                @foreach($notifications as $notification)
                  <li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="javascript:;">
                      <div class="d-flex py-1">
                        <div class="my-auto">
                          <img src="{{ asset('assets/img/avatar.jpg') }}" class="avatar avatar-sm me-3">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="text-sm font-weight-normal mb-1">
                            {{ $notification->title }}
                          </h6>
                          <p class="text-xs text-secondary mb-0">
                            <i class="fa fa-clock me-1"></i>
                            {{ $notification->created_at->diffForHumans() }}
                          </p>
                        </div>
                      </div>
                    </a>
                  </li>
                @endforeach
              @else
                <li class="mb-2">
                  <div class="dropdown-item border-radius-md text-center">
                    No new notifications
                  </div>
                </li>
              @endif
            </ul>
          </li>
          
          <!-- User Profile -->
          <li class="nav-item d-flex align-items-center">
            <a href="{{ route('profile.edit') }}" class="nav-link text-body font-weight-bold px-0">
              <i class="material-symbols-rounded me-1">account_circle</i>
              <span class="d-sm-inline d-none">{{ Auth::user()->name }}</span>
            </a>
          </li>
          
          <!-- Logout -->
          <li class="nav-item d-flex align-items-center ps-2">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="btn btn-link nav-link text-body p-0">
                <i class="material-symbols-rounded">logout</i>
                <span class="d-sm-inline d-none">Logout</span>
              </button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->