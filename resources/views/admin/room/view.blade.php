@extends('layouts.adminLayout')

@section('content')
<div class="container pt-4">

    <div class="card shadow-sm p-3 mb-4">
        <!-- Card Header -->
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color:navy;color:white">
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



                            <div class="col-md-6 mb-2">
                                <h5>Price:</h5>
                                <p class="badge bg-dark text-white fs-3">1 night : {{ $room->room_type->price }} kyats</p>
                            </div>

                            <div class="col-12 mb-3">
                                <h5>Bed Type:</h5>
                                <p>{{ $room->room_type->bed }}</p>
                            </div>
                            <div class="col-12 mb-3">
                                <h5>Capacity:</h5>
                                <p>{{ $room->room_type->capacity }}</p>
                            </div>
                            <div class="col-12 mb-3">
                                <h5>Facility:</h5>
                                <p>{{ $room->room_type->facility }}</p>
                            </div>
                            <div class="col-12 mb-3">
                                <h5>Status:</h5>
                                <p>{{ $room->room_type->status }}</p>
                            </div>
                             <div class="col-12 mb-3">
                                <h5>Description:</h5>
                                <p>{{ $room->room_type->description }}</p>
                            </div>

            </div>

            <h5 class="fw-bold mb-3">Room Features:</h5>

<div class="mb-3">
    <div id="allPreview" class="d-flex flex-wrap gap-3">
        @forelse($room->room_type->RoomTypeImages ?? [] as $img)
            <div class="col-md-4 col-sm-6">
                <div class="card shadow-sm text-center mb-3" style="width: 200px; border-radius:12px;">
                <div class="card-header bg-light py-1">
                    <b>Image</b>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center p-2">
                    <img src="{{ asset($img->img_src) }}"
                         class="img-fluid rounded"
                         style="max-height:120px; object-fit:cover;">
                </div>
            </div>
            </div>
        @empty
            <p class="text-muted">No images available.</p>
        @endforelse
    </div>
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
    h5{
        color: black
    }

    p{
        color:black
    }
    @media (max-width: 768px) {
        .card-body img {
            max-height: 100px;
        }
    }
</style>
@endsection
