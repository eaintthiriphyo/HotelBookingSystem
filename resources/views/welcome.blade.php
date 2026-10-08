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
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet">

    <style>

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
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: "Playfair Display", serif;
        }

        a {
            text-decoration: none;
        }


        /* =========================
           NAVBAR
        ========================== */

        .main-navbar {
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        .navbar-box {
            max-width: 1250px;
            margin: auto;
            padding: 12px 18px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 18px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        .brand {
            font-family: "Playfair Display", serif;
            font-size: 26px;
            font-weight: 700;
            color: var(--primary) !important;
        }

        .brand span {
            color: var(--accent);
        }

        .nav-link {
            color: var(--text) !important;
            font-weight: 500;
            margin: 0 6px;
            padding: 10px 14px !important;
            border-radius: 10px;
            transition: 0.3s;
        }

        .nav-link:hover {
            background: var(--primary);
            color: white !important;
        }

        .nav-book {
            background: var(--primary);
            color: white !important;
            padding: 11px 20px !important;
            border-radius: 12px;
        }

        .nav-book:hover {
            background: var(--accent);
            color: white !important;
        }


        /* =========================
           HERO
        ========================== */

        .hero {
            min-height: 90vh;
            position: relative;

            background:
                linear-gradient(
                    rgba(5, 18, 32, 0.42),
                    rgba(5, 18, 32, 0.62)
                ),
                url("{{ asset('images/banner.jpg') }}") center/cover;

            display: flex;
            align-items: center;
        }

        .hero-content {
            max-width: 1250px;
            width: 100%;
            margin: auto;
            padding: 150px 20px 170px;
            color: white;
        }

        .hero-small {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .hero-small::before {
            content: "";
            width: 35px;
            height: 1px;
            background: var(--accent);
        }

        .hero h1 {
            font-size: clamp(48px, 7vw, 90px);
            line-height: 1;
            max-width: 750px;
            margin-bottom: 25px;
        }

        .hero p {
            max-width: 560px;
            font-size: 18px;
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.88);
        }

        .hero-buttons {
            display: flex;
            gap: 14px;
            margin-top: 35px;
            flex-wrap: wrap;
        }

        .btn-main {
            background: var(--accent);
            color: white;
            border: none;
            padding: 14px 25px;
            border-radius: 12px;
            font-weight: 600;
        }

        .btn-main:hover {
            background: white;
            color: var(--primary);
        }

        .btn-outline-light-custom {
            border: 1px solid rgba(255,255,255,.6);
            color: white;
            padding: 13px 25px;
            border-radius: 12px;
        }

        .btn-outline-light-custom:hover {
            background: white;
            color: var(--primary);
        }


        /* =========================
           BOOKING BAR
        ========================== */

        .booking-wrapper {
            position: relative;
            margin-top: -65px;
            z-index: 5;
        }

        .booking-box {
            max-width: 1100px;
            margin: auto;
            background: white;
            border-radius: 22px;
            padding: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
        }

        .booking-inner {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr auto;
            gap: 10px;
        }

        .booking-item {
            padding: 16px 20px;
            border-right: 1px solid var(--border);
        }

        .booking-item label {
            display: block;
            font-size: 12px;
            color: var(--muted);
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .booking-item input,
        .booking-item select {
            border: none;
            outline: none;
            width: 100%;
            font-weight: 600;
            color: var(--text);
            background: transparent;
        }

        .booking-btn {
            border: none;
            background: var(--primary);
            color: white;
            padding: 0 28px;
            border-radius: 16px;
            font-weight: 600;
        }

        .booking-btn:hover {
            background: var(--accent);
        }


        /* =========================
           COMMON SECTION
        ========================== */

        .section {
            padding: 110px 0;
        }

        .section-title {
            font-size: clamp(36px, 4vw, 56px);
            line-height: 1.1;
            margin-bottom: 20px;
        }

        .section-subtitle {
            color: var(--muted);
            max-width: 600px;
            line-height: 1.8;
        }

        .eyebrow {
            color: var(--accent);
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-size: 13px;
            margin-bottom: 15px;
        }


        /* =========================
           HIGHLIGHTS
        ========================== */

        .highlights {
            background: white;
            padding: 45px 0;
        }

        .highlight {
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 15px 25px;
            border-right: 1px solid var(--border);
        }

        .highlight:last-child {
            border-right: none;
        }

        .highlight-icon {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            background: #f4efe4;
            color: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .highlight h5 {
            margin: 0;
            font-family: "DM Sans", sans-serif;
            font-weight: 700;
        }

        .highlight p {
            margin: 3px 0 0;
            color: var(--muted);
            font-size: 14px;
        }


        /* =========================
           ABOUT
        ========================== */

        .about-image {
            width: 100%;
            height: 580px;
            object-fit: cover;
            border-radius: 25px;
        }

        .about-content {
            padding-left: 40px;
        }

        .about-list {
            list-style: none;
            padding: 0;
            margin-top: 30px;
        }

        .about-list li {
            display: flex;
            gap: 12px;
            margin-bottom: 16px;
        }

        .about-list i {
            color: var(--accent);
            margin-top: 4px;
        }


        /* =========================
           ROOMS
        ========================== */

        .rooms-section {
            background: white;
        }

        .room-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 22px;
            overflow: hidden;
            height: 100%;
            transition: 0.35s;
        }

        .room-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(0,0,0,.10);
        }

        .room-image-wrapper {
            position: relative;
            height: 300px;
            overflow: hidden;
        }

        .room-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: 0.5s;
        }

        .room-card:hover .room-image {
            transform: scale(1.06);
        }

        .room-tag {
            position: absolute;
            top: 18px;
            left: 18px;
            background: white;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .room-content {
            padding: 25px;
        }

        .room-content h3 {
            font-size: 27px;
            margin-bottom: 8px;
        }

        .room-price {
            color: var(--accent);
            font-weight: 700;
            font-size: 19px;
        }

        .room-meta {
            display: flex;
            gap: 18px;
            flex-wrap: wrap;
            margin: 20px 0;
            color: var(--muted);
            font-size: 14px;
        }

        .room-meta i {
            color: var(--accent);
            margin-right: 5px;
        }

        .room-description {
            color: var(--muted);
            line-height: 1.7;
            font-size: 14px;
        }

        .room-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 22px;
        }

        .room-link {
            color: var(--primary);
            font-weight: 700;
        }

        .room-link:hover {
            color: var(--accent);
        }


        /* =========================
           SERVICES
        ========================== */

        .service-card {
            padding: 35px 28px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 20px;
            height: 100%;
            transition: 0.3s;
        }

        .service-card:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-6px);
        }

        .service-icon {
            font-size: 27px;
            color: var(--accent);
            margin-bottom: 25px;
        }

        .service-card p {
            color: var(--muted);
            line-height: 1.7;
        }

        .service-card:hover p {
            color: rgba(255,255,255,.7);
        }


        /* =========================
           PROMO
        ========================== */

        .promo {
            min-height: 480px;
            display: flex;
            align-items: center;

            background:
                linear-gradient(
                    rgba(8, 24, 42, .72),
                    rgba(8, 24, 42, .72)
                ),
                url("{{ asset('images/about2.jpg') }}") center/cover;

            border-radius: 28px;
            overflow: hidden;
        }

        .promo-content {
            padding: 70px;
            color: white;
            max-width: 700px;
        }

        .promo-content h2 {
            font-size: clamp(40px, 5vw, 65px);
        }


        /* =========================
           TESTIMONIAL
        ========================== */

        .testimonial {
            background: white;
            border-radius: 22px;
            padding: 35px;
            height: 100%;
            border: 1px solid var(--border);
        }

        .stars {
            color: var(--accent);
            margin-bottom: 20px;
        }

        .testimonial p {
            color: var(--muted);
            line-height: 1.8;
            font-size: 16px;
        }

        .guest {
            margin-top: 25px;
            font-weight: 700;
        }


        /* =========================
           CONTACT
        ========================== */

        .contact-section {
            background: var(--primary);
            color: white;
        }

        .contact-section .section-subtitle {
            color: rgba(255,255,255,.7);
        }

        .contact-info {
            margin-top: 35px;
        }

        .contact-item {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }

        .contact-item i {
            color: var(--accent);
            font-size: 20px;
            width: 25px;
        }

        .contact-form {
            background: white;
            padding: 35px;
            border-radius: 22px;
            color: var(--text);
        }

        .contact-form .form-control {
            border: 1px solid var(--border);
            padding: 13px 15px;
            border-radius: 10px;
        }

        .contact-form .form-control:focus {
            border-color: var(--accent);
            box-shadow: none;
        }


        /* =========================
           MAP
        ========================== */

        .map-section {
            background: var(--background);
        }

        .map-wrapper {
            width: 100%;
            overflow: hidden;
            border-radius: 24px;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.12);
        }

        .map-wrapper iframe {
            display: block;
            width: 100%;
            height: 430px;
            border: 0;
        }


        /* =========================
           FOOTER
        ========================== */

        footer {
            background: #061524;
            color: white;
            padding: 70px 0 25px;
        }

        footer h4 {
            margin-bottom: 20px;
        }

        footer p,
        footer li {
            color: rgba(255,255,255,.65);
            line-height: 1.8;
        }

        footer ul {
            list-style: none;
            padding: 0;
        }

        footer li {
            margin-bottom: 8px;
        }

        footer a {
            color: rgba(255,255,255,.65);
        }

        footer a:hover {
            color: var(--accent);
        }

        .socials {
            display: flex;
            gap: 10px;
        }

        .socials a {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255,255,255,.2);
            border-radius: 50%;
        }

        .copyright {
            border-top: 1px solid rgba(255,255,255,.1);
            margin-top: 50px;
            padding-top: 25px;
            text-align: center;
            color: rgba(255,255,255,.45);
            font-size: 14px;
        }


        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 991px) {

            .navbar-box {
                margin: 0 15px;
            }

            .booking-inner {
                grid-template-columns: 1fr 1fr;
            }

            .booking-item {
                border-right: none;
                border-bottom: 1px solid var(--border);
            }

            .booking-btn {
                min-height: 55px;
                grid-column: 1 / -1;
            }

            .about-content {
                padding-left: 0;
                margin-top: 40px;
            }

            .about-image {
                height: 450px;
            }

            .highlight {
                border-right: none;
                border-bottom: 1px solid var(--border);
            }

            .promo-content {
                padding: 45px;
            }

        }


        @media (max-width: 575px) {

            .hero-content {
                padding: 140px 20px 120px;
            }

            .hero h1 {
                font-size: 48px;
            }

            .booking-wrapper {
                margin: -40px 15px 0;
            }

            .booking-inner {
                grid-template-columns: 1fr;
            }

            .booking-btn {
                grid-column: auto;
            }

            .section {
                padding: 75px 0;
            }

            .about-image {
                height: 350px;
            }

            .promo-content {
                padding: 35px 25px;
            }

            .contact-form {
                padding: 25px;
            }

            .map-wrapper iframe {
                height: 350px;
            }

        }

    </style>

</head>


<body>


    <!-- =========================
         NAVBAR
    ========================== -->

    <nav class="main-navbar">

        <div class="navbar-box">

            <nav class="navbar navbar-expand-lg">

                <div class="container-fluid">

                    <a class="navbar-brand brand" href="{{ url('/') }}">
                        Paradise<span>.</span>
                    </a>


                    <button class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#mainNavbar"
                        aria-controls="mainNavbar"
                        aria-expanded="false"
                        aria-label="Toggle navigation">

                        <span class="navbar-toggler-icon"></span>

                    </button>


                    <div class="collapse navbar-collapse"
                        id="mainNavbar">

                        <ul class="navbar-nav ms-auto align-items-lg-center">


                            <li class="nav-item">

                                <a class="nav-link"
                                    href="#home">

                                    Home

                                </a>

                            </li>


                            <li class="nav-item">

                                <a class="nav-link"
                                    href="#about">

                                    About

                                </a>

                            </li>


                            <li class="nav-item">

                                <a class="nav-link"
                                    href="#rooms">

                                    Rooms

                                </a>

                            </li>


                            <li class="nav-item">

                                <a class="nav-link"
                                    href="#services">

                                    Services

                                </a>

                            </li>


                            <li class="nav-item">

                                <a class="nav-link"
                                    href="#contact">

                                    Contact

                                </a>

                            </li>


                            <li class="nav-item">

                                <a class="nav-link"
                                    href="#location">

                                    Location

                                </a>

                            </li>


                            @auth

                                @if (Auth::user()->status == 2 &&
                                     Auth::user()->role == 'user')

                                    <li class="nav-item">

                                        <a class="nav-link nav-book"
                                            href="{{ route('user.dashboard') }}">

                                            Dashboard

                                        </a>

                                    </li>

                                @else

                                    <li class="nav-item">

                                        <a class="nav-link nav-book"
                                            href="{{ route('admin.viewDashboard') }}">

                                            Admin

                                        </a>

                                    </li>

                                @endif


                            @else

                                <li class="nav-item">

                                    <a class="nav-link nav-book"
                                        href="{{ route('login') }}">

                                        Login

                                    </a>

                                </li>

                            @endauth


                        </ul>

                    </div>

                </div>

            </nav>

        </div>

    </nav>



    <!-- =========================
         HERO
    ========================== -->

    <section class="hero" id="home">

        <div class="hero-content">

            <div class="hero-small">

                Welcome to Paradise Hotel

            </div>


            <h1>

                Stay somewhere
                beautiful.

            </h1>


            <p>

                Discover a peaceful stay, thoughtfully designed rooms,
                exceptional service and everything you need for a memorable
                hotel experience.

            </p>


            <div class="hero-buttons">

                <a href="#rooms"
                    class="btn btn-main">

                    Explore Rooms

                    <i class="fa-solid fa-arrow-right ms-2"></i>

                </a>


                <a href="#about"
                    class="btn btn-outline-light-custom">

                    Discover Paradise

                </a>

            </div>

        </div>

    </section>



    <!-- =========================
         BOOKING SEARCH
    ========================== -->

    <!-- <div class="booking-wrapper">

        <div class="booking-box">

            <div class="booking-inner">


                <div class="booking-item">

                    <label>
                        Check In
                    </label>

                    <input type="date"
                        id="checkIn">

                </div>


                <div class="booking-item">

                    <label>
                        Check Out
                    </label>

                    <input type="date"
                        id="checkOut">

                </div>


                <div class="booking-item">

                    <label>
                        Guests
                    </label>

                    <select id="guests">

                        <option value="1">
                            1 Guest
                        </option>

                        <option value="2" selected>
                            2 Guests
                        </option>

                        <option value="3">
                            3 Guests
                        </option>

                        <option value="4">
                            4 Guests
                        </option>

                        <option value="5">
                            5+ Guests
                        </option>

                    </select>

                </div>


                <button class="booking-btn"
                    onclick="checkAvailability()">

                    Check Availability

                </button>

            </div>

        </div>

    </div> -->



    <!-- =========================
         HIGHLIGHTS
    ========================== -->

    <section class="highlights ">

        <div class="container mt-4">

            <div class="row g-0">


                <div class="col-lg-3 col-md-6">

                    <div class="highlight">

                        <div class="highlight-icon">

                            <i class="fa-solid fa-bed"></i>

                        </div>

                        <div>

                            <h5>
                                Comfortable Rooms
                            </h5>

                            <p>
                                Designed for relaxation
                            </p>

                        </div>

                    </div>

                </div>


                <div class="col-lg-3 col-md-6">

                    <div class="highlight">

                        <div class="highlight-icon">

                            <i class="fa-solid fa-wifi"></i>

                        </div>

                        <div>

                            <h5>
                                Free Wi-Fi
                            </h5>

                            <p>
                                Stay connected everywhere
                            </p>

                        </div>

                    </div>

                </div>


                <div class="col-lg-3 col-md-6">

                    <div class="highlight">

                        <div class="highlight-icon">

                            <i class="fa-solid fa-utensils"></i>

                        </div>

                        <div>

                            <h5>
                                Restaurant
                            </h5>

                            <p>
                                Fresh dining experience
                            </p>

                        </div>

                    </div>

                </div>


                <div class="col-lg-3 col-md-6">

                    <div class="highlight">

                        <div class="highlight-icon">

                            <i class="fa-solid fa-headset"></i>

                        </div>

                        <div>

                            <h5>
                                24/7 Service
                            </h5>

                            <p>
                                We're here when you need us
                            </p>

                        </div>

                    </div>

                </div>


            </div>

        </div>

    </section>



    <!-- =========================
         ABOUT
    ========================== -->

    <section class="section"
        id="about">

        <div class="container">

            <div class="row align-items-center g-5">


                <div class="col-lg-6">

                    <img src="{{ asset('images/about2.jpg') }}"
                        class="about-image"
                        alt="Paradise Hotel">

                </div>


                <div class="col-lg-6">

                    <div class="about-content">

                        <div class="eyebrow">
                            About Paradise
                        </div>


                        <h2 class="section-title">

                            A place made for
                            slowing down.

                        </h2>


                        <p class="section-subtitle">

                            Paradise Hotel combines comfortable accommodation,
                            thoughtful hospitality and modern facilities to
                            create a relaxing experience for every guest.

                        </p>


                        <ul class="about-list">

                            <li>

                                <i class="fa-solid fa-check"></i>

                                <span>
                                    Comfortable and carefully designed rooms.
                                </span>

                            </li>


                            <li>

                                <i class="fa-solid fa-check"></i>

                                <span>
                                    Friendly service from our hotel team.
                                </span>

                            </li>


                            <li>

                                <i class="fa-solid fa-check"></i>

                                <span>
                                    Modern facilities for business and leisure.
                                </span>

                            </li>

                        </ul>


                        <a href="#rooms"
                            class="btn btn-main mt-3">

                            Explore Our Rooms

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>



    <!-- =========================
         ROOMS
    ========================== -->

    <section class="section rooms-section"
        id="rooms">

        <div class="container">


            <div class="row align-items-end mb-5">


                <div class="col-lg-7">

                    <div class="eyebrow">
                        Stay with us
                    </div>

                    <h2 class="section-title">

                        Rooms designed
                        around you.

                    </h2>

                </div>


                <div class="col-lg-5">

                    <p class="section-subtitle ms-lg-auto">

                        Choose the room that fits your stay.
                        Every room combines comfort, space and
                        the essentials you need.

                    </p>

                </div>

            </div>



            <div class="row g-4">


                @foreach ($roomType as $rt)

                    <div class="col-xl-4 col-md-6">

                        <div class="room-card">


                            <div class="room-image-wrapper">


                                @if ($rt->RoomTypeImages->count() > 0)

                                
                                    <div id="roomCarousel{{ $rt->id }}"
                                         class="carousel slide"
                                         data-bs-ride="carousel">

                                        <div class="carousel-inner">

                                            @foreach ($rt->RoomTypeImages as $img)

                                                <div class="carousel-item
                                                    {{ $loop->first ? 'active' : '' }}">

                                                    <img
                                                        src="{{ asset($img->img_src) }}"
                                                        class="dashboard-room-image"
                                                        alt="{{ $rt->room_type }}" style="width:100%;height:300px"
                                                        >

                                                </div>

                                            @endforeach

                                        </div>

                                        @if ($rt->RoomTypeImages->count() > 1)

                                            <button
                                                class="carousel-control-prev"
                                                type="button"
                                                data-bs-target="#roomCarousel{{ $rt->id }}"
                                                data-bs-slide="prev">

                                                <span class="carousel-control-prev-icon"></span>

                                            </button>

                                            <button
                                                class="carousel-control-next"
                                                type="button"
                                                data-bs-target="#roomCarousel{{ $rt->id }}"
                                                data-bs-slide="next">

                                                <span class="carousel-control-next-icon"></span>

                                            </button>

                                        @endif

                                    </div>

                                @else

                                    <img
                                        src="{{ asset('images/banner.jpg') }}"
                                        class="dashboard-room-image"
                                        alt="{{ $rt->room_type }}">

                                @endif


                                <div class="room-tag">

                                    Paradise Hotel

                                </div>

                            </div>



                            <div class="room-content">


                                <div class="d-flex justify-content-between align-items-start gap-3">


                                    <h3>

                                        {{ $rt->room_type }}

                                    </h3>


                                    <div class="room-price">

                                        ${{ number_format($rt->price, 2) }}

                                    </div>

                                </div>



                                <div class="room-meta">


                                    <span>

                                        <i class="fa-solid fa-bed"></i>

                                        {{ $rt->bed }}

                                    </span>


                                    <span>

                                        <i class="fa-solid fa-users"></i>

                                        {{ $rt->capacity }} Guests

                                    </span>


                                    <span>

                                        <i class="fa-solid fa-star"></i>

                                        Premium

                                    </span>

                                </div>



                                <p class="room-description">

                                    {{ $rt->description }}

                                </p>



                                <div class="room-footer">


                                    <span class="text-muted small">

                                        {{ $rt->facility }}

                                    </span>


                                    <a href="{{ route('login') }}"
                                        class="room-link">

                                        Book Now

                                        <i class="fa-solid fa-arrow-right ms-1"></i>

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach


            </div>

        </div>

    </section>



    <!-- =========================
         SERVICES
    ========================== -->

    <section class="section"
        id="services">

        <div class="container">


            <div class="row mb-5">

                <div class="col-lg-7">

                    <div class="eyebrow">
                        Hotel Services
                    </div>

                    <h2 class="section-title">

                        Everything you need,
                        all in one place.

                    </h2>

                </div>

            </div>



            <div class="row g-4">


                <div class="col-lg-3 col-md-6">

                    <div class="service-card">

                        <div class="service-icon">
                            <i class="fa-solid fa-bed"></i>
                        </div>

                        <h4>
                            Room Service
                        </h4>

                        <p>
                            Enjoy convenient service directly
                            from the comfort of your room.
                        </p>

                    </div>

                </div>


                <div class="col-lg-3 col-md-6">

                    <div class="service-card">

                        <div class="service-icon">
                            <i class="fa-solid fa-utensils"></i>
                        </div>

                        <h4>
                            Restaurant
                        </h4>

                        <p>
                            Enjoy delicious meals and refreshing
                            drinks during your stay.
                        </p>

                    </div>

                </div>


                <div class="col-lg-3 col-md-6">

                    <div class="service-card">

                        <div class="service-icon">
                            <i class="fa-solid fa-spa"></i>
                        </div>

                        <h4>
                            Spa
                        </h4>

                        <p>
                            Take time to relax and enjoy a
                            peaceful wellness experience.
                        </p>

                    </div>

                </div>


                <div class="col-lg-3 col-md-6">

                    <div class="service-card">

                        <div class="service-icon">
                            <i class="fa-solid fa-wifi"></i>
                        </div>

                        <h4>
                            Free Wi-Fi
                        </h4>

                        <p>
                            Fast and convenient internet access
                            throughout the hotel.
                        </p>

                    </div>

                </div>


                <div class="col-lg-3 col-md-6">

                    <div class="service-card">

                        <div class="service-icon">
                            <i class="fa-solid fa-bus"></i>
                        </div>

                        <h4>
                            Airport Transfer
                        </h4>

                        <p>
                            Convenient transportation for
                            a smoother arrival and departure.
                        </p>

                    </div>

                </div>


                <div class="col-lg-3 col-md-6">

                    <div class="service-card">

                        <div class="service-icon">
                            <i class="fa-solid fa-car"></i>
                        </div>

                        <h4>
                            Parking
                        </h4>

                        <p>
                            Safe and convenient parking for
                            hotel guests.
                        </p>

                    </div>

                </div>


                <div class="col-lg-3 col-md-6">

                    <div class="service-card">

                        <div class="service-icon">
                            <i class="fa-solid fa-dumbbell"></i>
                        </div>

                        <h4>
                            Fitness
                        </h4>

                        <p>
                            Keep your routine going with our
                            fitness facilities.
                        </p>

                    </div>

                </div>


                <div class="col-lg-3 col-md-6">

                    <div class="service-card">

                        <div class="service-icon">
                            <i class="fa-solid fa-martini-glass"></i>
                        </div>

                        <h4>
                            Lounge
                        </h4>

                        <p>
                            Relax, meet friends and enjoy
                            a comfortable atmosphere.
                        </p>

                    </div>

                </div>


            </div>

        </div>

    </section>



    <!-- =========================
         PROMO
    ========================== -->

    <section class="container mb-5">

        <div class="promo">

            <div class="promo-content">


                <div class="eyebrow">
                    Your next escape
                </div>


                <h2>

                    Make your stay
                    unforgettable.

                </h2>


                <p class="mt-3 mb-4">

                    Whether you're travelling for business,
                    relaxing with family or enjoying a weekend
                    away, Paradise Hotel is ready to welcome you.

                </p>


                <a href="#rooms"
                    class="btn btn-main">

                    Find Your Room

                    <i class="fa-solid fa-arrow-right ms-2"></i>

                </a>

            </div>

        </div>

    </section>



    <!-- =========================
         TESTIMONIALS
    ========================== -->

    <section class="section bg-white">

        <div class="container">


            <div class="text-center mb-5">

                <div class="eyebrow">
                    Guest Experiences
                </div>

                <h2 class="section-title">

                    What our guests say.

                </h2>

            </div>



            <div class="row g-4">


                <div class="col-lg-4">

                    <div class="testimonial">

                        <div class="stars">

                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>

                        </div>


                        <p>

                            "A very comfortable place to stay.
                            The room was clean and the service
                            was friendly."

                        </p>


                        <div class="guest">

                            — Hotel Guest

                        </div>

                    </div>

                </div>



                <div class="col-lg-4">

                    <div class="testimonial">

                        <div class="stars">

                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>

                        </div>


                        <p>

                            "The hotel atmosphere was peaceful
                            and the facilities made our stay
                            very convenient."

                        </p>


                        <div class="guest">

                            — Hotel Guest

                        </div>

                    </div>

                </div>



                <div class="col-lg-4">

                    <div class="testimonial">

                        <div class="stars">

                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>

                        </div>


                        <p>

                            "Beautiful rooms, helpful staff and
                            a relaxing experience from beginning
                            to end."

                        </p>


                        <div class="guest">

                            — Hotel Guest

                        </div>

                    </div>

                </div>


            </div>

        </div>

    </section>



    <!-- =========================
         CONTACT
    ========================== -->

    <section class="section contact-section"
        id="contact">

        <div class="container">

            <div class="row g-5 align-items-center">


                <div class="col-lg-5">

                    <div class="eyebrow">
                        Get in touch
                    </div>


                    <h2 class="section-title">

                        Let's make your
                        stay special.

                    </h2>


                    <p class="section-subtitle">

                        Have a question or need help?
                        Send us a message and our team will
                        get back to you.

                    </p>



                    <div class="contact-info">


                        <div class="contact-item">

                            <i class="fa-solid fa-location-dot"></i>

                            <span>

                                Paradise Hotel<br>
                                Yangon, Myanmar

                            </span>

                        </div>


                        <div class="contact-item">

                            <i class="fa-solid fa-phone"></i>

                            <span>

                                +95 9 000 000 000

                            </span>

                        </div>


                        <div class="contact-item">

                            <i class="fa-solid fa-envelope"></i>

                            <span>

                                info@paradisehotel.com

                            </span>

                        </div>


                    </div>

                </div>



                <div class="col-lg-7">

                    <div class="contact-form">


                        @if(session('success'))

                            <div class="alert alert-success">

                                {{ session('success') }}

                            </div>

                        @endif



                        <form action="{{ route('contact.store') }}"
                            method="POST">

                            @csrf


                            <div class="row g-3">


                                <div class="col-md-6">

                                    <label class="form-label">
                                        Name
                                    </label>

                                    <input type="text"
                                        name="name"
                                        class="form-control"
                                        value="{{ old('name') }}"
                                        placeholder="Your name">

                                    @error('name')

                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>

                                    @enderror

                                </div>



                                <div class="col-md-6">

                                    <label class="form-label">
                                        Email
                                    </label>

                                    <input type="email"
                                        name="email"
                                        class="form-control"
                                        value="{{ old('email') }}"
                                        placeholder="Your email">

                                    @error('email')

                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>

                                    @enderror

                                </div>



                                <div class="col-12">

                                    <label class="form-label">
                                        Phone
                                    </label>

                                    <input type="text"
                                        name="phone"
                                        class="form-control"
                                        value="{{ old('phone') }}"
                                        placeholder="Your phone number">

                                    @error('phone')

                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>

                                    @enderror

                                </div>



                                <div class="col-12">

                                    <label class="form-label">
                                        Message
                                    </label>

                                    <textarea
                                        name="message"
                                        rows="5"
                                        class="form-control"
                                        placeholder="How can we help?">{{ old('message') }}</textarea>

                                    @error('message')

                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>

                                    @enderror

                                </div>



                                <div class="col-12">

                                    <button type="submit"
                                        class="btn btn-main">

                                        Send Message

                                        <i class="fa-solid fa-paper-plane ms-2"></i>

                                    </button>

                                </div>


                            </div>

                        </form>

                    </div>

                </div>


            </div>

        </div>

    </section>



    <!-- =========================
         MAP
    ========================== -->

    <section class="section map-section"
        id="location">

        <div class="container">


            <div class="text-center mb-5">

                <div class="eyebrow">
                    Our Location
                </div>


                <h2 class="section-title">

                    Find Us

                </h2>


                <p class="section-subtitle mx-auto">

                    Visit Paradise Hotel and enjoy a comfortable
                    stay in Yangon, Myanmar.

                </p>

            </div>


            <div class="map-wrapper">

                <iframe
                    src="https://www.openstreetmap.org/export/embed.html?bbox=96.15%2C16.82%2C96.20%2C16.86&layer=mapnik&marker=16.8409%2C96.1735"
                    loading="lazy">
                </iframe>

            </div>


            <div class="text-center mt-3">

                <small class="text-muted">

                    <i class="fa-solid fa-location-dot me-1"
                        style="color: var(--accent);"></i>

                    Paradise Hotel — Yangon, Myanmar

                </small>

            </div>

        </div>

    </section>



    <!-- =========================
         FOOTER
    ========================== -->

    <footer>

        <div class="container">

            <div class="row g-5">


                <div class="col-lg-4">

                    <h4>

                        Paradise
                        <span style="color: var(--accent);">
                            .
                        </span>

                    </h4>


                    <p>

                        A comfortable and modern hotel experience
                        designed to make every stay memorable.

                    </p>


                    <div class="socials mt-4">


                        <a href="#">

                            <i class="fa-brands fa-facebook-f"></i>

                        </a>


                        <a href="#">

                            <i class="fa-brands fa-instagram"></i>

                        </a>


                        <a href="#">

                            <i class="fa-brands fa-x-twitter"></i>

                        </a>


                    </div>

                </div>



                <div class="col-lg-2 col-md-4">

                    <h5>
                        Explore
                    </h5>


                    <ul>

                        <li>
                            <a href="#home">
                                Home
                            </a>
                        </li>

                        <li>
                            <a href="#about">
                                About
                            </a>
                        </li>

                        <li>
                            <a href="#rooms">
                                Rooms
                            </a>
                        </li>

                        <li>
                            <a href="#services">
                                Services
                            </a>
                        </li>

                    </ul>

                </div>



                <div class="col-lg-2 col-md-4">

                    <h5>
                        Hotel
                    </h5>


                    <ul>

                        <li>
                            <a href="#contact">
                                Contact
                            </a>
                        </li>

                        <li>
                            <a href="#location">
                                Location
                            </a>
                        </li>

                        <li>
                            <a href="#rooms">
                                Book a Room
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                Privacy
                            </a>
                        </li>

                    </ul>

                </div>



                <div class="col-lg-4 col-md-4">

                    <h5>
                        Contact
                    </h5>


                    <p>
                        Yangon, Myanmar
                    </p>


                    <p>
                        +95 9 000 000 000
                    </p>


                    <p>
                        info@paradisehotel.com
                    </p>

                </div>


            </div>



            <div class="copyright">

                © {{ date('Y') }} Paradise Hotel.
                All Rights Reserved.

            </div>

        </div>

    </footer>



    <!-- =========================
         BOOTSTRAP JS
    ========================== -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>



    <!-- =========================
         BOOKING SCRIPT
    ========================== -->

    <script>

        function checkAvailability() {

            const checkIn =
                document.getElementById("checkIn").value;

            const checkOut =
                document.getElementById("checkOut").value;


            if (!checkIn || !checkOut) {

                alert(
                    "Please select your check-in and check-out dates."
                );

                return;
            }


            if (new Date(checkOut) <= new Date(checkIn)) {

                alert(
                    "Check-out date must be after check-in date."
                );

                return;
            }


            document.getElementById("rooms").scrollIntoView({
                behavior: "smooth"
            });

        }

    </script>


</body>

</html>