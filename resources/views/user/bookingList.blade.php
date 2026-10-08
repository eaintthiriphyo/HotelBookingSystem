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

    .booking-list-page {
        padding-top: 110px;
        padding-bottom: 60px;
    }

    /* Top button */
    .history-btn {
        display: inline-block;
        background-color: var(--primary);
        color: white;
        border: 1px solid var(--primary);
        border-radius: 25px;
        padding: 10px 22px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-bottom: 25px;
    }

    .history-btn:hover {
        background-color: var(--accent);
        border-color: var(--accent);
        color: var(--primary);
    }

    /* Page title */
    .booking-list-title {
        color: var(--primary);
        font-family: "Playfair Display", serif;
        font-size: 36px;
        font-weight: 700;
        position: relative;
        display: inline-block;
    }

    .booking-list-title::after {
        content: "";
        display: block;
        width: 55px;
        height: 3px;
        background-color: var(--accent);
        margin: 12px auto 0;
    }

    /* Booking card */
    .booking-card {
        border-radius: 16px !important;
        overflow: hidden;
        background-color: var(--white);
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
        padding: 16px 22px;
    }

    .booking-id {
        font-size: 15px;
        font-weight: 600;
    }

    .booking-id-number {
        color: var(--accent);
        font-weight: 700;
    }

    /* Status */
    .status-badge {
        padding: 8px 18px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 600;
    }

    .status-pending {
        background-color: rgba(200, 164, 93, 0.2);
        color: #f0cd82;
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

    /* Body */
    .booking-body {
        padding: 28px;
    }

    .booking-info-item {
        background-color: #f7f7f5;
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 16px 18px;
        height: 100%;
        transition: all 0.25s ease;
    }

    .booking-info-item:hover {
        border-color: #d8c69d;
        background-color: #fbf7ee;
    }

    .info-label {
        display: block;
        color: var(--muted);
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.7px;
        margin-bottom: 6px;
    }

    .info-value {
        color: var(--primary);
        font-size: 15px;
        font-weight: 600;
    }

    .info-icon {
        color: var(--accent);
        margin-right: 7px;
    }

    @media (max-width: 767px) {

        .booking-list-page {
            padding-top: 90px;
        }

        .booking-list-title {
            font-size: 30px;
        }

        .booking-header {
            padding: 14px 16px;
        }

        .booking-body {
            padding: 18px;
        }

        .history-btn {
            width: 100%;
            text-align: center;
        }
    }
</style>


<div class="container booking-list-page mt-5">

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <!-- All History Button -->
            <div class="mb-3">
                <a href="{{ route('user.booking.viewAllList', Auth::user()->id) }}"
                   class="history-btn">
                    All History
                </a>
            </div>

            <!-- Title -->
            <div class="text-center mb-5">
                <h3 class="booking-list-title">
                    My Booking List
                </h3>
            </div>


            <!-- Booking Card -->
            <div class="card mb-4 shadow-lg border-0 booking-card">

                <!-- Header -->
                <div class="booking-header d-flex justify-content-between align-items-center">

                    <span class="booking-id">
                        Booking ID:
                        <span class="booking-id-number">
                            #{{ $item->id }}
                        </span>
                    </span>

                    <!-- Status Badge -->
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
                <div class="card-body booking-body">

                    <div class="row g-3">

                        <!-- Booking Date -->
                        <div class="col-md-6">

                            <div class="booking-info-item">

                                <span class="info-label">
                                    <span class="info-icon">📅</span>
                                    Booking Date
                                </span>

                                <span class="info-value">
                                    {{ $item->created_at->format('d M Y') }}
                                </span>

                            </div>

                        </div>


                        <!-- Room Number -->
                        <div class="col-md-6">

                            <div class="booking-info-item">

                                <span class="info-label">
                                    <span class="info-icon">🏨</span>
                                    Room Number
                                </span>

                                <span class="info-value">
                                    {{ $item->room->room_number ?? 'N/A' }}
                                </span>

                            </div>

                        </div>


                        <!-- Room Type -->
                        <div class="col-md-6">

                            <div class="booking-info-item">

                                <span class="info-label">
                                    <span class="info-icon">🛏</span>
                                    Room Type
                                </span>

                                <span class="info-value">
                                    {{ $item->room->room_type->room_type ?? 'N/A' }}
                                </span>

                            </div>

                        </div>


                        <!-- Check-in -->
                        <div class="col-md-6">

                            <div class="booking-info-item">

                                <span class="info-label">
                                    <span class="info-icon">📥</span>
                                    Check-in
                                </span>

                                <span class="info-value">
                                    {{ $item->check_in }}
                                </span>

                            </div>

                        </div>


                        <!-- Check-out -->
                        <div class="col-md-6">

                            <div class="booking-info-item">

                                <span class="info-label">
                                    <span class="info-icon">📤</span>
                                    Check-out
                                </span>

                                <span class="info-value">
                                    {{ $item->check_out }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection