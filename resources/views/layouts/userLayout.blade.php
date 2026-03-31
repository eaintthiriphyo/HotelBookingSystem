<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Booking</title>

    <!-- Bootstrap & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
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
        }

        .navbar-custom .nav-link.active {
            background-color: #ff4500;
            color: white !important;
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

        .footer {
            background-color: navy;
            color: white;
            padding: 50px 0;
        }

        .footer a {
            color: white;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom mb-3 shadow-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('welcome') }}">
                               <img src="{{ asset('images/hotel-logo5.png') }}" alt="Hotel Logo" width="150px">

            </a>
            <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Left Links -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}"
                            href="{{ route('user.dashboard') }}">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.dashboard') }}#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.dashboard') }}#rooms">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.dashboard') }}#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.dashboard') }}#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.viewReview') ? 'active' : '' }}"
                            href="{{ route('user.viewReview') }}">Reviews</a>
                    </li>


                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('user.bookingRoom') ? 'active' : '' }}"
                                href="{{ route('user.bookingRoom') }}">Booking</a>
                        </li>
                    @endauth
                </ul>

                <!-- Right Auth -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        @if (Route::has('register'))
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                                data-bs-toggle="dropdown">
                                <img class="profile-img me-2 rounded-circle"
                                    src="{{ Auth::user()->image ? asset('images/user/' . Auth::user()->image) : asset('images/user/default.png') }}"
                                    width="35" height="30">
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                <li class="text-center p-3 border-bottom">
                                    <img class="rounded-circle mb-2"
                                        src="{{ Auth::user()->image ? asset('images/user/' . Auth::user()->image) : asset('images/user/default.png') }}"
                                        width="60">
                                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                                    <div class="text-muted small">{{ Auth::user()->email }}</div>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('user.viewProfile', Auth::user()->email) }}"><i
                                            class="fa fa-user me-2"></i>Profile</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('user.viewEditProfile', Auth::user()->email) }}"><i
                                            class="fa fa-edit me-2"></i>Edit Profile</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('user.viewChangePassword', Auth::user()->email) }}"><i
                                            class="fa fa-lock me-2"></i>Change Password</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out-alt me-2"></i>Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold">Hotel Paradise</h5>
                    <p>Your luxurious stay in the heart of the city. Comfort, elegance, and exceptional service.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold">Contact</h5>
                    <p><i class="fas fa-phone-alt me-2"></i>+95 123 456 789</p>
                    <p><i class="fas fa-envelope me-2"></i>info@hotelparadise.com</p>
                    <p><i class="fab fa-facebook me-2"></i>facebook.com/hotelparadise</p>
                    <p><i class="fab fa-instagram me-2"></i>@hotelparadise</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold">Quick Links</h5>
                    <a href="{{ route('welcome') }}">Home</a><br>
                    <a href="{{ route('welcome') }}#services">Services</a><br>
                    <a href="{{ route('viewReview') }}">Reviews</a><br>
                    <a href="{{ route('welcome') }}#contact">Contact</a>
                </div>
            </div>
            <hr class="bg-light">
            <div>&copy; {{ date('Y') }} Hotel Paradise. All rights reserved.</div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Scroll-based section highlighting
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
        const sections = document.querySelectorAll('section[id]');

        function setActiveLink() {
            let scrollPos = window.pageYOffset || document.documentElement.scrollTop;

            sections.forEach(section => {
                let top = section.offsetTop - 100;
                let bottom = top + section.offsetHeight;

                const id = section.getAttribute('id');
                if (scrollPos >= top && scrollPos < bottom) {
                    navLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href').includes('#' + id)) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        }

        window.addEventListener('scroll', setActiveLink);
        window.addEventListener('load', setActiveLink);
    </script>
</body>

</html>
