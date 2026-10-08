<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Paradise Hotel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet">


    <style>

        /* =====================================================
           PARADISE HOTEL DESIGN SYSTEM
        ===================================================== */

        :root {

            --primary: #0b1f33;
            --primary-light: #163a5c;

            --accent: #c8a45d;
            --accent-light: #dfc486;

            --background: #f7f7f5;
            --white: #ffffff;

            --text: #1d2733;
            --muted: #737b85;

            --border: #e7e7e4;

        }


        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        html {
            scroll-behavior: smooth;
        }


        body {

            font-family: "DM Sans", sans-serif;

            background: var(--background);

            color: var(--text);

            line-height: 1.6;

        }


        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {

            font-family: "Playfair Display", serif;

        }


        a {
            text-decoration: none;
        }



        /* =====================================================
           NAVBAR
        ===================================================== */

        .main-navbar {

            position: fixed;

            top: 20px;

            left: 0;
            right: 0;

            z-index: 1050;

            width: 100%;

        }


        .navbar-box {

            max-width: 1250px;

            margin: auto;

            padding: 12px 18px;

            background: rgba(255, 255, 255, 0.96);

            border: 1px solid rgba(231, 231, 228, 0.9);

            border-radius: 18px;

            box-shadow:
                0 10px 40px rgba(11, 31, 51, 0.10);

            transition: all 0.3s ease;

        }


        .navbar-box.scrolled {

            box-shadow:
                0 15px 45px rgba(11, 31, 51, 0.16);

        }



        /* =====================================================
           LOGO
        ===================================================== */

        .brand {

            font-family: "Playfair Display", serif;

            font-size: 26px;

            font-weight: 700;

            color: var(--primary) !important;

            letter-spacing: -0.5px;

        }


        .brand span {

            color: var(--accent);

        }



        /* =====================================================
           NAVIGATION
        ===================================================== */

        .main-navbar .nav-link {

            color: var(--text) !important;

            font-size: 14px;

            font-weight: 600;

            margin: 0 4px;

            padding: 10px 14px !important;

            border-radius: 10px;

            transition: all 0.25s ease;

        }


        .main-navbar .nav-link:hover {

            background: var(--primary);

            color: white !important;

        }


        .main-navbar .nav-link.active {

            background: var(--primary);

            color: white !important;

        }



        /* =====================================================
           BOOKING BUTTON
        ===================================================== */

        .nav-book {

            background: var(--accent) !important;

            color: white !important;

            padding: 11px 20px !important;

            border-radius: 12px !important;

            margin-left: 7px !important;

        }


        .nav-book:hover {

            background: var(--primary) !important;

            color: white !important;

        }



        /* =====================================================
           PROFILE
        ===================================================== */

        .profile-link {

            display: flex;

            align-items: center;

            gap: 8px;

        }


        .profile-img {

            width: 36px;

            height: 36px;

            object-fit: cover;

            border: 2px solid var(--accent);

        }


        .profile-name {

            max-width: 130px;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;

        }



        /* =====================================================
           PROFILE DROPDOWN
        ===================================================== */

        .dropdown-menu {

            border: 1px solid var(--border);

            border-radius: 16px;

            padding: 8px;

            min-width: 260px;

            box-shadow:
                0 18px 50px rgba(11, 31, 51, 0.16);

            margin-top: 12px !important;

        }


        .profile-header {

            padding: 16px !important;

            border-radius: 10px;

        }


        .profile-header img {

            width: 68px;

            height: 68px;

            object-fit: cover;

            border: 3px solid var(--accent);

        }


        .profile-name-large {

            color: var(--primary);

            font-weight: 700;

        }


        .profile-email {

            color: var(--muted);

        }


        .dropdown-item {

            padding: 11px 13px;

            border-radius: 9px;

            color: var(--text);

            font-size: 14px;

            transition: all 0.2s ease;

        }


        .dropdown-item:hover {

            background: rgba(200, 164, 93, 0.12);

            color: var(--primary);

        }


        .dropdown-item i {

            color: var(--accent);

            width: 20px;

        }


        .dropdown-divider {

            border-color: var(--border);

        }



        /* =====================================================
           PAGE CONTENT
        ===================================================== */

        .main-content {

            min-height: 65vh;

        }



        /* =====================================================
           USER PAGE HERO / BANNER
        ===================================================== */

        .page-hero {

            min-height: 48vh;

            position: relative;

            display: flex;

            align-items: center;

            background:

                linear-gradient(
                    rgba(5, 18, 32, 0.55),
                    rgba(5, 18, 32, 0.68)
                ),

                url("{{ asset('images/banner.jpg') }}")
                center/cover;

        }


        .page-hero-content {

            padding-top: 100px;

            padding-bottom: 70px;

            color: white;

        }


        .page-hero .eyebrow {

            color: var(--accent);

            font-size: 13px;

            font-weight: 700;

            letter-spacing: 2px;

            text-transform: uppercase;

            margin-bottom: 15px;

        }


        .page-hero h1 {

            font-size: clamp(42px, 6vw, 70px);

            line-height: 1.1;

            margin-bottom: 15px;

        }


        .page-hero p {

            max-width: 650px;

            color: rgba(255,255,255,.82);

            font-size: 17px;

        }



        /* =====================================================
           COMMON USER PAGE SECTIONS
        ===================================================== */

        .hotel-section {

            padding: 100px 0;

        }


        .section-label {

            color: var(--accent);

            font-size: 13px;

            font-weight: 700;

            letter-spacing: 2px;

            text-transform: uppercase;

            margin-bottom: 12px;

        }


        .section-title {

            color: var(--primary);

            font-size: clamp(34px, 4vw, 52px);

            line-height: 1.15;

        }


        .section-description {

            color: var(--muted);

            line-height: 1.8;

        }



        /* =====================================================
           BUTTON
        ===================================================== */

        .hotel-btn {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            background: var(--accent);

            color: white;

            border: none;

            padding: 13px 23px;

            border-radius: 12px;

            font-weight: 600;

            transition: all .25s ease;

        }


        .hotel-btn:hover {

            background: var(--primary);

            color: white;

            transform: translateY(-2px);

        }



        /* =====================================================
           CARDS
        ===================================================== */

        .hotel-card {

            background: white;

            border: 1px solid var(--border);

            border-radius: 20px;

            padding: 28px;

            transition: all .3s ease;

        }


        .hotel-card:hover {

            transform: translateY(-5px);

            box-shadow:
                0 18px 45px rgba(11,31,51,.10);

        }



        /* =====================================================
           FORM
        ===================================================== */

        .hotel-form {

            background: white;

            border: 1px solid var(--border);

            border-radius: 22px;

            padding: 32px;

            box-shadow:
                0 15px 45px rgba(11,31,51,.07);

        }


        .hotel-form .form-control,
        .hotel-form .form-select {

            border: 1px solid var(--border);

            border-radius: 10px;

            padding: 12px 14px;

        }


        .hotel-form .form-control:focus,
        .hotel-form .form-select:focus {

            border-color: var(--accent);

            box-shadow:
                0 0 0 3px rgba(200,164,93,.12);

        }



        /* =====================================================
           FOOTER
        ===================================================== */

        .footer {

            background: #061524;

            color: rgba(255,255,255,.70);

            padding: 70px 0 25px;

        }


        .footer-brand {

            font-family: "Playfair Display", serif;

            font-size: 28px;

            font-weight: 700;

            color: white;

        }


        .footer-brand span {

            color: var(--accent);

        }


        .footer h5 {

            font-family: "Playfair Display", serif;

            color: white;

            font-size: 20px;

            margin-bottom: 20px;

        }


        .footer p {

            font-size: 14px;

            line-height: 1.8;

            color: rgba(255,255,255,.65);

        }


        .footer-contact-item {

            display: flex;

            align-items: flex-start;

            gap: 11px;

            margin-bottom: 12px;

        }


        .footer-contact-item i {

            color: var(--accent);

            width: 18px;

            margin-top: 5px;

        }


        .footer a {

            color: rgba(255,255,255,.65);

            text-decoration: none;

            transition: .2s;

        }


        .footer a:hover {

            color: var(--accent);

        }


        .footer-links a {

            display: block;

            margin-bottom: 10px;

        }


        .footer-divider {

            border-color: rgba(255,255,255,.12);

            margin: 40px 0 22px;

        }


        .footer-bottom {

            color: rgba(255,255,255,.45);

            font-size: 13px;

        }



        /* =====================================================
           SOCIAL ICONS
        ===================================================== */

        .social-links {

            display: flex;

            gap: 10px;

            margin-top: 20px;

        }


        .social-links a {

            width: 40px;

            height: 40px;

            display: flex;

            align-items: center;

            justify-content: center;

            border: 1px solid rgba(255,255,255,.18);

            border-radius: 50%;

            color: white;

            transition: all .25s ease;

        }


        .social-links a:hover {

            background: var(--accent);

            border-color: var(--accent);

            color: white;

            transform: translateY(-3px);

        }



        /* =====================================================
           MOBILE NAVBAR
        ===================================================== */

        .navbar-toggler {

            border: 1px solid var(--border);

            padding: 7px 10px;

            border-radius: 9px;

        }


        .navbar-toggler:focus {

            box-shadow:
                0 0 0 3px rgba(200,164,93,.20);

        }


        .navbar-toggler-icon {

            background-image:

                url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%230b1f33' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");

        }



        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 991px) {

            .main-navbar {

                top: 10px;

            }


            .navbar-box {

                margin: 0 15px;

            }


            .navbar-collapse {

                margin-top: 15px;

                padding-top: 10px;

                border-top: 1px solid var(--border);

            }


            .main-navbar .nav-link {

                padding: 11px 12px !important;

            }


            .nav-book {

                margin-left: 0 !important;

                margin-top: 5px;

            }


            .navbar-nav.ms-auto {

                margin-top: 10px;

            }


            .dropdown-menu {

                width: 100%;

                box-shadow: none;

                margin-top: 5px !important;

            }


            .page-hero {

                min-height: 42vh;

            }


            .page-hero-content {

                padding-top: 110px;

            }

        }



        @media (max-width: 575px) {

            .main-navbar {

                top: 8px;

            }


            .navbar-box {

                margin: 0 8px;

                padding: 9px 12px;

                border-radius: 14px;

            }


            .brand {

                font-size: 23px;

            }


            .page-hero {

                min-height: 40vh;

            }


            .page-hero-content {

                padding: 115px 10px 50px;

            }


            .page-hero h1 {

                font-size: 42px;

            }


            .page-hero p {

                font-size: 15px;

            }


            .hotel-section {

                padding: 70px 0;

            }


            .hotel-form {

                padding: 23px;

            }


            .footer {

                padding: 55px 0 20px;

            }

        }

    </style>

</head>


<body>


    <!-- =====================================================
         NAVBAR
    ===================================================== -->

    <nav class="main-navbar">

        <div class="navbar-box">

            <nav class="navbar navbar-expand-lg">

                <div class="container-fluid">


                    <!-- LOGO -->

                    <a class="navbar-brand brand"
                        href="{{ route('welcome') }}">

                        Paradise<span>.</span>

                    </a>


                    <!-- MOBILE BUTTON -->

                    <button
                        class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarNav"
                        aria-controls="navbarNav"
                        aria-expanded="false"
                        aria-label="Toggle navigation">

                        <span class="navbar-toggler-icon"></span>

                    </button>


                    <!-- NAVIGATION -->

                    <div
                        class="collapse navbar-collapse"
                        id="navbarNav">


                        <!-- LEFT NAVIGATION -->

                        <ul class="navbar-nav me-auto">


                            <!-- HOME -->

                            <li class="nav-item">

                                <a
                                    class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}"
                                    href="{{ route('user.dashboard') }}">

                                    <i class="fa-solid fa-house me-1 d-lg-none"></i>

                                    Home

                                </a>

                            </li>


                            <!-- ABOUT -->

                            <li class="nav-item">

                                <a
                                    class="nav-link"
                                    href="{{ route('user.dashboard') }}#about">

                                    About

                                </a>

                            </li>


                            <!-- ROOMS -->

                            <li class="nav-item">

                                <a
                                    class="nav-link"
                                    href="{{ route('user.dashboard') }}#rooms">

                                    Rooms

                                </a>

                            </li>


                            <!-- SERVICES -->

                            <li class="nav-item">

                                <a
                                    class="nav-link"
                                    href="{{ route('user.dashboard') }}#services">

                                    Services

                                </a>

                            </li>


                            <!-- CONTACT -->

                            <li class="nav-item">

                                <a
                                    class="nav-link"
                                    href="{{ route('user.dashboard') }}#contact">

                                    Contact

                                </a>

                            </li>


                            <!-- REVIEWS -->

                            <li class="nav-item">

                                <a
                                    class="nav-link {{ request()->routeIs('user.dashboard.viewReview') ? 'active' : '' }}"
                                    href="{{ route('user.dashboard.viewReview') }}">

                                    Reviews

                                </a>

                            </li>


                            <!-- BOOKING -->

                            @auth

                                <li class="nav-item">

                                    <a
                                        class="nav-link nav-book {{ request()->routeIs('user.dashboard.bookingRoom') ? 'active' : '' }}"
                                        href="{{ route('user.dashboard.bookingRoom') }}">

                                        <i class="fa-solid fa-calendar-check me-1"></i>

                                        Booking

                                    </a>

                                </li>

                            @endauth


                        </ul>



                        <!-- RIGHT AUTHENTICATION -->

                        <ul class="navbar-nav ms-auto">


                            @guest

                                <!-- LOGIN -->

                                <li class="nav-item">

                                    <a
                                        class="nav-link"
                                        href="{{ route('login') }}">

                                        Login

                                    </a>

                                </li>


                                <!-- REGISTER -->

                                @if (Route::has('register'))

                                    <li class="nav-item">

                                        <a
                                            class="nav-link"
                                            href="{{ route('register') }}">

                                            Register

                                        </a>

                                    </li>

                                @endif


                            @else


                                <!-- PROFILE -->

                                <li class="nav-item dropdown">

                                    <a
                                        class="nav-link dropdown-toggle profile-link"
                                        href="#"
                                        role="button"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false">


                                        <img
                                            class="profile-img rounded-circle"
                                            src="{{ Auth::user()->image
                                                ? asset('images/user/' . Auth::user()->image)
                                                : asset('images/user/default.png') }}"
                                            alt="Profile">


                                        <span class="profile-name">

                                            {{ Auth::user()->name }}

                                        </span>


                                    </a>



                                    <!-- PROFILE DROPDOWN -->

                                    <ul
                                        class="dropdown-menu dropdown-menu-end">


                                        <!-- PROFILE HEADER -->

                                        <li class="profile-header text-center border-bottom">

                                            <img
                                                class="rounded-circle mb-2"
                                                src="{{ Auth::user()->image
                                                    ? asset('images/user/' . Auth::user()->image)
                                                    : asset('images/user/default.png') }}"
                                                alt="Profile">


                                            <div class="profile-name-large">

                                                {{ Auth::user()->name }}

                                            </div>


                                            <div class="profile-email small">

                                                {{ Auth::user()->email }}

                                            </div>

                                        </li>



                                        <!-- PROFILE -->

                                        <li>

                                            <a
                                                class="dropdown-item"
                                                href="{{ route('user.viewProfile', Auth::user()->id) }}">

                                                <i class="fa fa-user me-2"></i>

                                                Profile

                                            </a>

                                        </li>



                                        <!-- EDIT PROFILE -->

                                        <li>

                                            <a
                                                class="dropdown-item"
                                                href="{{ route('user.viewEditProfile', Auth::user()->id) }}">

                                                <i class="fa fa-edit me-2"></i>

                                                Edit Profile

                                            </a>

                                        </li>



                                        <!-- CHANGE PASSWORD -->

                                        <li>

                                            <a
                                                class="dropdown-item"
                                                href="{{ route('user.viewChangePassword', Auth::user()->id) }}">

                                                <i class="fa fa-lock me-2"></i>

                                                Change Password

                                            </a>

                                        </li>



                                        <li>

                                            <hr class="dropdown-divider">

                                        </li>



                                        <!-- LOGOUT -->

                                        <li>

                                            <a
                                                class="dropdown-item"
                                                href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">

                                                <i class="fa fa-sign-out-alt me-2"></i>

                                                Logout

                                            </a>


                                            <form
                                                id="logout-form"
                                                action="{{ route('logout') }}"
                                                method="POST">

                                                @csrf

                                            </form>

                                        </li>


                                    </ul>

                                </li>


                            @endguest


                        </ul>


                    </div>

                </div>

            </nav>

        </div>

    </nav>



    <!-- =====================================================
         MAIN CONTENT
    ===================================================== -->

    <main class="main-content ">

        @yield('content')

    </main>



    <!-- =====================================================
         FOOTER
    ===================================================== -->

    <footer class="footer">

        <div class="container">

            <div class="row g-5">


                <!-- HOTEL -->

                <div class="col-lg-4 col-md-6">

                    <div class="footer-brand">

                        Paradise<span>.</span>

                    </div>


                    <p class="mt-3">

                        A comfortable and modern hotel experience
                        designed to make every stay memorable.

                    </p>


                    <div class="social-links">


                        <a href="#"
                            aria-label="Facebook">

                            <i class="fab fa-facebook-f"></i>

                        </a>


                        <a href="#"
                            aria-label="Instagram">

                            <i class="fab fa-instagram"></i>

                        </a>


                        <a href="#"
                            aria-label="Twitter">

                            <i class="fab fa-twitter"></i>

                        </a>


                    </div>

                </div>



                <!-- CONTACT -->

                <div class="col-lg-4 col-md-6">

                    <h5>
                        Contact
                    </h5>


                    <div class="footer-contact-item">

                        <i class="fas fa-phone-alt"></i>

                        <span>
                            +95 9 000 000 000
                        </span>

                    </div>


                    <div class="footer-contact-item">

                        <i class="fas fa-envelope"></i>

                        <span>
                            info@paradisehotel.com
                        </span>

                    </div>


                    <div class="footer-contact-item">

                        <i class="fas fa-location-dot"></i>

                        <span>
                            Yangon, Myanmar
                        </span>

                    </div>


                    <div class="footer-contact-item">

                        <i class="fas fa-clock"></i>

                        <span>
                            Open 24 Hours
                        </span>

                    </div>

                </div>



                <!-- QUICK LINKS -->

                <div class="col-lg-4 col-md-6">

                    <h5>
                        Quick Links
                    </h5>


                    <div class="footer-links">


                        <a href="{{ route('welcome') }}">

                            <i class="fa-solid fa-angle-right me-2"></i>

                            Home

                        </a>


                        <a href="{{ route('welcome') }}#about">

                            <i class="fa-solid fa-angle-right me-2"></i>

                            About

                        </a>


                        <a href="{{ route('welcome') }}#rooms">

                            <i class="fa-solid fa-angle-right me-2"></i>

                            Rooms

                        </a>


                        <a href="{{ route('welcome') }}#services">

                            <i class="fa-solid fa-angle-right me-2"></i>

                            Services

                        </a>


                        <a href="{{ route('viewReview') }}">

                            <i class="fa-solid fa-angle-right me-2"></i>

                            Reviews

                        </a>


                        <a href="{{ route('welcome') }}#contact">

                            <i class="fa-solid fa-angle-right me-2"></i>

                            Contact

                        </a>


                    </div>

                </div>


            </div>



            <!-- DIVIDER -->

            <hr class="footer-divider">



            <!-- FOOTER BOTTOM -->

            <div class="row">

                <div class="col-md-6 text-center text-md-start">

                    <div class="footer-bottom">

                        &copy; {{ date('Y') }}

                        Paradise Hotel.

                        All rights reserved.

                    </div>

                </div>


                <div class="col-md-6 text-center text-md-end">

                    <div class="footer-bottom">

                        Comfort &nbsp;•&nbsp;

                        Elegance &nbsp;•&nbsp;

                        Hospitality

                    </div>

                </div>

            </div>


        </div>

    </footer>



    <!-- =====================================================
         BOOTSTRAP JS
    ===================================================== -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>



    <!-- =====================================================
         NAVBAR SCROLL EFFECT
    ===================================================== -->

    <script>

        const navbarBox =
            document.querySelector('.navbar-box');


        function updateNavbar() {

            if (window.scrollY > 20) {

                navbarBox.classList.add('scrolled');

            } else {

                navbarBox.classList.remove('scrolled');

            }

        }


        window.addEventListener(
            'scroll',
            updateNavbar
        );


        window.addEventListener(
            'load',
            updateNavbar
        );

  



    

        const navLinks =
            document.querySelectorAll(
                '.main-navbar .nav-link'
            );


        const sections =
            document.querySelectorAll(
                'section[id]'
            );


        function setActiveLink() {

            const scrollPos =
                window.pageYOffset ||
                document.documentElement.scrollTop;


            sections.forEach(section => {

                const top =
                    section.offsetTop - 150;


                const bottom =
                    top + section.offsetHeight;


                const id =
                    section.getAttribute('id');


                if (
                    scrollPos >= top &&
                    scrollPos < bottom
                ) {

                    navLinks.forEach(link => {

                        link.classList.remove('active');


                        const href =
                            link.getAttribute('href');


                        if (
                            href &&
                            href.includes('#' + id)
                        ) {

                            link.classList.add('active');

                        }

                    });

                }

            });

        }


        window.addEventListener(
            'scroll',
            setActiveLink
        );


        window.addEventListener(
            'load',
            setActiveLink
        );

    </script>


</body>

</html>