@extends('layouts.userLayout')

@section('content')

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <h1>Find Your Perfect Hotel</h1>
        <p>Book the best rooms at the best hotels</p>
        <div class="search-bar">
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search hotel or room">
                <button class="btn btn-success btn-custom">Search</button>
            </form>
        </div>
    </div>
</section>

<!-- Rooms -->
<section id="rooms" class="container">
    <h2 class="section-title">Featured Rooms</h2>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card card-room">
                <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Deluxe Room</h5>
                    <p>$120 / Night</p>
                    <a href="#" class="btn btn-primary btn-sm">Book Now</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-room">
                <img src="https://images.unsplash.com/photo-1576671088290-6eac6d1a08c6" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Standard Room</h5>
                    <p>$90 / Night</p>
                    <a href="#" class="btn btn-primary btn-sm">Book Now</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-room">
                <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Suite Room</h5>
                    <p>$200 / Night</p>
                    <a href="#" class="btn btn-primary btn-sm">Book Now</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services -->
<section id="services" class="services">
    <div class="container">
        <h2 class="section-title">Our Services</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="service-item">
                    <i class="fa-solid fa-bed"></i>
                    <h5>Comfortable Rooms</h5>
                    <p>Luxury rooms with modern facilities.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-item">
                    <i class="fa-solid fa-utensils"></i>
                    <h5>Restaurant</h5>
                    <p>Enjoy delicious food and drinks.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-item">
                    <i class="fa-solid fa-spa"></i>
                    <h5>Spa & Wellness</h5>
                    <p>Relax and refresh your mind.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Contact Us Form -->
<section id="contact" class="py-5">
<div class="container">
<h2 class="section-title text-center mb-4">Contact Us</h2>
<div class="row justify-content-center">
<div class="col-md-7">

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow border-0">
<div class="card-body p-4">

<form method="POST" action="">
@csrf
<div class="mb-3">
<label class="form-label">Full Name</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Subject</label>
<input type="text" name="subject" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Message</label>
<textarea name="message" class="form-control" rows="4" required></textarea>
</div>

<div class="text-center">
<button type="submit" class="btn btn-primary px-4">Send Message</button>
</div>
</form>

</div>
</div>
</div>
</div>
</section>

<!-- Google Map -->
<section class="py-5 bg-light">
<div class="container">
<h2 class="section-title text-center mb-4">Our Location</h2>
<div class="ratio ratio-16x9">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!..." style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</div>
</div>
</section>
@endsection
