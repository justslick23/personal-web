@extends('layouts.app')

@section('title', 'About Me - Tokelo Foso')

@section('content')

<!-- Compact Hero -->
<section class="hero-section" style="min-height: 70vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8 scroll-animate">
                <div class="profile-container mx-auto mb-4" style="max-width: 200px;">
                    <img src="{{ asset('images/me.jpg') }}" 
                         alt="Tokelo Foso" 
                         class="profile-image" 
                         style="border-radius: 50%;"
                         onerror="this.src='{{ asset('images/default-profile.jpg') }}'">
                </div>
                <h1 class="display-2 fw-black mb-3">
                    <span class="text-gradient">Tokelo Foso</span>
                </h1>
                <p class="lead text-secondary mb-4">Creative Designer • Web Developer • Problem Solver</p>
                
                <!-- Quick Nav -->
                <div class="d-flex gap-3 justify-content-center flex-wrap mb-4">
                    <a href="#expertise" class="btn-modern">
                        <i class="fas fa-code me-2"></i>Expertise
                    </a>
                    <a href="#journey" class="btn-modern">
                        <i class="fas fa-route me-2"></i>Journey
                    </a>
                    <a href="#interests" class="btn-modern">
                        <i class="fas fa-heart me-2"></i>Interests
                    </a>
                </div>
                
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('download.cv') }}" class="btn-modern btn-primary-modern" target="_blank">
                        <i class="fas fa-download me-2"></i>Download CV
                    </a>
                    <a href="{{ route('contact') }}" class="btn-modern">
                        <i class="fas fa-paper-plane me-2"></i>Get In Touch
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Story -->
<section class="section-padding" style="background: var(--bg-secondary);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center scroll-animate">
                <span class="section-label mb-3 d-block">About Me</span>
                <h2 class="display-4 fw-bold mb-4">
                    Crafting Digital <span class="text-gradient">Experiences</span>
                </h2>
                <p class="lead text-secondary mb-4">
                    I'm Tokelo, a versatile creative with a flair for design, a knack for coding, and a love for music. 
                    Based in Maseru, Lesotho, I thrive on turning concepts into captivating visuals and seamless digital experiences.
                </p>
                
                <!-- Stats Row -->
                <div class="row g-3 mt-5">
                    <div class="col-md-3 col-6">
                        <div class="modern-card py-4">
                            <h3 class="h1 fw-bold mb-1 text-gradient" data-count="50">0</h3>
                            <p class="text-secondary small mb-0">Projects Done</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="modern-card py-4">
                            <h3 class="h1 fw-bold mb-1 text-gradient" data-count="25">0</h3>
                            <p class="text-secondary small mb-0">Happy Clients</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="modern-card py-4">
                            <h3 class="h1 fw-bold mb-1 text-gradient" data-count="3">0</h3>
                            <p class="text-secondary small mb-0">Years Exp</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="modern-card py-4">
                            <h3 class="h1 fw-bold mb-1 text-gradient">12</h3>
                            <p class="text-secondary small mb-0">Skills</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Skills Grid - Expertise Section -->
<section id="expertise" class="section-padding">
    <div class="container">
        <div class="section-header scroll-animate">
            <span class="section-label">Expertise</span>
            <h2 class="section-title">Tech <span class="text-gradient">Stack</span></h2>
            <div class="section-line"></div>
        </div>

        <div class="row g-4">
            @php
            $skillCategories = [
                [
                    'category' => 'Frontend',
                    'skills' => [
                        ['name' => 'HTML5', 'icon' => 'fab fa-html5', 'level' => 95],
                        ['name' => 'CSS3', 'icon' => 'fab fa-css3-alt', 'level' => 90],
                        ['name' => 'JavaScript', 'icon' => 'fab fa-js-square', 'level' => 85],
                        ['name' => 'React', 'icon' => 'fab fa-react', 'level' => 80]
                    ]
                ],
                [
                    'category' => 'Backend',
                    'skills' => [
                        ['name' => 'PHP', 'icon' => 'fab fa-php', 'level' => 88],
                        ['name' => 'Laravel', 'icon' => 'fas fa-fire', 'level' => 85],
                        ['name' => 'Node.js', 'icon' => 'fab fa-node', 'level' => 75]
                    ]
                ],
                [
                    'category' => 'Design',
                    'skills' => [
                        ['name' => 'Figma', 'icon' => 'fas fa-pen-nib', 'level' => 90],
                        ['name' => 'Photoshop', 'icon' => 'fas fa-image', 'level' => 92],
                        ['name' => 'Illustrator', 'icon' => 'fas fa-paintbrush', 'level' => 88],
                        ['name' => 'UI/UX', 'icon' => 'fas fa-object-group', 'level' => 85],
                        ['name' => 'Branding', 'icon' => 'fas fa-bullhorn', 'level' => 80]
                    ]
                ]
            ];
            @endphp
            
            @foreach($skillCategories as $catIndex => $category)
            <div class="col-lg-4 scroll-animate" style="animation-delay: {{ $catIndex * 0.1 }}s;">
                <div class="modern-card h-100">
                    <h5 class="fw-bold mb-4 text-gradient">{{ $category['category'] }}</h5>
                    @foreach($category['skills'] as $skill)
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="d-flex align-items-center gap-2">
                                <i class="{{ $skill['icon'] }} text-gradient"></i>
                                <span class="fw-semibold small">{{ $skill['name'] }}</span>
                            </div>
                            <span class="text-secondary small">{{ $skill['level'] }}%</span>
                        </div>
                        <div class="progress" style="height: 4px;">
                            <div class="progress-bar" style="width: {{ $skill['level'] }}%; background: var(--accent-gradient);"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Experience Section - Journey -->
<section id="journey" class="section-padding" style="background: var(--bg-secondary);">
    <div class="container">
        <div class="section-header scroll-animate">
            <span class="section-label">Journey</span>
            <h2 class="section-title">My <span class="text-gradient">Path</span></h2>
            <div class="section-line"></div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                @php
                $experiences = [
                    ['type' => 'work', 'year' => '2022-Present', 'title' => 'Web Designer', 'org' => 'Computer Business Solutions', 'desc' => 'Led design projects for multiple clients, creating responsive websites and improving user experience.'],
                    ['type' => 'work', 'year' => '2021-2022', 'title' => 'Graphic Designer', 'org' => 'Osmium Lesotho', 'desc' => 'Created visual content for marketing campaigns and social media.'],
                    ['type' => 'education', 'year' => '2018-2020', 'title' => 'Bachelor of Computer Science', 'org' => 'Monash University', 'desc' => 'Majored in Mobile Systems & Software Development.'],
                    ['type' => 'education', 'year' => '2014-2016', 'title' => 'IGCSE', 'org' => 'Machabeng College', 'desc' => 'Completed with distinction in Mathematics and Computer Science.']
                ];
                @endphp

                @foreach($experiences as $index => $exp)
                <div class="row align-items-start mb-4 scroll-animate" style="animation-delay: {{ $index * 0.1 }}s;">
                    <div class="col-md-2 text-md-center mb-3 mb-md-0">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle" 
                             style="width: 60px; height: 60px; background: var(--accent-gradient);">
                            <i class="fas fa-{{ $exp['type'] == 'work' ? 'briefcase' : 'graduation-cap' }} fa-lg" 
                               style="color: var(--bg-primary);"></i>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="modern-card">
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <div>
                                    <h5 class="fw-bold mb-1">{{ $exp['title'] }}</h5>
                                    <p class="text-gradient mb-0">{{ $exp['org'] }}</p>
                                </div>
                                <span class="badge px-3 py-2" style="background: var(--accent-primary); color: var(--bg-primary);">
                                    {{ $exp['year'] }}
                                </span>
                            </div>
                            <p class="text-secondary small mb-0">{{ $exp['desc'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Interests Section -->
<section id="interests" class="section-padding">
    <div class="container">
        <div class="section-header scroll-animate">
            <span class="section-label">Interests</span>
            <h2 class="section-title">Beyond <span class="text-gradient">Code</span></h2>
            <div class="section-line"></div>
        </div>
        
        <div class="row g-4 justify-content-center">
            @php
            $interests = [
                ['icon' => 'fas fa-music', 'title' => 'Music Production', 'desc' => 'Creating beats and exploring sound design'],
                ['icon' => 'fas fa-rocket', 'title' => 'Tech Exploration', 'desc' => 'Always learning new frameworks and tools'],
                ['icon' => 'fas fa-plane-departure', 'title' => 'Travel & Culture', 'desc' => 'Experiencing different perspectives'],
                ['icon' => 'fas fa-gamepad', 'title' => 'Gaming', 'desc' => 'Strategic thinking and relaxation'],
                ['icon' => 'fas fa-book-reader', 'title' => 'Continuous Learning', 'desc' => 'Never stop growing and improving'],
                ['icon' => 'fas fa-users', 'title' => 'Mentorship', 'desc' => 'Helping others grow in their journey']
            ];
            @endphp
            
            @foreach($interests as $index => $interest)
            <div class="col-lg-4 col-md-6 scroll-animate" style="animation-delay: {{ $index * 0.08 }}s;">
                <div class="modern-card h-100 text-center py-4">
                    <div class="mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle" 
                             style="width: 80px; height: 80px; background: rgba(168, 85, 247, 0.1);">
                            <i class="{{ $interest['icon'] }} fa-2x text-gradient"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-2">{{ $interest['title'] }}</h5>
                    <p class="text-secondary small mb-0">{{ $interest['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section-padding" style="background: var(--bg-secondary);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="modern-card text-center py-5 scroll-animate">
                    <h2 class="display-5 fw-bold mb-3">
                        Ready to <span class="text-gradient">Collaborate?</span>
                    </h2>
                    <p class="lead text-secondary mb-4">
                        Let's create something amazing together
                    </p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="{{ route('contact') }}" class="btn-modern btn-primary-modern">
                            <i class="fas fa-rocket me-2"></i>Start a Project
                        </a>
                        <a href="{{ route('portfolio') }}" class="btn-modern">
                            <i class="fas fa-briefcase me-2"></i>View My Work
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
    
    // Scroll animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
            }
        });
    }, { threshold: 0.1 });
    
    document.querySelectorAll('.scroll-animate').forEach(el => observer.observe(el));
    
    // Counter animation
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
    
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = parseInt(entry.target.dataset.count);
                animateCounter(entry.target, target);
                counterObserver.unobserve(entry.target);
            }
        });
    });
    
    document.querySelectorAll('[data-count]').forEach(el => counterObserver.observe(el));
});
</script>
@endpush