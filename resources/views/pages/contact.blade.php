@extends('layouts.app')

@section('title', 'Contact - Tokelo Foso')

@section('content')
@include('partials.page-header', [
    'title' => 'Contact Me',
    'breadcrumbs' => [['name' => 'Contact', 'url' => route('contact')]]
])
<!-- Full Screen Split Contact -->
<section class="section-padding" style="min-height: calc(100vh - 80px);">
    <div class="container-fluid h-100 p-0">
        <div class="row g-0 h-100">
            <!-- Left Side - Contact Info -->
            <div class="col-lg-5 d-flex align-items-center" style="background: var(--bg-secondary); min-height: 600px;">
                <div class="p-5 w-100 scroll-animate">
                    <span class="badge px-4 py-2 mb-4" style="background: rgba(168, 85, 247, 0.1); border: 1px solid var(--accent-primary);">
                        <i class="fas fa-envelope me-2"></i>Get In Touch
                    </span>
                    
                    <h1 class="display-3 fw-black mb-4">
                        Let's<br>
                        <span class="text-gradient">Connect</span>
                    </h1>
                    
                    <p class="lead text-secondary mb-5">
                        Have a project in mind? Let's discuss how we can bring your vision to life.
                    </p>
                    
                    <!-- Contact Cards -->
                    <div class="mb-4">
                        <div class="modern-card mb-3">
                            <div class="d-flex align-items-center">
                                <div class="contact-icon me-3">
                                    <i class="fas fa-phone" style="color: var(--accent-primary);"></i>
                                </div>
                                <div>
                                    <small class="text-secondary d-block mb-1">Phone</small>
                                    <a href="tel:+26668231628" class="text-decoration-none" style="color: var(--text-primary);">
                                        <strong>(+266) 6823 1628</strong>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modern-card mb-3">
                            <div class="d-flex align-items-center">
                                <div class="contact-icon me-3">
                                    <i class="fas fa-envelope" style="color: var(--accent-primary);"></i>
                                </div>
                                <div>
                                    <small class="text-secondary d-block mb-1">Email</small>
                                    <a href="mailto:hello@tokelofoso.online" class="text-decoration-none" style="color: var(--text-primary);">
                                        <strong>hello@tokelofoso.online</strong>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modern-card mb-3">
                            <div class="d-flex align-items-center">
                                <div class="contact-icon me-3">
                                    <i class="fas fa-map-marker-alt" style="color: var(--accent-primary);"></i>
                                </div>
                                <div>
                                    <small class="text-secondary d-block mb-1">Location</small>
                                    <strong>Ha Matala, Maseru, Lesotho</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Links -->
                    <div class="mb-4">
                        <p class="text-secondary small mb-3">FOLLOW ME</p>
                        <div class="d-flex gap-2">
                            <a href="https://www.linkedin.com/in/tokelo-foso/" class="social-link" target="_blank">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="https://www.facebook.com/tokelo.foso/" class="social-link" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://x.com/slkstr_" class="social-link" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.instagram.com/slkstrgrm/" class="social-link" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Response Badge -->
                    <div class="badge px-4 py-3" style="background: rgba(168, 85, 247, 0.1); border: 1px solid var(--accent-primary);">
                        <i class="fas fa-clock me-2" style="color: var(--accent-primary);"></i>
                        <span class="text-secondary">Response within 24 hours</span>
                    </div>
                </div>
            </div>
            
            <!-- Right Side - Contact Form -->
            <div class="col-lg-7 d-flex align-items-center" style="min-height: 600px;">
                <div class="p-5 w-100 scroll-animate" style="animation-delay: 0.2s; max-width: 700px; margin: 0 auto;">
                    <h2 class="display-5 fw-bold mb-4">Send a Message</h2>
                    
                    @if(session('success'))
                        <div class="alert alert-success mb-4">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" id="message" name="message" placeholder="Message" style="height: 200px;" required></textarea>
                                    <label for="message">Your Message</label>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <button type="submit" class="btn-modern btn-primary-modern w-100" style="padding: 1.25rem;">
                                    <i class="fas fa-paper-plane me-2"></i>
                                    Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="section-padding" style="background: var(--bg-secondary); padding: 0;">
    <div class="container-fluid p-0">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3476.750137157566!2d27.550330300000002!3d-29.3776044!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1e8c4b84d8424af3%3A0xdc887001ca323b8d!2sGraphics%20by%20Slkstr.!5e0!3m2!1sen!2sls!4v1745340306415!5m2!1sen!2sls" 
                width="100%" 
                height="500" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</section>

<!-- Quick CTA Bar -->
<section class="section-padding" style="padding: 3rem 0;">
    <div class="container">
        <div class="modern-card py-4 px-5 scroll-animate">
            <div class="row align-items-center">
                <div class="col-lg-8 mb-3 mb-lg-0">
                    <h4 class="fw-bold mb-2">Ready to start your project?</h4>
                    <p class="text-secondary mb-0">Let's collaborate and create something extraordinary together.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('portfolio') }}" class="btn-modern">
                        <i class="fas fa-briefcase me-2"></i>View Portfolio
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, { threshold: 0.1 });
    
    document.querySelectorAll('.scroll-animate').forEach(el => observer.observe(el));
});
</script>
@endpush