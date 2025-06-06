<footer class="site-footer py-5 bg-dark text-light">
    <div class="container">
        <div class="row">
            <!-- Branding and Social -->
            <div class="col-md-4 mb-4 mb-md-0">
                <h3 class="footer-heading text-white">Tokelo Foso</h3>
                <p class="footer-text">A creative portfolio showcasing the best of my work and services.</p>

                <div class="d-flex align-items-center gap-3 mt-3">
                    <a href="https://www.facebook.com/tokelo.foso" class="text-light fs-5" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.x.com/slkstr_" class="text-light fs-5" target="_blank">
                        <i class="fab fa-x-twitter"></i>
                    </a>
                    <a href="https://www.instagram.com/slkstrgrm" class="text-light fs-5" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.linkedin.com/in/tokelo-foso" class="text-light fs-5" target="_blank">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-md-4 mb-4 mb-md-0">
                <h3 class="footer-heading text-white">Quick Links</h3>
                <ul class="list-unstyled mt-3">
                    <li class="mb-2"><a href="{{ route('home') }}" class="text-light text-decoration-none">Home</a></li>
                    <li class="mb-2"><a href="{{ route('about') }}"  class="text-light text-decoration-none">About</a></li>
                    <li class="mb-2"><a href="{{ route('portfolio') }}" class="text-light text-decoration-none">Portfolio</a></li>
                    <li><a href="{{ route(name: 'contact') }}"  class="text-light text-decoration-none">Contact</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-md-4">
                <h3 class="footer-heading text-white">Contact Info</h3>
                <ul class="list-unstyled mt-3">
                    <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>Ha Matala Phase 2, Maseru, Lesotho</li>
                    <li class="mb-2"><i class="fas fa-phone me-2"></i>(+266) 6823 1628</li>
                    <li><i class="fas fa-envelope me-2"></i>hello@tokelofoso.online</li>
                </ul>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12 text-center">
                <p class="mb-0">&copy; {{ date('Y') }} <span class="fw-bold">Tokelo Foso</span>. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</footer>
<style>
      footer {
        background: radial-gradient(
        circle at 50% 50%,
        rgba(12, 10, 21, 0.3),
        #0f0f1d 50%,
        #0a0a23 100%
    );
    }

    footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('/images/background 2.jpg'); /* Ensure correct file path */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed; /* Parallax effect */
    filter: brightness(50%); /* Darkens only the background */
    z-index: -1; /* Places it behind content */
}
</style>