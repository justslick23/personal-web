<header class="site-header">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <!-- Logo -->
                <a class="navbar-brand" href="{{ route('home') }}">
                    <span class="logo-text"><span class="highlight">T</span>okelo</span>
                </a>

                <!-- Mobile Toggle Button -->
                <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="menu-icon"></span>
                </button>

                <!-- Navbar Links -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('about') ? 'active' : '' }}" href="{{ route('about') }}">About Me</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('portfolio') ? 'active' : '' }}" href="{{ route('portfolio') }}">Portfolio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('music') ? 'active' : '' }}" href="{{ route('music') }}">Music</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>

<style>
    .site-header {
        background-color: transparent !important; /* Makes the header background transparent */
        position: absolute; /* Allows section background to show through */
        width: 100%;
        z-index: 10; /* Keeps it above the other sections */
    }

    .nav-link.active {
        color: #fff !important;
        border-radius: 4px;
        padding: 8px 12px;
        font-weight: bolder;
    }

    /* Optional: Add a slight box-shadow or border to make the navbar stand out against certain backgrounds */
    .site-header .navbar {
    }
</style>
