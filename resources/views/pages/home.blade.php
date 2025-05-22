@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<<!-- Hero Section -->
<section class="hero-section position-relative text-white" style="min-height: 100vh; ">
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
    :root {
        --bg-primary: #0f0f23;
        --bg-secondary: #16213e;
        --bg-tertiary: #1a1a2e;
        --bg-card: rgba(22, 33, 62, 0.8);
        --bg-glass: rgba(255, 255, 255, 0.05);
        --border-glass: rgba(255, 255, 255, 0.1);
        --text-primary: #ffffff;
        --text-secondary: #b8c5d6;
        --text-muted: #8892b0;
        --accent-primary: #64ffda;
        --accent-secondary: #ff6b9d;
        --accent-tertiary: #ffd93d;
        --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --gradient-accent: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --gradient-dark: linear-gradient(135deg, #0f0f23 0%, #16213e 50%, #1a1a2e 100%);
        --shadow-dark: 0 25px 50px -12px rgba(0, 0, 0, 0.8);
        --shadow-glow: 0 0 30px rgba(100, 255, 218, 0.3);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: var(--bg-primary);
        color: var(--text-primary);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        line-height: 1.6;
        overflow-x: hidden;
    }

    /* Animated Background */
    .animated-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -2;
        background: var(--gradient-dark);
        background-size: 400% 400%;
        animation: gradientShift 20s ease infinite;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Particle Background */
    .particles {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        overflow: hidden;
    }

    .particle {
        position: absolute;
        background: var(--accent-primary);
        border-radius: 50%;
        opacity: 0.1;
        animation: float 20s linear infinite;
    }

    .particle:nth-child(odd) {
        background: var(--accent-secondary);
        animation-duration: 25s;
    }

    .particle:nth-child(3n) {
        background: var(--accent-tertiary);
        animation-duration: 30s;
    }

    @keyframes float {
        0% {
            transform: translateY(100vh) rotate(0deg);
            opacity: 0;
        }
        10% {
            opacity: 0.3;
        }
        90% {
            opacity: 0.3;
        }
        100% {
            transform: translateY(-100vh) rotate(360deg);
            opacity: 0;
        }
    }

    /* Glass Morphism Effect */
    .glass-card {
        background: var(--bg-glass);
        backdrop-filter: blur(20px);
        border: 1px solid var(--border-glass);
        border-radius: 24px;
        box-shadow: var(--shadow-dark);
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
        overflow: hidden;
    }

    .glass-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--accent-primary), transparent);
        opacity: 0.5;
    }

    .glass-card:hover {
        transform: translateY(-12px);
        box-shadow: var(--shadow-dark), var(--shadow-glow);
        border-color: rgba(100, 255, 218, 0.3);
    }

    /* Hero Section */
    .hero-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        position: relative;
        padding: 120px 0 60px;
        background: radial-gradient(
        circle at 50% 50%,
        rgba(12, 10, 21, 0.3),
        #0f0f1d 50%,
        #0a0a23 100%
    );
    }



    section {
        background: radial-gradient(
        circle at 50% 50%,
        rgba(12, 10, 21, 0.3),
        #0f0f1d 50%,
        #0a0a23 100%
    );
    }

    section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed; /* Parallax effect */
    filter: brightness(50%); /* Darkens only the background */
    z-index: -1; /* Places it behind content */
}

    .hero-title {
        font-size: clamp(3rem, 8vw, 6rem);
        font-weight: 800;
        line-height: 1.1;
        background: linear-gradient(135deg, var(--text-primary) 0%, var(--accent-primary) 50%, var(--accent-secondary) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 2rem;
    }

    .hero-subtitle {
        font-size: 1.5rem;
        color: var(--text-secondary);
        margin-bottom: 3rem;
        font-weight: 300;
    }

    /* Typewriter Effect */
    .typewriter {
        font-size: 1.2rem;
        color: var(--accent-primary);
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .typewriter::after {
        content: '|';
        animation: blink 1s infinite;
    }

    @keyframes blink {
        0%, 50% { opacity: 1; }
        51%, 100% { opacity: 0; }
    }

    /* Enhanced Buttons */
    .glow-btn {
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        border: none;
        border-radius: 50px;
        padding: 16px 32px;
        color: var(--bg-primary);
        font-weight: 600;
        font-size: 1rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        box-shadow: 0 8px 32px rgba(100, 255, 218, 0.3);
        position: relative;
        overflow: hidden;
    }

    .glow-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: left 0.6s;
    }

    .glow-btn:hover::before {
        left: 100%;
    }

    .glow-btn:hover {
        transform: translateY(-4px) scale(1.05);
        box-shadow: 0 16px 48px rgba(100, 255, 218, 0.5);
        color: var(--bg-primary);
        text-decoration: none;
    }

    .glow-btn.secondary {
        background: linear-gradient(135deg, var(--accent-secondary), var(--accent-tertiary));
        box-shadow: 0 8px 32px rgba(255, 107, 157, 0.3);
    }

    .glow-btn.secondary:hover {
        box-shadow: 0 16px 48px rgba(255, 107, 157, 0.5);
    }

    /* Profile Image */
    .profile-container {
        position: relative;
        display: inline-block;
    }

    .profile-img {
        width: 400px;
        height: 400px;
        border-radius: 50%;
        border: 4px solid var(--accent-primary);
        box-shadow: 0 0 50px rgba(100, 255, 218, 0.4);
        transition: all 0.4s ease;
        animation: profileFloat 6s ease-in-out infinite;
        object-fit: cover;
    }

    @keyframes profileFloat {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(2deg); }
    }

    .profile-glow {
        position: absolute;
        top: -30px;
        left: -30px;
        right: -30px;
        bottom: -30px;
        background: radial-gradient(circle, var(--accent-primary) 0%, transparent 70%);
        border-radius: 50%;
        z-index: -1;
        opacity: 0.2;
        animation: pulse 3s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.2; }
        50% { transform: scale(1.1); opacity: 0.1; }
    }

    /* Skills Progress Bars */
    .skill-item {
        margin-bottom: 2rem;
    }

    .skill-bar {
        height: 12px;
        background: var(--bg-secondary);
        border-radius: 10px;
        overflow: hidden;
        position: relative;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .skill-progress {
        height: 100%;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        border-radius: 10px;
        position: relative;
        animation: skillSlide 2s ease-out;
        box-shadow: 0 0 20px rgba(100, 255, 218, 0.5);
    }

    @keyframes skillSlide {
        from { width: 0 !important; }
    }

    .skill-progress::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        background: linear-gradient(
            45deg,
            rgba(255, 255, 255, 0.1) 25%,
            transparent 25%,
            transparent 50%,
            rgba(255, 255, 255, 0.1) 50%,
            rgba(255, 255, 255, 0.1) 75%,
            transparent 75%
        );
        background-size: 20px 20px;
        animation: move 2s linear infinite;
    }

    @keyframes move {
        0% { background-position: 0 0; }
        100% { background-position: 20px 20px; }
    }

    /* Portfolio Cards */
    .portfolio-card-modern {
        background: var(--bg-glass);
        backdrop-filter: blur(20px);
        border: 1px solid var(--border-glass);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
        height: 100%;
    }

    .portfolio-card-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 1;
    }

    .portfolio-card-modern:hover::before {
        opacity: 0.05;
    }

    .portfolio-card-modern:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: var(--shadow-dark), var(--shadow-glow);
        border-color: rgba(100, 255, 218, 0.3);
    }

    .portfolio-image {
        height: 250px;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .portfolio-card-modern:hover .portfolio-image {
        transform: scale(1.05);
    }

    /* Filter Buttons */
    .filter-btn-modern {
        background: var(--bg-glass);
        backdrop-filter: blur(10px);
        border: 1px solid var(--border-glass);
        border-radius: 30px;
        padding: 12px 24px;
        color: var(--text-secondary);
        transition: all 0.3s ease;
        margin: 0 8px 8px 0;
        font-weight: 500;
    }

    .filter-btn-modern:hover,
    .filter-btn-modern.active {
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        color: var(--bg-primary);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(100, 255, 218, 0.4);
    }

    /* Contact Form */
    .contact-form-modern {
        background: var(--bg-glass);
        backdrop-filter: blur(20px);
        border: 1px solid var(--border-glass);
        border-radius: 24px;
        padding: 3rem;
    }

    .form-control-modern {
        background: var(--bg-secondary);
        border: 1px solid var(--border-glass);
        border-radius: 12px;
        padding: 16px 20px;
        color: var(--text-primary);
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .form-control-modern:focus {
        outline: none;
        border-color: var(--accent-primary);
        box-shadow: 0 0 25px rgba(100, 255, 218, 0.3);
        background: var(--bg-tertiary);
        color: var(--text-primary);
    }

    .form-control-modern::placeholder {
        color: var(--text-muted);
    }

    /* Social Icons */
    .social-icon-modern {
        width: 60px;
        height: 60px;
        background: var(--bg-glass);
        backdrop-filter: blur(10px);
        border: 1px solid var(--border-glass);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-secondary);
        text-decoration: none;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        margin: 0 12px;
        font-size: 1.2rem;
    }

    .social-icon-modern:hover {
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        color: var(--bg-primary);
        transform: translateY(-8px) rotate(360deg);
        box-shadow: 0 15px 35px rgba(100, 255, 218, 0.4);
    }

    /* Experience Timeline */
    .timeline-item {
        background: var(--bg-glass);
        backdrop-filter: blur(20px);
        border: 1px solid var(--border-glass);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        position: relative;
        transition: all 0.3s ease;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: -10px;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        background: var(--accent-primary);
        border-radius: 50%;
        box-shadow: 0 0 20px rgba(100, 255, 218, 0.5);
    }

    .timeline-item:hover {
        transform: translateX(10px);
        border-color: rgba(100, 255, 218, 0.3);
    }

    /* Section Titles */
    .section-title {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 700;
        text-align: center;
        margin-bottom: 4rem;
        background: linear-gradient(135deg, var(--text-primary) 0%, var(--accent-primary) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Animations */
    .fade-in-up {
        animation: fadeInUp 1s ease-out forwards;
        opacity: 0;
        transform: translateY(50px);
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stagger-1 { animation-delay: 0.1s; }
    .stagger-2 { animation-delay: 0.2s; }
    .stagger-3 { animation-delay: 0.3s; }
    .stagger-4 { animation-delay: 0.4s; }
    .stagger-5 { animation-delay: 0.5s; }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-section {
            text-align: center;
            padding: 80px 0 40px;
        }
        
        .profile-img {
            width: 300px;
            height: 300px;
        }
        
        .contact-form-modern {
            padding: 2rem;
        }
        
        .particles {
            display: none;
        }
    }

    /* Portfolio Filter Animation */
    .portfolio-item-wrapper {
        transition: all 0.4s ease;
    }

    .portfolio-item-wrapper.hidden {
        opacity: 0;
        transform: scale(0.8);
        pointer-events: none;
    }

    .portfolio-item-wrapper.visible {
        opacity: 1;
        transform: scale(1);
    }

    /* Badge Styles */
    .custom-badge {
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        color: var(--bg-primary);
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    /* Contact Info Styles */
    .contact-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--bg-primary);
        font-size: 1.2rem;
    }
</style>

@endsection

<!-- Note: Make sure to include Font Awesome in your layout for the icons to work -->
<!-- Add this in your layout file head: -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> -->