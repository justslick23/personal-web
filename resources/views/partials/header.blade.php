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
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
        background-color: transparent;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .site-header.scrolled {
        background-color: var(--background-light); /* or use rgba(23, 23, 23, 0.9) for transparency */
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .nav-link.active {
        color: #fff !important;
        border-radius: 4px;
        padding: 8px 12px;
        font-weight: bolder;
    }

    body {
        padding-top: 80px; /* to avoid overlap */
    }
</style>

<script>
    window.addEventListener('scroll', function () {
        const header = document.querySelector('.site-header');
        if (window.scrollY > 10) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
</script>
