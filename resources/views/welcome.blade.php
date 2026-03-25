<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paradise Hotel Booking</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.6;
        }

        .navbar-custom {
            background: navy;
            border-bottom: 10px solid navy;
            position: sticky;
            top: 0;
            z-index: 1000;
        }



        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: white !important;
            border-radius: 5px;
            padding: 5px 10px;
            text-decoration: none;
        }

        .navbar-custom .nav-link:hover {
            background-color: white;
            color: navy !important;
            border-radius: 5px;
            padding: 5px 10px;
        }

        /* Active link */
        .navbar-custom .nav-link.active {
            background-color: #ff4500;
            /* highlight active page */
            color: white !important;
            border-radius: 5px;
        }

        .hero-section {

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

        .section-title {
            text-align: center;
            margin: 50px 0 30px;
            font-weight: 700;
        }

        .card-room img {
            height: 200px;
            object-fit: cover;
        }

        .about-section img {
            max-width: 100%;
            border-radius: 15px;
        }

        .services .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .services .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-custom {
            border-radius: 10px;
            padding: 5px 15px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom mb-3 shadow-lg ">
        <div class="container pt-3">
            <a class="navbar-brand" href="{{ route('welcome') }}">
                <h4>Paradise</h4>
                <p>Luxury Hotel</p>
            </a>
            <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('*#about') ? 'active' : '' }}" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('*#rooms') ? 'active' : '' }}" href="#rooms">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('*#services') ? 'active' : '' }}"
                            href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('*#contact') ? 'active' : '' }}" href="#contact">Contact</a>
                    </li>
                                        <li class="nav-item"><a class="nav-link" href="{{ route('viewReview') }}">Reviews</a></li>

                </ul>

                <div>
                    @if (Route::has('login'))
                        @auth
                            @if (Auth::user()->status == 2 && (Auth::user()->role = 'user'))
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
    <div class="container">
        <section class="hero-section"
            style="background-image: url('{{ asset('images/banner.jpg') }}');
           background-size: cover;
           background-position: center;
           background-repeat: no-repeat;">

            <div class="hero-content">
                <h1>Find Your Perfect Room</h1>
                <p>Book the best rooms</p>
            </div>

        </section>
    </div>
    <!-- About Us -->
    <section id="about" class="about-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <!-- Image Column -->
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="{{ asset('images/about2.jpg') }}" alt="Hotel Paradise" class="img-fluid rounded shadow">
                </div>
                <!-- Text Column -->
                <div class="col-md-6">
                    <h2 class="mb-4 fw-bold">About Us</h2>
                    <p>
                        Welcome to <strong>Hotel Paradise</strong>! We offer luxurious rooms, exquisite dining,
                        and world-class service to make your stay unforgettable.
                        Located in the heart of the city, we provide comfort, elegance, and a perfect getaway
                        for travelers and families alike.
                    </p>
                    <p>
                        Experience our modern amenities, relaxing spa, fine dining, and personalized services
                        designed to create memorable moments.
                    </p>
                    <a href="#rooms" class="btn  btn-custom mt-3"  style="background-color:orangered;color:white">Explore Rooms</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Rooms -->
    <section id="rooms" class="container my-3">
        <h1 class="section-title">Featured Rooms</h1>
        <div class="row g-4">
            @foreach ($roomType as $rt)
                <div class="col-md-4">
                    <div class="card card-room">
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

                        <div class="card-body">
                            <h5 class="card-title">{{ $rt->room_type }}</h5>
                            <p>$ {{ $rt->price }}</p>
                            <p>{{ $rt->description }}</p>
                            <a href="{{ route('login') }}" class="btn " style="background-color:orangered;color:white">Book Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>


    <!-- Services -->
    <section id="services" class="services py-5">
        <div class="container">
            <h1 class="section-title mb-5">Our Services</h1>

            <div class="row g-4">

                <!-- Service 1 -->
                <div class="col-md-3 col-sm-6">
                    <div class="card shadow-lg h-100 text-center shadow-sm border-0">
                        <div class="card-body">
                            <i class="fa-solid fa-bed fa-3x mb-3 " style="color: navy"></i>
                            <h5 class="card-title">Comfortable Rooms</h5>
                            <p class="card-text">Luxury rooms with modern facilities.</p>
                        </div>
                    </div>
                </div>

                <!-- Service 2 -->
                <div class="col-md-3 col-sm-6">
                    <div class="card shadow-lg  h-100 text-center shadow-sm border-0">
                        <div class="card-body">
                            <i class="fa-solid fa-utensils fa-3x mb-3 " style="color: navy"></i>
                            <h5 class="card-title">Restaurant</h5>
                            <p class="card-text">Enjoy delicious food and drinks.</p>
                        </div>
                    </div>
                </div>

                <!-- Service 3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="card shadow-lg  h-100 text-center shadow-sm border-0">
                        <div class="card-body">
                            <i class="fa-solid fa-spa fa-3x mb-3 " style="color: navy"></i>
                            <h5 class="card-title">Spa & Wellness</h5>
                            <p class="card-text">Relax and refresh your mind.</p>
                        </div>
                    </div>
                </div>

                <!-- Service 4 -->
                <div class="col-md-3 col-sm-6">
                    <div class="card shadow-lg  h-100 text-center shadow-sm border-0">
                        <div class="card-body">
                            <i class="fa-solid fa-wifi fa-3x mb-3 " style="color: navy"></i>
                            <h5 class="card-title">Free Wi-Fi</h5>
                            <p class="card-text">Stay connected during your stay.</p>
                        </div>
                    </div>
                </div>

                <!-- Service 5 -->
                <div class="col-md-3 col-sm-6">
                    <div class="card shadow-lg  h-100 text-center shadow-sm border-0">
                        <div class="card-body">
                            <i class="fa-solid fa-bus fa-3x mb-3 " style="color: navy"></i>
                            <h5 class="card-title">Airport Shuttle</h5>
                            <p class="card-text">Convenient transfers to/from airport.</p>
                        </div>
                    </div>
                </div>

                <!-- Service 6 -->
                <div class="col-md-3 col-sm-6">
                    <div class="card shadow-lg  h-100 text-center shadow-sm border-0">
                        <div class="card-body">
                            <i class="fa-solid fa-car fa-3x mb-3 " style="color: navy"></i>
                            <h5 class="card-title">Parking</h5>
                            <p class="card-text">Secure parking for guests.</p>
                        </div>
                    </div>
                </div>

                <!-- Service 7 -->
                <div class="col-md-3 col-sm-6">
                    <div class="card shadow-lg  h-100 text-center shadow-sm border-0">
                        <div class="card-body">
                            <i class="fa-solid fa-dumbbell fa-3x mb-3 " style="color: navy"></i>
                            <h5 class="card-title">Gym</h5>
                            <p class="card-text">Modern fitness center for all guests.</p>
                        </div>
                    </div>
                </div>

                <!-- Service 8 -->
                <div class="col-md-3 col-sm-6">
                    <div class="card shadow-lg  h-100 text-center shadow-sm border-0">
                        <div class="card-body">
                            <i class="fa-solid fa-cocktail fa-3x mb-3" style="color: navy"></i>
                            <h5 class="card-title">Bar & Lounge</h5>
                            <p class="card-text">Relax with cocktails and beverages.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Contact Form -->
    <section id="contact" class="py-5">
        <div class="container">
            <h1 class="section-title text-center mb-4">Contact Us</h1>
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
                                    <input type="text" name="name" class="form-control" >
                                   @error('name')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" >
                                    @error('email')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                    <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control" >
                                    @error('phone')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Message</label>
                                    <textarea name="message" class="form-control" rows="4" ></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn px-4" style="background-color:orangered;color:white">Send Message</button>
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
        <div class="container col-8 mx-auto">
            <h1 class="section-title text-center mb-4">Our Location</h1>
            <div class="ratio ratio-16x9">
                <iframe src="https://www.google.com/maps/embed?pb=YOUR_FULL_EMBED_LINK_HERE" style="border:0;"
                    allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-white py-5" style="background-color: navy; margin-top:150px;">
        <div class="container text-center">
            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3" style="font-size: 1.3rem;">Hotel Paradise</h5>
                    <p style="font-size: 0.95rem; line-height: 1.6;">
                        Your luxurious stay in the heart of the city. Experience comfort, elegance, and exceptional
                        service at our hotel.
                    </p>
                </div>

                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3" style="font-size: 1.3rem;">Contact</h5>
                    <ul class="list-unstyled" style="font-size: 0.95rem; line-height: 2;">
                        <li><i class="fas fa-phone-alt me-2"></i> +95 123 456 789</li>
                        <li><i class="fas fa-envelope me-2"></i> info@hotelparadise.com</li>
                        <li><i class="fab fa-facebook me-2"></i> facebook.com/hotelparadise</li>
                        <li><i class="fab fa-instagram me-2"></i> @hotelparadise</li>
                    </ul>
                </div>

                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3" style="font-size: 1.3rem;">Quick Links</h5>
                    <ul class="list-unstyled" style="font-size: 0.95rem; line-height: 2;">
                        <li><a href="#" class="text-white text-decoration-none hover-underline">Home</a></li>
                        <li><a href="#" class="text-white text-decoration-none hover-underline">Services</a>
                        </li>
                        <li><a href="#" class="text-white text-decoration-none hover-underline">Reviews</a></li>
                        <li><a href="#" class="text-white text-decoration-none hover-underline">Email &
                                Address</a></li>
                    </ul>
                </div>
            </div>

            <hr class="bg-light">

            <div class="text-center" style="font-size: 0.9rem;">
                <span>&copy; {{ date('Y') }} Hotel Paradise. All rights reserved.</span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Select all navbar links
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

    navLinks.forEach(link => {
        link.addEventListener('click', function () {
            // Remove active from all links
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Optional: Highlight based on scroll
    const sections = document.querySelectorAll('section');
    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop - 80;
            if (pageYOffset >= sectionTop) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === '#' + current) {
                link.classList.add('active');
            }
        });
    });
</script>
</body>

</html>
