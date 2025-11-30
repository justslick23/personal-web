{{-- Modern Header Component --}}
<header class="site-header">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="d-flex justify-content-between align-items-center w-100">
                <!-- Logo -->
                <a class="navbar-brand" href="{{ route('home') }}">
                    <div class="logo-container">
                        <span class="logo-icon">T</span>
                        <span class="logo-text">okelo</span>
                    </div>
                </a>
                
                <!-- Mobile Toggle -->
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                
                <!-- Navigation Links -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                                About
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('portfolio') ? 'active' : '' }}" href="{{ route('portfolio') }}">
                                Portfolio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('music') ? 'active' : '' }}" href="{{ route('music') }}">
                                Music
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                                Contact
                            </a>
                        </li>
                    </ul>
                    
                    <!-- Right Side Actions -->
                    <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
                        <a href="https://github.com/justslick23" class="nav-link" target="_blank" rel="noopener">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="{{ route('contact') }}" class="btn-modern btn-primary-modern">
                            <i class="fas fa-paper-plane"></i>
                            Hire Me
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

<!-- Scroll Progress Bar -->
<div class="scroll-progress" id="scrollProgress"></div>

@push('body-scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('.site-header');
    const scrollProgress = document.getElementById('scrollProgress');
    
    // Header scroll effect
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 20) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
        
        // Update scroll progress bar
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        scrollProgress.style.width = scrolled + '%';
    });
    
    // Close mobile menu when clicking on a link
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    const navCollapse = document.querySelector('.navbar-collapse');
    
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 992) {
                const bsCollapse = new bootstrap.Collapse(navCollapse, {
                    toggle: false
                });
                bsCollapse.hide();
            }
        });
    });
});
</script>
@endpush