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

@endsection
