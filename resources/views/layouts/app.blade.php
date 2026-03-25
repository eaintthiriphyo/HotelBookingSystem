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
    <nav class="navbar navbar-expand-lg navbar-custom  shadow-lg ">
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
                        <a class="nav-link {{ request()->is('*#about') ? 'active' : '' }}" href="{{ url('/#about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('*#rooms') ? 'active' : '' }}" href="{{ url('/#rooms') }}">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('*#services') ? 'active' : '' }}"
                            href="{{ url('/#services') }}">Services</a>
                    </li>
                       <li class="nav-item">
                        <a class="nav-link {{ request()->is('*#contact') ? 'active' : '' }}" href="{{ url('/#contact') }}">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('reviews') ? 'active' : '' }}"
                            href="{{ route('viewReview') }}">
                            Reviews
                        </a>
                    </li>

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



    <main class="py-3">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class=" text-white py-5" style="background-color: navy ;">
        <div class="container text-center">
            <div class="row mt-5">

                <!-- About / Hotel Name -->
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3" style="font-size: 1.3rem;">Hotel Paradise</h5>
                    <p style="font-size: 0.95rem; line-height: 1.6;">
                        Your luxurious stay in the heart of the city. Experience comfort, elegance, and exceptional
                        service at our hotel.
                    </p>
                </div>

                <!-- Contact Info -->
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3" style="font-size: 1.3rem;">Contact</h5>
                    <ul class="list-unstyled" style="font-size: 0.95rem; line-height: 2;">
                        <li><i class="fas fa-phone-alt me-2"></i> +95 123 456 789</li>
                        <li><i class="fas fa-envelope me-2"></i> info@hotelparadise.com</li>
                        <li><i class="fab fa-facebook me-2"></i> facebook.com/hotelparadise</li>
                        <li><i class="fab fa-instagram me-2"></i> @hotelparadise</li>
                    </ul>
                </div>

                <!-- Quick Links -->
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3" style="font-size: 1.3rem;">Quick Links</h5>
                    <ul class="list-unstyled" style="font-size: 0.95rem; line-height: 2;">
                        <li><a href="{{ route('welcome') }}"
                                class="text-white text-decoration-none hover-underline">Home</a></li>
                        <li><a href="#service" class="text-white text-decoration-none hover-underline">Services</a></li>
                        <li><a href="" class="text-white text-decoration-none hover-underline">Reviews</a></li>
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Select all navbar links
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

        // Add click event to each link
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Remove active from all links
                navLinks.forEach(l => l.classList.remove('active'));
                // Add active to the clicked link
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
