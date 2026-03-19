<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Hotel Booking</title>

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar-custom {
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(6px);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-custom .nav-link {
            color: white !important;
            font-weight: 500;
            margin-right: 15px;
        }

        .navbar-custom .nav-link:hover {
            color: #ffc107 !important;
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            height: 90vh;
            background: url('https://images.unsplash.com/photo-1566073771259-6a8506099945') no-repeat center center/cover;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            top: 0;
            left: 0;
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            width: 100%;
            max-width: 700px;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 700;
        }

        .hero-content p {
            font-size: 1.3rem;
            margin: 20px 0;
        }

        .search-bar {
            max-width: 500px;
            margin: 20px auto 0;
        }

        .search-bar input {
            border-radius: 30px 0 0 30px;
        }

        .search-bar button {
            border-radius: 0 30px 30px 0;
        }

        /* Rooms & Services */
        .section-title {
            text-align: center;
            margin: 60px 0 40px;
            font-weight: 700;
        }

        .section-title:after {
            content: '';
            width: 80px;
            height: 3px;
            background: #0d6efd;
            display: block;
            margin: 10px auto;
        }

        .card-room {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: 0.3s;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .card-room img {
            height: 220px;
            object-fit: cover;
            transition: 0.4s;
        }

        .card-room:hover img {
            transform: scale(1.1);
        }

        .card-room:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .services {
            background: white;
            padding: 60px 0;
        }

        .service-item {
            text-align: center;
            padding: 30px;
            border-radius: 10px;
            transition: 0.3s;
        }

        .service-item i {
            font-size: 40px;
            color: #0d6efd;
            margin-bottom: 15px;
        }

        .service-item:hover {
            background: #f1f1f1;
            transform: translateY(-5px);
        }

        /* Footer */
        .footer {
            background: #111;
            color: #ccc;
            padding: 30px 0;
            text-align: center;
            margin-top: auto;
        }

        .footer a {
            color: white;
            margin: 0 10px;
        }

        .footer a:hover {
            color: #ffc107;
        }

        /* Profile Image */
        .profile-img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">🏨 Paradise</a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{route('user.dashboard')}}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#rooms">Rooms</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('viewReview')}}">Reviews</a></li>


                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    @endauth
                </ul>

                <!-- Auth User -->
                <ul class="navbar-nav ms-auto">
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <img class="profile-img me-2" src="{{ Auth::user()->image ? asset('images/user/' . Auth::user()->image) : asset('images/user/default.png') }}">
                            <span class="text-white">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li class="text-center p-3 border-bottom">
                                <img class="rounded-circle mb-2" src="{{ Auth::user()->image ? asset('images/user/' . Auth::user()->image) : asset('images/user/default.png') }}" width="60">
                                <div class="fw-bold">{{ Auth::user()->name }}</div>
                                <div class="text-muted small">{{ Auth::user()->email }}</div>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('user.viewProfile', Auth::user()->email) }}"><i class="fa fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('user.viewEditProfile', Auth::user()->email) }}"><i class="fa fa-edit me-2"></i>Edit Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('user.viewChangePassword', Auth::user()->email) }}"><i class="fa fa-lock me-2"></i>Change Password</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out-alt me-2"></i>Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
                            </li>
                        </ul>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="containe-fluidr">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer" id="contact">
        <p>© 2026 Hotel Booking. All rights reserved.</p>
        <p>
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>