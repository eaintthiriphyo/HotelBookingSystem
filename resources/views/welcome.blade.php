<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Hotel Booking</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body {
    font-family: 'Nunito', sans-serif;
    margin: 0;
    padding: 0;
}
.navbar-custom {
    background: rgba(0,0,0,0.7);
}
.navbar-custom .navbar-brand,
.navbar-custom .nav-link {
    color: white !important;
}
.hero-section {
    background: url('https://images.unsplash.com/photo-1566073771259-6a8506099945') no-repeat center center/cover;
    height: 90vh;
    position: relative;
    color: white;
}
.hero-section::before {
    content:'';
    position:absolute;
    top:0; left:0; width:100%; height:100%;
    background: rgba(0,0,0,0.5);
}
.hero-content {
    position: relative;
    z-index:1;
    height:100%;
    display:flex;
    flex-direction: column;
    justify-content:center;
    align-items:center;
    text-align:center;
}
.hero-content h1 {
    font-size: 3rem;
    font-weight:700;
}
.hero-content p {
    font-size: 1.2rem;
    margin:20px 0;
}
.search-bar {
    max-width:500px;
    margin:auto;
}
.section-title {
    text-align:center;
    margin:50px 0 30px;
    font-weight:700;
}
.card-room img {
    height:200px;
    object-fit:cover;
}
.services {
    background:#f7f7f7;
    padding:50px 0;
}
.service-item {
    text-align:center;
    padding:20px;
}
.service-item i {
    font-size:40px;
    margin-bottom:15px;
    color:#007bff;
}
.footer {
    background:#222;
    color:white;
    padding:20px 0;
    text-align:center;
}
.btn-custom {
    border-radius:30px;
    padding:10px 25px;
}
</style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom">
<div class="container">
<a class="navbar-brand" href="#">🏨 Hotel Booking</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav me-auto mb-2 mb-lg-0">
<li class="nav-item"><a class="nav-link" href="#">Home</a></li>
<li class="nav-item"><a class="nav-link" href="#rooms">Rooms</a></li>
<li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
<li class="nav-item"><a class="nav-link" href="{{route('viewReview')}}">Reviews</a></li>

</ul>

<div>
@if(Route::has('login'))
@auth
@if(Auth::user()->status==2)
<a href="{{ route('user.dashboard') }}" class="btn btn-primary btn-custom">Dashboard</a>
@else
<a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-custom">Admin</a>
@endif
@else
<a href="{{ route('login') }}" class="btn btn-outline-light btn-custom me-2">Login</a>
@if(Route::has('register'))
<a href="{{ route('register') }}" class="btn btn-light btn-custom">Register</a>
@endif
@endauth
@endif
</div>
</div>
</div>
</nav>

<!-- Hero Section -->
<section class="hero-section">
<div class="hero-content">
<h1>Find Your Perfect Hotel</h1>
<p>Book the best rooms at the best hotels</p>
<div class="search-bar">
<form class="d-flex">
<input class="form-control me-2" type="search" placeholder="Search hotel or room">
<button class="btn btn-success btn-custom" type="submit">Search</button>
</form>
</div>
</div>
</section>

<!-- Featured Rooms -->
<section id="rooms" class="container my-5">
<h2 class="section-title">Featured Rooms</h2>
<div class="row g-4">
<div class="col-md-4">
<div class="card card-room">
<img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c" class="card-img-top" alt="Room">
<div class="card-body">
<h5 class="card-title">Deluxe Room</h5>
<p class="card-text">$120/night - King Bed, Sea View</p>
<a href="#" class="btn btn-primary btn-sm">Book Now</a>
</div>
</div>
</div>
<div class="col-md-4">
<div class="card card-room">
<img src="https://images.unsplash.com/photo-1576671088290-6eac6d1a08c6" class="card-img-top" alt="Room">
<div class="card-body">
<h5 class="card-title">Standard Room</h5>
<p class="card-text">$90/night - Queen Bed, City View</p>
<a href="#" class="btn btn-primary btn-sm">Book Now</a>
</div>
</div>
</div>
<div class="col-md-4">
<div class="card card-room">
<img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2" class="card-img-top" alt="Room">
<div class="card-body">
<h5 class="card-title">Suite</h5>
<p class="card-text">$200/night - 2 Beds, Ocean View</p>
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
<div class="row g-4">
<div class="col-md-4">
<div class="service-item">
<i class="fa-solid fa-bed"></i>
<h5>Comfortable Rooms</h5>
<p>Luxury rooms with all modern facilities</p>
</div>
</div>
<div class="col-md-4">
<div class="service-item">
<i class="fa-solid fa-utensils"></i>
<h5>Restaurant</h5>
<p>Delicious cuisines and beverages</p>
</div>
</div>
<div class="col-md-4">
<div class="service-item">
<i class="fa-solid fa-spa"></i>
<h5>Spa & Wellness</h5>
<p>Relax and rejuvenate in our spa</p>
</div>
</div>
</div>
</div>
</section>

<!-- Footer -->
<footer class="footer" id="contact">
<p>© 2026 Hotel Booking. All rights reserved.</p>
<p>Follow us:
<a href="#" class="text-white me-2"><i class="fab fa-facebook"></i></a>
<a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
<a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
