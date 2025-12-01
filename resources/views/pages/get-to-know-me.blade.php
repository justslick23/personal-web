@extends('layouts.app')

@section('title', 'Get to Know Me - Tokelo Foso')

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
                    Get to Know <span class="text-gradient">Me</span>
                </h1>
                <p class="lead text-secondary mb-4">Beyond the surface — who I really am</p>
                
                <!-- Quick Nav -->
                <div class="d-flex gap-3 justify-content-center flex-wrap mb-4">
                    <a href="#who-i-am" class="btn-modern">
                        <i class="fas fa-user me-2"></i>Who I Am
                    </a>
                    <a href="#personality" class="btn-modern">
                        <i class="fas fa-heart me-2"></i>Personality
                    </a>
                    <a href="#relationships" class="btn-modern">
                        <i class="fas fa-hand-holding-heart me-2"></i>Relationships
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Who I Am -->
<section id="who-i-am" class="section-padding" style="background: var(--bg-secondary);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="text-center mb-5 scroll-animate">
                    <span class="section-label mb-3 d-block">Introduction</span>
                    <h2 class="display-4 fw-bold mb-4">
                        Who <span class="text-gradient">I Am</span>
                    </h2>
                </div>
                
                <div class="scroll-animate">
                    <div class="modern-card p-5">
                        <p class="lead mb-4">
                            My name is <strong class="text-gradient">Tokelo Foso</strong>, also known as <strong>Slickster</strong>, and I'm 26.
                        </p>
                        <p class="text-secondary mb-4">
                            I'm a simple guy in a lot of ways — I like peace, consistency, and building a steady life — but I'm also someone with ambition, creativity, and a drive for growth. I'm at that point where I'm shaping my future with intention, and I genuinely want to connect with people who add value to my life.
                        </p>
                        <p class="text-secondary mb-0">
                            I carry a calm energy. I don't force things. <em class="text-gradient">If it flows, it flows. If it doesn't, I don't stress it.</em>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- What I Do -->
<section class="section-padding">
    <div class="container">
        <div class="section-header scroll-animate">
            <span class="section-label">My Work</span>
            <h2 class="section-title">What <span class="text-gradient">I Do</span></h2>
            <div class="section-line"></div>
        </div>
        
        <div class="row g-4">
            @php
            $workAreas = [
                [
                    'icon' => 'fas fa-code',
                    'title' => 'Software Development & Web Design',
                    'company' => 'Computer Business Solutions',
                    'desc' => 'I work in software development and web design, and honestly, I enjoy it. I like creating things from scratch — systems, solutions, digital tools — anything that can help someone or make life easier. My background is in Computer Science, and I\'ve built real systems that people actually use.'
                ],
                [
                    'icon' => 'fas fa-music',
                    'title' => 'Music Production',
                    'company' => 'Hip Hop & Amapiano',
                    'desc' => 'I produce Hip Hop and Amapiano — the soulful, mellow, emotional kind. Music helps me think, relax, and express myself in a way nothing else does. It\'s a passion I take seriously, but I also enjoy it. It keeps me grounded.'
                ],
                [
                    'icon' => 'fas fa-palette',
                    'title' => 'Graphic Design',
                    'company' => 'Visual Creativity',
                    'desc' => 'I also do graphic design, which is another space where I get to be creative, experiment with ideas, and bring visuals to life. Tech is a big part of who I am, but it\'s not the whole picture. It\'s just one of the ways I express my creativity.'
                ]
            ];
            @endphp
            
            @foreach($workAreas as $index => $work)
            <div class="col-lg-4 scroll-animate" style="animation-delay: {{ $index * 0.1 }}s;">
                <div class="modern-card h-100 text-center">
                    <div class="mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle" 
                             style="width: 80px; height: 80px; background: var(--accent-gradient);">
                            <i class="{{ $work['icon'] }} fa-2x" style="color: var(--bg-primary);"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold mb-2">{{ $work['title'] }}</h4>
                    <p class="text-gradient small fw-semibold mb-3">{{ $work['company'] }}</p>
                    <p class="text-secondary small mb-0">{{ $work['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Personality & Values -->
<section id="personality" class="section-padding" style="background: var(--bg-secondary);">
    <div class="container">
        <div class="section-header scroll-animate">
            <span class="section-label">Personality</span>
            <h2 class="section-title">My Energy & <span class="text-gradient">Vibe</span></h2>
            <div class="section-line"></div>
        </div>
        
        <div class="row g-5">
            <!-- Personality Traits -->
            <div class="col-lg-6 scroll-animate">
                <div class="modern-card h-100">
                    <h4 class="fw-bold mb-4">I'm a mix of:</h4>
                    @php
                    $traits = [
                        ['icon' => 'fa-user-friends', 'text' => 'Introverted but sociable'],
                        ['icon' => 'fa-shield-alt', 'text' => 'Calm but confident'],
                        ['icon' => 'fa-laugh', 'text' => 'Funny when I\'m comfortable'],
                        ['icon' => 'fa-eye', 'text' => 'Observant'],
                        ['icon' => 'fa-brain', 'text' => 'Emotionally aware']
                    ];
                    @endphp
                    
                    @foreach($traits as $trait)
                    <div class="d-flex align-items-center mb-3 pb-3 border-bottom" style="border-color: var(--border-color) !important;">
                        <div class="me-3">
                            <div class="d-inline-flex align-items-center justify-content-center rounded" 
                                 style="width: 40px; height: 40px; background: rgba(168, 85, 247, 0.1);">
                                <i class="fas {{ $trait['icon'] }} text-gradient"></i>
                            </div>
                        </div>
                        <span class="fw-semibold">{{ $trait['text'] }}</span>
                    </div>
                    @endforeach
                    
                    <div class="mt-4 p-4 rounded" style="background: rgba(168, 85, 247, 0.05); border-left: 3px solid var(--accent-primary);">
                        <p class="mb-0 small fst-italic text-secondary">
                            <i class="fas fa-quote-left me-2 text-gradient"></i>
                            I believe in communication. I don't like guessing games, hidden feelings, or emotional confusion. If I show up for you, it's with intention.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Core Values -->
            <div class="col-lg-6 scroll-animate" style="animation-delay: 0.1s;">
                <div class="modern-card h-100">
                    <h4 class="fw-bold mb-4">Core Values</h4>
                    <div class="row g-3">
                        @php
                        $values = [
                            ['icon' => 'fa-heart', 'name' => 'Respect'],
                            ['icon' => 'fa-sync', 'name' => 'Consistency'],
                            ['icon' => 'fa-shield-alt', 'name' => 'Honesty'],
                            ['icon' => 'fa-hands-helping', 'name' => 'Kindness'],
                            ['icon' => 'fa-dove', 'name' => 'Peace over chaos'],
                            ['icon' => 'fa-fire', 'name' => 'Effort'],
                            ['icon' => 'fa-gem', 'name' => 'Being real']
                        ];
                        @endphp
                        
                        @foreach($values as $value)
                        <div class="col-6">
                            <div class="p-3 text-center rounded h-100" style="background: rgba(168, 85, 247, 0.05);">
                                <i class="fas {{ $value['icon'] }} mb-2 text-gradient"></i>
                                <p class="mb-0 small fw-semibold">{{ $value['name'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-4 p-3 rounded" style="background: var(--bg-primary);">
                        <p class="mb-0 small text-secondary">
                            I take note of small things — tone, energy, how someone communicates, how they handle conflict, whether they listen. I appreciate gentle energy, soft personalities, and people who understand emotional maturity.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Interests -->
<section class="section-padding">
    <div class="container">
        <div class="section-header scroll-animate">
            <span class="section-label">What I Enjoy</span>
            <h2 class="section-title">My <span class="text-gradient">Interests</span></h2>
            <div class="section-line"></div>
        </div>
        
        <div class="row g-3">
            @php
            $interests = [
                ['icon' => 'fa-laptop-code', 'text' => 'Building tech projects'],
                ['icon' => 'fa-headphones', 'text' => 'Producing music'],
                ['icon' => 'fa-lightbulb', 'text' => 'Exploring new ideas and business concepts'],
                ['icon' => 'fa-coffee', 'text' => 'Slow mornings with good music'],
                ['icon' => 'fa-graduation-cap', 'text' => 'Learning new skills'],
                ['icon' => 'fa-utensils', 'text' => 'Discovering new restaurants'],
                ['icon' => 'fa-chart-line', 'text' => 'Improving myself daily'],
                ['icon' => 'fa-moon', 'text' => 'Late-night conversations']
            ];
            @endphp
            
            @foreach($interests as $index => $interest)
            <div class="col-lg-3 col-md-4 col-sm-6 scroll-animate" style="animation-delay: {{ $index * 0.05 }}s;">
                <div class="modern-card text-center py-4">
                    <i class="fas {{ $interest['icon'] }} fa-2x mb-3 text-gradient"></i>
                    <p class="mb-0 small fw-semibold">{{ $interest['text'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="row justify-content-center mt-5">
            <div class="col-lg-8 scroll-animate">
                <div class="modern-card text-center p-4" style="background: rgba(168, 85, 247, 0.05);">
                    <p class="mb-0 text-secondary">
                        I'm not loud, not flashy, and not always outside. I'm more of a calm, collected person who enjoys comfortable spaces and meaningful company.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Dating & Relationships -->
<section id="relationships" class="section-padding" style="background: var(--bg-secondary);">
    <div class="container">
        <div class="section-header scroll-animate">
            <span class="section-label">Dating & Love</span>
            <h2 class="section-title">In <span class="text-gradient">Relationships</span></h2>
            <div class="section-line"></div>
        </div>
        
        <div class="row g-5 justify-content-center">
            <div class="col-lg-10">
                <div class="scroll-animate mb-5">
                    <div class="modern-card p-5 text-center">
                        <h4 class="fw-bold mb-4">I've been in enough talking stages to know exactly what I want.</h4>
                        <p class="text-secondary mb-0">I'm not in a rush, but I'm also not entertaining time-wasting situations.</p>
                    </div>
                </div>
                
                <div class="row g-4">
                    <!-- In Relationships I'm -->
                    <div class="col-lg-6 scroll-animate">
                        <div class="modern-card h-100">
                            <h5 class="fw-bold mb-4 text-gradient">In a relationship, I'm:</h5>
                            @php
                            $relationshipTraits = [
                                ['icon' => 'fa-heart', 'text' => 'Loyal'],
                                ['icon' => 'fa-user-check', 'text' => 'Present'],
                                ['icon' => 'fa-hand-holding-heart', 'text' => 'Affectionate'],
                                ['icon' => 'fa-hands-helping', 'text' => 'Supportive'],
                                ['icon' => 'fa-comments', 'text' => 'Communicative'],
                                ['icon' => 'fa-gem', 'text' => 'Respectful']
                            ];
                            @endphp
                            
                            @foreach($relationshipTraits as $trait)
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3">
                                    <i class="fas {{ $trait['icon'] }} fa-lg text-gradient"></i>
                                </div>
                                <span class="fw-semibold">{{ $trait['text'] }}</span>
                            </div>
                            @endforeach
                            
                            <div class="mt-4 p-3 rounded" style="background: rgba(168, 85, 247, 0.05);">
                                <p class="mb-0 small fst-italic text-secondary">
                                    I can be very romantic when I feel safe. I love taking care of someone I'm with.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- What I'm Looking For -->
                    <div class="col-lg-6 scroll-animate" style="animation-delay: 0.1s;">
                        <div class="modern-card h-100">
                            <h5 class="fw-bold mb-4 text-gradient">What I'm looking for:</h5>
                            @php
                            $lookingFor = [
                                'Someone soft and kind',
                                'Someone who can communicate',
                                'Someone who knows what she wants',
                                'Someone who brings peace',
                                'Someone who\'s emotionally aware',
                                'Someone genuine'
                            ];
                            @endphp
                            
                            @foreach($lookingFor as $trait)
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3">
                                    <i class="fas fa-star text-gradient"></i>
                                </div>
                                <span>{{ $trait }}</span>
                            </div>
                            @endforeach
                            
                            <div class="mt-4 p-3 rounded text-center" style="background: var(--bg-primary);">
                                <p class="mb-0 fw-semibold">I'm not asking for perfection — just honesty and consistency.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- What I Like in a Woman -->
                <div class="scroll-animate mt-5">
                    <div class="modern-card p-4">
                        <h5 class="fw-bold mb-4 text-center">What I Like in a Woman</h5>
                        <div class="row g-3">
                            @php
                            $qualities = [
                                'A warm personality',
                                'A playful side',
                                'Intelligence and ambition',
                                'Good communication',
                                'Emotional softness',
                                'A beautiful smile',
                                'Respect for herself and others',
                                'A sense of humor',
                                'A peaceful presence'
                            ];
                            @endphp
                            
                            @foreach($qualities as $quality)
                            <div class="col-md-4 col-sm-6">
                                <div class="p-3 rounded text-center" style="background: rgba(168, 85, 247, 0.05);">
                                    <p class="mb-0 small">{{ $quality }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Random Facts -->
<section class="section-padding">
    <div class="container">
        <div class="section-header scroll-animate">
            <span class="section-label">Fun Facts</span>
            <h2 class="section-title">A Few <span class="text-gradient">Random Things</span></h2>
            <div class="section-line"></div>
        </div>
        
        <div class="row g-3">
            @php
            $facts = [
                ['icon' => 'fa-laugh', 'text' => 'I\'m sarcastic in a funny way'],
                ['icon' => 'fa-moon', 'text' => 'I like late-night conversations'],
                ['icon' => 'fa-brain', 'text' => 'I overthink sometimes'],
                ['icon' => 'fa-search', 'text' => 'I analyze things deeply'],
                ['icon' => 'fa-eye', 'text' => 'I\'m very observant — maybe too observant'],
                ['icon' => 'fa-smile', 'text' => 'I like women who are expressive and open']
            ];
            @endphp
            
            @foreach($facts as $index => $fact)
            <div class="col-lg-4 col-md-6 scroll-animate" style="animation-delay: {{ $index * 0.05 }}s;">
                <div class="modern-card p-4">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle" 
                                 style="width: 50px; height: 50px; background: rgba(168, 85, 247, 0.1);">
                                <i class="fas {{ $fact['icon'] }} text-gradient"></i>
                            </div>
                        </div>
                        <p class="mb-0 fw-semibold">{{ $fact['text'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Why I'm Sharing This -->
<section class="section-padding" style="background: var(--bg-secondary);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="scroll-animate">
                    <div class="modern-card p-5 text-center">
                        <span class="section-label mb-3 d-block">Final Note</span>
                        <h2 class="display-5 fw-bold mb-4">
                            Why I'm <span class="text-gradient">Sharing This</span>
                        </h2>
                        <p class="lead text-secondary mb-4">
                            Because I've had enough "So tell me about yourself" conversations.
                        </p>
                        <p class="lead text-secondary mb-5">
                            I'd rather give a detailed picture of who I am from the start.
                        </p>
                        
                        <div class="p-4 rounded mb-4" style="background: rgba(168, 85, 247, 0.05);">
                            <p class="mb-3">If we get to know each other, cool — at least you know who you're dealing with.</p>
                            <p class="mb-3">If our energies match, we can build something meaningful.</p>
                            <p class="mb-0 fw-bold text-gradient">If not, that's life — all love. ✌️</p>
                        </div>
                        
                        <div class="d-flex gap-3 justify-content-center flex-wrap mt-5">
                            <a href="{{ route('contact') }}" class="btn-modern btn-primary-modern">
                                <i class="fas fa-envelope me-2"></i>Let's Connect
                            </a>
                            <a href="{{ route('about') }}" class="btn-modern">
                                <i class="fas fa-user me-2"></i>About Me
                            </a>
                            <a href="{{ route('home') }}" class="btn-modern">
                                <i class="fas fa-home me-2"></i>Back Home
                            </a>
                        </div>
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
});
</script>
@endpush