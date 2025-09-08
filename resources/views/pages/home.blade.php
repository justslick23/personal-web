@php
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
@endphp

@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/modern-portfolio.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@section('content')

<!-- Hero Section -->
<section class="hero-section d-flex align-items-center position-relative">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 scroll-animate">
                <div class="mb-4">
                    <span class="badge bg-dark border border-success rounded-pill px-3 py-2 mb-3">
                        <i class="fas fa-circle text-success me-2" style="font-size: 8px;"></i>
                        Available for work
                    </span>
                </div>
                
                <h1 class="display-2 fw-black mb-4 animate-fade-up">
                    <span class="text-white">HI I AM</span><br>
                    <span class="text-gradient">TOKELO</span><br>
                    <span class="text-white">FOSO</span>
                </h1>
                
                <p class="lead mb-4 text-secondary animate-fade-up" style="animation-delay: 0.2s; max-width: 500px;">
                    I am a creative designer specializing in
                    <span class="text-success typewriter" id="typewriter">Web Design</span>
                </p>
                
                <div class="d-flex gap-3 mb-5 animate-fade-up" style="animation-delay: 0.4s;">
                    <a href="#contact" class="btn-modern btn-primary-modern">
                        <i class="fas fa-paper-plane"></i>
                        Let's Talk
                    </a>
                    <a href="#portfolio" class="btn-modern">
                        <i class="fas fa-eye"></i>
                        View Work
                    </a>
                </div>
                
                <!-- Stats -->
                <div class="row g-4 animate-fade-up" style="animation-delay: 0.6s;">
                    <div class="col-4">
                        <h3 class="h2 fw-bold text-success mb-0" data-count="50">0</h3>
                        <small class="text-secondary">Projects</small>
                    </div>
                    <div class="col-4">
                        <h3 class="h2 fw-bold text-success mb-0" data-count="3">0</h3>
                        <small class="text-secondary">Years Exp</small>
                    </div>
                    <div class="col-4">
                        <h3 class="h2 fw-bold text-success mb-0" data-count="25">0</h3>
                        <small class="text-secondary">Happy Clients</small>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 text-center animate-fade-right">
                <div class="profile-container animate-float">
                    <img src="{{ asset('images/me.jpg') }}" 
                         class="profile-image" 
                         alt="Tokelo Foso">
                </div>
            </div>
        </div>
    </div>
    
    <!-- Social Icons - Desktop -->
    <div class="social-icons d-none d-lg-flex">
        <a href="https://www.facebook.com/tokelo.foso/" class="social-icon" title="Facebook">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="https://x.com/slkstr_" class="social-icon" title="Twitter">
            <i class="fab fa-twitter"></i>
        </a>
        <a href="https://www.linkedin.com/in/tokelo-foso/" class="social-icon" title="LinkedIn">
            <i class="fab fa-linkedin-in"></i>
        </a>
        <a href="https://www.instagram.com/slkstrgrm/" class="social-icon" title="Instagram">
            <i class="fab fa-instagram"></i>
        </a>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="position-absolute bottom-0 start-50 translate-middle-x mb-4">
        <div class="scroll-indicator">
            <div class="scroll-line"></div>
            <small class="text-secondary mt-2 d-block">Scroll</small>
        </div>
    </div>
</section>


<!-- About Section -->
<section id="about" class="section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 scroll-animate">
                <span class="text-success fw-semibold mb-3 d-block">ABOUT ME</span>
                <h2 class="display-4 fw-bold mb-4">
                    A Product Designer with<br>
                    a <span class="text-gradient">knack for turning</span><br>
                    problems into pixel-<br>
                    perfect, user-driven<br>
                    strategic solutions
                </h2>
            </div>
            
            <div class="col-lg-6 scroll-animate" style="animation-delay: 0.3s;">
                <div class="modern-card">
                    <p class="text-secondary mb-4">
                        I'm Tokelo, a versatile creative with a flair for design, a knack for coding, and a love for music. 
                        As a Graphic Designer and Web Developer, I thrive on turning concepts into captivating visuals and seamless digital experiences.
                    </p>
                    
                    <div class="row g-4 mb-4">
                        <div class="col-6">
                            <h6 class="text-success fw-semibold mb-2">Experience</h6>
                            <p class="text-secondary mb-0">3+ Years</p>
                        </div>
                        <div class="col-6">
                            <h6 class="text-success fw-semibold mb-2">Location</h6>
                            <p class="text-secondary mb-0">Maseru, Lesotho</p>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-3">
                        <a href="#contact" class="btn-modern btn-primary-modern">
                            <i class="fas fa-download"></i>
                            Download CV
                        </a>
                        <a href="#contact" class="btn-modern">
                            <i class="fas fa-paper-plane"></i>
                            Get In Touch
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Section -->
<section id="portfolio" class="section-padding">
    <div class="container">
        <div class="text-center mb-5 scroll-animate">
            <span class="text-success fw-semibold mb-3 d-block">FEATURED PROJECTS</span>
            <h2 class="display-4 fw-bold mb-4">
                My <span class="text-gradient">Recent Work</span>
            </h2>
            <p class="text-secondary mx-auto" style="max-width: 600px;">
                Here are some of my recent projects that showcase my design abilities and creative approach.
            </p>
        </div>

        <!-- Portfolio Filters -->
        <div class="filter-buttons scroll-animate">
            <button class="filter-btn active" data-filter="all">All Projects</button>
            <button class="filter-btn" data-filter="Web App Design">Web Apps</button>
            <button class="filter-btn" data-filter="Poster Design">Posters</button>
            <button class="filter-btn" data-filter="Branding">Branding</button>
        </div>

        <!-- Portfolio Grid -->
        <div class="portfolio-grid" id="portfolio-items">
            @if(isset($portfolioItems) && $portfolioItems->count() > 0)
                @foreach($portfolioItems as $index => $item)
                    <div class="portfolio-item scroll-animate" 
                         data-category="{{ $item->category }}" 
                         style="animation-delay: {{ $index * 0.1 }}s;">
                        <div class="position-relative overflow-hidden">
                            <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/default-portfolio.jpg') }}" 
                                 class="portfolio-image" 
                                 alt="{{ $item->title }}"
                                 onerror="this.src='{{ asset('images/default-portfolio.jpg') }}'">
                            
                            <div class="portfolio-overlay">
                                <div class="text-center">
                                    @if($item->link && $item->category == 'Web App Design')
                                        <a href="{{ $item->link }}" class="btn-modern btn-primary-modern" target="_blank">
                                            <i class="fas fa-external-link-alt"></i>
                                            View Project
                                        </a>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge bg-success">{{ $item->category }}</span>
                            </div>
                        </div>
                        
                        <div class="p-4">
                            <h5 class="fw-bold mb-2">{{ $item->title }}</h5>
                            <p class="text-secondary mb-0 small">
                                {{ Str::limit($item->description, 100) }}
                            </p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center scroll-animate">
                    <div class="py-5">
                        <i class="fas fa-folder-open fa-4x text-success mb-4"></i>
                        <h4 class="text-white mb-3">Portfolio Coming Soon</h4>
                        <p class="text-secondary">Check back later for my latest work.</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="text-center mt-5 scroll-animate">
            <a href="{{ route('portfolio') }}" class="btn-modern">
                <i class="fas fa-arrow-right"></i>
                View All Projects
            </a>
        </div>
    </div>
</section>


<!-- Experience Section -->
<section class="section-padding" style="background: #080808;">
    <div class="container">
        <div class="text-center mb-5 scroll-animate">
            <span class="text-success fw-semibold mb-3 d-block">EXPERIENCE</span>
            <h2 class="display-4 fw-bold mb-4">
                My <span class="text-gradient">Journey</span>
            </h2>
        </div>
        
        <div class="row">
            <div class="col-lg-6 mb-5">
                <h3 class="h4 fw-bold text-success mb-4 scroll-animate">
                    <i class="fas fa-briefcase me-2"></i>Work Experience
                </h3>
                
                <div class="timeline">
                    <div class="timeline-item scroll-animate">
                        <div class="modern-card">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="fw-bold text-white mb-1">Web Designer</h5>
                                    <p class="text-success mb-2">Computer Business Solutions</p>
                                </div>
                                <span class="badge bg-success">2022-Present</span>
                            </div>
                            <p class="text-secondary mb-0">
                                Led design projects for multiple clients, creating responsive websites and improving user experience across various industries.
                            </p>
                        </div>
                    </div>
                    
                    <div class="timeline-item scroll-animate" style="animation-delay: 0.2s;">
                        <div class="modern-card">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="fw-bold text-white mb-1">Graphic Designer</h5>
                                    <p class="text-success mb-2">Osmium Lesotho</p>
                                </div>
                                <span class="badge bg-success">2021-2022</span>
                            </div>
                            <p class="text-secondary mb-0">
                                Created visual content for marketing campaigns, social media, and websites. Worked closely with clients to bring their brand vision to life.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <h3 class="h4 fw-bold text-success mb-4 scroll-animate">
                    <i class="fas fa-graduation-cap me-2"></i>Education
                </h3>
                
                <div class="timeline">
                    <div class="timeline-item scroll-animate">
                        <div class="modern-card">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="fw-bold text-white mb-1">Bachelor of Computer and Information Sciences</h5>
                                    <p class="text-success mb-2">Monash University</p>
                                </div>
                                <span class="badge bg-success">2018-2020</span>
                            </div>
                            <p class="text-secondary mb-0">
                                Majored in Mobile Systems and Software Development. Gained expertise in programming, database management, and system design.
                            </p>
                        </div>
                    </div>
                    
                    <div class="timeline-item scroll-animate" style="animation-delay: 0.2s;">
                        <div class="modern-card">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="fw-bold text-white mb-1">IGCSE</h5>
                                    <p class="text-success mb-2">Machabeng College</p>
                                </div>
                                <span class="badge bg-success">2014-2016</span>
                            </div>
                            <p class="text-secondary mb-0">
                                Completed International General Certificate of Secondary Education with distinction in Mathematics and Computer Science.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Skills Section -->
<section class="section-padding">
    <div class="container">
        <div class="text-center mb-5 scroll-animate">
            <span class="text-success fw-semibold mb-3 d-block">SKILLS & TOOLS</span>
            <h2 class="display-4 fw-bold mb-4">
                The Key Design and<br>
                <span class="text-gradient">Development Tools I Use</span>
            </h2>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-4 col-6 scroll-animate">
                <div class="modern-card text-center h-100">
                    <i class="fab fa-html5 fa-3x text-success mb-3"></i>
                    <h6 class="fw-semibold">HTML5</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6 scroll-animate" style="animation-delay: 0.1s;">
                <div class="modern-card text-center h-100">
                    <i class="fab fa-css3-alt fa-3x text-success mb-3"></i>
                    <h6 class="fw-semibold">CSS3</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6 scroll-animate" style="animation-delay: 0.2s;">
                <div class="modern-card text-center h-100">
                    <i class="fab fa-js-square fa-3x text-success mb-3"></i>
                    <h6 class="fw-semibold">JavaScript</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6 scroll-animate" style="animation-delay: 0.3s;">
                <div class="modern-card text-center h-100">
                    <i class="fab fa-react fa-3x text-success mb-3"></i>
                    <h6 class="fw-semibold">React</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6 scroll-animate" style="animation-delay: 0.4s;">
                <div class="modern-card text-center h-100">
                    <i class="fab fa-php fa-3x text-success mb-3"></i>
                    <h6 class="fw-semibold">PHP</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6 scroll-animate" style="animation-delay: 0.5s;">
                <div class="modern-card text-center h-100">
                    <i class="fab fa-laravel fa-3x text-success mb-3"></i>
                    <h6 class="fw-semibold">Laravel</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6 scroll-animate" style="animation-delay: 0.6s;">
                <div class="modern-card text-center h-100">
                    <i class="fas fa-palette fa-3x text-success mb-3"></i>
                    <h6 class="fw-semibold">Adobe CC</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6 scroll-animate" style="animation-delay: 0.7s;">
                <div class="modern-card text-center h-100">
                    <i class="fas fa-pen-nib fa-3x text-success mb-3"></i>
                    <h6 class="fw-semibold">Figma</h6>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="section-padding" style="background: #080808;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 scroll-animate">
                <span class="text-success fw-semibold mb-3 d-block">CONTACT</span>
                <h2 class="display-4 fw-bold mb-4">
                    Let's Talk About<br>
                    <span class="text-gradient">Your Project</span>
                </h2>
                <p class="lead text-secondary mb-5">
                    Ready to bring your vision to life? I'm here to help you create something amazing. 
                    Let's discuss your project and see how we can work together.
                </p>
                
                <div class="contact-info">
                    <div class="d-flex align-items-center mb-4">
                        <div class="me-4">
                            <div class="contact-icon">
                                <i class="fas fa-envelope fa-lg text-success"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-1">Email</h6>
                            <a href="mailto:hello@tokelofoso.online" class="text-success text-decoration-none">
                                hello@tokelofoso.online
                            </a>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="me-4">
                            <div class="contact-icon">
                                <i class="fas fa-phone fa-lg text-success"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-1">Phone</h6>
                            <a href="tel:+26668231628" class="text-success text-decoration-none">
                                (+266) 6823 1628
                            </a>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center mb-5">
                        <div class="me-4">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt fa-lg text-success"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-1">Location</h6>
                            <p class="text-secondary mb-0">Ha Matala Phase 2, Maseru, Lesotho</p>
                        </div>
                    </div>
                </div>
                
                <!-- Social Icons - Mobile -->
                <div class="social-icons d-flex d-lg-none justify-content-start mb-4">
                    <a href="https://www.facebook.com/tokelo.foso/" class="social-icon me-3" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://x.com/slkstr_" class="social-icon me-3" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.linkedin.com/in/tokelo-foso/" class="social-icon me-3" title="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="https://www.instagram.com/slkstrgrm/" class="social-icon" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-6 scroll-animate" style="animation-delay: 0.3s;">
                <div class="modern-card">
                    <h3 class="fw-bold mb-4">Send Me a Message</h3>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                                    <label for="name" class="text-secondary">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Your Email" required>
                                    <label for="email" class="text-secondary">Your Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" name="subject" class="form-control" id="subject" placeholder="Subject">
                                    <label for="subject" class="text-secondary">Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea name="message" class="form-control" id="message" style="height: 120px;" placeholder="Your Message" required></textarea>
                                    <label for="message" class="text-secondary">Your Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <input type="hidden" name="g-recaptcha-response" id="recaptcha">
                                <button type="submit" class="btn-modern btn-primary-modern w-100 py-3">
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



@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Typewriter Effect
    const roles = ["Web Designer", "Software Developer", "Graphic Designer", "UI/UX Designer"];
    let roleIndex = 0;
    let charIndex = 0;
    let isDeleting = false;
    const typewriterElement = document.getElementById('typewriter');
    
    function typeWriter() {
        const currentRole = roles[roleIndex];
        
        if (isDeleting) {
            typewriterElement.textContent = currentRole.substring(0, charIndex - 1);
            charIndex--;
        } else {
            typewriterElement.textContent = currentRole.substring(0, charIndex + 1);
            charIndex++;
        }
        
        let speed = isDeleting ? 50 : 100;
        
        if (!isDeleting && charIndex === currentRole.length) {
            speed = 2000;
            isDeleting = true;
        } else if (isDeleting && charIndex === 0) {
            isDeleting = false;
            roleIndex = (roleIndex + 1) % roles.length;
            speed = 200;
        }
        
        setTimeout(typeWriter, speed);
    }
    
    typeWriter();
    
    // Portfolio Filter
    const filterButtons = document.querySelectorAll('.filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.dataset.filter;
            
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Filter items
            portfolioItems.forEach(item => {
                const category = item.dataset.category;
                if (filter === 'all' || category === filter) {
                    item.style.display = 'block';
                    item.style.animation = 'fadeInUp 0.5s ease-out';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
    
    // Smooth Scroll for Anchor Links
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
    
    // Scroll Animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.scroll-animate').forEach(el => {
        observer.observe(el);
    });
    
    // Counter Animation
    function animateCounter(element, target) {
        let current = 0;
        const increment = target / 50;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current);
        }, 50);
    }
    
    // Trigger counters when they come into view
    const counterObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = parseInt(entry.target.dataset.count);
                animateCounter(entry.target, target);
                counterObserver.unobserve(entry.target);
            }
        });
    });
    
    document.querySelectorAll('[data-count]').forEach(el => {
        counterObserver.observe(el);
    });
    
    // reCAPTCHA
    if (typeof grecaptcha !== 'undefined') {
        grecaptcha.ready(function () {
            grecaptcha.execute('{{ config('captcha.sitekey') }}', {action: 'contact'}).then(function (token) {
                document.getElementById('recaptcha').value = token;
            });
        });
    }
});
</script>

{!! NoCaptcha::renderJs() !!}
@endpush