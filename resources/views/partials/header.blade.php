<header class="site-header">
    <div class="navbar-wrapper">
        <nav class="navbar navbar-expand-lg">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <div class="logo-container">
                    <span class="logo-icon">T</span>
                    <span class="logo-text">okelo</span>
                    <span class="version-badge">v1.0</span>
                </div>
            </a>
            
            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>
            
            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('about') ? 'active' : '' }}" href="{{ route('about') }}">
                            About Me
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('portfolio') ? 'active' : '' }}" href="{{ route('portfolio') }}">
                            Portfolio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('music') ? 'active' : '' }}" href="{{ route('music') }}">
                            Music
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                            Contact
                        </a>
                    </li>
                </ul>
                
                <!-- Right side elements -->
                <div class="navbar-right d-flex align-items-center gap-3">
                    <!-- Search -->
                  {{--   <div class="search-container">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Search">
                        <kbd class="search-kbd">ctrl K</kbd>
                    </div>
                    
                    <!-- Theme Toggle -->
                    <button class="theme-toggle" aria-label="Toggle theme">
                        <i class="fas fa-sun"></i>
                    </button> --}}
                    
                    <!-- GitHub Link -->
                    <a href="https://github.com/justslick23" class="social-link" aria-label="GitHub">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
            </div>
        </nav>
    </div>
</header>

<style>
:root {
    --bg-primary: #0f0f0f;
    --bg-secondary: #1a1a1a;
    --bg-tertiary: #262626;
    --text-primary: #ffffff;
    --text-secondary: #a1a1aa;
    --text-muted: #71717a;
    --border-color: #27272a;
    --accent-primary: #3b82f6;
    --accent-secondary: #8b5cf6;
    --glass-bg: rgba(255, 255, 255, 0.03);
    --glass-border: rgba(255, 255, 255, 0.08);
    --hover-bg: rgba(255, 255, 255, 0.05);
}

.site-header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 9999; /* Higher z-index for more dominance */
    background: rgba(15, 15, 15, 0.12); /* More transparent */
    backdrop-filter: blur(16px); /* Increased blur */
    -webkit-backdrop-filter: blur(16px);
    border-bottom: 1px solid var(--glass-border);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.25); /* Optional: add depth */
    transition: all 0.3s ease;
}

.site-header.scrolled {
    background: rgba(15, 15, 15, 0.85);
    border-bottom-color: var(--glass-border);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
}

.navbar {
    padding: 1rem 0;
    min-height: 64px;
}

.navbar-wrapper {
  max-width: 960px;  /* or any width you want */
  margin: 0 auto;
  padding: 0 1rem;
  width: 100%;
}


/* Logo Styles */
.logo-container {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
    transition: opacity 0.2s ease;
}

.logo-container:hover {
    opacity: 0.8;
}

.logo-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, #3b82f6, #8b5cf6);
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 700;
    color: white;
    transition: transform 0.2s ease;
}

.logo-container:hover .logo-icon {
    transform: scale(1.05);
}

.logo-text {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
    letter-spacing: -0.025em;
}

.version-badge {
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    color: var(--text-muted);
    font-size: 0.75rem;
    font-weight: 500;
    padding: 0.125rem 0.375rem;
    border-radius: 4px;
    margin-left: 0.25rem;
}

/* Navigation Links */
.navbar-nav {
    gap: 0.85rem;
    margin: 0 auto; /* Center horizontally */
    display: flex;
    justify-content: center;
    align-items: center;
}

.navbar-collapse {
    justify-content: center; /* Add this */
}

.nav-link {
    color: var(--text-secondary) !important;
    font-weight: 700;
    font-size: 1.1rem;
    padding: 0.5rem 0.75rem !important;
    border-radius: 6px;
    transition: all 0.2s ease;
    text-decoration: none;
    position: relative;
}

.nav-link:hover {
    color: var(--text-primary) !important;
    background: var(--hover-bg);
}

.nav-link.active {
    color: var(--text-primary) !important;
    background: var(--glass-bg);
}

/* Right side elements */
.navbar-right {
    align-items: center;
}

/* Search Input */
.search-container {
    position: relative;
    display: flex;
    align-items: center;
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    border-radius: 8px;
    padding: 0.5rem 0.75rem;
    transition: all 0.2s ease;
    min-width: 200px;
}

.search-container:hover,
.search-container:focus-within {
    background: var(--hover-bg);
    border-color: var(--accent-primary);
}

.search-icon {
    color: var(--text-muted);
    font-size: 0.875rem;
    margin-right: 0.5rem;
}

.search-input {
    background: transparent;
    border: none;
    outline: none;
    color: var(--text-primary);
    font-size: 0.875rem;
    flex: 1;
    min-width: 0;
}

.search-input::placeholder {
    color: var(--text-muted);
}

.search-kbd {
    background: var(--bg-tertiary);
    border: 1px solid var(--border-color);
    border-radius: 4px;
    color: var(--text-muted);
    font-size: 0.75rem;
    font-family: ui-monospace, monospace;
    padding: 0.125rem 0.25rem;
    margin-left: 0.5rem;
    line-height: 1;
}

/* Theme Toggle */
.theme-toggle {
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    border-radius: 6px;
    color: var(--text-secondary);
    padding: 0.5rem;
    transition: all 0.2s ease;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
}

.theme-toggle:hover {
    background: var(--hover-bg);
    color: var(--text-primary);
    border-color: var(--accent-primary);
}

/* Social Links */
.social-link {
    color: var(--text-secondary);
    font-size: 1.125rem;
    transition: color 0.2s ease;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 6px;
}

.social-link:hover {
    color: var(--text-primary);
    background: var(--hover-bg);
}

/* Mobile Toggle */
.custom-toggler {
    border: none;
    padding: 0.5rem;
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    border-radius: 6px;
    transition: all 0.2s ease;
}

.custom-toggler:hover {
    background: var(--hover-bg);
}

.custom-toggler:focus {
    box-shadow: 0 0 0 2px var(--accent-primary);
    outline: none;
}

.hamburger-line {
    display: block;
    width: 18px;
    height: 2px;
    background: var(--text-primary);
    margin: 3px 0;
    transition: all 0.3s ease;
    border-radius: 1px;
}

.custom-toggler:not(.collapsed) .hamburger-line:nth-child(1) {
    transform: rotate(45deg) translate(5px, 5px);
}

.custom-toggler:not(.collapsed) .hamburger-line:nth-child(2) {
    opacity: 0;
}

.custom-toggler:not(.collapsed) .hamburger-line:nth-child(3) {
    transform: rotate(-45deg) translate(5px, -5px);
}



/* Mobile Styles */
@media (max-width: 991.98px) {
    .navbar-collapse {
        margin-top: 1rem;
        padding: 1.5rem;
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    
    .navbar-nav {
        flex-direction: column;
        gap: 0.25rem;
        margin-bottom: 1rem;
    }
    
    .nav-link {
        width: 100%;
        text-align: left;
        padding: 0.75rem 1rem !important;
    }
    
    .navbar-right {
        flex-direction: column;
        gap: 0.75rem;
        width: 100%;
        align-items: stretch;
    }
    
    .search-container {
        width: 100%;
        min-width: auto;
    }
    
    .theme-toggle,
    .social-link {
        width: 100%;
        justify-content: flex-start;
        padding: 0.75rem 1rem;
        border-radius: 6px;
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
    }
}

/* Body padding for fixed header */
body {
    padding-top: 80px;
}

/* Smooth animations */
* {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

/* Focus styles for accessibility */
.nav-link:focus,
.search-input:focus,
.theme-toggle:focus,
.social-link:focus {
    outline: 2px solid var(--accent-primary);
    outline-offset: 2px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('.site-header');
    const toggler = document.querySelector('.custom-toggler');
    const searchInput = document.querySelector('.search-input');
    const themeToggle = document.querySelector('.theme-toggle');
    
    // Scroll effect
    let ticking = false;
    
    function updateHeader() {
        if (window.scrollY > 20) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
        ticking = false;
    }
    
    function requestTick() {
        if (!ticking) {
            requestAnimationFrame(updateHeader);
            ticking = true;
        }
    }
    
    window.addEventListener('scroll', requestTick);
    
    // Mobile menu toggle
    toggler.addEventListener('click', function() {
        this.classList.toggle('collapsed');
    });
    
    // Search functionality
    if (searchInput) {
        // Keyboard shortcut (Ctrl+K)
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                searchInput.focus();
            }
        });
        
        // Search input animation
        searchInput.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
        });
        
        searchInput.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    }
    
    // Theme toggle functionality
    if (themeToggle) {
        themeToggle.addEventListener('click', function() {
            const icon = this.querySelector('i');
            if (icon.classList.contains('fa-sun')) {
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            } else {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            }
            
            // Add theme switching logic here
            document.body.classList.toggle('light-theme');
        });
    }
    
    // Smooth scroll for navigation links
    document.querySelectorAll('.nav-link[href^="#"]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>