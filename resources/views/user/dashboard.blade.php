@extends('layouts.userLayout')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1>Find Your Perfect Hotel</h1>
            <p>Book the best rooms at the best hotels</p>
            <div class="search-bar">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search hotel or room">
                    <button class="btn btn-success btn-custom">Search</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Rooms -->
    



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
                                                    <img src="/images/{{ $img }}" class="d-block w-100"
                                                        style="height:250px; object-fit:cover;">
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="carousel-item active">
                                                <img src="https://via.placeholder.com/500x300" class="d-block w-100">
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Carousel controls -->
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
                                    <a href="{{ route('user.bookingRoom', ['room_type_id' => $rt->id]) }}"
                                        class="btn btn-primary btn-sm">Book Now</a>
                                </div>

                            </div>
                        </div>
                    @endforeach
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


            <!-- Contact Us Form -->
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
            </section>

            <!-- Google Map -->
            <section class="py-5 bg-light">
                <div class="container">
                    <h2 class="section-title text-center mb-4">Our Location</h2>
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!..." style="border:0;" allowfullscreen=""
                            loading="lazy"></iframe>
                    </div>
                </div>
            </section>
        @endsection
