@extends('layouts.userLayout')

@section('content')
    <!-- Rooms -->

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
                    <a href="#rooms" class="btn  btn-custom mt-3" style="background-color: navy;color:white">Explore
                        Rooms</a>
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
                                @if ($rt->RoomTypeImages->count() > 0)
                                    @foreach ($rt->RoomTypeImages as $img)
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <img src="{{ asset($img->img_src) }}" class="d-block w-100"
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
                            <p> 1 night : {{ $rt->price }} kyats </p>
                            <p>Bed Type: {{ $rt->bed }}</p>
                            <p>Capacity: {{ $rt->capacity }}</p>
                            <p>Facility: {{ $rt->facility }}</p>
                            <p>{{ $rt->description }}</p>
                            <a href="{{ route('user.dashboard.bookingRoom') }}" class="btn "
                                style="background-color: navy;color:white">Book Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>


    <!-- Services -->
    <section id="services" class="services py-5">
        <div class="container">
            <h1 class="section-title text-center mb-5">Our Services</h1>

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
                                    <input type="text" name="name" class="form-control">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control">
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control">
                                    @error('phone')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Message</label>
                                    <textarea name="message" class="form-control" rows="4"></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn px-4"
                                        style="background-color:navy;color:white">Send Message</button>
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
@endsection
