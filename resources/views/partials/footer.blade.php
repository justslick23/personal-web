<footer class="site-footer position-relative overflow-hidden">
    <!-- Wishlist CTA Section -->
    <div class="wishlist-cta py-5 position-relative text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="mb-4">
                        <div class="cta-icon rounded-circle p-4 d-inline-block mb-3">
                            <i class="fas fa-heart fs-1"></i>
                        </div>
                        <h3 class="fw-bold mb-3 text-gradient">A Little Help Goes a Long Way 💙</h3>
                        <p class="text-secondary fs-5 mb-4">
                            I'm putting together a few things I need — whether it's for the new space or just to treat myself a little.  
                            If you'd like to chip in, check out my wishlist and pick something meaningful.
                        </p>
                        <a href="{{ route('wishlist.public') }}" class="btn-modern btn-primary-modern px-5 py-3">
                            <i class="fas fa-gift me-2"></i>
                            View My Wishlist
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Footer -->
    <div class="main-footer py-5">
        <div class="container">
            <div class="row g-5">
                <!-- Brand -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand">
                        <h2 class="fw-bold mb-3 text-gradient">Tokelo Foso</h2>
                        <p class="text-secondary mb-4 fs-6">
                            Creative Designer & Developer crafting exceptional digital experiences. 
                            Let's build something amazing together.
                        </p>
                        <div class="social-links d-flex gap-3">
                            <a href="https://www.facebook.com/tokelo.foso" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.x.com/slkstr_" class="social-icon"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.instagram.com/slkstrgrm" class="social-icon"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.linkedin.com/in/tokelo-foso" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6">
                    <div class="footer-links">
                        <h5 class="fw-semibold text-white mb-4">
                            <i class="fas fa-link me-2 text-primary"></i>Quick Links
                        </h5>
                        <ul class="list-unstyled">
                            <li class="mb-3"><a href="{{ route('home') }}" class="footer-link"><i class="fas fa-home me-2"></i>Home</a></li>
                            <li class="mb-3"><a href="{{ route('about') }}" class="footer-link"><i class="fas fa-user me-2"></i>About</a></li>
                            <li class="mb-3"><a href="{{ route('portfolio') }}" class="footer-link"><i class="fas fa-folder-open me-2"></i>Portfolio</a></li>
                            <li class="mb-3"><a href="{{ route('contact') }}" class="footer-link"><i class="fas fa-envelope me-2"></i>Contact</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Services -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-services">
                        <h5 class="fw-semibold text-white mb-4">
                            <i class="fas fa-tools me-2 text-primary"></i>Services
                        </h5>
                        <ul class="list-unstyled">
                            <li class="mb-3"><i class="fas fa-palette text-primary me-2"></i><span class="text-secondary">Graphic Design</span></li>
                            <li class="mb-3"><i class="fas fa-bullhorn text-primary me-2"></i><span class="text-secondary">Brand Identity</span></li>
                        </ul>
                    </div>
                </div>

                <!-- Contact -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-contact">
                        <h5 class="fw-semibold text-white mb-4">
                            <i class="fas fa-address-card me-2 text-primary"></i>Get In Touch
                        </h5>
                        <p class="text-secondary mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i>Ha Matala Phase 2, Maseru, Lesotho</p>
                        <p class="text-secondary mb-2"><i class="fas fa-phone text-primary me-2"></i><a href="tel:+26668231628" class="text-secondary text-decoration-none">(+266) 6823 1628</a></p>
                        <p class="text-secondary mb-4"><i class="fas fa-envelope text-primary me-2"></i><a href="mailto:hello@tokelofoso.online" class="text-secondary text-decoration-none">hello@tokelofoso.online</a></p>
                        <div class="d-flex align-items-center">
                            <div class="status-indicator me-2"></div>
                            <small class="text-success fw-semibold">Available for Projects</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="footer-bottom py-4 border-top border-opacity-25">
        <div class="container d-flex flex-wrap justify-content-between align-items-center">
            <p class="mb-0 text-secondary">&copy; {{ date('Y') }} <span class="text-gradient">Tokelo Foso</span>. All Rights Reserved.</p>
            <div class="d-flex gap-4 mt-3 mt-md-0">
                <small class="text-secondary"><i class="fas fa-heart text-accent me-1"></i> Made with love in Lesotho</small>
                <small class="text-secondary"><i class="fas fa-code text-primary me-1"></i> Coded with passion</small>
            </div>
        </div>
    </div>
</footer>
