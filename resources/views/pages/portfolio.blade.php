@extends('layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Portfolio',
        'breadcrumbs' => [
            ['name' => 'Portfolio', 'url' => route('portfolio')],
        ]
    ])

    <!-- Portfolio Hero Section -->
    <section id="portfolio-hero" class="portfolio-hero-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="portfolio-hero-image position-relative">
                        <img src="{{ asset('images/portfolio-hero.jpg') }}" alt="Portfolio Hero" class="img-fluid rounded-lg shadow-lg">
                        <div class="experience-badge position-absolute bg-primary text-white py-3 px-4 rounded-lg shadow">
                            <span class="d-block text-center fs-1 fw-bold">10+</span>
                            <span class="d-block text-center">Projects</span>
                        </div>
                        <div class="shape-1 position-absolute bg-secondary opacity-50 rounded-circle"></div>
                        <div class="shape-2 position-absolute bg-primary opacity-50 rounded-circle"></div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="portfolio-hero-content ps-lg-4">
                        <h6 class="text-primary fw-bold text-uppercase mb-3">My Portfolio</h6>
                        <h2 class="display-4 fw-bold mb-4">Creative <span class="text-primary">Projects</span> & Professional Work</h2>
                        <p class="lead mb-4">
                            A showcase of my best work across multiple disciplines, highlighting my expertise and creative approach.
                        </p>
                        <div class="d-flex flex-wrap gap-3 mb-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-primary me-2"></i>
                                <span>Web Applications</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-primary me-2"></i>
                                <span>UI/UX Design</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-primary me-2"></i>
                                <span>Mobile Apps</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-primary me-2"></i>
                                <span>Brand Identity</span>
                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <a href="#projects" class="btn btn-primary btn-lg rounded-pill">View Projects</a>
                            <a href="#contact" class="btn btn-outline-dark btn-lg rounded-pill">Contact Me</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Categories Section -->
    <section id="categories" class="categories-section py-5 bg-dark text-light">
        <div class="container">
            <!-- Section Heading -->
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <div class="section-heading" data-aos="fade-up">
                        <h6 class="text-warning fw-bold text-uppercase mb-2">Expertise</h6>
                        <h2 class="display-5 fw-bold mb-3">Areas of <span class="text-warning">Specialization</span></h2>
                        <div class="section-line mx-auto bg-warning my-3" style="width: 80px; height: 3px;"></div>
                        <p class="lead">Browse through my different areas of expertise and specialization.</p>
                    </div>
                </div>
            </div>
    
            <!-- Category Pills -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8">
                    <div class="category-filter d-flex flex-wrap justify-content-center gap-2" data-aos="fade-up">
                        <button class="btn btn-warning rounded-pill active" data-filter="all">All Projects</button>
                        <button class="btn btn-outline-light rounded-pill" data-filter="web">Web Development</button>
                        <button class="btn btn-outline-light rounded-pill" data-filter="mobile">Mobile Apps</button>
                        <button class="btn btn-outline-light rounded-pill" data-filter="ui">UI/UX Design</button>
                        <button class="btn btn-outline-light rounded-pill" data-filter="brand">Brand Identity</button>
                    </div>
                </div>
            </div>
    
            <!-- Portfolio Grid -->
            <div class="row g-4 portfolio-grid">
                @foreach ($projects as $project)
                    <div class="col-md-6 col-lg-4 portfolio-item" data-category="{{ strtolower($project->category) }}" data-aos="fade-up">
                        <div class="portfolio-card bg-secondary h-100 rounded-lg overflow-hidden">
                            <div class="portfolio-image">
                                <!-- Display the image with proper URL from the 'public' disk -->
                                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="img-fluid w-100">
                                
                                <div class="portfolio-overlay d-flex align-items-center justify-content-center">
                                    <div class="portfolio-actions">
                                        <!-- Open image in a new tab when clicked -->
                                        <a href="{{ asset('storage/' . $project->image) }}" class="btn btn-sm btn-light rounded-circle me-2" target="_blank">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        <!-- Check if there's an external link to the project -->
                                        @if ($project->link)
                                            <a href="{{ $project->link }}" class="btn btn-sm btn-primary rounded-circle" target="_blank">
                                                <i class="fas fa-link"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="portfolio-content p-4">
                                <div class="portfolio-category mb-2">
                                    <span class="badge bg-warning rounded-pill">{{ $project->category }}</span>
                                </div>
                                <h4 class="portfolio-title mb-2">{{ $project->title }}</h4>
                                <p class="portfolio-description text-muted mb-0">{{ $project->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    
            <!-- Load More Button -->
            <div class="row mt-5">
                <div class="col-12 text-center" data-aos="fade-up">
                    <a href="#" class="btn btn-outline-light btn-lg rounded-pill px-5">Load More Projects</a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Process Section -->
    <section id="process" class="process-section py-5">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8">
                    <div class="section-heading text-center" data-aos="fade-up">
                        <h6 class="text-primary fw-bold text-uppercase mb-2">Work Process</h6>
                        <h2 class="display-5 fw-bold mb-3">How I Bring <span class="text-primary">Ideas</span> to Life</h2>
                        <div class="section-line mx-auto bg-primary my-4" style="width: 80px; height: 3px;"></div>
                        <p class="lead">A structured approach to ensure successful project delivery and client satisfaction.</p>
                    </div>
                </div>
            </div>
            
            <div class="row g-4">
                <!-- Process Step 1 -->
                <div class="col-md-6 col-lg-3" data-aos="fade-up">
                    <div class="process-step text-center p-4 rounded-lg h-100">
                        <div class="process-icon mb-4 mx-auto">
                            <span class="step-number d-flex align-items-center justify-content-center rounded-circle bg-primary text-white mb-3">1</span>
                            <i class="fas fa-lightbulb fs-2 text-primary"></i>
                        </div>
                        <h4 class="process-title mb-3">Discovery</h4>
                        <p class="process-description mb-0">Understanding client needs, research, and conceptualizing initial ideas for the project.</p>
                    </div>
                </div>
                
                <!-- Process Step 2 -->
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="process-step text-center p-4 rounded-lg h-100">
                        <div class="process-icon mb-4 mx-auto">
                            <span class="step-number d-flex align-items-center justify-content-center rounded-circle bg-success text-white mb-3">2</span>
                            <i class="fas fa-drafting-compass fs-2 text-success"></i>
                        </div>
                        <h4 class="process-title mb-3">Planning</h4>
                        <p class="process-description mb-0">Creating wireframes, prototypes, and defining technical requirements for implementation.</p>
                    </div>
                </div>
                
                <!-- Process Step 3 -->
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="process-step text-center p-4 rounded-lg h-100">
                        <div class="process-icon mb-4 mx-auto">
                            <span class="step-number d-flex align-items-center justify-content-center rounded-circle bg-warning text-white mb-3">3</span>
                            <i class="fas fa-code fs-2 text-warning"></i>
                        </div>
                        <h4 class="process-title mb-3">Development</h4>
                        <p class="process-description mb-0">Building the solution using cutting-edge technologies and industry best practices.</p>
                    </div>
                </div>
                
                <!-- Process Step 4 -->
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="process-step text-center p-4 rounded-lg h-100">
                        <div class="process-icon mb-4 mx-auto">
                            <span class="step-number d-flex align-items-center justify-content-center rounded-circle bg-danger text-white mb-3">4</span>
                            <i class="fas fa-rocket fs-2 text-danger"></i>
                        </div>
                        <h4 class="process-title mb-3">Delivery</h4>
                        <p class="process-description mb-0">Testing, refinement, client review, and successful project deployment.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section id="stats" class="stats-section py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Stat Item 1 -->
                <div class="col-6 col-md-3" data-aos="fade-up">
                    <div class="stat-item text-center p-4 rounded-lg h-100">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-project-diagram fs-1 text-primary"></i>
                        </div>
                        <h2 class="stat-number mb-2 display-5 fw-bold">50+</h2>
                        <p class="stat-label mb-0 text-uppercase">Projects Completed</p>
                    </div>
                </div>
                
                <!-- Stat Item 2 -->
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-item text-center p-4 rounded-lg h-100">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-smile-beam fs-1 text-success"></i>
                        </div>
                        <h2 class="stat-number mb-2 display-5 fw-bold">40+</h2>
                        <p class="stat-label mb-0 text-uppercase">Happy Clients</p>
                    </div>
                </div>
                
                <!-- Stat Item 3 -->
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-item text-center p-4 rounded-lg h-100">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-clock fs-1 text-warning"></i>
                        </div>
                        <h2 class="stat-number mb-2 display-5 fw-bold">5000+</h2>
                        <p class="stat-label mb-0 text-uppercase">Hours of Work</p>
                    </div>
                </div>
                
                <!-- Stat Item 4 -->
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-item text-center p-4 rounded-lg h-100">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-award fs-1 text-danger"></i>
                        </div>
                        <h2 class="stat-number mb-2 display-5 fw-bold">10+</h2>
                        <p class="stat-label mb-0 text-uppercase">Awards Won</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section py-5 bg-dark text-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8">
                    <div class="section-heading text-center" data-aos="fade-up">
                        <h6 class="text-warning fw-bold text-uppercase mb-2">Get In Touch</h6>
                        <h2 class="display-5 fw-bold mb-3">Let's Discuss Your <span class="text-warning">Project</span></h2>
                        <div class="section-line mx-auto bg-warning my-3" style="width: 80px; height: 3px;"></div>
                        <p class="lead">Have a project in mind? Get in touch and let's create something amazing together.</p>
                    </div>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="contact-info bg-secondary p-4 rounded-lg h-100">
                        <h4 class="mb-4">Contact Information</h4>
                        
                        <div class="contact-item d-flex mb-4">
                            <div class="contact-icon me-3">
                                <i class="fas fa-map-marker-alt fs-4 text-warning"></i>
                            </div>
                            <div class="contact-text">
                                <h5 class="mb-1">Location</h5>
                                <p class="mb-0">123 Creative Street, Tech City, Country</p>
                            </div>
                        </div>
                        
                        <div class="contact-item d-flex mb-4">
                            <div class="contact-icon me-3">
                                <i class="fas fa-envelope fs-4 text-warning"></i>
                            </div>
                            <div class="contact-text">
                                <h5 class="mb-1">Email</h5>
                                <p class="mb-0">hello@yourportfolio.com</p>
                            </div>
                        </div>
                        
                        <div class="contact-item d-flex mb-4">
                            <div class="contact-icon me-3">
                                <i class="fas fa-phone-alt fs-4 text-warning"></i>
                            </div>
                            <div class="contact-text">
                                <h5 class="mb-1">Phone</h5>
                                <p class="mb-0">+1 (123) 456-7890</p>
                            </div>
                        </div>
                        
                        <div class="social-links mt-5">
                            <h5 class="mb-3">Connect With Me</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="social-link d-flex align-items-center justify-content-center bg-dark rounded-circle">
                                    <i class="fab fa-linkedin-in text-warning"></i>
                                </a>
                                <a href="#" class="social-link d-flex align-items-center justify-content-center bg-dark rounded-circle">
                                    <i class="fab fa-github text-warning"></i>
                                </a>
                                <a href="#" class="social-link d-flex align-items-center justify-content-center bg-dark rounded-circle">
                                    <i class="fab fa-dribbble text-warning"></i>
                                </a>
                                <a href="#" class="social-link d-flex align-items-center justify-content-center bg-dark rounded-circle">
                                    <i class="fab fa-behance text-warning"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="contact-form bg-secondary p-4 rounded-lg">
                        <h4 class="mb-4">Send a Message</h4>
                        
                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Your Name</label>
                                        <input type="text" class="form-control bg-dark border-0 text-light" id="name" name="name" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">Your Email</label>
                                        <input type="email" class="form-control bg-dark border-0 text-light" id="email" name="email" required>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="subject" class="form-label">Subject</label>
                                        <input type="text" class="form-control bg-dark border-0 text-light" id="subject" name="subject" required>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-group mb-4">
                                        <label for="message" class="form-label">Your Message</label>
                                        <textarea class="form-control bg-dark border-0 text-light" id="message" name="message" rows="5" required></textarea>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <button type="submit" class="btn btn-warning btn-lg rounded-pill px-5">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection