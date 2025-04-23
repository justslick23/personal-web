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
                    <p class="text-light opacity-75 mb-0">Led design projects for multiple clients, creating responsive websites and improving user experience metrics by 40%.</p>
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
                    <p class="text-light opacity-75 mb-0">Graduated with honors. Specialized in digital product design and interactive media.</p>
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
            <h2 class="fw-bold mb-3">My Recent Work</h2>
            <p class="text-light opacity-75 mx-auto" style="max-width: 650px;">Here are some of my recent projects that showcase my design abilities and creative approach.</p>
        </div>
        
        <div class="portfolio-filter mb-5 text-center">
            <button class="btn btn-sm btn-primary px-4 py-2 me-2 mb-2">All</button>
            <button class="btn btn-sm btn-outline-light px-4 py-2 me-2 mb-2">App Design</button>
            <button class="btn btn-sm btn-outline-light px-4 py-2 me-2 mb-2">Poster Design</button>
        </div>
        
        <div class="row g-4">
            @foreach($portfolioItems as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="portfolio-item position-relative overflow-hidden rounded-3">
                        <img src="{{ asset('storage/' . $item->image) }}" class="img-fluid w-100" alt="{{ $item->title }}">
                        <div class="portfolio-overlay position-absolute start-0 top-0 w-100 h-100 d-flex flex-column justify-content-end p-4 bg-dark bg-opacity-75 opacity-0 transition-opacity">
                            <h5 class="mb-2">{{ $item->title }}</h5>
                            <p class="text-primary mb-3">{{ $item->category }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>



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
                            <p class="mb-0"><a href="tel:+1234567890" class="text-primary text-decoration-none">(+266) 6823 1628</a></p>
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
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control form-control-lg border-0 bg-dark text-white" placeholder="Your Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control form-control-lg border-0 bg-dark text-white" placeholder="Your Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control form-control-lg border-0 bg-dark text-white" placeholder="Subject">
                        </div>
                        <div class="mb-4">
                            <textarea class="form-control form-control-lg border-0 bg-dark text-white" rows="5" placeholder="Your Message" required></textarea>
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
.portfolio-item {
    transition: all 0.3s ease;
}
.portfolio-item:hover .portfolio-overlay {
    opacity: 1 !important;
}
.transition-opacity {
    transition: opacity 0.3s ease;
}
.form-control:focus {
    box-shadow: none;
    border-color: #0d6efd;
}
</style>

@endsection

<!-- Note: Make sure to include Font Awesome in your layout for the icons to work -->
<!-- Add this in your layout file head: -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> -->