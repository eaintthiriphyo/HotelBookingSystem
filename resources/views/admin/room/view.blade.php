@extends('layouts.adminLayout')

@section('content')
<div class="container pt-4">


    <div class="row justify-content-center">
        <div class="col-md-10">
    <a href="{{ route('admin.room.index') }}" class="btn btn-dark mb-3">Back</a>

            <div class="card shadow p-3 mb-4">
                <div class="card-header bg-light">
                    <h3 class="mb-0"><b>Room Details: {{ $room->room_number }}</b></h3>
                </div>

                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5>Room Type:</h5>
                            <p>{{ $room->room_type->room_type }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Status:</h5>
                            @if($room->is_avaliable == 'avaliable')
                                <span class="badge bg-primary text-white">Available</span>
                            @elseif($room->is_avaliable == 'pending')
                                <span class="badge bg-warning text-white">Pending</span>
                            @elseif($room->is_avaliable == 'booked')
                                <span class="badge bg-success text-white">Booked</span>
                            @elseif($room->is_avaliable == 'unavailable')
                                <span class="badge bg-danger">Unavailable</span>
                            @endif
                        </div>
                    </div>

                    <h5>Room Features:</h5>
                    <div class="row">
                        @php
                            $features = ['kitchen', 'bedroom', 'bathroom', 'view'];
                        @endphp

                        @foreach($features as $feature)
                        <div class="col-md-3 mb-3">
                            <div class="card h-100 text-center shadow-sm">
                                <div class="card-header">
                                    <b>{{ ucfirst($feature) }}</b>
                                </div>
                                <div class="card-body">
                                    @if($room->room_type->$feature && $room->room_type->$feature != 'default.jpg')
                                        <img src="{{ asset('images/'.$room->room_type->$feature) }}" class="img-fluid rounded mb-2">
                                    @else
                                        <p class="text-muted">Not included</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
