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
            background: rgba(0, 0, 0, 0.7);
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
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .hero-content {
            position: relative;
            z-index: 1;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .hero-content h1 {
            font-size: 3rem;
            font-weight: 700;
        }

        .hero-content p {
            font-size: 1.2rem;
            margin: 20px 0;
        }

        .search-bar {
            max-width: 500px;
            margin: auto;
        }

        .section-title {
            text-align: center;
            margin: 50px 0 30px;
            font-weight: 700;
        }

        .card-room img {
            height: 200px;
            object-fit: cover;
        }

        .services {
            background: #f7f7f7;
            padding: 50px 0;
        }

        .service-item {
            text-align: center;
            padding: 20px;
        }

        .service-item i {
            font-size: 40px;
            margin-bottom: 15px;
            color: #007bff;
        }

        .footer {
            background: #222;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        .btn-custom {
            border-radius: 30px;
            padding: 10px 25px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">🏨Paradise</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#rooms">Rooms</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('viewReview') }}">Reviews</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>

                <div>
                    @if (Route::has('login'))
                        @auth
                            @if (Auth::user()->status == 2)
                                <a href="{{ route('user.dashboard') }}" class="btn btn-primary btn-custom">Dashboard</a>
                            @else
                                <a href="{{ route('admin.viewDashboard') }}" class="btn btn-primary btn-custom">Admin</a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-light btn-custom me-2">Login</a>
                            @if (Route::has('register'))
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
    <section id="rooms" class="container">
        <h2 class="section-title">Featured Rooms</h2>
        <div class="row g-4">
            @foreach ($roomType as $rt)
                <div class="col-md-4">
                    <div class="card card-room">

                        <!-- Carousel -->
                        <div id="roomCarousel{{ $rt->id }}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @if ($rt->images->count() > 0)
                                    @foreach ($rt->images as $index => $img)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <img src="{{ asset('images/' . $img) }}" class="d-block w-100"
                                                style="height:250px; object-fit:cover;">
                                        </div>
                                    @endforeach
                                @else
                                    <div class="carousel-item active">
                                        <img src="https://via.placeholder.com/500x300" class="d-block w-100">
                                    </div>
                                @endif
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#roomCarousel{{ $rt->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#roomCarousel{{ $rt->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <h5 class="card-title">{{ $rt->room_type }}</h5>
                            <p>$ {{ $rt->price }}</p>
                            <p>{{ $rt->description }}</p>

                                <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Book Now</a>

                        </div>

                    </div>
                </div>
            @endforeach
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

    <!-- Contact Form -->
    <section id="contact" class="py-5">
        <div class="container">
            <h2 class="section-title text-center mb-4">Contact Us</h2>
            <div class="row justify-content-center">
                <div class="col-md-7">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card shadow border-0">
                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('contact.store') }}">
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
        </div>
    </section>

    <!-- Google Map -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-4">Our Location</h2>
            <div class="ratio ratio-16x9">
                <iframe src="https://www.google.com/maps/embed?pb=YOUR_FULL_EMBED_LINK_HERE"
                    style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="footer">
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
