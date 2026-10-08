<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Paradise Hotel Booking</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet">

    <style>

        /* =====================================================
           GLOBAL
        ===================================================== */

        :root {
            --primary: #0b1f33;
            --primary-light: #163a5c;
            --accent: #c8a45d;
            --background: #f7f7f5;
            --white: #ffffff;
            --text: #1d2733;
            --muted: #737b85;
            --border: #e7e7e4;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            padding: 0;
            background: #ffffff;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            line-height: 1.6;
        }


        /* =====================================================
           NAVBAR
        ===================================================== */

        .navbar-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1050;
            padding: 20px 25px;
            background: transparent;
        }

        .navbar-custom {
            max-width: 1200px;
            margin: 0 auto;

            background: rgba(255, 255, 255, 0.97);

            border-radius: 18px;

            padding: 10px 22px;

            box-shadow:
                0 8px 30px rgba(11, 31, 51, 0.10);

            border: 1px solid rgba(231, 231, 228, 0.9);
        }


        /* =====================================================
           BRAND
        ===================================================== */

        .navbar-custom .navbar-brand {
            color: var(--primary) !important;

            font-family: 'Playfair Display', serif;

            font-size: 1.65rem;

            font-weight: 600;

            letter-spacing: 0.5px;

            text-decoration: none;

            display: flex;

            align-items: center;

            white-space: nowrap;
        }

        .hotel-brand span {
            color: var(--accent);

            font-size: 1.9rem;
        }


        /* =====================================================
           NAVIGATION LINKS
        ===================================================== */

        .navbar-custom .navbar-nav {
            gap: 5px;
        }

        .navbar-custom .nav-link {
            color: var(--primary) !important;

            font-size: 0.95rem;

            font-weight: 500;

            padding: 9px 15px !important;

            border-radius: 8px;

            transition: all 0.25s ease;
        }

        .navbar-custom .nav-link:hover {
            background: #f3f5f6;

            color: var(--primary-light) !important;
        }

        .navbar-custom .nav-link.active {
            background: var(--primary);

            color: var(--white) !important;
        }


        /* =====================================================
           AUTHENTICATION BUTTONS
        ===================================================== */

        .navbar-auth {
            white-space: nowrap;
        }

        .btn-hotel {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            border-radius: 8px;

            padding: 9px 19px;

            font-size: 0.9rem;

            font-weight: 600;

            text-decoration: none;

            transition: all 0.25s ease;
        }


        /* Login */

        .btn-login {
            color: var(--primary);

            background: transparent;

            border: 1px solid var(--primary);
        }

        .btn-login:hover {
            background: var(--primary);

            color: var(--white);
        }


        /* Register / Dashboard / Admin */

        .btn-register,
        .btn-dashboard {
            background: var(--primary);

            color: var(--white);

            border: 1px solid var(--primary);
        }

        .btn-register:hover,
        .btn-dashboard:hover {
            background: var(--primary-light);

            color: var(--white);

            border-color: var(--primary-light);

            transform: translateY(-1px);
        }


        /* =====================================================
           MAIN CONTENT
        ===================================================== */

        main {
            min-height: calc(100vh - 100px);
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        .hotel-footer {
            background: var(--primary);

            color: rgba(255, 255, 255, 0.85);

            margin-top: 70px;

            padding: 60px 0 25px;
        }


        /* Footer title */

        .footer-title {
            color: var(--white);

            font-family: 'Playfair Display', serif;

            font-size: 1.4rem;

            font-weight: 600;

            margin-bottom: 18px;
        }


        /* Footer paragraph */

        .footer-text {
            color: rgba(255, 255, 255, 0.72);

            font-size: 0.92rem;

            line-height: 1.8;

            max-width: 380px;
        }


        /* Footer links */

        .footer-links {
            list-style: none;

            padding: 0;

            margin: 0;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.78);

            text-decoration: none;

            font-size: 0.92rem;

            transition: all 0.2s ease;
        }

        .footer-links a:hover {
            color: var(--accent);

            padding-left: 4px;
        }


        /* Footer contact */

        .footer-contact {
            list-style: none;

            padding: 0;

            margin: 0;
        }

        .footer-contact li {
            margin-bottom: 12px;

            color: rgba(255, 255, 255, 0.78);

            font-size: 0.92rem;
        }

        .footer-contact i {
            width: 22px;

            color: var(--accent);
        }


        /* =====================================================
           SOCIAL ICONS
        ===================================================== */

        .footer-social {
            display: flex;

            gap: 10px;

            margin-top: 18px;
        }

        .footer-social a {
            width: 38px;

            height: 38px;

            display: flex;

            align-items: center;

            justify-content: center;

            border: 1px solid rgba(255, 255, 255, 0.25);

            border-radius: 50%;

            color: white;

            text-decoration: none;

            transition: all 0.25s ease;
        }

        .footer-social a:hover {
            background: var(--accent);

            border-color: var(--accent);

            color: var(--primary);

            transform: translateY(-2px);
        }


        /* =====================================================
           FOOTER DIVIDER
        ===================================================== */

        .footer-divider {
            border-color: rgba(255, 255, 255, 0.15);

            margin: 35px 0 20px;
        }

        .copyright {
            color: rgba(255, 255, 255, 0.55);

            font-size: 0.85rem;

            text-align: center;
        }


        /* =====================================================
           MOBILE NAVBAR
        ===================================================== */

        .navbar-toggler {
            border: 1px solid var(--border);

            border-radius: 8px;

            padding: 7px 10px;

            background: white;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%230b1f33' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }


        /* =====================================================
           TABLET
        ===================================================== */

        @media (max-width: 991px) {

            .navbar-wrapper {
                padding: 12px;
            }

            .navbar-custom {
                padding: 10px 15px;

                border-radius: 15px;
            }

            .navbar-custom .navbar-nav {
                margin-top: 15px;

                gap: 2px;
            }

            .navbar-custom .nav-link {
                padding: 10px 12px !important;
            }

            .navbar-auth {
                margin-top: 15px;

                padding-top: 15px;

                border-top: 1px solid var(--border);

                width: 100%;
            }

            .navbar-auth .btn-hotel {
                margin-bottom: 5px;
            }

        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 575px) {

            .navbar-wrapper {
                padding: 8px;
            }

            .navbar-custom {
                padding: 8px 12px;

                border-radius: 14px;
            }

            .navbar-custom .navbar-brand {
                font-size: 1.4rem;
            }

            .hotel-brand span {
                font-size: 1.6rem;
            }

            .hotel-footer {
                padding: 45px 0 20px;
            }

        }

    </style>
</head>


<body>


    <!-- =====================================================
         NAVBAR
    ====================================================== -->

    <div class="navbar-wrapper">

        <nav class="navbar navbar-expand-lg navbar-custom">

            <div class="container-fluid">


                <!-- =========================================
                     HOTEL BRAND
                ========================================== -->

                <a class="navbar-brand hotel-brand"
                    href="{{ route('welcome') }}">

                    Paradise<span>.</span>

                </a>


                <!-- =========================================
                     MOBILE MENU BUTTON
                ========================================== -->

                <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation">

                    <span class="navbar-toggler-icon"></span>

                </button>


                <!-- =========================================
                     NAVIGATION
                ========================================== -->

                <div class="collapse navbar-collapse"
                    id="navbarNav">


                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                        <!-- Home -->

                        <li class="nav-item">

                            <a class="nav-link
                                {{ request()->is('/') ? 'active' : '' }}"
                                href="{{ url('/') }}">

                                Home

                            </a>

                        </li>


                        <!-- About -->

                        <li class="nav-item">

                            <a class="nav-link
                                {{ request()->is('*#about') ? 'active' : '' }}"
                                href="{{ url('/#about') }}">

                                About

                            </a>

                        </li>


                        <!-- Rooms -->

                        <li class="nav-item">

                            <a class="nav-link
                                {{ request()->is('*#rooms') ? 'active' : '' }}"
                                href="{{ url('/#rooms') }}">

                                Rooms

                            </a>

                        </li>


                        <!-- Services -->

                        <li class="nav-item">

                            <a class="nav-link
                                {{ request()->is('*#services') ? 'active' : '' }}"
                                href="{{ url('/#services') }}">

                                Services

                            </a>

                        </li>


                        <!-- Contact -->

                        <li class="nav-item">

                            <a class="nav-link
                                {{ request()->is('*#contact') ? 'active' : '' }}"
                                href="{{ url('/#contact') }}">

                                Contact

                            </a>

                        </li>


                        <!-- Reviews -->

                        <li class="nav-item">

                            <a class="nav-link
                                {{ request()->is('reviews') ? 'active' : '' }}"
                                href="{{ route('viewReview') }}">

                                Reviews

                            </a>

                        </li>


                    </ul>


                    <!-- =====================================
                         AUTHENTICATION
                    ====================================== -->

                    <div class="navbar-auth d-flex align-items-center gap-2">


                        @if (Route::has('login'))


                            @auth


                                <!-- Logged in -->

                                @if (Auth::user()->status == 2)


                                    <!-- User Dashboard -->

                                    <a href="{{ route('user.dashboard') }}"
                                        class="btn-hotel btn-dashboard">

                                        <i class="fa-solid fa-gauge-high me-1"></i>

                                        Dashboard

                                    </a>


                                @else


                                    <!-- Admin Dashboard -->

                                    <a href="{{ route('admin.viewDashboard') }}"
                                        class="btn-hotel btn-dashboard">

                                        <i class="fa-solid fa-user-shield me-1"></i>

                                        Admin

                                    </a>


                                @endif


                            @else


                                <!-- Login -->

                                <a href="{{ route('login') }}"
                                    class="btn-hotel btn-login">

                                    Login

                                </a>


                                <!-- Register -->

                                @if (Route::has('register'))

                                    <a href="{{ route('register') }}"
                                        class="btn-hotel btn-register">

                                        Register

                                    </a>

                                @endif


                            @endauth


                        @endif


                    </div>

                </div>

            </div>

        </nav>

    </div>


    <!-- =====================================================
         PAGE CONTENT
    ====================================================== -->

    <main>

        @yield('content')

    </main>


    <!-- =====================================================
         FOOTER
    ====================================================== -->

    <footer class="hotel-footer">

        <div class="container">

            <div class="row">


                <!-- =========================================
                     HOTEL INFORMATION
                ========================================== -->

                <div class="col-lg-4 col-md-6 mb-4">

                    <h5 class="footer-title">
                        Hotel Paradise
                    </h5>

                    <p class="footer-text">

                        Your luxurious stay in the heart of the city.
                        Experience comfort, elegance, and exceptional
                        service at our hotel.

                    </p>


                    <!-- Social -->

                    <div class="footer-social">

                        <a href="#" aria-label="Facebook">

                            <i class="fab fa-facebook-f"></i>

                        </a>

                        <a href="#" aria-label="Instagram">

                            <i class="fab fa-instagram"></i>

                        </a>

                        <a href="#" aria-label="Twitter">

                            <i class="fab fa-x-twitter"></i>

                        </a>

                    </div>

                </div>


                <!-- =========================================
                     CONTACT
                ========================================== -->

                <div class="col-lg-4 col-md-6 mb-4">

                    <h5 class="footer-title">
                        Contact
                    </h5>

                    <ul class="footer-contact">


                        <li>

                            <i class="fas fa-phone-alt"></i>

                            +95 123 456 789

                        </li>


                        <li>

                            <i class="fas fa-envelope"></i>

                            info@hotelparadise.com

                        </li>


                        <li>

                            <i class="fas fa-location-dot"></i>

                            Yangon, Myanmar

                        </li>


                    </ul>

                </div>


                <!-- =========================================
                     QUICK LINKS
                ========================================== -->

                <div class="col-lg-4 col-md-6 mb-4">

                    <h5 class="footer-title">
                        Quick Links
                    </h5>

                    <ul class="footer-links">


                        <li>

                            <a href="{{ route('welcome') }}">
                                Home
                            </a>

                        </li>


                        <li>

                            <a href="{{ url('/#about') }}">
                                About
                            </a>

                        </li>


                        <li>

                            <a href="{{ url('/#rooms') }}">
                                Rooms
                            </a>

                        </li>


                        <li>

                            <a href="{{ url('/#services') }}">
                                Services
                            </a>

                        </li>


                        <li>

                            <a href="{{ route('viewReview') }}">
                                Reviews
                            </a>

                        </li>


                    </ul>

                </div>


            </div>


            <!-- =========================================
                 FOOTER DIVIDER
            ========================================== -->

            <hr class="footer-divider">


            <!-- =========================================
                 COPYRIGHT
            ========================================== -->

            <div class="copyright">

                &copy; {{ date('Y') }}

                Hotel Paradise.

                All rights reserved.

            </div>


        </div>

    </footer>


    <!-- =====================================================
         BOOTSTRAP JS
    ====================================================== -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>


    <!-- =====================================================
         NAVBAR ACTIVE LINK
         Existing logic preserved
    ====================================================== -->

    <script>

        const navLinks =
            document.querySelectorAll('.navbar-nav .nav-link');


        navLinks.forEach(link => {

            link.addEventListener('click', function() {

                navLinks.forEach(l =>
                    l.classList.remove('active')
                );

                this.classList.add('active');

            });

        });


        const sections =
            document.querySelectorAll('section');


        window.addEventListener('scroll', () => {

            let current = '';


            sections.forEach(section => {

                const sectionTop =
                    section.offsetTop - 80;


                if (pageYOffset >= sectionTop) {

                    current =
                        section.getAttribute('id');

                }

            });


            navLinks.forEach(link => {

                link.classList.remove('active');


                if (
                    link.getAttribute('href') ===
                    '#' + current
                ) {

                    link.classList.add('active');

                }

            });

        });

    </script>

</body>

</html>