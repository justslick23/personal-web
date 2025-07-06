@@php use Illuminate\Support\Facades\Storage; @endphp

@extends('layouts.app')

@section('content')
<style>
    :root {
        --bs-primary: #6366f1;
        --bs-secondary: #8b5cf6;
        --bs-dark: #0f172a;
        --bs-gray-dark: #020617;
    }

    /* Make input + textarea placeholder text white */
.form-control::placeholder {
    color: #ffffff !important;
    opacity: 1; /* Ensures full opacity */
}

/* Just in case dark mode text needs reinforcing */
.form-control.text-white {
    color: #ffffff;
}

    
    .bg-gradient-primary { background: linear-gradient(135deg, var(--bs-primary), var(--bs-secondary)) !important; }
    .bg-gradient-dark { background: linear-gradient(135deg, var(--bs-dark), var(--bs-gray-dark)) !important; }
    .text-gradient { background: linear-gradient(135deg, #fff 0%, var(--bs-primary) 50%, #ec4899 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    .profile-img { border: 4px solid var(--bs-primary); }
    .card-hover:hover { transform: translateY(-5px); }
    .btn-glow:hover { box-shadow: 0 0 20px rgba(99, 102, 241, 0.4); }
</style>

<!-- Hero Section -->
<section class="bg-gradient-dark text-white d-flex align-items-center min-vh-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <p class="text-uppercase fw-bold fs-5 text-primary mb-3">
                    <span id="typewriter">Web Designer</span>
                </p>
                
                <h1 class="display-1 fw-bold mb-4 text-gradient">
                    Hello, I'm<br>
                    <span class="text-primary">Tokelo Foso</span>
                </h1>
                
                <p class="lead mb-4 text-white-50">
                    Crafting visuals, coding experiences, and composing beats are my passions. 
                    Let's bring your ideas to life with creativity at its core.
                </p>
                
                <div class="d-flex gap-3 mb-4">
                    <a href="#portfolio" class="btn btn-primary btn-lg px-4 py-3 rounded-pill btn-glow">
                        <i class="fas fa-rocket me-2"></i>View Projects
                    </a>
                    <a href="#contact" class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill">
                        <i class="fas fa-paper-plane me-2"></i>Contact Me
                    </a>
                </div>
                
                <!-- Social Icons -->
                <div class="d-flex gap-2 d-lg-none">
                    <a href="https://www.facebook.com/tokelo.foso/" class="btn btn-outline-light btn-sm rounded-circle">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://x.com/slkstr_" class="btn btn-outline-light btn-sm rounded-circle">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.linkedin.com/in/tokelo-foso/" class="btn btn-outline-light btn-sm rounded-circle">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="https://www.instagram.com/slkstrgrm/" class="btn btn-outline-light btn-sm rounded-circle">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-6 text-center">
                <div class="position-relative d-inline-block">
                    <img src="{{ asset('images/me.jpg') }}" 
                         class="img-fluid rounded-circle profile-img shadow-lg" 
                         alt="Tokelo Foso"
                         style="width: 300px; height: 300px; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
    
    <!-- Floating Social Icons - Desktop -->
    <div class="position-fixed end-0 top-50 translate-middle-y d-none d-lg-flex flex-column gap-3 pe-3">
        <a href="https://www.facebook.com/tokelo.foso/" class="btn btn-outline-light rounded-circle">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="https://x.com/slkstr_" class="btn btn-outline-light rounded-circle">
            <i class="fab fa-twitter"></i>
        </a>
        <a href="https://www.linkedin.com/in/tokelo-foso/" class="btn btn-outline-light rounded-circle">
            <i class="fab fa-linkedin-in"></i>
        </a>
        <a href="https://www.instagram.com/slkstrgrm/" class="btn btn-outline-light rounded-circle">
            <i class="fab fa-instagram"></i>
        </a>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-5 bg-dark text-white">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="display-4 fw-bold mb-3">About Me</h2>
                <p class="lead text-primary mb-4 h4">Creative Designer & Developer based in Lesotho</p>
                <p class="mb-4 text-white-50">
                    I'm Tokelo, a versatile creative with a flair for design, a knack for coding, and a love for music. 
                    As a Graphic Designer and Web Developer, I thrive on turning concepts into captivating visuals and seamless digital experiences.
                </p>
                <div class="d-flex align-items-center">
                    <i class="fas fa-magic fa-3x text-primary me-3"></i>
                    <p class="mb-0 fs-5">Bringing ideas to life, one pixel at a time.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card bg-dark border-primary card-hover transition-all">
                    <div class="card-body p-4">
                        <h3 class="card-title fw-bold mb-4 text-center">The Designer's Mindset: Problem to Pixel</h3>
                        
                        <p class="card-text text-white-50 text-center mb-4">
                            I approach every challenge as an opportunity to innovate. From dissecting complex problems to meticulously 
                            crafting pixel-perfect designs and robust code, my goal is to deliver intuitive, effective, and visually 
                            compelling solutions that truly work.
                        </p>
                        
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-binoculars fa-2x text-primary me-3"></i>
                            <div>
                                <h5 class="mb-0">Understand & Analyze</h5>
                                <p class="text-white-50 mb-0 small">Deep dive into challenges and goals.</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-drafting-compass fa-2x text-primary me-3"></i>
                            <div>
                                <h5 class="mb-0">Design & Engineer</h5>
                                <p class="text-white-50 mb-0 small">Crafting thoughtful and functional blueprints.</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center mb-4">
                            <i class="fas fa-check-double fa-2x text-primary me-3"></i>
                            <div>
                                <h5 class="mb-0">Refine & Deliver</h5>
                                <p class="text-white-50 mb-0 small">Polished, high-quality results that exceed expectations.</p>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <p class="fs-5 mb-3">Ready to solve your next design challenge?</p>
                            <a href="#contact" class="btn btn-primary btn-lg">
                                Let's Discuss Your Project <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Experience Section -->
<section class="py-5" style="background-color: var(--bs-gray-dark);">
    <div class="container py-5">
        <h2 class="display-4 fw-bold text-center mb-5 text-white">Experience & Education</h2>
        <div class="row">
            <div class="col-lg-6 mb-4">
                <h3 class="border-start border-primary border-4 ps-3 mb-4 text-white">Work Experience</h3>
                
                <div class="card bg-dark border-secondary mb-4 card-hover">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h4 class="card-title text-white">Web Designer</h4>
                            <span class="badge bg-primary">2022-Present</span>
                        </div>
                        <p class="text-primary mb-2">Computer Business Solutions</p>
                        <p class="card-text text-white-50">Led design projects for multiple clients, creating responsive websites and improving user experience.</p>
                    </div>
                </div>
                
                <div class="card bg-dark border-secondary card-hover">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h4 class="card-title text-white">Graphic Designer</h4>
                            <span class="badge bg-primary">2021-2022</span>
                        </div>
                        <p class="text-primary mb-2">Osmium Lesotho</p>
                        <p class="card-text text-white-50">Created visual content for marketing campaigns, social media, and websites. Worked closely with clients to bring their brand vision to life.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <h3 class="border-start border-primary border-4 ps-3 mb-4 text-white">Education</h3>
                
                <div class="card bg-dark border-secondary mb-4 card-hover">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h4 class="card-title text-white">Bachelor of Computer and Information Sciences</h4>
                            <span class="badge bg-primary">2018-2020</span>
                        </div>
                        <p class="text-primary mb-2">Monash University</p>
                        <p class="card-text text-white-50">Majored in Mobile Systems and Software Development</p>
                    </div>
                </div>
                
                <div class="card bg-dark border-secondary card-hover">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h4 class="card-title text-white">IGCSE</h4>
                            <span class="badge bg-primary">2014-2016</span>
                        </div>
                        <p class="text-primary mb-2">Machabeng College</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Section -->
<section id="portfolio" class="py-5 bg-dark text-white">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h6 class="text-primary fw-bold text-uppercase mb-2">Portfolio</h6>
            <h2 class="display-4 fw-bold mb-3">My Recent Work</h2>
            <p class="text-white-50 mx-auto" style="max-width: 650px;">Here are some of my recent projects that showcase my design abilities and creative approach.</p>
        </div>

        <!-- Portfolio Filters -->
        <div class="text-center mb-5">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-primary active" data-filter="all">All</button>
                <button type="button" class="btn btn-outline-primary" data-filter="Web App Design">Web Apps</button>
                <button type="button" class="btn btn-outline-primary" data-filter="Poster Design">Posters</button>
            </div>
        </div>

        <!-- Portfolio Items -->
        <div class="row g-4" id="portfolio-items">
            @foreach($portfolioItems as $item)
                <div class="col-md-6 col-lg-4" data-category="{{ $item->category }}">
                    <div class="card bg-dark border-secondary h-100 card-hover">
                        <div class="position-relative">
                            <img src="{{ $item->image ? asset('public/' . $item->image) : asset('images/default.jpg') }}" 
                                 class="card-img-top" 
                                 alt="{{ $item->title }}"
                                 style="height: 250px; object-fit: cover;">
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge bg-primary">{{ $item->category }}</span>
                            </div>
                        </div>
                        
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold text-white">{{ $item->title }}</h5>
                            @if($item->link && $item->category == 'Web App Design')
                                <a href="{{ $item->link }}" class="btn btn-sm btn-primary" target="_blank">
                                    View Project
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $portfolioItems->links() }}
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-5" style="background-color: var(--bs-gray-dark);">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="display-4 fw-bold mb-4 text-white">Let's Work Together</h2>
                <p class="lead text-primary mb-4">Have a design project in mind? Let's bring your vision to life.</p>
                <p class="mb-5 text-white-50">I'm always open to discussing new projects, creative ideas or opportunities to be part of your vision.</p>
                
                <div class="d-flex align-items-center mb-4">
                    <div class="me-3 d-flex justify-content-center align-items-center" style="width: 50px; height: 50px;">
                        <i class="fas fa-envelope text-white"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 text-white">Email</h5>
                        <a href="mailto:hello@tokelofoso.online" class="text-primary text-decoration-none">hello@tokelofoso.online</a>
                    </div>
                </div>
                
                <div class="d-flex align-items-center mb-4">
                    <div class="me-3 d-flex justify-content-center align-items-center" style="width: 50px; height: 50px;">
                        <i class="fas fa-phone text-white"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 text-white">Phone</h5>
                        <a href="tel:+26668231628" class="text-primary text-decoration-none">(+266) 6823 1628</a>
                    </div>
                </div>
                
                <div class="d-flex align-items-center mb-5">
                    <div class="me-3 d-flex justify-content-center align-items-center rounded-circle" style="width: 50px; height: 50px;">
                        <i class="fas fa-map-marker-alt text-white"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 text-white">Location</h5>
                        <p class="mb-0 text-white-50">Ha Matala Phase 2, Maseru, Lesotho</p>
                    </div>
                </div>
                
                <div>
                    <h5 class="mb-3 text-white">Follow Me</h5>
                    <div class="d-flex gap-2">
                        <a href="https://www.facebook.com/tokelo.foso" class="btn btn-outline-light">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.x.com/slkstr_" class="btn btn-outline-light">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/tokelo-foso" class="btn btn-outline-light">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://www.instagram.com/slkstrgrm" class="btn btn-outline-light">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="card bg-dark border-primary">
                    <div class="card-body p-4">
                        <h3 class="card-title mb-4 text-white">Send Me a Message</h3>
                        
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="text" name="name" class="form-control bg-dark border-secondary text-white" placeholder="Your Name" required>
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control bg-dark border-secondary text-white" placeholder="Your Email" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="subject" class="form-control bg-dark border-secondary text-white" placeholder="Subject">
                            </div>
                            <div class="mb-4">
                                <textarea name="message" class="form-control bg-dark border-secondary text-white" rows="5" placeholder="Your Message" required></textarea>
                            </div>
                            
                            <input type="hidden" name="g-recaptcha-response" id="recaptcha">
                            <button type="submit" class="btn btn-primary w-100">Send Message</button>
                        </form>
                        
                        
                        {!! NoCaptcha::renderJs() !!}
                        <script>
                            grecaptcha.ready(function () {
                                grecaptcha.execute('{{ config('captcha.sitekey') }}', {action: 'contact'}).then(function (token) {
                                    document.getElementById('recaptcha').value = token;
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Simple typewriter
    const roles = ["Web Designer", "Software Developer", "Graphic Designer"];
    let i = 0;
    setInterval(() => {
        document.getElementById('typewriter').textContent = roles[i];
        i = (i + 1) % roles.length;
    }, 3000);
    
    // Portfolio filter
    document.querySelectorAll('[data-filter]').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('[data-filter]').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const filter = this.dataset.filter;
            document.querySelectorAll('[data-category]').forEach(item => {
                item.style.display = (filter === 'all' || item.dataset.category === filter) ? 'block' : 'none';
            });
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Simple typewriter
    const roles = ["Web Designer", "Software Developer", "Graphic Designer"];
    let i = 0;
    setInterval(() => {
        document.getElementById('typewriter').textContent = roles[i];
        i = (i + 1) % roles.length;
    }, 3000);
    
    // Portfolio filter
    document.querySelectorAll('[data-filter]').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('[data-filter]').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const filter = this.dataset.filter;
            document.querySelectorAll('[data-category]').forEach(item => {
                item.style.display = (filter === 'all' || item.dataset.category === filter) ? 'block' : 'none';
            });
        });
    });
});
</script>

@endsection