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
        --cream: #fbf7ee;
    }

    body {
        background-color: var(--background);
        color: var(--text);
    }

    /* =========================
       MAIN PAGE
    ========================= */

    .booking-page {
        padding-top: 110px;
        padding-bottom: 100px;
    }

    /* =========================
       ROOM BOOKING HEADER
    ========================= */

    .booking-main-card {
        border: 1px solid var(--border) !important;
        border-radius: 16px !important;
        overflow: hidden;
        background: var(--white);
    }

    .booking-main-header {
        background: linear-gradient(
            135deg,
            var(--primary),
            var(--primary-light)
        );
        color: white;
        padding: 20px 25px;
        border-bottom: 3px solid var(--accent);
    }

    .booking-main-header h3 {
        font-family: "Playfair Display", serif;
        font-weight: 700;
    }

    .history-btn {
        background-color: white;
        color: var(--primary);
        border: 1px solid var(--accent);
        padding: 9px 18px;
        border-radius: 25px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: 0.3s ease;
    }

    .history-btn:hover {
        background-color: var(--accent);
        color: var(--primary);
    }

    /* =========================
       BOOKING DATE
    ========================= */

    .booking-date-box {
        background-color: var(--cream);
        border: 1px solid #eee1c6;
        border-radius: 10px;
        padding: 15px 20px;
    }

    .booking-date-label {
        color: var(--muted);
        font-size: 13px;
    }

    .booking-date-value {
        color: var(--primary);
        font-weight: 700;
    }

    /* =========================
       ALERTS
    ========================= */

    .custom-alert {
        border-radius: 10px;
        border: none;
    }

    /* =========================
       ROOM IMAGE CARD
    ========================= */

    .room-preview-card {
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        background-color: var(--white);
        box-shadow: 0 8px 25px rgba(11, 31, 51, 0.08);
        height: 100%;
    }

    .room-image-wrapper {
        position: relative;
        overflow: hidden;
    }

    .room-image-wrapper img {
        height: 265px;
        object-fit: cover;
    }

    .room-image-wrapper .carousel-item {
        background-color: var(--primary);
    }

    .room-preview-body {
        padding: 22px;
    }

    .room-preview-title {
        color: var(--primary);
        font-family: "Playfair Display", serif;
        font-weight: 700;
        font-size: 24px;
        margin-bottom: 15px;
    }

    .room-detail {
        color: var(--muted);
        font-size: 14px;
        padding: 7px 0;
        border-bottom: 1px solid var(--border);
    }

    .room-detail:last-child {
        border-bottom: none;
    }

    .room-detail strong {
        color: var(--primary);
    }

    .room-price {
        color: var(--accent) !important;
        font-size: 17px;
        font-weight: 700;
    }

    /* Carousel */
    .carousel-control-prev,
    .carousel-control-next {
        width: 45px;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(11, 31, 51, 0.75);
        border-radius: 50%;
        padding: 18px;
        background-size: 50%;
    }

    /* =========================
       BOOKING STEP CARDS
    ========================= */

    .booking-step-card {
        border: 1px solid var(--border) !important;
        border-radius: 16px !important;
        overflow: hidden;
        background-color: var(--white);
        box-shadow: 0 8px 25px rgba(11, 31, 51, 0.07) !important;
    }

    .step-header {
        background: linear-gradient(
            135deg,
            var(--primary),
            var(--primary-light)
        );
        color: white;
        padding: 17px 22px;
        border-bottom: 3px solid var(--accent);
    }

    .step-header h4,
    .step-header h3 {
        font-family: "Playfair Display", serif;
        font-weight: 700;
    }

    /* =========================
       FORM
    ========================= */

    .form-label {
        color: var(--primary);
        font-size: 14px;
    }

    .form-control,
    .form-select {
        border: 1px solid #dcdedb;
        border-radius: 9px;
        color: var(--text);
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 0.2rem rgba(200, 164, 93, 0.18);
    }

    .form-control-lg {
        padding: 11px 14px;
    }

    /* =========================
       ROOM TYPE BUTTONS
    ========================= */

    .room-type-btn {
        background-color: white;
        color: var(--primary);
        border: 2px solid var(--primary);
        padding: 10px 18px;
        border-radius: 9px;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .room-type-btn:hover {
        background-color: var(--primary-light);
        color: white;
        border-color: var(--primary-light);
    }

    .room-type-btn.active {
        background-color: var(--primary);
        color: white;
        border-color: var(--accent);
        box-shadow: 0 4px 10px rgba(11, 31, 51, 0.15);
    }

    /* =========================
       AVAILABLE ROOMS
    ========================= */

    .available-label {
        color: var(--primary);
    }

    .room-btn {
        padding: 11px 22px;
        min-width: 70px;
        border-radius: 9px;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .room-btn.btn-primary {
        background-color: var(--primary) !important;
        border-color: var(--accent) !important;
        color: white !important;
    }

    .room-btn.btn-outline-primary {
        background-color: white !important;
        color: var(--primary) !important;
        border: 2px solid var(--primary) !important;
    }

    .room-btn.btn-outline-primary:hover {
        background-color: var(--primary-light) !important;
        color: white !important;
    }

    .no-room {
        color: #a13d34;
        background-color: #f8e9e7;
        border: 1px solid #e4bbb7;
        padding: 10px 15px;
        border-radius: 8px;
        font-size: 14px;
    }

    /* =========================
       MAIN BUTTONS
    ========================= */

    .booking-action-btn {
        background-color: var(--primary);
        color: white;
        padding: 13px;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .booking-action-btn:hover {
        background-color: var(--accent);
        color: var(--primary);
    }

    .confirm-btn {
        background-color: var(--primary);
        color: white;
    }

    .confirm-btn:hover {
        background-color: var(--accent);
        color: var(--primary);
    }

    /* =========================
       SUMMARY
    ========================= */

    .summary-box {
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 18px;
        border: 1px solid var(--border);
    }

    .customer-summary {
        background-color: var(--background);
    }

    .room-summary {
        background-color: var(--cream);
        border-color: #eee1c6;
    }

    .price-summary {
        background-color: var(--cream);
        border-color: #eee1c6;
    }

    .summary-box p {
        color: var(--text);
    }

    .summary-box b {
        color: var(--primary);
    }

    .summary-room-name {
        color: var(--primary);
        font-family: "Playfair Display", serif;
        font-weight: 700;
    }

    .price-summary hr {
        border-color: #ded4bd;
        opacity: 1;
    }

    .total-cost {
        color: var(--accent);
        font-size: 21px;
        font-weight: 700;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 767px) {

        .booking-page {
            padding-top: 90px;
            padding-bottom: 60px;
        }

        .booking-main-header {
            padding: 16px;
        }

        .booking-main-header h3 {
            font-size: 21px;
        }

        .history-btn {
            padding: 7px 12px;
            font-size: 12px;
        }

        .room-preview-body {
            padding: 18px;
        }

        .room-preview-title {
            font-size: 21px;
        }

        .step-header {
            padding: 15px 18px;
        }
    }
</style>


<div class="container booking-page mt-5">

    <!-- =========================
         ROOM BOOKING HEADER
    ========================== -->

    <div class="card shadow-sm mb-4 booking-main-card">

        <div class="booking-main-header d-flex justify-content-between align-items-center">

            <h3 class="mb-0">
                Room Booking
            </h3>

            <a href="{{ route('user.booking.viewAllList', Auth::user()->id) }}"
               class="history-btn">
                All My Bookings
            </a>

        </div>

        <div class="card-body">

            <div class="booking-date-box">

                <span class="booking-date-label">
                    Booking Date
                </span>

                <br>

                <span class="booking-date-value">
                    {{ \Carbon\Carbon::now()->format('Y-m-d') }}
                </span>

            </div>

        </div>

    </div>


    <!-- =========================
         ALERTS
    ========================== -->

    @if ($errors->any())

        <div class="alert alert-danger alert-dismissible fade show custom-alert"
             role="alert">

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    @if (session('success'))

        <div class="alert alert-success alert-dismissible fade show custom-alert"
             role="alert">

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    @if (session('error'))

        <div class="alert alert-danger alert-dismissible fade show custom-alert"
             role="alert">

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    <div class="row g-4 mb-5">

        <!-- =========================
             LEFT: ROOM PREVIEW
        ========================== -->

        <div class="col-md-4">

            <div class="room-preview-card">

                <div class="room-image-wrapper">

                    <div id="roomCarousel"
                         class="carousel slide"
                         data-bs-ride="carousel">

                        <div class="carousel-inner"
                             id="carouselImages">

                            <div class="carousel-item active">

                                <img src="https://via.placeholder.com/500x300"
                                     class="d-block w-100"
                                     style="height:265px; object-fit:cover;">

                            </div>

                        </div>


                        <button class="carousel-control-prev"
                                type="button"
                                data-bs-target="#roomCarousel"
                                data-bs-slide="prev">

                            <span class="carousel-control-prev-icon"></span>

                        </button>


                        <button class="carousel-control-next"
                                type="button"
                                data-bs-target="#roomCarousel"
                                data-bs-slide="next">

                            <span class="carousel-control-next-icon"></span>

                        </button>

                    </div>

                </div>


                <div class="room-preview-body">

                    <h5 class="room-preview-title"
                        id="roomName">
                    </h5>

                    <div class="room-detail room-price"
                         id="roomPrice">
                    </div>

                    <div class="room-detail"
                         id="roomBedType">
                    </div>

                    <div class="room-detail"
                         id="roomCapacity">
                    </div>

                    <div class="room-detail"
                         id="roomFacility">
                    </div>

                    <div class="room-detail"
                         id="roomDescription">
                    </div>

                </div>

            </div>

        </div>


        <!-- =========================
             RIGHT: BOOKING STEPS
        ========================== -->

        <div class="col-md-8">

            <!-- =====================
                 STEP 1
            ====================== -->

            <div class="card shadow-sm mb-4 border-0 booking-step-card"
                 id="bookingStep">

                <div class="step-header">

                    <h4 class="mb-0">
                        Booking Details
                    </h4>

                </div>


                <div class="card-body p-4">

                    <!-- Dates -->

                    <div class="row g-3 mb-4">

                        <div class="col-md-6">

                            <label class="form-label fw-bold">
                                Check-In
                            </label>

                            <input type="date"
                                   id="checkIn"
                                   class="form-control form-control-lg"
                                   value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">

                        </div>


                        <div class="col-md-6">

                            <label class="form-label fw-bold">
                                Check-Out
                            </label>

                            <input type="date"
                                   id="checkOut"
                                   class="form-control form-control-lg"
                                   value="{{ \Carbon\Carbon::now()->addDay()->format('Y-m-d') }}">

                        </div>

                    </div>


                    <!-- Room Type -->

                    <div class="mb-4">

                        <label class="form-label fw-bold">
                            Choose Room Type
                        </label>

                        <div id="roomTypeButtons"
                             class="d-flex flex-wrap gap-2 mt-2">

                            @foreach ($roomTypes as $type)

                                <button type="button"
                                        class="room-type-btn"
                                        data-id="{{ $type->id }}"
                                        data-images='@json($type->RoomTypeImages, JSON_HEX_APOS | JSON_HEX_QUOT)'
                                        data-price="{{ $type->price }}">

                                    {{ $type->room_type }}

                                </button>

                                <input type="hidden"
                                       name="price"
                                       id="price"
                                       value="{{ $type->price }}">

                            @endforeach

                        </div>

                    </div>


                    <!-- Available Rooms -->

                    <div class="mb-4">

                        <label class="form-label fw-bold available-label">
                            Available Rooms
                        </label>

                        <div id="availableRooms"
                             class="d-flex flex-wrap gap-2 mt-2">
                        </div>

                        <input type="hidden"
                               id="finalRoomId">

                    </div>


                    <!-- Continue -->

                    <button type="button"
                            id="goToCustomer"
                            class="booking-action-btn w-100 mt-2">

                        Continue →

                    </button>

                </div>

            </div>


            <!-- =====================
                 STEP 2
            ====================== -->

            <div class="card shadow-sm mb-4 border-0 booking-step-card"
                 id="customerStep"
                 style="display:none;">

                <div class="step-header">

                    <h4 class="mb-0">
                        Customer Details
                    </h4>

                </div>


                <div class="card-body p-4">

                    <div class="row g-3">

                        <!-- Name -->

                        <div class="col-md-6">

                            <label class="form-label fw-bold">
                                Full Name
                            </label>

                            <input type="text"
                                   id="inputName"
                                   class="form-control form-control-lg"
                                   placeholder="Enter your name"
                                   value="{{ Auth::user()->name }}">

                            @error('name')

                                <p class="text-danger">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        <!-- Email -->

                        <div class="col-md-6">

                            <label class="form-label fw-bold">
                                Email Address
                            </label>

                            <input type="email"
                                   id="inputEmail"
                                   class="form-control form-control-lg"
                                   placeholder="example@gmail.com"
                                   name="email"
                                   value="{{ Auth::user()->email }}">

                            @error('email')

                                <p class="text-danger">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        <!-- Phone -->

                        <div class="col-md-6">

                            <label class="form-label fw-bold">
                                Phone Number
                            </label>

                            <input type="number"
                                   id="inputPhone"
                                   class="form-control form-control-lg"
                                   placeholder="09xxxxxxxxx"
                                   name="phone"
                                   value="{{ Auth::user()->phone }}"
                                   required>

                            @error('phone')

                                <p class="text-danger">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        <!-- NRC -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-bold">
                                NRC
                            </label>

                            <div class="row g-2">

                                <div class="col-3">

                                    <select id="fullNrcCode"
                                            class="form-control">

                                        <option value="">
                                            State/Region
                                        </option>

                                        @for ($i = 1; $i <= 14; $i++)

                                            <option value="{{ $i }}"
                                                {{ old('nrc_code') == $i ? 'selected' : '' }}>

                                                {{ $i }}/

                                            </option>

                                        @endfor

                                    </select>

                                </div>


                                <div class="col-5">

                                    <select id="fullNrcTownship"
                                            class="form-control">

                                        <option value="">
                                            Township
                                        </option>

                                        @foreach ($nrcData['data'] as $item)

                                            <option value="{{ $item['name_en'] }}"
                                                    data-state="{{ $item['nrc_code'] }}"
                                                    {{ old('nrc_township') == $item['name_en'] ? 'selected' : '' }}>

                                                {{ $item['name_mm'] }}

                                            </option>

                                        @endforeach

                                    </select>

                                </div>


                                <div class="col-2">

                                    <select id="fullNrcType"
                                            class="form-control">

                                        <option value="N"
                                            {{ old('nrc_type') == 'N' ? 'selected' : '' }}>
                                            (N)
                                        </option>

                                        <option value="E"
                                            {{ old('nrc_type') == 'E' ? 'selected' : '' }}>
                                            (E)
                                        </option>

                                        <option value="P"
                                            {{ old('nrc_type') == 'P' ? 'selected' : '' }}>
                                            (P)
                                        </option>

                                    </select>

                                </div>


                                <div class="col-2">

                                    <input type="text"
                                           id="inputCredential"
                                           class="form-control"
                                           maxlength="6"
                                           placeholder="123456"
                                           value="{{ old('nrc_number') }}">

                                </div>


                                @error('credential')

                                    <span class="text-danger mt-1">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>

                        </div>


                        <!-- Address -->

                        <div class="col-12">

                            <label class="form-label fw-bold">
                                Address
                            </label>

                            <textarea id="inputAddress"
                                      rows="2"
                                      name="address"
                                      class="form-control form-control-lg"
                                      required
                                      placeholder="Enter your address">{{ Auth::user()->address }}</textarea>

                            @error('address')

                                <p class="text-danger">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>


                    <button type="button"
                            id="saveProfile"
                            class="booking-action-btn w-100 mt-4">

                        Continue to Summary →

                    </button>

                </div>

            </div>


            <!-- =====================
                 STEP 3
            ====================== -->

            <div class="card shadow-sm mb-4 border-0 booking-step-card"
                 id="bookingSummary"
                 style="display:none;">

                <div class="step-header d-flex justify-content-between align-items-center">

                    <h3 class="mb-0">
                        Booking Summary
                    </h3>

                    <a href="{{ route('user.dashboard.bookingRoom') }}"
                       class="history-btn">

                        Back

                    </a>

                </div>


                <div class="card-body p-4">

                    <!-- Customer Info -->

                    <div class="summary-box customer-summary">

                        <p class="mb-2">
                            <b>Name:</b>
                            <span id="summaryName"></span>
                        </p>

                        <p class="mb-2">
                            <b>Email:</b>
                            <span id="summaryEmail"></span>
                        </p>

                        <p class="mb-0">
                            <b>Phone:</b>
                            <span id="summaryPhone"></span>
                        </p>

                    </div>


                    <!-- Room Info -->

                    <div class="summary-box room-summary">

                        <h5 class="mb-3 summary-room-name"
                            id="summaryRoom">
                        </h5>

                        <p class="mb-2">
                            <b>Check-In:</b>
                            <span id="summaryCheckIn"></span>
                        </p>

                        <p class="mb-2">
                            <b>Check-Out:</b>
                            <span id="summaryCheckOut"></span>
                        </p>

                        <p class="mb-0">
                            <b>Nights:</b>
                            <span id="summaryNights"></span>
                        </p>

                    </div>


                    <!-- Price -->

                    <div class="summary-box price-summary">

                        <div class="d-flex justify-content-between mb-2">

                            <span>
                                Price / Night
                            </span>

                            <span id="summaryPrice"></span>

                        </div>


                        <div class="d-flex justify-content-between">

                            <span>
                                Total Nights
                            </span>

                            <span id="summaryNights"></span>

                        </div>


                        <hr>


                        <div class="d-flex justify-content-between align-items-center fw-bold">

                            <span style="font-size:18px;">
                                Total Cost
                            </span>

                            <span class="total-cost"
                                  id="summaryTotal">
                            </span>

                        </div>

                    </div>


                    <!-- Form -->

                    <form id="bookingForm"
                          action="{{ route('user.booking.store') }}"
                          method="POST">

                        @csrf

                        <input type="hidden"
                               name="check_in"
                               id="finalCheckIn">

                        <input type="hidden"
                               name="check_out"
                               id="finalCheckOut">

                        <input type="hidden"
                               name="room_id"
                               id="finalRoomIdForm">

                        <input type="hidden"
                               name="name"
                               id="finalName">

                        <input type="hidden"
                               name="email"
                               id="finalEmail">

                        <input type="hidden"
                               name="phone"
                               id="finalPhone">

                        <input type="hidden"
                               name="credential"
                               id="finalCredential">

                        <input type="hidden"
                               name="address"
                               id="finalAddress">


                        <button type="button"
                                id="confirmBooking"
                                class="booking-action-btn confirm-btn w-100 mt-3">

                            Confirm Booking

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

    $(document).ready(function() {

        // Generate NRC
        function generateNRC() {

            const code = $('#fullNrcCode').val();
            const township = $('#fullNrcTownship').val();
            const type = $('#fullNrcType').val();
            const number = $('#fullNrcNumber').val();

            if (code && township && type && number) {

                $('#fullCredential').val(
                    `${code}/${township}(${type})${number}`
                );

            }

        }

        $('#fullNrcCode, #fullNrcTownship, #fullNrcType, #fullNrcNumber')
            .on('change keyup', generateNRC);


        // Filter Townships by State

        $('#fullNrcCode').on('change', function() {

            const code = $(this).val();

            $('#fullNrcTownship option').each(function() {

                const state = $(this).data('state');

                $(this).toggle(
                    state == code || $(this).val() == ''
                );

            });

        });


        let selectedRoomType = null;
        let selectedRoomId = null;


        // Check-in / Check-out min date

        function updateCheckOutMin() {

            const checkIn = $('#checkIn').val();

            if (!checkIn) return;

            const next = new Date(checkIn);

            next.setDate(next.getDate() + 1);

            const dd = String(next.getDate()).padStart(2, '0');
            const mm = String(next.getMonth() + 1).padStart(2, '0');
            const yyyy = next.getFullYear();

            $('#checkOut').attr(
                'min',
                `${yyyy}-${mm}-${dd}`
            );

            if ($('#checkOut').val() < $('#checkOut').attr('min')) {

                $('#checkOut').val(
                    $('#checkOut').attr('min')
                );

            }

        }


        updateCheckOutMin();


        $('#checkIn').on('change', function() {

            updateCheckOutMin();

            fetchAvailableRooms();

        });


        $('#checkOut').on('change', fetchAvailableRooms);


        // Select room type

        function selectRoomType(btn) {

            selectedRoomType = btn.data('id');

            $('.room-type-btn').removeClass('active');

            btn.addClass('active');

            let images = btn.data('images');

            let carousel = $('#carouselImages');

            carousel.empty();


            if (images && images.length > 0) {

                images.forEach((img, index) => {

                    let imgUrl = img.img_src.startsWith('http')
                        ? img.img_src
                        : `{{ asset('') }}${img.img_src}`;

                    carousel.append(

                        `<div class="carousel-item ${index === 0 ? 'active' : ''}">
                            <img src="${imgUrl}"
                                 class="d-block w-100"
                                 style="height:265px; object-fit:cover;">
                        </div>`

                    );

                });

            } else {

                carousel.append(

                    `<div class="carousel-item active">
                        <img src="https://via.placeholder.com/500x300"
                             class="d-block w-100"
                             style="height:265px; object-fit:cover;">
                    </div>`

                );

            }


            let roomData = @json($roomTypes->keyBy('id'));

            let selected = roomData[selectedRoomType];

            $('#roomName').text(selected.room_type);

            $('#roomPrice').text(
                '1 night: ' + selected.price + " kyats"
            );

            $('#roomBedType').text(
                'Bed Type: ' + selected.bed
            );

            $('#roomCapacity').text(
                'Capacity: ' + selected.capacity
            );

            $('#roomFacility').text(
                'Facility: ' + selected.facility
            );

            $('#roomDescription').text(
                'Description: ' + selected.description
            );

            fetchAvailableRooms();

        }


        $(document).on(
            'click',
            '.room-type-btn',
            function() {

                selectRoomType($(this));

            }
        );


        selectRoomType(
            $('.room-type-btn').first()
        );


        // Fetch available rooms

        function fetchAvailableRooms() {

            const checkIn = $('#checkIn').val();
            const checkOut = $('#checkOut').val();

            if (!selectedRoomType || !checkIn || !checkOut) {
                return;
            }


            $.get(
                "{{ route('user.booking.availableRooms') }}",
                {
                    room_type_id: selectedRoomType,
                    check_in: checkIn,
                    check_out: checkOut
                },
                function(data) {

                    let container = $('#availableRooms');

                    container.empty();


                    if (data.rooms.length === 0) {

                        container.append(
                            '<span class="no-room">No rooms available</span>'
                        );

                        return;

                    }


                    data.rooms.forEach(function(room, index) {

                        let activeClass =
                            index === 0
                                ? 'btn-primary'
                                : 'btn-outline-primary';


                        container.append(

                            `<button class="btn ${activeClass} me-2 mb-2 room-btn"
                                     data-id="${room.id}">
                                ${room.room_number}
                            </button>`

                        );


                        if (index === 0) {

                            selectedRoomId = room.id;

                            $('#finalRoomId').val(
                                selectedRoomId
                            );

                        }

                    });

                }
            );

        }


        $(document).on(
            'click',
            '.room-btn',
            function() {

                $('.room-btn')
                    .removeClass('btn-primary')
                    .addClass('btn-outline-primary');

                $(this)
                    .removeClass('btn-outline-primary')
                    .addClass('btn-primary');

                selectedRoomId = $(this).data('id');

                $('#finalRoomId').val(
                    selectedRoomId
                );

            }
        );


        $('#goToCustomer').click(function() {

            if (
                !$('#checkIn').val() ||
                !$('#checkOut').val() ||
                !$('#finalRoomId').val()
            ) {

                alert('Please select all booking details!');

                return;

            }

            $('#bookingStep').hide();

            $('#customerStep').show();

        });


        // Save profile

        $('#saveProfile').click(function() {

            const checkIn = $('#checkIn').val();
            const checkOut = $('#checkOut').val();

            const roomName = $('#roomName').text();

            var price = $('#price').val();

            const nights = Math.ceil(
                (new Date(checkOut) - new Date(checkIn)) /
                (1000 * 60 * 60 * 24)
            );

            const total = price * nights;

            const name = $('#inputName').val();
            const email = $('#inputEmail').val();
            const phone = $('#inputPhone').val();
            const credential = $('#inputCredential').val();
            const address = $('#inputAddress').val();


            $('#summaryRoom').text(roomName);

            $('#summaryCheckIn').text(checkIn);

            $('#summaryCheckOut').text(checkOut);

            $('#summaryNights').text(nights);

            $('#summaryPrice').text(
                `$ ${price}`
            );

            $('#summaryTotal').text(
                `$ ${total}`
            );

            $('#summaryName').text(name);

            $('#summaryEmail').text(email);

            $('#summaryPhone').text(phone);

            $('#summaryCredential').text(credential);

            $('#summaryAddress').text(address);


            $('#finalCheckIn').val(checkIn);

            $('#finalCheckOut').val(checkOut);

            $('#finalRoomIdForm').val(
                $('#finalRoomId').val()
            );

            $('#finalName').val(name);

            $('#finalEmail').val(email);

            $('#finalPhone').val(phone);

            $('#finalCredential').val(credential);

            $('#finalAddress').val(address);


            $('#customerStep').hide();

            $('#bookingSummary').show();

        });


        // Confirm booking -> submit form

        $('#confirmBooking').click(function() {

            $('#bookingForm').submit();

        });

    });

</script>

@endsection