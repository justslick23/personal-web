@extends('layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Contact Us',
        'breadcrumbs' => [
            ['name' => 'Contact', 'url' => route('contact')],
        ]
    ])

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="contact-info mb-4">
                    <h2 class="text-center mb-3 text-white">Get in Touch</h2>
                    <p class="text-center text-white">We’d love to hear from you. Please fill out the form below, and we’ll get back to you as soon as possible.</p>
                    
                    <!-- Contact Form -->
                    <form action="#" method="POST" class="shadow p-4 bg-dark text-white rounded">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Full Name</label>
                                <input type="text" class="form-control bg-secondary text-white" id="name" name="name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control bg-secondary text-white" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message">Your Message</label>
                            <textarea class="form-control bg-secondary text-white" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary px-5">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="location-info shadow p-4 bg-dark text-white rounded">
                    <h3 class="mb-3">Our Location</h3>
                    <!-- Google Map Embed -->
                    <div class="embed-responsive embed-responsive-16by9 mb-4">
                        <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.4564593178966!2d144.95373631521857!3d-37.81362797975148!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d5d0e3a68f5%3A0xbfa2387e4b3b36b!2sFederation%20Square!5e0!3m2!1sen!2sus!4v1617804855028!5m2!1sen!2sus" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    
                    <h4>Contact Details</h4>
                    <p><strong>Phone:</strong> +123 456 789</p>
                    <p><strong>Email:</strong> contact@yourdomain.com</p>
                    <p><strong>Address:</strong> 123 Main Street, City, Country</p>
                </div>
            </div>
        </div>
    </div>
@endsection
