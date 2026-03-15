@extends('layouts.adminLayout')

@section('content')
<div class="container pt-4">

       <div class="row justify-content-center">
        <div class="col-md-10">
    <a href="{{ route('admin.room.index') }}" class="btn btn-dark mb-3">Back</a>

        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><b>Room Type Details</b></h4>
        </div>

        <div class="card-body">

            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Room Type:</h5>
                    <p>{{ $roomType->room_type }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Price:</h5>
                    <p>$ {{ $roomType->price }}</p>
                </div>
                <div class="col-12">
                    <h5>Description:</h5>
                    <p>{{ $roomType->description }}</p>
                </div>
            </div>

            <h5>Room Features:</h5>
            <div class="row">
                @php
                    $features = ['kitchen', 'bedroom', 'bathroom', 'view'];
                @endphp

                @foreach($features as $feature)
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="card h-100 text-center shadow-sm">
                            <div class="card-header bg-light"><b>{{ ucfirst($feature) }}</b></div>
                            <div class="card-body d-flex align-items-center justify-content-center">
                                @if($roomType->$feature && $roomType->$feature != 'default.jpg')
                                    <img src="{{ asset('images/'.$roomType->$feature) }}" class="img-fluid rounded shadow">
                                @else
                                    <span class="text-danger">Not included</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

</div>
@endsection
