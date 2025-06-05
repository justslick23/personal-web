@php use Illuminate\Support\Facades\Storage; @endphp

@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary: #6366f1;
        --secondary: #8b5cf6;
        --accent: #ec4899;
        --dark: #0f172a;
        --darker: #020617;
        --gray: #334155;
        --success: #10b981;
        --warning: #f59e0b;
    }
    
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        overflow-x: hidden;
    }
    
    .hero-section {
        min-height: 100vh;
        background: linear-gradient(135deg, var(--dark) 0%, var(--darker) 100%);
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
    }
    
    /* Animated Background Particles */
    .particles {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
        pointer-events: none;
    }
    
    .particle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: var(--primary);
        border-radius: 50%;
        animation: float-particles 6s infinite linear;
        opacity: 0.6;
    }
    
    @keyframes float-particles {
        0% {
            transform: translateY(100vh) rotate(0deg);
            opacity: 0;
        }
        10% {
            opacity: 0.6;
        }
        90% {
            opacity: 0.6;
        }
        100% {
            transform: translateY(-10px) rotate(360deg);
            opacity: 0;
        }
    }
    
    /* Glowing Orbs */
    .orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(1px);
        animation: float-orb 8s infinite ease-in-out;
        pointer-events: none;
    }
    
    .orb-1 {
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.3), transparent);
        top: 20%;
        left: -10%;
        animation-delay: 0s;
    }
    
    .orb-2 {
        width: 150px;
        height: 150px;
        background: radial-gradient(circle, rgba(139, 92, 246, 0.25), transparent);
        top: 60%;
        right: -5%;
        animation-delay: -4s;
    }
    
    .orb-3 {
        width: 100px;
        height: 100px;
        background: radial-gradient(circle, rgba(236, 72, 153, 0.2), transparent);
        top: 80%;
        left: 20%;
        animation-delay: -2s;
    }
    
    @keyframes float-orb {
        0%, 100% {
            transform: translateY(0px) scale(1);
        }
        33% {
            transform: translateY(-30px) scale(1.1);
        }
        66% {
            transform: translateY(20px) scale(0.9);
        }
    }
    
    /* Content Styling */
    .hero-content {
        position: relative;
        z-index: 10;
    }
    
    .typewriter {
        display: inline-block;
        font-weight: 600;
        position: relative;
        min-height: 1.5em;
    }
    
    .typewriter::after {
        content: '|';
        display: inline-block;
        color: var(--primary);
        animation: blink 1s infinite;
        margin-left: 2px;
    }
    
    @keyframes blink {
        0%, 50% { opacity: 1; }
        51%, 100% { opacity: 0; }
    }
    
    .hero-title {
        font-size: clamp(2.5rem, 8vw, 5rem);
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, #fff 0%, var(--primary) 50%, var(--accent) 100%);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: glow-text 3s ease-in-out infinite alternate;
    }
    
    @keyframes glow-text {
        from {
            filter: drop-shadow(0 0 20px rgba(99, 102, 241, 0.3));
        }
        to {
            filter: drop-shadow(0 0 30px rgba(99, 102, 241, 0.6));
        }
    }
    
    .hero-description {
        font-size: 1.25rem;
        line-height: 1.7;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 2rem;
        animation: slideInUp 1s ease-out 0.5s both;
    }
    
    /* Profile Image with Interactive Effects */
    .profile-container {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }
    
    .profile-image {
        width: 300px;
        height: 300px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid transparent;
        background: linear-gradient(45deg, var(--primary), var(--secondary), var(--accent)) padding-box;
        transition: all 0.4s ease;
        animation: profile-float 6s ease-in-out infinite;
    }
    
    .profile-image:hover {
        transform: scale(1.05);
        filter: brightness(1.1);
    }
    
    @keyframes profile-float {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
        }
        25% {
            transform: translateY(-20px) rotate(1deg);
        }
        50% {
            transform: translateY(-10px) rotate(0deg);
        }
        75% {
            transform: translateY(-15px) rotate(-1deg);
        }
    }
    
    .profile-ring {
        position: absolute;
        inset: -20px;
        border: 2px solid transparent;
        border-radius: 50%;
        background: linear-gradient(45deg, var(--primary), transparent, var(--accent)) border-box;
        animation: rotate-ring 10s linear infinite;
        opacity: 0.7;
    }
    
    @keyframes rotate-ring {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    /* Interactive Buttons */
    .hero-btn {
        padding: 15px 35px;
        font-size: 1.1rem;
        font-weight: 600;
        border: none;
        border-radius: 50px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn-primary-hero {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        box-shadow: 0 10px 30px rgba(99, 102, 241, 0.3);
    }
    
    .btn-primary-hero:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(99, 102, 241, 0.5);
        color: white;
        text-decoration: none;
    }
    
    .btn-outline-hero {
        background: transparent;
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(10px);
    }
    
    .btn-outline-hero:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: var(--primary);
        transform: translateY(-3px);
        color: white;
        text-decoration: none;
    }
    
    .hero-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }
    
    .hero-btn:hover::before {
        left: 100%;
    }
    
    /* Social Icons - Hero Section */
    .social-float {
        position: absolute;
        right: 2rem;
        top: 50%;
        transform: translateY(-50%);
        display: flex;
        flex-direction: column;
        gap: 1rem;
        z-index: 10;
    }
    
    .social-float .social-icon {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
        animation: bounce-in 0.8s ease-out;
    }
    
    .social-float .social-icon:hover {
        background: var(--primary);
        transform: translateX(-10px) scale(1.1);
        color: white;
        box-shadow: 0 10px 25px rgba(99, 102, 241, 0.4);
        text-decoration: none;
    }
    
    .social-float .social-icon:nth-child(1) { animation-delay: 0.1s; }
    .social-float .social-icon:nth-child(2) { animation-delay: 0.2s; }
    .social-float .social-icon:nth-child(3) { animation-delay: 0.3s; }
    .social-float .social-icon:nth-child(4) { animation-delay: 0.4s; }
    
    @keyframes bounce-in {
        0% {
            opacity: 0;
            transform: translateX(50px) scale(0.3);
        }
        50% {
            transform: translateX(-10px) scale(1.05);
        }
        70% {
            transform: translateX(5px) scale(0.9);
        }
        100% {
            opacity: 1;
            transform: translateX(0) scale(1);
        }
    }
    
    /* Scroll Indicator */
    .scroll-indicator {
        position: absolute;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        color: rgba(255, 255, 255, 0.6);
        text-align: center;
        animation: bounce-scroll 2s infinite;
    }
    
    .scroll-indicator i {
        font-size: 1.5rem;
        display: block;
        margin-top: 0.5rem;
    }
    
    @keyframes bounce-scroll {
        0%, 20%, 50%, 80%, 100% {
            transform: translateX(-50%) translateY(0);
        }
        40% {
            transform: translateX(-50%) translateY(-10px);
        }
        60% {
            transform: translateX(-50%) translateY(-5px);
        }
    }
    
    /* Animations */
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .slide-in-left {
        animation: slideInLeft 1s ease-out;
    }
    
    .slide-in-right {
        animation: slideInRight 1s ease-out 0.3s both;
    }
    
    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-100px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(100px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    /* Skills Section */
    .skill-bar {
        background: rgba(255,255,255,0.1);
        height: 8px;
        border-radius: 4px;
        overflow: hidden;
    }
    
    .skill-progress {
        height: 100%;
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        border-radius: 4px;
        transition: width 2s ease;
        width: 0;
    }
    
    /* Portfolio Section */
    .portfolio-card {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 12px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .portfolio-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        border-color: var(--primary);
    }
    
    .portfolio-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
        transition: left 0.5s;
    }
    
    .portfolio-card:hover::before {
        left: 100%;
    }
    
    .filter-btn {
        padding: 8px 20px;
        border: 1px solid rgba(255,255,255,0.2);
        background: transparent;
        color: white;
        border-radius: 25px;
        transition: all 0.3s ease;
        margin: 0 5px;
        cursor: pointer;
    }
    
    .filter-btn.active,
    .filter-btn:hover {
        background: var(--primary);
        border-color: var(--primary);
        transform: translateY(-2px);
    }
    
    /* Contact Section */
    .contact-icon {
        width: 50px;
        height: 50px;
        background: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease;
        color: white;
    }
    
    .contact-icon:hover {
        transform: scale(1.1);
    }
    
    .form-control {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        color: white;
        padding: 12px 16px;
        border-radius: 8px;
        transition: all 0.3s ease;
        width: 100%;
    }
    
    .form-control:focus {
        background: rgba(255,255,255,0.1);
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
        outline: none;
        color: white;
    }
    
    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        transition: all 0.3s ease;
        color: white;
        cursor: pointer;
        font-weight: 600;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
        color: white;
    }
    
    /* Section Animation */
    .section-enter {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease;
    }
    
    .section-enter.visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* General Social Icons */
    .social-icon {
        width: 40px;
        height: 40px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        margin-right: 10px;
        color: white;
        text-decoration: none;
    }
    
    .social-icon:hover {
        background: var(--primary);
        transform: translateY(-3px);
        color: white;
        text-decoration: none;
    }
    
    /* Alert Styles */
    .alert {
        border-radius: 8px;
        border: none;
    }
    
    .alert-success {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success);
        border: 1px solid rgba(16, 185, 129, 0.2);
    }
    
    .btn-close {
        filter: invert(1);
    }
    
    /* Portfolio Image Styling */
    .portfolio-item img {
        transition: transform 0.3s ease;
    }
    
    .portfolio-item:hover img {
        transform: scale(1.05);
    }
    
    /* Loading States */
    .btn-loading {
        position: relative;
        color: transparent;
    }
    
    .btn-loading::after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        top: 50%;
        left: 50%;
        margin-left: -8px;
        margin-top: -8px;
        border: 2px solid #ffffff;
        border-radius: 50%;
        border-top-color: transparent;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .social-float {
            position: static;
            flex-direction: row;
            justify-content: center;
            margin-top: 2rem;
            transform: none;
        }
        
        .social-float .social-icon:hover {
            transform: translateY(-5px) scale(1.1);
        }
        
        .profile-image {
            width: 250px;
            height: 250px;
        }
        
        .hero-btn {
            padding: 12px 25px;
            font-size: 1rem;
        }
        
        .hero-title {
            font-size: clamp(2rem, 6vw, 3.5rem);
        }
        
        .hero-description {
            font-size: 1.1rem;
        }
        
        .particles {
            display: none;
        }
        
        .orb {
            display: none;
        }
    }
    
    @media (max-width: 576px) {
        .hero-section {
            min-height: auto;
            padding: 4rem 0;
        }
        
        .profile-image {
            width: 200px;
            height: 200px;
        }
        
        .hero-btn {
            width: 100%;
            justify-content: center;
        }
        
        .section-padding {
            padding: 3rem 0;
        }
    }
    
    /* Smooth scrolling */
    html {
        scroll-behavior: smooth;
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: var(--dark);
    }
    
    ::-webkit-scrollbar-thumb {
        background: var(--primary);
        border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: var(--secondary);
    }
    </style>
    

<!-- Hero Section -->
<section class="hero-section">
        <!-- Animated Background -->
        <div class="particles" id="particles"></div>
        
        <!-- Floating Orbs -->
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
        
        <!-- Floating Social Icons -->
        <div class="social-float d-none d-lg-flex">
            <a href="https://www.facebook.com/tokelo.foso/" class="social-icon">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://x.com/slkstr_" class="social-icon">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="https://www.linkedin.com/in/tokelo-foso/" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
            </a>
            <a href="https://www.instagram.com/slkstrgrm/" class="social-icon">
                <i class="fab fa-instagram"></i>
            </a>
        </div>
        
        <div class="container">
            <div class="row align-items-center">
                <!-- Content Column -->
                <div class="col-lg-6 hero-content slide-in-left">
                    <p class="text-uppercase mb-3 text-primary fs-5 fw-bold">
                        <span id="typewriter" class="typewriter"></span>
                    </p>
                    
                    <h1 class="hero-title">
                        Hello, I'm<br>
                        <span class="text-primary">Tokelo Foso</span>
                    </h1>
                    
                    <p class="hero-description">
                        Crafting visuals, coding experiences, and composing beats are my passions. 
                        Let's bring your ideas to life with creativity at its core. 
                        Welcome to my world of design, development, and music!
                    </p>
                    
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <a href="#portfolio" class="hero-btn btn-primary-hero">
                            <i class="fas fa-rocket"></i>
                            View Projects
                        </a>
                        <a href="#contact" class="hero-btn btn-outline-hero">
                            <i class="fas fa-paper-plane"></i>
                            Contact Me
                        </a>
                    </div>
                    
                    <!-- Mobile Social Icons -->
                    <div class="social-float d-flex d-lg-none justify-content-start">
                        <a href="https://www.facebook.com/tokelo.foso/" class="social-icon me-2">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://x.com/slkstr_" class="social-icon me-2">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/tokelo-foso/" class="social-icon me-2">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://www.instagram.com/slkstrgrm/" class="social-icon">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Image Column -->
                <div class="col-lg-6 text-center slide-in-right">
                    <div class="profile-container">
                        <div class="profile-ring"></div>
                        <img src="{{ asset('images/me.jpg') }}" 
                             class="profile-image" 
                             alt="Tokelo Foso"
                             id="profileImg">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="scroll-indicator">
            <small>Scroll Down</small>
            <i class="fas fa-chevron-down"></i>
        </div>
    </section>

<!-- About Section -->
<section id="about" class="py-5" style="background: var(--dark);">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 section-enter animation-fade-in-left"> <h2 class="fw-bold mb-3 text-white display-4">About Me</h2> <p class="lead text-primary mb-4 h4">Creative Designer & Developer based in Lesotho</p>
                <p class="mb-4 text-light opacity-75">I'm Tokelo, a versatile creative with a flair for design, a knack for coding, and a love for music. As a Graphic Designer and Web Developer, I thrive on turning concepts into captivating visuals and seamless digital experiences.</p>
                <div class="d-flex align-items-center mt-4 animation-scale-up"> <i class="fas fa-magic fa-3x text-primary me-3"></i> <p class="text-white mb-0 fs-5">Bringing ideas to life, one pixel at a time.</p>
                </div>
            </div>
            <div class="col-lg-6 section-enter animation-fade-in-right"> <div class="p-4 rounded-3 shadow-lg hover-effect" style="background: var(--darker);"> <h3 class="fw-bold mb-4 text-white text-center">The Designer's Mindset: Problem to Pixel</h3>
                    
                    <p class="mb-4 text-light opacity-75 text-center">
                        I approach every challenge as an opportunity to innovate. From dissecting complex problems to meticulously crafting pixel-perfect designs and robust code, my goal is to deliver intuitive, effective, and visually compelling solutions that truly work.
                    </p>
                    
                    <div class="d-flex align-items-center mb-3 process-step animation-slide-up"> <i class="fas fa-binoculars fa-2x text-primary me-3 icon-bounce"></i> <div>
                            <h5 class="text-white mb-0">Understand & Analyze</h5>
                            <p class="text-light opacity-75 mb-0">Deep dive into challenges and goals.</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center mb-3 process-step animation-slide-up delay-1"> <i class="fas fa-drafting-compass fa-2x text-primary me-3 icon-bounce"></i>
                        <div>
                            <h5 class="text-white mb-0">Design & Engineer</h5>
                            <p class="text-light opacity-75 mb-0">Crafting thoughtful and functional blueprints.</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center process-step animation-slide-up delay-2"> <i class="fas fa-check-double fa-2x text-primary me-3 icon-bounce"></i>
                        <div>
                            <h5 class="text-white mb-0">Refine & Deliver</h5>
                            <p class="text-light opacity-75 mb-0">Polished, high-quality results that exceed expectations.</p>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <p class="text-white mb-3 fs-5">Ready to solve your next design challenge?</p>
                        <a href="#contact" class="btn btn-primary btn-lg custom-btn-pulse">Let's Discuss Your Project <i class="fas fa-arrow-right ms-2"></i></a> </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', () => {
    const sections = document.querySelectorAll('.section-enter');

    const observerOptions = {
        root: null, // viewport
        rootMargin: '0px',
        threshold: 0.2 // Trigger when 20% of the element is visible
    };

    const sectionObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible'); // Add a 'visible' class
                observer.unobserve(entry.target); // Stop observing once animated
            }
        });
    }, observerOptions);

    sections.forEach(section => {
        sectionObserver.observe(section);
    });

    // For the individual process steps and magic icon line
    const processSteps = document.querySelectorAll('.process-step, .animation-scale-up');
    const stepObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 }); // Trigger when 50% visible

    processSteps.forEach(step => {
        stepObserver.observe(step);
    });
});
</script>
<style>
    /* Basic Animations (adjust timings and values as needed) */

/* Fade In Left/Right */
.animation-fade-in-left {
    opacity: 0;
    transform: translateX(-50px);
    transition: opacity 0.8s ease-out, transform 0.8s ease-out;
}

.animation-fade-in-right {
    opacity: 0;
    transform: translateX(50px);
    transition: opacity 0.8s ease-out, transform 0.8s ease-out;
}

/* Slide Up */
.animation-slide-up {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}

/* Animation Delays for sequence */
.animation-slide-up.delay-1 { transition-delay: 0.2s; }
.animation-slide-up.delay-2 { transition-delay: 0.4s; }

/* Scale Up (subtle for the magic icon line) */
.animation-scale-up {
    opacity: 0;
    transform: scale(0.9);
    transition: opacity 0.7s ease-out, transform 0.7s ease-out;
}


/* Scroll-triggered animations (requires JavaScript or a library like AOS) */
/*
   To make these animations trigger on scroll, you would typically use JavaScript
   (e.g., Intersection Observer API or a library like AOS - Animate On Scroll).
   For example, with AOS, you'd add `data-aos="fade-left"` etc. to your HTML.
   Without JS, they will play on page load.
*/
.section-enter.animation-fade-in-left,
.section-enter.animation-fade-in-right,
.animation-slide-up,
.animation-scale-up {
    /* These styles will be applied by JavaScript when the element enters the viewport */
    /* Example using a 'visible' class toggled by JS */
    /*
    &.visible {
        opacity: 1;
        transform: translateX(0);
        transform: translateY(0);
        transform: scale(1);
    }
    */
}

/* ... (your existing animation CSS) ... */

/* When 'visible' class is added by JS, play animation */
.section-enter.visible.animation-fade-in-left {
    opacity: 1;
    transform: translateX(0);
}
.section-enter.visible.animation-fade-in-right {
    opacity: 1;
    transform: translateX(0);
}

.process-step.visible.animation-slide-up {
    opacity: 1;
    transform: translateY(0);
}

.animation-scale-up.visible {
    opacity: 1;
    transform: scale(1);
}


/* Hover Effects */

/* General box hover effect */
.hover-effect {
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}
.hover-effect:hover {
    transform: translateY(-5px); /* Lifts the box slightly */
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3); /* Stronger shadow on hover */
}

/* Process Step Hover */
.process-step {
    transition: background-color 0.3s ease, transform 0.3s ease;
    padding: 10px; /* Add some padding for the hover effect */
    border-radius: 5px;
    cursor: pointer; /* Indicates interactivity */
}
.process-step:hover {
    background-color: rgba(var(--primary-rgb), 0.1); /* Subtle primary color background */
    transform: translateX(5px); /* Nudges it slightly to the right */
}

/* Icon Bounce on hover */
.icon-bounce {
    transition: transform 0.3s ease-in-out;
}
.process-step:hover .icon-bounce { /* Apply bounce when parent .process-step is hovered */
    animation: bounce 0.6s forwards;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); } /* Small upward bounce */
}

/* Custom Button Pulse Animation */
.custom-btn-pulse {
    animation: pulse-initial 2s infinite ease-in-out; /* Initial subtle pulse */
    transition: all 0.3s ease;
}

.custom-btn-pulse:hover {
    animation: none; /* Stop initial pulse on hover */
    transform: scale(1.05); /* Grow slightly on hover */
    box-shadow: 0 0 20px rgba(var(--primary-rgb), 0.6); /* Glow effect */
}

@keyframes pulse-initial {
    0% { transform: scale(1); }
    50% { transform: scale(1.02); }
    100% { transform: scale(1); }
}


</style>

<!-- Experience Section -->
<section class="py-5" style="background: var(--darker);">
    <div class="container py-5">
        <h2 class="fw-bold text-center mb-5 text-white section-enter">Experience & Education</h2>
        <div class="row">
            <div class="col-lg-6 section-enter">
                <h3 class="border-start border-primary border-4 ps-3 mb-4 text-white">Work Experience</h3>
                
                <div class="portfolio-card p-4 mb-4">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h4 class="mb-2 text-white">Web Designer</h4>
                        <span class="badge bg-primary">2022-Present</span>
                    </div>
                    <p class="text-primary mb-2">Computer Business Solutions</p>
                    <p class="text-light opacity-75 mb-0">Led design projects for multiple clients, creating responsive websites and improving user experience.</p>
                </div>
                
                <div class="portfolio-card p-4">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h4 class="mb-2 text-white">Graphic Designer</h4>
                        <span class="badge bg-primary">2021-2022</span>
                    </div>
                    <p class="text-primary mb-2">Osmium Lesotho</p>
                    <p class="text-light opacity-75 mb-0">Created visual content for marketing campaigns, social media, and websites. Worked closely with clients to bring their brand vision to life.</p>
                </div>
            </div>
            
            <div class="col-lg-6 section-enter">
                <h3 class="border-start border-primary border-4 ps-3 mb-4 text-white">Education</h3>
                
                <div class="portfolio-card p-4 mb-4">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h4 class="mb-2 text-white">Bachelor of Computer and Information Sciences</h4>
                        <span class="badge bg-primary">2018-2020</span>
                    </div>
                    <p class="text-primary mb-2">Monash University</p>
                    <p class="text-light opacity-75 mb-0">Majored in Mobile Systems and Software Development</p>
                </div>
                
                <div class="portfolio-card p-4">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h4 class="mb-2 text-white">IGCSE</h4>
                        <span class="badge bg-primary">2014-2016</span>
                    </div>
                    <p class="text-primary mb-2">Machabeng College</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Section -->
<section id="portfolio" class="py-5" style="background: var(--dark);">
    <div class="container py-5">
        <div class="text-center mb-5 section-enter">
            <h6 class="text-primary fw-bold text-uppercase mb-2">Portfolio</h6>
            <h2 class="fw-bold mb-3 display-4 text-white">My Recent Work</h2>
            <p class="text-light opacity-75 mx-auto" style="max-width: 650px;">Here are some of my recent projects that showcase my design abilities and creative approach.</p>
        </div>

        <!-- Portfolio Filters -->
        <div class="text-center mb-5 section-enter">
            <button class="filter-btn active" data-filter="all">All</button>
            <button class="filter-btn" data-filter="Web App Design">Web Apps</button>
            <button class="filter-btn" data-filter="Poster Design">Posters</button>
        </div>

        <!-- Portfolio Items -->
        <div class="row g-4" id="portfolio-items">
            @foreach($portfolioItems as $item)
                <div class="col-md-6 col-lg-4 portfolio-item" data-category="{{ $item->category }}">
                    <div class="portfolio-card h-100">
                        <div class="position-relative" style="aspect-ratio: 1/1;">
                            <img src="{{ $item->image ? asset('public/' . $item->image) : asset('images/default.jpg') }}" alt="Course Image">

                                                    <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge bg-primary">{{ $item->category }}</span>
                            </div>
                        </div>
                        
                        <div class="p-3 text-center">
                            <h5 class="fw-bold mb-2 text-white">{{ $item->title }}</h5>
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
        <div class="text-center mt-5">
            {{ $portfolioItems->links() }}
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-5" style="background: var(--darker);">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 section-enter">
                <h2 class="fw-bold mb-4 text-white">Let's Work Together</h2>
                <p class="lead text-primary mb-4">Have a design project in mind? Let's bring your vision to life.</p>
                <p class="mb-5 text-light opacity-75">I'm always open to discussing new projects, creative ideas or opportunities to be part of your vision.</p>
                
                <div class="mb-4 d-flex align-items-center">
                    <div class="contact-icon me-3">
                        <i class="fas fa-envelope text-white"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 text-white">Email</h5>
                        <a href="mailto:hello@tokelofoso.online" class="text-primary text-decoration-none">hello@tokelofoso.online</a>
                    </div>
                </div>
                
                <div class="mb-4 d-flex align-items-center">
                    <div class="contact-icon me-3">
                        <i class="fas fa-phone text-white"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 text-white">Phone</h5>
                        <a href="tel:+26668231628" class="text-primary text-decoration-none">(+266) 6823 1628</a>
                    </div>
                </div>
                
                <div class="mb-5 d-flex align-items-center">
                    <div class="contact-icon me-3">
                        <i class="fas fa-map-marker-alt text-white"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 text-white">Location</h5>
                        <p class="mb-0 text-light opacity-75">Ha Matala Phase 2, Maseru, Lesotho</p>
                    </div>
                </div>
                
                <div>
                    <h5 class="mb-3 text-white">Follow Me</h5>
                    <div class="d-flex">
                        <a href="https://www.facebook.com/tokelo.foso" class="social-icon">
                            <i class="fab fa-facebook-f text-white"></i>
                        </a>
                        <a href="https://www.x.com/slkstr_" class="social-icon">
                            <i class="fab fa-x-twitter text-white"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/tokelo-foso" class="social-icon">
                            <i class="fab fa-linkedin-in text-white"></i>
                        </a>
                        <a href="https://www.instagram.com/slkstrgrm" class="social-icon">
                            <i class="fab fa-instagram text-white"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 section-enter">
                <div class="portfolio-card p-4">
                    <h3 class="mb-4 text-white">Send Me a Message</h3>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="subject" class="form-control" placeholder="Subject">
                        </div>
                        <div class="mb-4">
                            <textarea name="message" class="form-control" rows="5" placeholder="Your Message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Typewriter effect
    const roles = ["Web Designer", "Software Developer", "Graphic Designer"];
    let roleIndex = 0;
    let charIndex = 0;
    let isDeleting = false;
    const typewriter = document.getElementById('typewriter');
    
    function type() {
        const currentRole = roles[roleIndex];
        
        if (isDeleting) {
            typewriter.textContent = currentRole.substring(0, charIndex - 1);
            charIndex--;
        } else {
            typewriter.textContent = currentRole.substring(0, charIndex + 1);
            charIndex++;
        }
        
        if (!isDeleting && charIndex === currentRole.length) {
            setTimeout(() => isDeleting = true, 2000);
        } else if (isDeleting && charIndex === 0) {
            isDeleting = false;
            roleIndex = (roleIndex + 1) % roles.length;
        }
        
        setTimeout(type, isDeleting ? 50 : 100);
    }
    
    setTimeout(type, 1000);
    
    // Scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                
                // Animate skill bars
                if (entry.target.querySelector('.skill-progress')) {
                    entry.target.querySelectorAll('.skill-progress').forEach(bar => {
                        setTimeout(() => {
                            bar.style.width = bar.dataset.width + '%';
                        }, 500);
                    });
                }
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.section-enter').forEach(el => {
        observer.observe(el);
    });
    
    // Portfolio filter
    const filterBtns = document.querySelectorAll('.filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Update active button
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const filter = this.dataset.filter;
            
            portfolioItems.forEach(item => {
                if (filter === 'all' || item.dataset.category === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
    
    // Smooth scrolling for anchor links
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