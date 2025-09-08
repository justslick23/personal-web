// Advanced Scroll Animations and Effects
// Save as public/js/scroll-animations.js

class ScrollAnimations {
    constructor() {
        this.init();
        this.setupParallax();
        this.setupCursor();
        this.setupPageTransitions();
        this.setupScrollIndicator();
        this.setupBackToTop();
    }

    init() {
        // Enhanced Intersection Observer with stagger effects
        const observerOptions = {
            threshold: 0.15,
            rootMargin: '0px 0px -100px 0px'
        };

        this.observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    // Add stagger delay based on element position
                    const delay = index * 100;
                    setTimeout(() => {
                        entry.target.classList.add('animate');
                        this.triggerCustomAnimation(entry.target);
                    }, delay);
                }
            });
        }, observerOptions);

        // Observe all scroll-animate elements
        document.querySelectorAll('.scroll-animate').forEach(el => {
            this.observer.observe(el);
        });

        // Text reveal animations
        this.initTextReveal();
        
        // Mouse move parallax
        this.initMouseParallax();
        
        // Floating elements
        this.initFloatingElements();
        
        // Performance monitoring
        this.initPerformanceMonitor();
    }

    triggerCustomAnimation(element) {
        // Counter animations
        if (element.hasAttribute('data-count')) {
            this.animateCounter(element);
        }

        // Progress bars
        if (element.classList.contains('progress-bar')) {
            this.animateProgressBar(element);
        }

        // Typewriter for headings
        if (element.classList.contains('typewriter-heading')) {
            this.typewriterAnimation(element);
        }

        // Morphing shapes
        if (element.classList.contains('morph-shape')) {
            this.morphAnimation(element);
        }

        // Number increment animations
        if (element.classList.contains('number-animate')) {
            this.animateNumber(element);
        }
    }

    animateCounter(element) {
        const target = parseInt(element.dataset.count);
        const duration = parseInt(element.dataset.duration) || 2000;
        const startValue = parseInt(element.dataset.start) || 0;
        const suffix = element.dataset.suffix || '';
        const prefix = element.dataset.prefix || '';
        
        const startTime = performance.now();
        const range = target - startValue;

        const updateCounter = (currentTime) => {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            
            // Easing function for smooth animation
            const easeOutCubic = 1 - Math.pow(1 - progress, 3);
            const current = Math.floor(startValue + (range * easeOutCubic));
            
            element.textContent = prefix + current.toLocaleString() + suffix;
            
            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = prefix + target.toLocaleString() + suffix;
            }
        };

        requestAnimationFrame(updateCounter);
    }

    animateProgressBar(element) {
        const progress = element.dataset.progress || 90;
        const duration = parseInt(element.dataset.duration) || 2000;
        
        element.style.width = '0%';
        element.style.transition = `width ${duration}ms cubic-bezier(0.4, 0, 0.2, 1)`;
        
        setTimeout(() => {
            element.style.width = progress + '%';
        }, 100);

        // Add number display if data-show-number is true
        if (element.dataset.showNumber === 'true') {
            const numberDisplay = document.createElement('span');
            numberDisplay.className = 'progress-number';
            element.parentElement.appendChild(numberDisplay);
            
            this.animateProgressNumber(numberDisplay, progress, duration);
        }
    }

    animateProgressNumber(element, target, duration) {
        const startTime = performance.now();
        
        const updateNumber = (currentTime) => {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const current = Math.floor(target * progress);
            
            element.textContent = current + '%';
            
            if (progress < 1) {
                requestAnimationFrame(updateNumber);
            }
        };
        
        requestAnimationFrame(updateNumber);
    }

    typewriterAnimation(element) {
        const text = element.textContent;
        const speed = parseInt(element.dataset.speed) || 50;
        const randomDelay = element.dataset.random === 'true';
        
        element.textContent = '';
        element.style.borderRight = '2px solid currentColor';
        
        let i = 0;
        const typeChar = () => {
            if (i < text.length) {
                element.textContent += text.charAt(i);
                i++;
                const delay = randomDelay ? speed + Math.random() * 50 : speed;
                setTimeout(typeChar, delay);
            } else {
                // Remove cursor after completion
                setTimeout(() => {
                    element.style.borderRight = 'none';
                }, 1000);
            }
        };

        typeChar();
    }

    morphAnimation(element) {
        const shapes = element.dataset.shapes ? element.dataset.shapes.split(',') : ['circle', 'square', 'triangle'];
        let currentShape = 0;
        
        const morphNext = () => {
            element.className = element.className.replace(/shape-\w+/, '');
            element.classList.add(`shape-${shapes[currentShape]}`);
            currentShape = (currentShape + 1) % shapes.length;
        };
        
        const interval = parseInt(element.dataset.interval) || 2000;
        setInterval(morphNext, interval);
    }

    animateNumber(element) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const digits = entry.target.querySelectorAll('.digit');
                    digits.forEach((digit, index) => {
                        setTimeout(() => {
                            digit.style.animation = 'flipIn 0.6s ease-out';
                        }, index * 100);
                    });
                    observer.unobserve(entry.target);
                }
            });
        });
        
        observer.observe(element);
    }

    initTextReveal() {
        document.querySelectorAll('.text-reveal').forEach(element => {
            const text = element.textContent;
            const revealType = element.dataset.reveal || 'chars';
            
            if (revealType === 'chars') {
                element.innerHTML = text
                    .split('')
                    .map((char, index) => `<span class="char" style="animation-delay: ${index * 0.05}s">${char}</span>`)
                    .join('');
            } else if (revealType === 'words') {
                element.innerHTML = text
                    .split(' ')
                    .map((word, index) => `<span class="word" style="animation-delay: ${index * 0.1}s">${word}</span>`)
                    .join(' ');
            }

            this.observer.observe(element);
        });
    }

    initMouseParallax() {
        let mouseX = 0, mouseY = 0;
        let currentX = 0, currentY = 0;
        let isMoving = false;

        document.addEventListener('mousemove', (e) => {
            mouseX = (e.clientX - window.innerWidth / 2) / window.innerWidth;
            mouseY = (e.clientY - window.innerHeight / 2) / window.innerHeight;
            isMoving = true;
        });

        const updateParallax = () => {
            if (isMoving) {
                currentX += (mouseX - currentX) * 0.1;
                currentY += (mouseY - currentY) * 0.1;

                document.querySelectorAll('.mouse-parallax').forEach(element => {
                    const speed = parseFloat(element.dataset.speed) || 1;
                    const direction = element.dataset.direction || 'normal';
                    const multiplier = direction === 'reverse' ? -1 : 1;
                    
                    const x = currentX * 50 * speed * multiplier;
                    const y = currentY * 50 * speed * multiplier;
                    
                    element.style.transform = `translate3d(${x}px, ${y}px, 0)`;
                });

                // Reduce updates when mouse stops moving
                if (Math.abs(mouseX - currentX) < 0.001 && Math.abs(mouseY - currentY) < 0.001) {
                    isMoving = false;
                }
            }

            requestAnimationFrame(updateParallax);
        };

        updateParallax();
    }

    initFloatingElements() {
        document.querySelectorAll('.float-element').forEach(element => {
            const amplitude = parseFloat(element.dataset.amplitude) || 10;
            const speed = parseFloat(element.dataset.speed) || 1;
            const delay = parseFloat(element.dataset.delay) || 0;
            
            let startTime = performance.now() + (delay * 1000);
            
            const animate = (currentTime) => {
                if (currentTime >= startTime) {
                    const elapsed = (currentTime - startTime) * 0.001 * speed;
                    const y = Math.sin(elapsed) * amplitude;
                    element.style.transform = `translateY(${y}px)`;
                }
                requestAnimationFrame(animate);
            };
            
            requestAnimationFrame(animate);
        });
    }

    setupParallax() {
        let ticking = false;
        const parallaxElements = document.querySelectorAll('.parallax');
        
        if (parallaxElements.length === 0) return;

        const updateParallax = () => {
            const scrolled = window.pageYOffset;
            const windowHeight = window.innerHeight;

            parallaxElements.forEach(element => {
                const rect = element.getBoundingClientRect();
                const speed = parseFloat(element.dataset.speed) || 0.5;
                const direction = element.dataset.direction || 'up';
                
                // Only update elements in viewport for performance
                if (rect.bottom >= 0 && rect.top <= windowHeight) {
                    const yPos = direction === 'down' ? 
                        (scrolled * speed) : 
                        -(scrolled * speed);
                    
                    element.style.transform = `translate3d(0, ${yPos}px, 0)`;
                }
            });

            ticking = false;
        };

        const requestParallaxUpdate = () => {
            if (!ticking) {
                requestAnimationFrame(updateParallax);
                ticking = true;
            }
        };

        window.addEventListener('scroll', requestParallaxUpdate, { passive: true });
    }

    setupCursor() {
        if (window.innerWidth <= 768) return; // Skip on mobile devices

        const cursor = document.createElement('div');
        cursor.classList.add('custom-cursor');
        document.body.appendChild(cursor);

        const cursorDot = document.createElement('div');
        cursorDot.classList.add('cursor-dot');
        document.body.appendChild(cursorDot);

        let mouseX = 0, mouseY = 0;
        let cursorX = 0, cursorY = 0;

        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
        });

        const updateCursor = () => {
            cursorX += (mouseX - cursorX) * 0.15;
            cursorY += (mouseY - cursorY) * 0.15;

            cursor.style.left = cursorX + 'px';
            cursor.style.top = cursorY + 'px';
            
            cursorDot.style.left = mouseX + 'px';
            cursorDot.style.top = mouseY + 'px';

            requestAnimationFrame(updateCursor);
        };

        updateCursor();

        // Cursor interactions
        document.querySelectorAll('a, button, .clickable, .btn-modern').forEach(element => {
            element.addEventListener('mouseenter', () => {
                cursor.classList.add('cursor-hover');
                cursorDot.classList.add('cursor-hover');
            });

            element.addEventListener('mouseleave', () => {
                cursor.classList.remove('cursor-hover');
                cursorDot.classList.remove('cursor-hover');
            });
        });

        // Hide cursor when leaving window
        document.addEventListener('mouseleave', () => {
            cursor.style.opacity = '0';
            cursorDot.style.opacity = '0';
        });

        document.addEventListener('mouseenter', () => {
            cursor.style.opacity = '1';
            cursorDot.style.opacity = '1';
        });
    }

    setupPageTransitions() {
        const transitionOverlay = document.createElement('div');
        transitionOverlay.classList.add('page-transition');
        document.body.appendChild(transitionOverlay);

        // Intercept navigation
        document.querySelectorAll('a:not([href^="#"]):not([target="_blank"]):not([download])').forEach(link => {
            link.addEventListener('click', (e) => {
                const href = link.getAttribute('href');
                
                if (href && !href.startsWith('mailto:') && !href.startsWith('tel:') && !href.startsWith('javascript:')) {
                    e.preventDefault();
                    
                    transitionOverlay.classList.add('active');
                    
                    setTimeout(() => {
                        window.location.href = href;
                    }, 500);
                }
            });
        });

        // Remove transition on page load
        window.addEventListener('load', () => {
            setTimeout(() => {
                transitionOverlay.classList.remove('active');
            }, 100);
        });
    }

    setupScrollIndicator() {
        const indicator = document.createElement('div');
        indicator.classList.add('scroll-progress');
        document.body.appendChild(indicator);

        window.addEventListener('scroll', () => {
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            indicator.style.width = scrolled + '%';
        }, { passive: true });
    }

    setupBackToTop() {
        const backToTop = document.createElement('button');
        backToTop.classList.add('back-to-top');
        backToTop.innerHTML = '<i class="fas fa-arrow-up"></i>';
        backToTop.setAttribute('aria-label', 'Back to top');
        document.body.appendChild(backToTop);

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        }, { passive: true });

        backToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    initPerformanceMonitor() {
        // Reduce animations on low-end devices
        if (navigator.hardwareConcurrency && navigator.hardwareConcurrency <= 2) {
            document.documentElement.classList.add('reduced-motion');
        }

        // Pause animations when page is not visible
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                document.documentElement.classList.add('paused-animations');
            } else {
                document.documentElement.classList.remove('paused-animations');
            }
        });
    }
}

// Enhanced Magnetic buttons effect
class MagneticButtons {
    constructor() {
        this.buttons = document.querySelectorAll('.btn-magnetic, .btn-modern');
        this.init();
    }

    init() {
        this.buttons.forEach(button => {
            button.addEventListener('mouseenter', this.handleMouseEnter.bind(this));
            button.addEventListener('mousemove', this.handleMouseMove.bind(this));
            button.addEventListener('mouseleave', this.handleMouseLeave.bind(this));
        });
    }

    handleMouseEnter(e) {
        const button = e.currentTarget;
        button.style.transition = 'transform 0.1s ease-out';
    }

    handleMouseMove(e) {
        const button = e.currentTarget;
        const rect = button.getBoundingClientRect();
        const strength = parseFloat(button.dataset.magneticStrength) || 0.3;
        
        const x = ((e.clientX - rect.left - rect.width / 2) / rect.width) * 100 * strength;
        const y = ((e.clientY - rect.top - rect.height / 2) / rect.height) * 100 * strength;

        button.style.transform = `translate(${x}px, ${y}px)`;
    }

    handleMouseLeave(e) {
        const button = e.currentTarget;
        button.style.transition = 'transform 0.3s cubic-bezier(0.2, 0, 0.38, 0.9)';
        button.style.transform = 'translate(0px, 0px)';
    }
}

// Enhanced smooth scrollbar
class SmoothScrollbar {
    constructor() {
        this.scrollContainer = document.querySelector('.smooth-scroll');
        if (this.scrollContainer && !this.isMobile()) {
            this.init();
        }
    }

    isMobile() {
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    }

    init() {
        let currentScroll = 0;
        let targetScroll = 0;
        const ease = parseFloat(this.scrollContainer.dataset.ease) || 0.1;
        let isScrolling = false;

        const updateScroll = () => {
            targetScroll = window.pageYOffset;
            currentScroll += (targetScroll - currentScroll) * ease;
            
            // Only update if there's a noticeable difference
            if (Math.abs(targetScroll - currentScroll) > 0.1) {
                this.scrollContainer.style.transform = `translateY(${-currentScroll}px)`;
                isScrolling = true;
            } else {
                isScrolling = false;
            }
            
            requestAnimationFrame(updateScroll);
        };

        updateScroll();
    }
}

// Text scramble effect
class TextScramble {
    constructor(elements) {
        this.elements = typeof elements === 'string' ? document.querySelectorAll(elements) : elements;
        this.chars = '!<>-_\\/[]{}—=+*^?#________';
        this.init();
    }

    init() {
        this.elements.forEach(element => {
            const originalText = element.textContent;
            element.addEventListener('mouseenter', () => this.scramble(element, originalText));
        });
    }

    scramble(element, text) {
        let iteration = 0;
        const speed = element.dataset.scrambleSpeed || 30;
        
        const interval = setInterval(() => {
            element.textContent = text
                .split("")
                .map((char, index) => {
                    if (index < iteration) {
                        return text[index];
                    }
                    return this.chars[Math.floor(Math.random() * this.chars.length)];
                })
                .join("");
            
            if (iteration >= text.length) {
                clearInterval(interval);
            }
            
            iteration += 1 / 3;
        }, speed);
    }
}

// Particle system for backgrounds
class ParticleSystem {
    constructor(canvas) {
        this.canvas = canvas;
        this.ctx = canvas.getContext('2d');
        this.particles = [];
        this.particleCount = parseInt(canvas.dataset.count) || 50;
        this.init();
    }

    init() {
        this.resizeCanvas();
        this.createParticles();
        this.animate();
        
        window.addEventListener('resize', () => this.resizeCanvas());
    }

    resizeCanvas() {
        this.canvas.width = window.innerWidth;
        this.canvas.height = window.innerHeight;
    }

    createParticles() {
        for (let i = 0; i < this.particleCount; i++) {
            this.particles.push({
                x: Math.random() * this.canvas.width,
                y: Math.random() * this.canvas.height,
                vx: (Math.random() - 0.5) * 2,
                vy: (Math.random() - 0.5) * 2,
                size: Math.random() * 3 + 1,
                opacity: Math.random() * 0.5 + 0.2
            });
        }
    }

    animate() {
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        
        this.particles.forEach(particle => {
            particle.x += particle.vx;
            particle.y += particle.vy;
            
            // Wrap around edges
            if (particle.x < 0) particle.x = this.canvas.width;
            if (particle.x > this.canvas.width) particle.x = 0;
            if (particle.y < 0) particle.y = this.canvas.height;
            if (particle.y > this.canvas.height) particle.y = 0;
            
            // Draw particle
            this.ctx.beginPath();
            this.ctx.arc(particle.x, particle.y, particle.size, 0, Math.PI * 2);
            this.ctx.fillStyle = `rgba(255, 255, 255, ${particle.opacity})`;
            this.ctx.fill();
        });
        
        requestAnimationFrame(() => this.animate());
    }
}

// Initialize all animations when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Main scroll animations
    new ScrollAnimations();
    
    // Magnetic buttons
    new MagneticButtons();
    
    // Smooth scrollbar
    new SmoothScrollbar();
    
    // Text scramble effect
    if (document.querySelectorAll('.text-scramble').length > 0) {
        new TextScramble('.text-scramble');
    }
    
    // Initialize particle systems
    document.querySelectorAll('.particle-canvas').forEach(canvas => {
        new ParticleSystem(canvas);
    });
    
    // Lazy loading for performance
    if ('IntersectionObserver' in window) {
        const lazyImages = document.querySelectorAll('img[data-src]');
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        lazyImages.forEach(img => imageObserver.observe(img));
    }
});

// Expose classes globally for external use
window.ScrollAnimations = ScrollAnimations;
window.MagneticButtons = MagneticButtons;
window.SmoothScrollbar = SmoothScrollbar;
window.TextScramble = TextScramble;
window.ParticleSystem = ParticleSystem;