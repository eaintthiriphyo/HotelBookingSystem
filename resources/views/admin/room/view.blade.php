@extends('layouts.adminLayout')

@section('content')
<div class="container pt-4">

    <div class="card shadow-sm p-3 mb-4">
        <!-- Card Header -->
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0"><b>Room Details: {{ $room->room_number }}</b></h3>
            <a href="{{ route('admin.room.index') }}" class="btn btn-sm btn-light">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        <!-- Card Body -->
        <div class="card-body">

            <div class="row mb-4">
                <div class="col-md-6">
                    <h5 class="fw-bold">
                        Room Type:
                        <span class="badge bg-dark text-white">{{ $room->room_type->room_type }}</span>
                    </h5>
                </div>

            </div>

            <h5 class="fw-bold mb-3">Room Features:</h5>
            <div class="row g-3">
                @php $features = ['kitchen', 'bedroom', 'bathroom', 'view']; @endphp

                @foreach($features as $feature)
                @if(!empty($room->room_type->$feature) && $room->room_type->$feature != 'default.jpg')
                <div class="col-md-3 col-sm-6">
                    <div class="card h-100 text-center shadow-sm hover-effect">
                        <div class="card-header bg-secondary text-white">
                            <b>{{ ucfirst($feature) }}</b>
                        </div>

                        <div class="card-body d-flex align-items-center justify-content-center" style="min-height:120px;">
                            <img src="{{ asset('images/'.$room->room_type->$feature) }}"
                                class="img-fluid rounded shadow feature-img">
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>

        </div>
    </div>

</div>

<style>
    .card-header {
        font-weight: 600;
        font-size: 1rem;
    }

    .badge {
        font-size: 0.9rem;
        padding: 0.45em 0.75em;
        text-transform: capitalize;
    }

    .card-body p {
        margin-bottom: 0;
    }

    .feature-img {
        max-height: 120px;
        transition: transform 0.3s;
    }

    .hover-effect:hover .feature-img {
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .card-body img {
            max-height: 100px;
        }
    }
</style>
@endsection