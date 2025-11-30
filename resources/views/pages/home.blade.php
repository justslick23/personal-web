@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="hero-section d-flex align-items-center position-relative">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 scroll-animate">
                <div class="mb-4">
                    <span class="badge bg-dark border px-3 py-2 mb-3" style="border-color: var(--accent-primary) !important;">
                        <i class="fas fa-circle me-2" style="font-size: 8px; color: var(--accent-primary);"></i>
                        Available for work
                    </span>
                </div>
                
                <h1 class="display-2 fw-black mb-4 animate-fade-up">
                    <span>HI I AM</span><br>
                    <span class="text-gradient">TOKELO</span><br>
                    <span>FOSO</span>
                </h1>
                
                <p class="lead mb-4 text-secondary animate-fade-up" style="animation-delay: 0.2s; max-width: 500px;">
                    I am a creative designer specializing in
                    <span class="text-gradient typewriter" id="typewriter">Web Design</span>
                </p>
                
                <div class="d-flex gap-3 mb-5 animate-fade-up flex-wrap" style="animation-delay: 0.4s;">
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
                        <h3 class="h2 fw-bold mb-0" style="color: var(--accent-primary);" data-count="50">0</h3>
                        <small class="text-secondary">Projects</small>
                    </div>
                    <div class="col-4">
                        <h3 class="h2 fw-bold mb-0" style="color: var(--accent-primary);" data-count="3">0</h3>
                        <small class="text-secondary">Years Exp</small>
                    </div>
                    <div class="col-4">
                        <h3 class="h2 fw-bold mb-0" style="color: var(--accent-primary);" data-count="25">0</h3>
                        <small class="text-secondary">Happy Clients</small>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 text-center scroll-animate">
                <div class="profile-container animate-float">
                    <img src="{{ asset('images/me.jpg') }}" 
                         class="profile-image" 
                         alt="Tokelo Foso"
                         onerror="this.src='{{ asset('images/default-profile.jpg') }}'">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="section-padding">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 scroll-animate">
                <span class="section-label mb-3 d-block">ABOUT ME</span>
                <h2 class="display-4 fw-bold mb-4">
                    A Product Designer with<br>
                    a <span class="text-gradient">knack for turning</span><br>
                    problems into pixel-<br>
                    perfect solutions
                </h2>
            </div>
            
            <div class="col-lg-6 scroll-animate" style="animation-delay: 0.2s;">
                <div class="modern-card">
                    <p class="text-secondary mb-4">
                        I'm Tokelo, a versatile creative with a flair for design, a knack for coding, and a love for music. 
                        As a Graphic Designer and Web Developer, I thrive on turning concepts into captivating visuals and seamless digital experiences.
                    </p>
                    
                    <div class="row g-4 mb-4">
                        <div class="col-6">
                            <h6 class="fw-semibold mb-2" style="color: var(--accent-primary);">Experience</h6>
                            <p class="text-secondary mb-0">3+ Years</p>
                        </div>
                        <div class="col-6">
                            <h6 class="fw-semibold mb-2" style="color: var(--accent-primary);">Location</h6>
                            <p class="text-secondary mb-0">Maseru, Lesotho</p>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('download.cv') }}" class="btn-modern btn-primary-modern">
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
<section id="portfolio" class="section-padding" style="background: var(--bg-secondary);">
    <div class="container">
        <div class="section-header scroll-animate">
            <span class="section-label">FEATURED PROJECTS</span>
            <h2 class="section-title">
                My <span class="text-gradient">Recent Work</span>
            </h2>
            <p class="text-secondary mx-auto mt-4" style="max-width: 600px;">
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
            @forelse($portfolioItems as $index => $item)
                <div class="portfolio-item scroll-animate" 
                     data-category="{{ $item->category ?? 'uncategorized' }}" 
                     style="animation-delay: {{ $index * 0.1 }}s;">
                    <div class="modern-card p-0 overflow-hidden h-100">
                        <div class="position-relative overflow-hidden">
                            @php
                                // UPDATED IMAGE PATH LOGIC FOR PUBLIC FOLDER
                                $imagePath = asset('images/default-portfolio.jpg');
                                if (!empty($item->image)) {
                                    if (str_starts_with($item->image, 'http://') || str_starts_with($item->image, 'https://')) {
                                        $imagePath = $item->image;
                                    } else {
                                        // Image stored in public folder (images/portfolio/)
                                        $imagePath = asset($item->image);
                                    }
                                }
                            @endphp
                            
                            <img src="{{ $imagePath }}" 
                                 class="portfolio-image" 
                                 alt="{{ $item->title ?? 'Portfolio Item' }}"
                                 onerror="this.src='{{ asset('images/default-portfolio.jpg') }}'">
                            
                            <div class="portfolio-overlay">
                                <div class="text-center">
                                    @if(!empty($item->link) && in_array($item->category, ['Web App Design', 'Web Design']))
                                        <a href="{{ $item->link }}" class="btn-modern btn-primary-modern" target="_blank" rel="noopener">
                                            <i class="fas fa-external-link-alt"></i>
                                            View Project
                                        </a>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge" style="background: var(--accent-primary); color: var(--bg-primary);">
                                    {{ $item->category ?? 'Uncategorized' }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-4">
                            <h5 class="fw-bold mb-2">{{ $item->title ?? 'Untitled Project' }}</h5>
                            <p class="text-secondary mb-0 small">
                                {{ !empty($item->description) ? (strlen($item->description) > 100 ? substr($item->description, 0, 100) . '...' : $item->description) : 'No description available.' }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center scroll-animate">
                    <div class="py-5">
                        <i class="fas fa-folder-open fa-4x mb-4" style="color: var(--accent-primary); opacity: 0.5;"></i>
                        <h4 class="mb-3">Portfolio Coming Soon</h4>
                        <p class="text-secondary">Check back later for my latest work.</p>
                    </div>
                </div>
            @endforelse
        </div>

        @if($portfolioItems->isNotEmpty())
        <div class="text-center mt-5 scroll-animate">
            <a href="{{ route('portfolio') }}" class="btn-modern btn-primary-modern">
                <i class="fas fa-arrow-right"></i>
                View All Projects
            </a>
        </div>
        @endif
    </div>
</section>

<!-- Skills Section -->
<section class="section-padding">
    <div class="container">
        <div class="section-header scroll-animate">
            <span class="section-label">SKILLS & TOOLS</span>
            <h2 class="section-title">
                The Key Design and<br>
                <span class="text-gradient">Development Tools I Use</span>
            </h2>
        </div>
        
        <div class="row g-4">
            @php
            $skills = [
                ['name' => 'HTML5', 'icon' => 'fab fa-html5'],
                ['name' => 'CSS3', 'icon' => 'fab fa-css3-alt'],
                ['name' => 'JavaScript', 'icon' => 'fab fa-js-square'],
                ['name' => 'React', 'icon' => 'fab fa-react'],
                ['name' => 'PHP', 'icon' => 'fab fa-php'],
                ['name' => 'Laravel', 'icon' => 'fab fa-laravel'],
                ['name' => 'Adobe CC', 'icon' => 'fas fa-palette'],
                ['name' => 'Figma', 'icon' => 'fas fa-pen-nib']
            ];
            @endphp
            
            @foreach($skills as $index => $skill)
            <div class="col-lg-3 col-md-4 col-6 scroll-animate" style="animation-delay: {{ $index * 0.1 }}s;">
                <div class="modern-card text-center h-100">
                    <i class="{{ $skill['icon'] }} fa-3x mb-3" style="color: var(--accent-primary);"></i>
                    <h6 class="fw-semibold">{{ $skill['name'] }}</h6>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="section-padding" style="background: var(--bg-secondary);">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 scroll-animate">
                <span class="section-label mb-3 d-block">CONTACT</span>
                <h2 class="display-4 fw-bold mb-4">
                    Let's Talk About<br>
                    <span class="text-gradient">Your Project</span>
                </h2>
                <p class="lead text-secondary mb-5">
                    Ready to bring your vision to life? I'm here to help you create something amazing. 
                    Let's discuss your project and see how we can work together.
                </p>
                
                <div class="contact-info">
                    <div class="contact-item d-flex align-items-center mb-4">
                        <div class="contact-icon me-4">
                            <i class="fas fa-envelope fa-lg" style="color: var(--accent-primary);"></i>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-1">Email</h6>
                            <a href="mailto:hello@tokelofoso.online" style="color: var(--accent-primary);" class="text-decoration-none">
                                hello@tokelofoso.online
                            </a>
                        </div>
                    </div>
                    
                    <div class="contact-item d-flex align-items-center mb-4">
                        <div class="contact-icon me-4">
                            <i class="fas fa-phone fa-lg" style="color: var(--accent-primary);"></i>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-1">Phone</h6>
                            <a href="tel:+26668231628" style="color: var(--accent-primary);" class="text-decoration-none">
                                (+266) 6823 1628
                            </a>
                        </div>
                    </div>
                    
                    <div class="contact-item d-flex align-items-center mb-5">
                        <div class="contact-icon me-4">
                            <i class="fas fa-map-marker-alt fa-lg" style="color: var(--accent-primary);"></i>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-1">Location</h6>
                            <p class="text-secondary mb-0">Ha Matala Phase 2, Maseru, Lesotho</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 scroll-animate" style="animation-delay: 0.2s;">
                <div class="modern-card">
                    <h3 class="fw-bold mb-4">Send Me a Message</h3>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" 
                                           name="name" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           placeholder="Your Name" 
                                           value="{{ old('name') }}"
                                           required>
                                    <label for="name">Your Name</label>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" 
                                           name="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           placeholder="Your Email" 
                                           value="{{ old('email') }}"
                                           required>
                                    <label for="email">Your Email</label>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea name="message" 
                                              class="form-control @error('message') is-invalid @enderror" 
                                              id="message" 
                                              style="height: 120px;" 
                                              placeholder="Your Message" 
                                              required>{{ old('message') }}</textarea>
                                    <label for="message">Your Message</label>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                                @error('g-recaptcha-response')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
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
<!-- Google reCAPTCHA -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Typewriter Effect
    const roles = ["Web Designer", "Software Developer", "Graphic Designer", "UI/UX Designer"];
    let roleIndex = 0;
    let charIndex = 0;
    let isDeleting = false;
    const typewriterElement = document.getElementById('typewriter');
    
    function typeWriter() {
        if (!typewriterElement) return;
        
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
            
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
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
});
</script>
@endpush