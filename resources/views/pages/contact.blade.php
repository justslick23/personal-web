@extends('layouts.app')

@section('content')
@section('title', 'Contact - Tokelo Foso')

    @include('partials.page-header', [
        'title' => 'Contact Me',
        'breadcrumbs' => [
            ['name' => 'Contact', 'url' => route('contact')],
        ]
    ])

  
    <!-- Contact Form & Info Section -->
    <section id="contact-main" class="section-padding">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8" data-aos="fade-up">
                    <div class="section-heading">
                        <h6 class="text-primary fw-bold text-uppercase mb-2">Get In Touch</h6>
                        <h2 class="display-4 fw-bold mb-4 text-gradient">Let's Work <span class="text-glow">Together</span></h2>
                        <div class="section-line mx-auto bg-primary my-4" style="width: 80px; height: 3px;"></div>
                        <p class="lead">Ready to bring your ideas to life? I'd love to hear about your project and discuss how we can create something amazing together.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row g-5">
                <!-- Contact Form -->
                <div class="col-lg-8" data-aos="fade-right">
                    <div class="modern-card">
                        <div class="contact-form-header mb-4">
                            <h3 class="text-gradient mb-3">Send Me a Message</h3>
                            <p class="text-secondary">Fill out the form below and I'll get back to you within 24 hours.</p>
                        </div>

                        <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" 
                                               class="form-control" 
                                               id="name" 
                                               name="name" 
                                               placeholder="Your Name"
                                               required>
                                        <label for="name">
                                            <i class="fas fa-user me-2 text-primary"></i>Full Name
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" 
                                               class="form-control" 
                                               id="email" 
                                               name="email" 
                                               placeholder="your@email.com"
                                               required>
                                        <label for="email">
                                            <i class="fas fa-envelope me-2 text-primary"></i>Email Address
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" 
                                               class="form-control" 
                                               id="subject" 
                                               name="subject" 
                                               placeholder="Project Subject"
                                               required>
                                        <label for="subject">
                                            <i class="fas fa-tag me-2 text-primary"></i>Subject
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" 
                                                  id="message" 
                                                  name="message" 
                                                  placeholder="Tell me about your project..."
                                                  style="height: 150px"
                                                  required></textarea>
                                        <label for="message">
                                            <i class="fas fa-comment-dots me-2 text-primary"></i>Your Message
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="g-recaptcha-response" id="recaptcha">

                            <div class="text-center mt-4">
                                <button type="submit" class="btn-primary-modern btn-modern">
                                    <i class="fas fa-paper-plane me-2"></i>
                                    Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="col-lg-4" data-aos="fade-left">
                    <!-- Contact Details Card -->
                    <div class="modern-card mb-4">
                        <div class="contact-info-header mb-4">
                            <h3 class="text-gradient mb-3">Contact Information</h3>
                            <p class="text-secondary">Feel free to reach out through any of these channels.</p>
                        </div>

                        <div class="contact-details">
                            <div class="contact-item d-flex align-items-center mb-4">
                                <div class="contact-icon me-3">
                                    <div class="icon-circle bg-primary-soft rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="fas fa-phone text-primary"></i>
                                    </div>
                                </div>
                                <div class="contact-text">
                                    <h5 class="mb-1">Phone</h5>
                                    <p class="text-secondary mb-0">(+266) 6823 1628</p>
                                </div>
                            </div>

                            <div class="contact-item d-flex align-items-center mb-4">
                                <div class="contact-icon me-3">
                                    <div class="icon-circle bg-primary-soft rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="fas fa-envelope text-primary"></i>
                                    </div>
                                </div>
                                <div class="contact-text">
                                    <h5 class="mb-1">Email</h5>
                                    <p class="text-secondary mb-0">hello@tokelofoso.online</p>
                                </div>
                            </div>

                            <div class="contact-item d-flex align-items-center mb-4">
                                <div class="contact-icon me-3">
                                    <div class="icon-circle bg-primary-soft rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                    </div>
                                </div>
                                <div class="contact-text">
                                    <h5 class="mb-1">Location</h5>
                                    <p class="text-secondary mb-0">Ha Matala Phase 2<br>Maseru, Lesotho</p>
                                </div>
                            </div>

                            <div class="contact-item d-flex align-items-center">
                                <div class="contact-icon me-3">
                                    <div class="icon-circle bg-primary-soft rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="fas fa-clock text-primary"></i>
                                    </div>
                                </div>
                                <div class="contact-text">
                                    <h5 class="mb-1">Response Time</h5>
                                    <p class="text-secondary mb-0">Within 24 hours</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Links Card -->
                    <div class="modern-card">
                        <h4 class="text-gradient mb-3">Connect With Me</h4>
                        <div class="social-connect d-flex gap-3">
                            <a href="#" class="social-icon">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="fab fa-github"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Location Map Section -->
    <section id="location-map" class="section-padding bg-dark">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10" data-aos="fade-up">
                    <div class="modern-card">
                        <div class="map-header text-center mb-4">
                            <h3 class="text-gradient mb-3">Find Me Here</h3>
                            <p class="text-secondary">Located in the heart of Maseru, Lesotho</p>
                        </div>
                        
                        <div class="map-container position-relative overflow-hidden rounded-lg">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3476.750137157566!2d27.550330300000002!3d-29.3776044!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1e8c4b84d8424af3%3A0xdc887001ca323b8d!2sGraphics%20by%20Slkstr.!5e0!3m2!1sen!2sls!4v1745340306415!5m2!1sen!2sls" 
                                    width="100%" 
                                    height="400" 
                                    style="border:0; filter: grayscale(1) contrast(1.2) opacity(0.8);" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                            
                            <!-- Map overlay for styling -->
                            <div class="map-overlay position-absolute top-0 start-0 w-100 h-100 pointer-events-none" 
                                 style="background: linear-gradient(135deg, rgba(0, 255, 136, 0.1) 0%, rgba(0, 102, 255, 0.1) 100%);"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="contact-cta" class="section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center" data-aos="fade-up">
                    <div class="cta-content">
                        <h2 class="display-5 fw-bold mb-4 text-gradient">Ready to Start Your Project?</h2>
                        <p class="lead mb-4">Whether you need a stunning website, eye-catching graphics, or a complete digital solution, I'm here to help bring your vision to life.</p>
                        <div class="cta-buttons d-flex flex-wrap gap-3 justify-content-center">
                            <a href="#contact-main" class="btn-primary-modern btn-modern">
                                <i class="fas fa-comment-dots me-2"></i>
                                Start a Conversation
                            </a>
                            <a href="{{ route('portfolio') }}" class="btn-modern">
                                <i class="fas fa-eye me-2"></i>
                                View My Work
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Initialize AOS Animation -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS if available
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    easing: 'ease-out',
                    once: true,
                    offset: 100
                });
            }
            
            // Smooth scrolling for internal links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
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

@endsection