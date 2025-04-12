// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS (Animate On Scroll)
    AOS.init({
      duration: 1000,
      once: true,
      offset: 100,
      easing: 'ease-out-cubic'
    });
    
    // Initialize portfolio filtering with Isotope
    let portfolioGrid = document.querySelector('.portfolio-grid');
    let iso;
    
    if (portfolioGrid) {
      // Initialize Isotope after images are loaded
      imagesLoaded(portfolioGrid, function() {
        iso = new Isotope(portfolioGrid, {
          itemSelector: '.portfolio-item',
          layoutMode: 'fitRows'
        });
        
        // Filter items on button click
        document.querySelectorAll('.filter-btn').forEach(function(btn) {
          btn.addEventListener('click', function() {
            let filterValue = this.getAttribute('data-filter');
            
            // Remove active class from all buttons
            document.querySelectorAll('.filter-btn').forEach(function(btn) {
              btn.classList.remove('active');
            });
            
            // Add active class to current button
            this.classList.add('active');
            
            // Filter items
            iso.arrange({
              filter: filterValue === '*' ? null : filterValue
            });
          });
        });
      });
    }
    
    // Initialize testimonial slider with Slick
    $('.testimonial-slider').slick({
      infinite: true,
      slidesToShow: 2,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 5000,
      dots: true,
      arrows: false,
      responsive: [
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 1
          }
        }
      ]
    });
    
    // Initialize Magnific Popup for portfolio items
    $('.portfolio-zoom').magnificPopup({
      type: 'image',
      gallery: {
        enabled: true
      },
      zoom: {
        enabled: true,
        duration: 300,
        easing: 'ease-in-out'
      }
    });
    
    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        e.preventDefault();
        
        let target = document.querySelector(this.getAttribute('href'));
        if (target) {
          window.scrollTo({
            top: target.offsetTop - 70,
            behavior: 'smooth'
          });
        }
      });
    });
    
    // Show/hide scroll to top button
    window.addEventListener('scroll', function() {
      let scrollToTop = document.querySelector('.scroll-to-top');
      if (scrollToTop) {
        if (window.pageYOffset > 300) {
          scrollToTop.classList.add('show');
        } else {
          scrollToTop.classList.remove('show');
        }
      }
    });
    
    // Animate skill bars when they come into view
    let skillBars = document.querySelectorAll('.skill-progress');
    
    const animateSkillBars = () => {
      skillBars.forEach(bar => {
        let rect = bar.getBoundingClientRect();
        let windowHeight = window.innerHeight || document.documentElement.clientHeight;
        
        if (rect.top <= windowHeight && rect.bottom >= 0 && !bar.classList.contains('animated')) {
          let width = bar.getAttribute('style').match(/width:\s*(\d+)%/)[1];
          bar.style.width = '0%';
          
          setTimeout(() => {
            bar.style.width = width + '%';
            bar.classList.add('animated');
          }, 100);
        }
      });
    };
    
    // Initial check for skill bars
    animateSkillBars();
    
    // Check again on scroll
    window.addEventListener('scroll', animateSkillBars);
    
    // Form validation and submission
    let contactForm = document.getElementById('contactForm');
    
    if (contactForm) {
      contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form values
        let name = document.getElementById('name').value;
        let email = document.getElementById('email').value;
        let subject = document.getElementById('subject').value;
        let message = document.getElementById('message').value;
        
        // Basic validation
        if (!name || !email || !subject || !message) {
          // Show error message
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please fill in all required fields!',
          });
          return;
        }
        
        // Email validation
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please enter a valid email address!',
          });
          return;
        }
        
        // Show loading state
        let submitBtn = contactForm.querySelector('button[type="submit"]');
        let originalBtnText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
        submitBtn.disabled = true;
        
        // Simulate form submission (replace with actual AJAX call)
        setTimeout(function() {
          // Reset form
          contactForm.reset();
          
          // Reset button
          submitBtn.innerHTML = originalBtnText;
          submitBtn.disabled = false;
          
          // Show success message
          Swal.fire({
            icon: 'success',
            title: 'Message Sent!',
            text: 'Thank you for contacting me. I will get back to you soon!',
          });
        }, 2000);
      });
    }
    
    // Add sticky header on scroll
    let header = document.querySelector('header');
    
    if (header) {
      window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
          header.classList.add('sticky');
        } else {
          header.classList.remove('sticky');
        }
      });
    }
    
    // Mobile menu toggle
    let menuToggle = document.querySelector('.menu-toggle');
    let navMenu = document.querySelector('.navbar-collapse');
    
    if (menuToggle) {
      menuToggle.addEventListener('click', function() {
        menuToggle.classList.toggle('active');
        navMenu.classList.toggle('show');
      });
      
      // Close menu when clicking outside
      document.addEventListener('click', function(e) {
        if (!menuToggle.contains(e.target) && !navMenu.contains(e.target)) {
          menuToggle.classList.remove('active');
          navMenu.classList.remove('show');
        }
      });
      
      // Close menu when clicking on nav links
      document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function() {
          menuToggle.classList.remove('active');
          navMenu.classList.remove('show');
        });
      });
    }
  });

  document.addEventListener("DOMContentLoaded", function() {
    // Get the subtitle element
    const subtitleElement = document.querySelector(".hero-subtitle");
    
    // Store the original text structure
    const baseText = "Website Designer, Software Developer, Graphic Designer, Music Producer";
    
    // Break into individual roles
    const roles = [
        "Website Designer",
        "Software Developer",
        "Graphic Designer",
        "Music Producer"
    ];
    
    // Variables to control the typing effect
    let roleIndex = 0;
    let isDeleting = false;
    let text = '';
    let charIndex = 0;
    let typingSpeed = 100; // milliseconds per character when typing
    let deletingSpeed = 50; // milliseconds per character when deleting
    let pauseTime = 1500; // pause time after typing a full role
    
    function typeEffect() {
        // Get the current role
        const currentRole = roles[roleIndex];
        
        // Check if we're deleting or typing
        if(isDeleting) {
            // Remove a character
            text = currentRole.substring(0, charIndex - 1);
            charIndex--;
            typingSpeed = deletingSpeed;
        } else {
            // Add a character
            text = currentRole.substring(0, charIndex + 1);
            charIndex++;
            typingSpeed = 100;
        }
        
        // Update the display text
        subtitleElement.textContent = text;
        
        // Determine next action
        if(!isDeleting && charIndex === currentRole.length) {
            // Finished typing current role, pause then start deleting
            isDeleting = true;
            typingSpeed = pauseTime;
        } else if(isDeleting && charIndex === 0) {
            // Finished deleting, move to next role
            isDeleting = false;
            roleIndex = (roleIndex + 1) % roles.length;
        }
        
        // Schedule the next update
        setTimeout(typeEffect, typingSpeed);
    }
    
    // Start the typing effect
    typeEffect();
});

document.addEventListener("DOMContentLoaded", function () {
  var swiper = new Swiper(".swiper-container", {
      loop: true,
      spaceBetween: 20,
      slidesPerView: 1,
      autoplay: {
          delay: 5000,
          disableOnInteraction: false,
      },
      pagination: {
          el: ".swiper-pagination",
          clickable: true,
      },
      navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
      },
  });
});