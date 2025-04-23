@extends('layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Contact Me',
        'breadcrumbs' => [
            ['name' => 'Contact', 'url' => route('contact')],
        ]
    ])

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="contact-info mb-4">
                    <h2 class="text-center mb-3 text-white">Get in Touch</h2>
                    <p class="text-center text-white">I'd love to hear from you. Please fill out the form below, and I'll get back to you as soon as possible.</p>
                    
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
                    <h3 class="mb-3"> Location</h3>
                    <!-- Google Map Embed -->
                    <div class="embed-responsive embed-responsive-16by9 mb-4">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3476.750137157566!2d27.550330300000002!3d-29.3776044!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1e8c4b84d8424af3%3A0xdc887001ca323b8d!2sGraphics%20by%20Slkstr.!5e0!3m2!1sen!2sls!4v1745340306415!5m2!1sen!2sls" width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                                        </div>
                    
                    <h4>Contact Details</h4>
                    <p><strong>Phone:</strong> (+266) 6823 1628</p>
                    <p><strong>Email:</strong> hello@tokelofoso.online</p>
                    <p><strong>Address:</strong> Ha Matala Phase 2, Maseru Lesotho</p>
                </div>
            </div>
        </div>
    </div>
@endsection
