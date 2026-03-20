@extends('layouts.adminLayout')

@section('content')
<div class="container pt-4">

    <div class="row justify-content-center">
        <div class="col-md-10">

            <a href="{{ route('admin.room.index') }}" class="btn btn-dark mb-3">
                <i class="fas fa-arrow-left"></i> Back
            </a>

            <div class="card shadow-sm border-0">
                <!-- Card Header -->
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><b>Room Type Details</b></h4>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <!-- Room Info -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-2">
                            <h5>Room Type:</h5>
                            <p class="badge bg-dark text-white fs-3">{{ $roomType->room_type }}</p>
                        </div>
                        <div class="col-md-6 mb-2">
                            <h5>Price:</h5>
                            <p class="badge bg-dark text-white fs-3">$ {{ $roomType->price }}</p>
                        </div>
                        <div class="col-12 mb-3">
                            <h5>Description:</h5>
                            <p>{{ $roomType->description }}</p>
                        </div>
                    </div>

                    <!-- Room Features -->
                    <h5 class="mb-3">Room Features:</h5>
                    <div class="row g-3">
                        @php
                        $features = ['kitchen', 'bedroom', 'bathroom', 'view'];
                        @endphp

                        @foreach($features as $feature)
                        @if(!empty($roomType->$feature) && $roomType->$feature != 'default.jpg')
                        <div class="col-md-3 col-sm-6">
                            <div class="card h-100 shadow-sm text-center">
                                <div class="card-header bg-light">
                                    <b>{{ ucfirst($feature) }}</b>
                                </div>

                                <div class="card-body d-flex align-items-center justify-content-center p-2">
                                    <img src="{{ asset('images/' . $roomType->$feature) }}"
                                        class="img-fluid rounded shadow"
                                        style="max-height:120px;">
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<style>
    .card {
        border-radius: 0.6rem;
    }

    .badge {
        padding: 0.5rem 0.8rem;
    }

    .card-body p {
        margin-bottom: 0;
    }

    .card-header {
        font-size: 1rem;
    }

    .img-fluid {
        border-radius: 0.5rem;
        max-width: 100%;
    }

    h5 {
        font-weight: 600;
    }
</style>
@endsection