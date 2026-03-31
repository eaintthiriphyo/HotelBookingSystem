@extends('layouts.userLayout')

@section('content')
<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-lg-10">

            <h3 class="text-center mb-5 fw-bold text-dark">
                 My Booking History
            </h3>

            @foreach($list as $item)
                @php
                    $checkIn = \Carbon\Carbon::parse($item->check_in);
                    $checkOut = \Carbon\Carbon::parse($item->check_out);
                    $nights = $checkOut->diffInDays($checkIn);
                    $roomPrice = $item->room->room_type->price ?? 0;
                    $totalPrice = $roomPrice * $nights;
                @endphp

                <div class="card mb-4 shadow-sm border-0" style="border-radius:14px; overflow:hidden;">

                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-center px-4 py-3"
                         style="background: linear-gradient(45deg, navy, #001f3f); color:white;">

                        <div>
                            <small>Booking ID</small><br>
                            <strong>#{{ $item->id }}</strong>
                        </div>

                        <!-- Status -->
                        @if($item->status == 'pending')
                            <span class="badge px-3 py-2" style="background-color: orange;">Pending</span>
                        @elseif($item->status == 'booked')
                            <span class="badge px-3 py-2 bg-success">Approved</span>
                        @else
                            <span class="badge px-3 py-2 bg-danger">Cancelled</span>
                        @endif
                    </div>

                    <!-- Body -->
                    <div class="card-body px-4 py-4">

                        <div class="row g-4">

                            <!-- Left: Room Info -->
                            <div class="col-md-6">
                                <div class="p-3 rounded" style="background-color:#f8f9fa;">
                                    <h5 class="mb-3">Room Info</h5>
                                    <p class="mb-1"><b>Room No:</b> {{ $item->room->room_number ?? 'N/A' }}</p>
                                    <p class="mb-1"><b>Type:</b> {{ $item->room->room_type->room_type ?? 'N/A' }}</p>
                                    <p class="mb-0"><b> Price/Night:</b> {{ number_format($roomPrice,2) }} kyats</p>
                                </div>
                            </div>

                            <!-- Right: Booking Info -->
                            <div class="col-md-6">
                                <div class="p-3 rounded" style="background-color:#fff3f0;">
                                    <h5 class="mb-3">Booking Info</h5>
                                    <p class="mb-1"><b> Date:</b> {{ $item->created_at->format('d M Y') }}</p>
                                    <p class="mb-1"><b> Check-in:</b> {{ $item->check_in }}</p>
                                    <p class="mb-1"><b> Check-out:</b> {{ $item->check_out }}</p>
                                    <p class="mb-0"><b> Nights:</b> {{ $nights }}</p>

                                    <hr>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <span><b>Total Price</b></span>
                                        <span style="color: orangered; font-weight:bold;">
                                            ${{ number_format($totalPrice,2) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            @endforeach

            @if(count($list) === 0)
                <div class="alert alert-info text-center">You have no bookings yet.</div>
            @endif

        </div>
    </div>

</div>
@endsection
