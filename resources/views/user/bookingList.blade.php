@extends('layouts.userLayout')

@section('content')
<div class="container py-5">

    <div class="row justify-content-center">
        <a href="{{route('user.booking.viewAllList',Auth::user()->id)}}" class="btn btn-dark">All History</a>
        <div class="col-lg-10">

            <h3 class="text-center mb-5 fw-bold text-dark">
                 My Booking List
            </h3>




                <div class="card mb-4 shadow-lg border-0 rounded-4">

                    <!-- Header -->
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center rounded-top">
                        <span>Booking ID: #{{ $item->id }}</span>

                        <!-- Status Badge -->
                        @if($item->status == 'pending')
                            <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
                        @elseif($item->status == 'booked')
                            <span class="badge bg-success px-3 py-2">Approved</span>
                        @else
                            <span class="badge bg-danger px-3 py-2">Cancelled</span>
                        @endif
                    </div>

                    <!-- Body -->
                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6 mb-2">
                                <strong>📅 Booking Date:</strong><br>
                                {{ $item->created_at->format('d M Y') }}
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>🏨 Room Number:</strong><br>
                                {{ $item->room->room_number ?? 'N/A' }}
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>🛏 Room Type:</strong><br>
                                {{ $item->room->room_type->room_type ?? 'N/A' }}
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>📥 Check-in:</strong><br>
                                {{ $item->check_in }}
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>📤 Check-out:</strong><br>
                                {{ $item->check_out }}
                            </div>

                        </div>

                    </div>

                </div>



        </div>
    </div>

</div>
@endsection
