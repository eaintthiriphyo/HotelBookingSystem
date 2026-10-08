@extends('layouts.userLayout')

@section('content')

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

    .dashboard-page {
        background: var(--background);
        color: var(--text);
        font-family: "DM Sans", sans-serif;
    }

    .dashboard-page h1,
    .dashboard-page h2,
    .dashboard-page h3,
    .dashboard-page h4,
    .dashboard-page h5 {
        font-family: "Playfair Display", serif;
    }

    /* =========================
       HERO
    ========================== */

    .dashboard-hero {
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

.dashboard-hero-content {
    max-width: 1250px;
    width: 100%;
    margin: auto;
    padding: 100px 20px 80px;
}

    .hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 20px;
    }

    .hero-eyebrow::before {
        content: "";
        width: 35px;
        height: 1px;
        background: var(--accent);
    }

    .dashboard-hero h1 {
        font-size: clamp(48px, 7vw, 82px);
        line-height: 1;
        max-width: 750px;
        margin-bottom: 25px;
    }

    .dashboard-hero p {
        max-width: 560px;
        font-size: 18px;
        line-height: 1.8;
        color: rgba(255,255,255,.88);
    }

    .dashboard-btn {
        display: inline-block;
        background: var(--accent);
        color: white;
        border: none;
        padding: 14px 25px;
        border-radius: 12px;
        font-weight: 600;
        transition: .3s;
    }

    .dashboard-btn:hover {
        background: white;
        color: var(--primary);
    }

    /* =========================
       COMMON
    ========================== */

    .dashboard-section {
        padding: 100px 0;
    }

    .dashboard-section-title {
        font-size: clamp(36px, 4vw, 56px);
        line-height: 1.1;
        margin-bottom: 20px;
    }

    .dashboard-eyebrow {
        color: var(--accent);
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        font-size: 13px;
        margin-bottom: 15px;
    }

    .dashboard-subtitle {
        color: var(--muted);
        line-height: 1.8;
        max-width: 650px;
    }

    /* =========================
       ABOUT
    ========================== */

    .dashboard-about-image {
        width: 100%;
        height: 560px;
        object-fit: cover;
        border-radius: 25px;
    }

    .dashboard-about-content {
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

    .dashboard-rooms {
        background: white;
    }

    .dashboard-room-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 22px;
        overflow: hidden;
        height: 100%;
        transition: .35s;
    }

    .dashboard-room-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(0,0,0,.10);
    }

    .dashboard-room-image-wrapper {
        position: relative;
        height: 280px;
        overflow: hidden;
    }

    .dashboard-room-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: .5s;
    }

    .dashboard-room-card:hover .dashboard-room-image {
        transform: scale(1.06);
    }

    .dashboard-room-tag {
        position: absolute;
        top: 18px;
        left: 18px;
        background: white;
        padding: 7px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .dashboard-room-content {
        padding: 25px;
    }

    .dashboard-room-content h3 {
        font-size: 27px;
        margin-bottom: 8px;
    }

    .dashboard-room-price {
        color: var(--accent);
        font-weight: 700;
        font-size: 19px;
        white-space: nowrap;
    }

    .dashboard-room-meta {
        display: flex;
        gap: 18px;
        flex-wrap: wrap;
        margin: 20px 0;
        color: var(--muted);
        font-size: 14px;
    }

    .dashboard-room-meta i {
        color: var(--accent);
        margin-right: 5px;
    }

    .dashboard-room-description {
        color: var(--muted);
        line-height: 1.7;
        font-size: 14px;
    }

    .dashboard-room-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-top: 22px;
    }

    .dashboard-room-link {
        color: var(--primary);
        font-weight: 700;
        white-space: nowrap;
    }

    .dashboard-room-link:hover {
        color: var(--accent);
    }

    /* =========================
       SERVICES
    ========================== */

    .dashboard-service-card {
        padding: 35px 28px;
        background: white;
        border: 1px solid var(--border);
        border-radius: 20px;
        height: 100%;
        transition: .3s;
    }

    .dashboard-service-card:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-6px);
    }

    .dashboard-service-icon {
        font-size: 30px;
        color: var(--accent);
        margin-bottom: 25px;
    }

    .dashboard-service-card p {
        color: var(--muted);
        line-height: 1.7;
    }

    .dashboard-service-card:hover p {
        color: rgba(255,255,255,.7);
    }

    /* =========================
       CONTACT
    ========================== */

    .dashboard-contact {
        background: var(--primary);
        color: white;
    }

    .dashboard-contact .dashboard-subtitle {
        color: rgba(255,255,255,.7);
    }

    .dashboard-contact-info {
        margin-top: 35px;
    }

    .dashboard-contact-item {
        display: flex;
        gap: 15px;
        margin-bottom: 25px;
    }

    .dashboard-contact-item i {
        color: var(--accent);
        font-size: 20px;
        width: 25px;
    }

    .dashboard-contact-form {
        background: white;
        padding: 35px;
        border-radius: 22px;
        color: var(--text);
    }

    .dashboard-contact-form .form-control {
        border: 1px solid var(--border);
        padding: 13px 15px;
        border-radius: 10px;
    }

    .dashboard-contact-form .form-control:focus {
        border-color: var(--accent);
        box-shadow: none;
    }

    /* =========================
       MAP
    ========================== */

    .dashboard-map-section {
        background: var(--background);
    }

    .dashboard-map-wrapper {
        width: 100%;
        overflow: hidden;
        border-radius: 24px;
        box-shadow: 0 15px 45px rgba(0,0,0,.12);
    }

    .dashboard-map-wrapper iframe {
        display: block;
        width: 100%;
        height: 430px;
        border: 0;
    }

    /* =========================
       RESPONSIVE
    ========================== */

    @media (max-width: 991px) {

        .dashboard-about-content {
            padding-left: 0;
            margin-top: 40px;
        }

        .dashboard-about-image {
            height: 450px;
        }
    }

    @media (max-width: 575px) {

        .dashboard-hero-content {
            padding: 120px 20px 90px;
        }

        .dashboard-hero h1 {
            font-size: 48px;
        }

        .dashboard-section {
            padding: 75px 0;
        }

        .dashboard-about-image {
            height: 350px;
        }

        .dashboard-contact-form {
            padding: 25px;
        }

        .dashboard-room-footer {
            align-items: flex-start;
            flex-direction: column;
        }

        .dashboard-map-wrapper iframe {
            height: 350px;
        }
    }
</style>


<div class="dashboard-page">

    <!-- =========================
         HERO
    ========================== -->

    <section class="dashboard-hero">

        <div class="dashboard-hero-content">

            <div class="hero-eyebrow text-white">
                Welcome Back
            </div>

            <h1 class="text-white">
                Find Your
                Perfect Room.
            </h1>

            <p>
                Discover comfortable rooms, thoughtful service and
                everything you need for a relaxing stay at Paradise Hotel.
            </p>

            <div class="mt-4">

                <a href="#rooms" class="dashboard-btn">
                    Explore Rooms
                    <i class="fa-solid fa-arrow-right ms-2"></i>
                </a>

            </div>

        </div>

    </section>


    <!-- =========================
         ABOUT
    ========================== -->

    <section class="dashboard-section " id="about">

        <div class="container ">

            <div class="row align-items-center g-5">

                <div class="col-lg-6">

                    <img
                        src="{{ asset('images/about2.jpg') }}"
                        class="dashboard-about-image"
                        alt="Hotel Paradise">

                </div>

                <div class="col-lg-6">

                    <div class="dashboard-about-content">

                        <div class="dashboard-eyebrow">
                            About Paradise
                        </div>

                        <h2 class="dashboard-section-title">
                            A place made for
                            slowing down.
                        </h2>

                        <p class="dashboard-subtitle">
                            Welcome to <strong>Hotel Paradise</strong>.
                            We offer comfortable rooms, excellent dining,
                            modern facilities and friendly service to make
                            your stay memorable.
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
                           class="dashboard-btn mt-3">

                            Explore Our Rooms

                            <i class="fa-solid fa-arrow-right ms-2"></i>

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =========================
         ROOMS
    ========================== -->

    <section class="dashboard-section dashboard-rooms"
             id="rooms">

        <div class="container">

            <div class="row align-items-end mb-5">

                <div class="col-lg-7">

                    <div class="dashboard-eyebrow">
                        Stay With Us
                    </div>

                    <h2 class="dashboard-section-title">
                        Rooms designed
                        around you.
                    </h2>

                </div>

                <div class="col-lg-5">

                    <p class="dashboard-subtitle ms-lg-auto">
                        Choose the room that fits your stay.
                        Every room combines comfort, space and
                        the essentials you need.
                    </p>

                </div>

            </div>


            <div class="row g-4">

                @foreach ($roomType as $rt)

                    <div class="col-xl-4 col-md-6">

                        <div class="dashboard-room-card">

                            <div class="dashboard-room-image-wrapper">

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
                                                        alt="{{ $rt->room_type }}">

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


                                <div class="dashboard-room-tag">
                                    Paradise Hotel
                                </div>

                            </div>


                            <div class="dashboard-room-content">

                                <div class="d-flex
                                            justify-content-between
                                            align-items-start
                                            gap-3">

                                    <h3>
                                        {{ $rt->room_type }}
                                    </h3>

                                    <div class="dashboard-room-price">

                                        {{ $rt->price }} kyats

                                    </div>

                                </div>


                                <div class="dashboard-room-meta">

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


                                <p class="dashboard-room-description">
                                    {{ $rt->description }}
                                </p>


                                <div class="dashboard-room-footer">

                                    <span class="text-muted small">
                                        {{ $rt->facility }}
                                    </span>

                                    <a
                                        href="{{ route('user.dashboard.bookingRoom') }}"
                                        class="dashboard-room-link">

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

    <section class="dashboard-section"
             id="services">

        <div class="container">

            <div class="row mb-5">

                <div class="col-lg-7">

                    <div class="dashboard-eyebrow">
                        Hotel Services
                    </div>

                    <h2 class="dashboard-section-title">
                        Everything you need,
                        all in one place.
                    </h2>

                </div>

            </div>


            <div class="row g-4">

                <!-- Service 1 -->
                <div class="col-lg-3 col-md-6">

                    <div class="dashboard-service-card">

                        <div class="dashboard-service-icon">
                            <i class="fa-solid fa-bed"></i>
                        </div>

                        <h4>Comfortable Rooms</h4>

                        <p>
                            Luxury rooms with modern facilities
                            designed for relaxation.
                        </p>

                    </div>

                </div>


                <!-- Service 2 -->
                <div class="col-lg-3 col-md-6">

                    <div class="dashboard-service-card">

                        <div class="dashboard-service-icon">
                            <i class="fa-solid fa-utensils"></i>
                        </div>

                        <h4>Restaurant</h4>

                        <p>
                            Enjoy delicious food and drinks
                            during your stay.
                        </p>

                    </div>

                </div>


                <!-- Service 3 -->
                <div class="col-lg-3 col-md-6">

                    <div class="dashboard-service-card">

                        <div class="dashboard-service-icon">
                            <i class="fa-solid fa-spa"></i>
                        </div>

                        <h4>Spa & Wellness</h4>

                        <p>
                            Relax and refresh your mind with
                            our wellness facilities.
                        </p>

                    </div>

                </div>


                <!-- Service 4 -->
                <div class="col-lg-3 col-md-6">

                    <div class="dashboard-service-card">

                        <div class="dashboard-service-icon">
                            <i class="fa-solid fa-wifi"></i>
                        </div>

                        <h4>Free Wi-Fi</h4>

                        <p>
                            Stay connected with convenient
                            internet access.
                        </p>

                    </div>

                </div>


                <!-- Service 5 -->
                <div class="col-lg-3 col-md-6">

                    <div class="dashboard-service-card">

                        <div class="dashboard-service-icon">
                            <i class="fa-solid fa-bus"></i>
                        </div>

                        <h4>Airport Shuttle</h4>

                        <p>
                            Convenient transfers to and from
                            the airport.
                        </p>

                    </div>

                </div>


                <!-- Service 6 -->
                <div class="col-lg-3 col-md-6">

                    <div class="dashboard-service-card">

                        <div class="dashboard-service-icon">
                            <i class="fa-solid fa-car"></i>
                        </div>

                        <h4>Parking</h4>

                        <p>
                            Secure and convenient parking
                            for hotel guests.
                        </p>

                    </div>

                </div>


                <!-- Service 7 -->
                <div class="col-lg-3 col-md-6">

                    <div class="dashboard-service-card">

                        <div class="dashboard-service-icon">
                            <i class="fa-solid fa-dumbbell"></i>
                        </div>

                        <h4>Gym</h4>

                        <p>
                            Modern fitness facilities for
                            all hotel guests.
                        </p>

                    </div>

                </div>


                <!-- Service 8 -->
                <div class="col-lg-3 col-md-6">

                    <div class="dashboard-service-card">

                        <div class="dashboard-service-icon">
                            <i class="fa-solid fa-martini-glass"></i>
                        </div>

                        <h4>Bar & Lounge</h4>

                        <p>
                            Relax and enjoy a comfortable
                            lounge atmosphere.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =========================
         CONTACT
    ========================== -->

    <section class="dashboard-section dashboard-contact"
             id="contact">

        <div class="container">

            <div class="row g-5 align-items-center">

                <div class="col-lg-5">

                    <div class="dashboard-eyebrow">
                        Get In Touch
                    </div>

                    <h2 class="dashboard-section-title">
                        Let's make your
                        stay special.
                    </h2>

                    <p class="dashboard-subtitle">
                        Have a question or need help?
                        Send us a message and our team will
                        get back to you.
                    </p>


                    <div class="dashboard-contact-info">

                        <div class="dashboard-contact-item">

                            <i class="fa-solid fa-location-dot"></i>

                            <span>
                                Paradise Hotel<br>
                                Yangon, Myanmar
                            </span>

                        </div>


                        <div class="dashboard-contact-item">

                            <i class="fa-solid fa-phone"></i>

                            <span>
                                +95 9 000 000 000
                            </span>

                        </div>


                        <div class="dashboard-contact-item">

                            <i class="fa-solid fa-envelope"></i>

                            <span>
                                info@paradisehotel.com
                            </span>

                        </div>

                    </div>

                </div>


                <div class="col-lg-7">

                    <div class="dashboard-contact-form">

                        @if (session('success'))

                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>

                        @endif


                        <form method="POST"
                              action="{{ route('contact.store') }}">

                            @csrf


                            <div class="row g-3">

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Full Name
                                    </label>

                                    <input
                                        type="text"
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

                                    <input
                                        type="email"
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

                                    <input
                                        type="text"
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

                                    <button
                                        type="submit"
                                        class="dashboard-btn">

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

    <section class="dashboard-section dashboard-map-section"
             id="location">

        <div class="container">

            <div class="text-center mb-5">

                <div class="dashboard-eyebrow">
                    Our Location
                </div>

                <h2 class="dashboard-section-title">
                    Find Us
                </h2>

                <p class="dashboard-subtitle mx-auto">
                    Visit Paradise Hotel and enjoy a comfortable
                    stay in Yangon, Myanmar.
                </p>

            </div>


            <div class="dashboard-map-wrapper">

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

</div>

@endsection

