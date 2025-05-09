@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<<!-- Hero Section -->
<section class="hero-section position-relative text-white" style="min-height: 100vh; background-image: url('{{ asset('images/671cf59ff59393be6e93326276503411.jpg') }}'); background-size: cover; background-position: center; background-color: rgba(0, 0, 0, 0.6); ">
    <!-- Background Image Container -->

    
    <div class="container h-100 d-flex flex-column justify-content-center py-5">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <p class="text-uppercase mb-2">
                    <span id="typewriter" class="text-primary d-inline-block"></span>
                </p>
                <!-- Typewriter Effect Script -->
                <script>
                    const roles = ["Web Designer", "Software Developer", "Graphic Designer"];
                    let part = 0;
                    let partIndex = 0;
                    let intervalVal;
                    const element = document.getElementById("typewriter");
                
                    function typeEffect() {
                        let currentRole = roles[part];
                        element.innerHTML = currentRole.substring(0, partIndex + 1);
                
                        partIndex++;
                
                        if (partIndex === currentRole.length) {
                            clearInterval(intervalVal);
                            setTimeout(() => {
                                intervalVal = setInterval(eraseEffect, 100);
                            }, 2000);
                        }
                    }
                
                    function eraseEffect() {
                        let currentRole = roles[part];
                        element.innerHTML = currentRole.substring(0, partIndex - 1);
                        partIndex--;
                
                        if (partIndex === 0) {
                            clearInterval(intervalVal);
                            part = (part + 1) % roles.length;
                            setTimeout(() => {
                                intervalVal = setInterval(typeEffect, 100);
                            }, 300);
                        }
                    }
                
                    // Start typing
                    document.addEventListener("DOMContentLoaded", () => {
                        setTimeout(() => {
                            intervalVal = setInterval(typeEffect, 100);
                        }, 1000);
                    });
                </script>
                
                <h1 class="display-3 fw-bold mb-4">Hello, I'm <br><span class="text-primary">Tokelo Foso</span></h1>
                <p class="lead mb-5 text-light opacity-75">Crafting visuals, coding experiences, and composing beats are my passions. Let's bring your ideas to life with creativity at its core. Welcome to my world of design, development, and music!</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="#portfolio" class="btn btn-primary px-4 py-2">View Projects</a>
                    <a href="#contact" class="btn btn-outline-light px-4 py-2">Contact Me</a>
                </div>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0 text-center">
                <style>
                    @keyframes moveUpDown {
                        0% {
                            transform: translateY(0);
                        }
                        50% {
                            transform: translateY(-20px); /* Adjust this value for the height of the movement */
                        }
                        100% {
                            transform: translateY(0);
                        }
                    }
                
                    .moving-image {
                        animation: moveUpDown 2s ease-in-out infinite; /* 2s duration, infinite loop */
                    }
                </style>
                
                <img src="{{ asset('images/me.jpg') }}" class="img-fluid moving-image" alt="Tokelo Foso" style="max-width: 500px;">
            </div>
        </div>
    </div>
    <div class="position-absolute bottom-0 start-0 w-100 text-center pb-4">
        <a href="#about" class="text-white">
            <i class="fas fa-chevron-down fa-2x"></i>
        </a>
    </div>
</section>


<!-- About Section -->
<section id="about" class="py-5 bg-dark text-white">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-6 pe-lg-5">
                <h2 class="fw-bold mb-4">About Me</h2>
                <p class="lead text-primary mb-4">Creative Designer & Developer based in Lesotho</p>
                <p class="mb-4 text-light opacity-75">I’m Tokelo, a versatile creative with a flair for design, a knack for coding, and a love for music. As a Graphic Designer and Web Developer, I thrive on turning concepts into captivating visuals and seamless digital experiences. When I’m not immersed in pixels and code, you’ll find me shaping melodies as a Music Producer. Join me on this journey where creativity knows no bounds.

                </p>
            
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0">
                <div class="p-4 bg-black rounded-3 h-100">
                    <h3 class="fw-bold mb-4">My Skills</h3>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>UI/UX Design</span>
                            <span>95%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" style="width: 95%"></div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Web Design</span>
                            <span>90%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" style="width: 90%"></div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Figma</span>
                            <span>90%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" style="width: 90%"></div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Adobe XD</span>
                            <span>85%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" style="width: 85%"></div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Illustrator</span>
                            <span>75%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" style="width: 75%"></div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>HTML/CSS</span>
                            <span>90%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" style="width: 90%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Experience Section -->
<section class="py-5 bg-black text-white">
    <div class="container py-5">
        <h2 class="fw-bold text-center mb-5">Experience & Education</h2>
        <div class="row">
            <div class="col-lg-6 pe-lg-5">
                <h3 class="border-start border-primary border-4 ps-3 mb-4">Work Experience</h3>
                
                <div class="bg-dark p-4 rounded-3 mb-4 position-relative">
                    <span class="badge bg-primary position-absolute end-0 top-0 mt-4 me-4">2022-Present</span>
                    <h4 class="mb-2">Web Designer</h4>
                    <p class="text-primary mb-2">Computer Business Solutions</p>
                    <p class="text-light opacity-75 mb-0">Led design projects for multiple clients, creating responsive websites and improving user experience.</p>
                </div>
                
                <div class="bg-dark p-4 rounded-3 mb-4 position-relative">
                    <span class="badge bg-primary position-absolute end-0 top-0 mt-4 me-4">2021-2022</span>
                    <h4 class="mb-2">Graphic Designer</h4>
                    <p class="text-primary mb-2">Osmium Lesotho</p>
                    <p class="text-light opacity-75 mb-0">
                        Created visual content for marketing campaigns, social media, and websites. Worked closely with clients to bring their brand vision to life through innovative designs. Supported product launches and enhanced UI elements for digital platforms.
                    </p>
                </div>
                
            </div>
            
            <div class="col-lg-6 mt-5 mt-lg-0">
                <h3 class="border-start border-primary border-4 ps-3 mb-4">Education</h3>
                
                <div class="bg-dark p-4 rounded-3 mb-4 position-relative">
                    <span class="badge bg-primary position-absolute end-0 top-0 mt-4 me-4">2018-2020</span>
                    <h4 class="mb-2">Bachelor of Computer and Information Sciences</h4>
                    <p class="text-primary mb-2">Monash University</p>
                    <p class="text-light opacity-75 mb-0">Majored in Mobile Systems and Software Development</p>
                </div>
                
                <div class="bg-dark p-4 rounded-3 position-relative">
                    <span class="badge bg-primary position-absolute end-0 top-0 mt-4 me-4">2014-2016</span>
                    <h4 class="mb-2">International General Certificate in Secondary Education</h4>
                    <p class="text-primary mb-2">Machabeng College</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Section -->
<!-- Portfolio Section -->
<section id="portfolio" class="py-5 bg-dark text-white">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h6 class="text-primary fw-bold text-uppercase mb-2">Portfolio</h6>
            <h2 class="fw-bold mb-3 display-4">My Recent Work</h2>
            <div class="divider-custom mx-auto my-4">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <p class="text-light opacity-75 mx-auto" style="max-width: 650px;">Here are some of my recent projects that showcase my design abilities and creative approach.</p>
        </div>

        <!-- Portfolio Filters -->
        <div class="portfolio-filter mb-5 text-center">
            <div class="filter-container p-2 rounded-pill d-inline-block bg-dark border border-secondary">
                <button class="btn btn-primary rounded-pill px-4 py-2 me-1 filter-btn active-filter" data-filter="all">All</button>
                <button class="btn btn-dark rounded-pill px-4 py-2 me-1 filter-btn" data-filter="Web App Design">Web Apps</button>
                <button class="btn btn-dark rounded-pill px-4 py-2 filter-btn" data-filter="Poster Design">Posters</button>
            </div>
        </div>

        <!-- Portfolio Items -->
        <div class="row g-4" id="portfolio-items">
            @foreach($portfolioItems as $item)
                <div class="col-md-6 col-lg-4 portfolio-item-wrapper">
                    <div class="portfolio-box h-100" data-category="{{ $item->category }}">
                        <div class="portfolio-card rounded-4 overflow-hidden bg-dark border border-secondary">
                            <!-- Make the image container taller -->
                            <div class="position-relative" style="aspect-ratio: 1/1;">
                                <!-- Link the image to the Fancybox lightbox for Poster Design -->
                                @if($item->category == 'Poster Design')
                                    <a href="{{ asset('storage/' . $item->image) }}" data-fancybox="gallery" data-caption="{{ $item->title }}">
                                        <img src="{{ asset('storage/' . $item->image) }}" class="portfolio-img w-100 h-100 object-fit-cover" alt="{{ $item->title }}">
                                        <div class="img-overlay">
                                            <span class="zoom-icon"><i class="fas fa-search-plus fa-2x"></i></span>
                                        </div>
                                    </a>
                                @else
                                    <div class="position-relative">
                                        <img src="{{ asset('storage/' . $item->image) }}" class="portfolio-img w-100 h-100 object-fit-cover" alt="{{ $item->title }}">
                                        @if($item->link)
                                        <div class="img-overlay">
                                            <span class="link-icon"><i class="fas fa-link fa-2x"></i></span>
                                        </div>
                                        @endif
                                    </div>
                                @endif
                                <div class="category-badge">{{ $item->category }}</div>
                            </div>
                            
                            <!-- Card content -->
                            <div class="portfolio-content p-3 text-center">
                                <h5 class="portfolio-title fw-bold mb-2">{{ $item->title }}</h5>
                                
                                <div class="portfolio-actions mt-2">
                                    <!-- View Project Button for Web App Design -->
                                    @if($item->category == 'Web App Design' && $item->link) 
                                        <a href="{{ $item->link }}" class="btn btn-sm btn-primary rounded-pill px-3 py-1" target="_blank">
                                            <i class="fas fa-external-link-alt me-1"></i>View
                                        </a>
                                    @endif
                                    
                                    <!-- View Image Button for Poster Design -->
                                    @if($item->category == 'Poster Design')
                                        <a href="{{ asset('storage/' . $item->image) }}" class="btn btn-sm btn-primary rounded-pill px-3 py-1" data-fancybox="gallery-buttons" data-caption="{{ $item->title }}">
                                            <i class="fas fa-search-plus me-1"></i>View
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination Links -->
        <div class="row justify-content-center mt-5">
            <div class="col-12 text-center">
                <div class="pagination-custom">
                    {{ $portfolioItems->links() }} <!-- Display pagination links -->
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Custom divider */
    .divider-custom {
        width: 100%;
        max-width: 7rem;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .divider-custom-line {
        width: 100%;
        height: 0.25rem;
        background-color: var(--bs-primary);
        border-radius: 1rem;
    }
    
    .divider-custom-icon {
        color: var(--bs-primary);
        font-size: 1rem;
        margin: 0 1rem;
    }
    
    /* Smooth transition for filters */
    .filter-container {
        box-shadow: 0 0.25rem 1rem rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
    }
    
    .filter-btn {
        transition: all 0.3s ease;
        border: none;
        font-weight: 600;
    }
    
    .filter-btn:hover {
        transform: translateY(-2px);
    }
    
    .active-filter {
        box-shadow: 0 0.25rem 0.5rem rgba(var(--bs-primary-rgb), 0.4);
    }
    
    /* Portfolio card styling */
    .portfolio-card {
        transition: all 0.4s ease;
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.25);
        position: relative;
        border: 1px solid rgba(255, 255, 255, 0.1);
        background-color: #212529;
    }
    
    .portfolio-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.2);
    }
    
    .portfolio-img {
        transition: all 0.5s ease;
    }
    
    .category-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background-color: var(--bs-primary);
        color: white;
        font-size: 0.75rem;
        padding: 0.35rem 0.75rem;
        border-radius: 2rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 0.25rem 0.5rem rgba(var(--bs-primary-rgb), 0.4);
    }
    
    .img-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: all 0.3s ease;
    }
    
    .portfolio-card:hover .img-overlay {
        opacity: 1;
    }
    
    .zoom-icon, .link-icon {
        color: white;
        opacity: 0;
        transform: scale(0.5);
        transition: all 0.3s ease 0.1s;
    }
    
    .portfolio-card:hover .zoom-icon,
    .portfolio-card:hover .link-icon {
        opacity: 1;
        transform: scale(1);
    }
    
    .portfolio-content {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        background-color: rgba(255, 255, 255, 0.05);
    }
    
    .portfolio-title {
        color: white;
        position: relative;
        display: inline-block;
    }
    
    .portfolio-title:after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        width: 50px;
        height: 3px;
        background-color: var(--bs-primary);
        transform: translateX(-50%);
    }
    
    /* Animation for filtering */
    .portfolio-box {
        transition: all 0.6s ease;
    }
    
    .portfolio-item-wrapper {
        transition: all 0.4s ease;
    }
    
    .portfolio-box.hidden {
        opacity: 0;
        transform: scale(0.8);
    }
    
    .portfolio-box.visible {
        opacity: 1;
        transform: scale(1);
    }
    
    /* Custom pagination styling */
    .pagination-custom .page-item .page-link {
        border-radius: 50%;
        margin: 0 0.2rem;
        color: var(--bs-primary);
        border: none;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .pagination-custom .page-item.active .page-link {
        background-color: var(--bs-primary);
        color: white;
        box-shadow: 0 0.25rem 0.5rem rgba(var(--bs-primary-rgb), 0.4);
    }
    
    .pagination-custom .page-item .page-link:hover {
        background-color: rgba(var(--bs-primary-rgb), 0.1);
        transform: translateY(-2px);
    }
</style>

<!-- Fancybox CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const filterButtons = document.querySelectorAll(".filter-btn");
        const portfolioItems = document.querySelectorAll(".portfolio-box");
        
        // Filter functionality
        filterButtons.forEach(button => {
            button.addEventListener("click", function () {
                const filter = this.getAttribute("data-filter").toLowerCase().trim();
                
                // Update button styles
                filterButtons.forEach(btn => {
                    btn.classList.remove("btn-primary", "active-filter");
                    btn.classList.add("btn-dark");
                });
                this.classList.remove("btn-dark");
                this.classList.add("btn-primary", "active-filter");
                
                // Create animation
                const wrappers = document.querySelectorAll('.portfolio-item-wrapper');
                
                // Filter and animate portfolio items
                let visibleCount = 0;
                
                portfolioItems.forEach((item, index) => {
                    const wrapper = wrappers[index];
                    const category = item.getAttribute("data-category").toLowerCase().trim();
                    
                    if (filter === "all" || category === filter.toLowerCase()) {
                        // Show the item with a staggered delay
                        setTimeout(() => {
                            wrapper.style.display = "block";
                            item.classList.remove("hidden");
                            item.classList.add("visible");
                        }, visibleCount * 100);
                        visibleCount++;
                    } else {
                        // Hide the item
                        item.classList.remove("visible");
                        item.classList.add("hidden");
                        setTimeout(() => {
                            wrapper.style.display = "none";
                        }, 300);
                    }
                });
            });
        });
        
        // Show all initially with staggered animation
        portfolioItems.forEach((item, index) => {
            setTimeout(() => {
                item.classList.add("visible");
            }, index * 100);
        });
        
        // Initialize Fancybox with custom options
        if (typeof $.fancybox === 'function') {
            $("[data-fancybox]").fancybox({
                buttons: [
                    "zoom",
                    "share",
                    "slideShow",
                    "fullScreen",
                    "download",
                    "thumbs",
                    "close"
                ],
                loop: true,
                protect: true,
                animationEffect: "zoom-in-out",
                transitionEffect: "fade",
                transitionDuration: 500,
                idleTime: 4,
                thumbs: {
                    autoStart: true,
                    hideOnClose: true
                },
                touch: {
                    vertical: true,
                    momentum: true
                }
            });
            
            // Add custom class to Fancybox container
            $(document).on('onInit.fb', function(e, instance) {
                instance.$refs.container.addClass('custom-fancybox');
            });
        } else {
            console.warn("Fancybox not loaded. Make sure jQuery and Fancybox are properly included.");
        }
    });
</script>

<!-- jQuery and Fancybox JS (required for Fancybox to work) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

<!-- Contact Section -->
<section id="contact" class="py-5 bg-dark text-white">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 pe-lg-5 mb-5 mb-lg-0">
                <h2 class="fw-bold mb-4">Let's Work Together</h2>
                <p class="lead text-primary mb-4">Have a design project in mind? Let's bring your vision to life.</p>
                <p class="mb-5 text-light opacity-75">I'm always open to discussing new projects, creative ideas or opportunities to be part of your vision.</p>
                
                <div class="contact-info">
                    <div class="d-flex align-items-center mb-4">
                        <div class="contact-icon bg-primary p-3 rounded-circle me-3">
                            <i class="fas fa-envelope text-dark"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Email</h5>
                            <p class="mb-0"><a href="mailto:hello@tokelofoso.online" class="text-primary text-decoration-none">hello@tokelofoso.online</a></p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="contact-icon bg-primary p-3 rounded-circle me-3">
                            <i class="fas fa-phone text-dark"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Phone</h5>
                            <p class="mb-0"><a href="tel:+26668231628" class="text-primary text-decoration-none">(+266) 6823 1628</a></p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center">
                        <div class="contact-icon bg-primary p-3 rounded-circle me-3">
                            <i class="fas fa-map-marker-alt text-dark"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Location</h5>
                            <p class="mb-0 text-light opacity-75">Ha Matala Phase 2, Maseru, Lesotho</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-5">
                    <h5 class="mb-3">Follow Me</h5>
                    <div class="d-flex">
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/tokelo.foso" class="social-icon bg-dark p-2 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <i class="fab fa-facebook-f text-primary"></i>
                        </a>
                
                        <!-- X (formerly Twitter) -->
                        <a href="https://www.x.com/slkstr_" class="social-icon bg-dark p-2 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <i class="fab fa-x text-primary"></i>
                        </a>
                
                        <!-- LinkedIn -->
                        <a href="https://www.linkedin.com/in/tokelo-foso" class="social-icon bg-dark p-2 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <i class="fab fa-linkedin-in text-primary"></i>
                        </a>
                
                        <!-- Instagram -->
                        <a href="https://www.instagram.com/slkstrgrm" class="social-icon bg-dark p-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="fab fa-instagram text-primary"></i>
                        </a>
                    </div>
                </div>
                
            </div>
            
            <div class="col-lg-6">
                <div class="contact-form bg-black p-4 p-lg-5 rounded-3">
                    <h3 class="mb-4">Send Me a Message</h3>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label text-white">Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg border-0 bg-dark text-white" placeholder="Your Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label text-white">Email</label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg border-0 bg-dark text-white" placeholder="Your Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label text-white">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control form-control-lg border-0 bg-dark text-white" placeholder="Subject">
                        </div>
                        <div class="mb-4">
                            <label for="message" class="form-label text-white">Message</label>
                            <textarea name="message" id="message" class="form-control form-control-lg border-0 bg-dark text-white" rows="5" placeholder="Your Message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary px-4 py-3 w-100">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Add this for the portfolio overlay hover effect -->
<style>
/* Portfolio Overlay Hover Effect */
.portfolio-item {
    transition: all 0.3s ease;
    position: relative; /* Ensure overlay is positioned correctly */
}

.portfolio-box {
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.portfolio-box.hidden {
    opacity: 0;
    transform: scale(0.95);
    pointer-events: none;
    position: absolute;
}

.portfolio-box.visible {
    opacity: 1;
    transform: scale(1);
    position: relative;
}

/* Show the overlay on hover */
.portfolio-item:hover .portfolio-overlay {
    opacity: 1 !important;
    transition: opacity 0.3s ease-in-out;
}

/* Ensure equal height for all portfolio items */
.portfolio-box {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}

.portfolio-item {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
}

/* Ensure images fill the space while maintaining their aspect ratio */
.portfolio-item img {
    object-fit: cover; /* Ensures the image covers the container */
    height: 250px; /* You can adjust this value to your desired height */
    width: 100%; /* Ensures the image spans the full width */
}

/* Optional: Add a uniform margin/padding */
.portfolio-box {
    padding: 15px;
}

/* Hide items initially when filtered out */
.hidden {
    display: none;
}

.visible {
    display: block;
}

/* Customize pagination links */
.pagination {
    justify-content: center;
    margin-top: 20px;
}

.pagination .page-link {
    border-radius: 50%;
    padding: 8px 16px;
    color: #fff;
    background-color: #007bff;
}

.pagination .page-link:hover {
    background-color: #0056b3;
}


/* Transition effect for opacity */
.transition-opacity {
    transition: opacity 0.3s ease;
}

/* Focus effect for form inputs */
.form-control:focus {
    box-shadow: none;
    border-color: #0d6efd;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .portfolio-item img {
        height: 200px; /* Adjust for smaller screens */
    }
}

</style>

@endsection

<!-- Note: Make sure to include Font Awesome in your layout for the icons to work -->
<!-- Add this in your layout file head: -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> -->