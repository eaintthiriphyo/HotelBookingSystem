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

    body {
        background-color: var(--background);
    }

    .booking-page {
        padding-top: 110px;
        padding-bottom: 60px;
    }

    .booking-title {
        color: var(--primary);
        font-family: "Playfair Display", serif;
        font-size: 36px;
        font-weight: 700;
        position: relative;
        display: inline-block;
    }

    .booking-title::after {
        content: "";
        display: block;
        width: 55px;
        height: 3px;
        background-color: var(--accent);
        margin: 12px auto 0;
    }

    .booking-card {
        border-radius: 16px;
        overflow: hidden;
        background: var(--white);
        border: 1px solid var(--border) !important;
        transition: all 0.3s ease;
    }

    .booking-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(11, 31, 51, 0.12) !important;
    }

    /* Header */
    .booking-header {
        background: linear-gradient(
            135deg,
            var(--primary),
            var(--primary-light)
        );
        color: var(--white);
        border-bottom: 3px solid var(--accent);
    }

    .booking-id-label {
        color: rgba(255, 255, 255, 0.7);
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .booking-id {
        color: var(--white);
        font-size: 20px;
    }

    /* Status badges */
    .status-badge {
        padding: 8px 18px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 600;
    }

    .status-pending {
        background-color: rgba(200, 164, 93, 0.2);
        color: #e0bd73;
        border: 1px solid var(--accent);
    }

    .status-approved {
        background-color: #e8f3ed;
        color: #286b45;
        border: 1px solid #b9dcc7;
    }

    .status-cancelled {
        background-color: #f8e9e7;
        color: #a13d34;
        border: 1px solid #e4bbb7;
    }

    /* Information boxes */
    .info-box {
        padding: 22px;
        border-radius: 12px;
        height: 100%;
    }

    .room-info {
        background-color: #f7f7f5;
        border: 1px solid var(--border);
    }

    .booking-info {
        background-color: #fbf7ee;
        border: 1px solid #eee1c6;
    }

    .info-title {
        color: var(--primary);
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 18px;
        position: relative;
        padding-left: 14px;
    }

    .info-title::before {
        content: "";
        position: absolute;
        left: 0;
        top: 3px;
        width: 4px;
        height: 18px;
        background-color: var(--accent);
        border-radius: 3px;
    }

    .info-box p {
        color: var(--text);
        font-size: 14px;
    }

    .info-box p b {
        color: var(--primary);
    }

    .booking-info hr {
        border-color: #dfd6c5;
        opacity: 1;
    }

    .total-label {
        color: var(--primary);
        font-size: 15px;
    }

    .total-price {
        color: var(--accent);
        font-size: 21px;
        font-weight: 700;
    }

    /* Empty booking */
    .no-booking {
        background-color: #fbf7ee;
        color: var(--primary);
        border: 1px solid #eadbb9;
        border-radius: 10px;
        padding: 18px;
    }

    @media (max-width: 767px) {
        .booking-page {
            padding-top: 90px;
        }

        .booking-title {
            font-size: 30px;
        }

        .booking-header {
            padding: 16px !important;
        }

        .booking-card .card-body {
            padding: 20px !important;
        }
    }
</style>

<div class="container booking-page mt-5">

    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="text-center mb-5">
                <h3 class="booking-title">
                    My Booking History
                </h3>
            </div>

            @foreach($list as $item)

                @php
                    $checkIn = \Carbon\Carbon::parse($item->check_in);
                    $checkOut = \Carbon\Carbon::parse($item->check_out);
                    $nights = $checkOut->diffInDays($checkIn);
                    $roomPrice = $item->room->room_type->price ?? 0;
                    $totalPrice = $roomPrice * $nights;
                @endphp

                <div class="card mb-4 shadow-sm border-0 booking-card">

                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-center px-4 py-3 booking-header">

                        <div>
                            <small class="booking-id-label">
                                Booking ID
                            </small>
                            <br>

                            <strong class="booking-id">
                                #{{ $item->id }}
                            </strong>
                        </div>

                        <!-- Status -->
                        @if($item->status == 'pending')

                            <span class="status-badge status-pending">
                                Pending
                            </span>

                        @elseif($item->status == 'booked')

                            <span class="status-badge status-approved">
                                Approved
                            </span>

                        @else

                            <span class="status-badge status-cancelled">
                                Cancelled
                            </span>

                        @endif

                    </div>

                    <!-- Body -->
                    <div class="card-body px-4 py-4">

                        <div class="row g-4">

                            <!-- Left: Room Info -->
                            <div class="col-md-6">

                                <div class="info-box room-info">

                                    <h5 class="info-title">
                                        Room Info
                                    </h5>

                                    <p class="mb-2">
                                        <b>Room No:</b>
                                        {{ $item->room->room_number ?? 'N/A' }}
                                    </p>

                                    <p class="mb-2">
                                        <b>Type:</b>
                                        {{ $item->room->room_type->room_type ?? 'N/A' }}
                                    </p>

                                    <p class="mb-0">
                                        <b>Price/Night:</b>
                                        {{ number_format($roomPrice,2) }} kyats
                                    </p>

                                </div>

                            </div>

                            <!-- Right: Booking Info -->
                            <div class="col-md-6">

                                <div class="info-box booking-info">

                                    <h5 class="info-title">
                                        Booking Info
                                    </h5>

                                    <p class="mb-2">
                                        <b>Date:</b>
                                        {{ $item->created_at->format('d M Y') }}
                                    </p>

                                    <p class="mb-2">
                                        <b>Check-in:</b>
                                        {{ $item->check_in }}
                                    </p>

                                    <p class="mb-2">
                                        <b>Check-out:</b>
                                        {{ $item->check_out }}
                                    </p>

                                    <p class="mb-0">
                                        <b>Nights:</b>
                                        {{ $nights }}
                                    </p>

                                    <hr>

                                    <div class="d-flex justify-content-between align-items-center">

                                        <span class="total-label">
                                            <b>Total Price</b>
                                        </span>

                                        <span class="total-price">
                                            {{ number_format($totalPrice,2) }} kyats
                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

            @if(count($list) === 0)

                <div class="no-booking text-center">
                    You have no bookings yet.
                </div>

            @endif

        </div>
    </div>

</div>

@endsection