{{-- Modern Footer Component --}}
<footer class="site-footer">
    <div class="container">
        <!-- Footer Content Grid -->
        <div class="footer-content">
            <!-- About Section -->
            <div class="footer-section scroll-reveal">
                <div class="logo-container mb-3">
                    <span class="logo-icon">T</span>
                    <span class="logo-text">okelo Foso</span>
                </div>
                <p class="text-secondary mb-4">
                    Creative designer and developer crafting meaningful digital experiences. 
                    Based in Maseru, Lesotho.
                </p>
                <div class="social-links">
                    <a href="https://www.linkedin.com/in/tokelo-foso/" class="social-link" target="_blank" rel="noopener" aria-label="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="https://github.com/justslick23" class="social-link" target="_blank" rel="noopener" aria-label="GitHub">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="https://www.facebook.com/tokelo.foso/" class="social-link" target="_blank" rel="noopener" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://x.com/slkstr_" class="social-link" target="_blank" rel="noopener" aria-label="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.instagram.com/slkstrgrm/" class="social-link" target="_blank" rel="noopener" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-section scroll-reveal" style="animation-delay: 0.1s;">
                <h5>Quick Links</h5>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Me</a></li>
                    <li><a href="{{ route('portfolio') }}">Portfolio</a></li>
                    <li><a href="{{ route('music') }}">Music</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div class="footer-section scroll-reveal" style="animation-delay: 0.2s;">
                <h5>Services</h5>
                <ul class="footer-links">
                    <li><a href="{{ route('portfolio') }}">Web Design</a></li>
                    <li><a href="{{ route('portfolio') }}">Web Development</a></li>
                    <li><a href="{{ route('portfolio') }}">Graphic Design</a></li>
                    <li><a href="{{ route('portfolio') }}">UI/UX Design</a></li>
                    <li><a href="{{ route('portfolio') }}">Branding</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="footer-section scroll-reveal" style="animation-delay: 0.3s;">
                <h5>Get In Touch</h5>
                <ul class="footer-links">
                    <li>
                        <i class="fas fa-envelope me-2" style="color: var(--accent-primary);"></i>
                        <a href="mailto:hello@tokelofoso.online">hello@tokelofoso.online</a>
                    </li>
                    <li>
                        <i class="fas fa-phone me-2" style="color: var(--accent-primary);"></i>
                        <a href="tel:+26668231628">(+266) 6823 1628</a>
                    </li>
                    <li>
                        <i class="fas fa-map-marker-alt me-2" style="color: var(--accent-primary);"></i>
                        Ha Matala Phase 2, Maseru
                    </li>
                    <li>
                        <i class="fas fa-clock me-2" style="color: var(--accent-primary);"></i>
                        Mon - Fri: 9AM - 6PM
                    </li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p class="mb-0">
                &copy; {{ date('Y') }} <span class="text-gradient">Tokelo Foso</span>. All rights reserved. 
                Built with <i class="fas fa-heart" style="color: var(--accent-primary);"></i> in Lesotho.
            </p>
        </div>
    </div>
</footer>

@push('body-scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scroll reveal for footer elements
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.footer-section').forEach(el => {
        observer.observe(el);
    });
});
</script>
@endpush