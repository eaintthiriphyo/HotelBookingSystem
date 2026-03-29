@extends('layouts.adminLayout')

@section('content')
    <div class="container pt-4">

        <div class="row justify-content-center">
            <div class="col-md-10">



                <div class="card shadow-sm border-0">
                    <!-- Card Header -->
                    <div class="card-header d-flex justify-content-between align-items-center py-4"
                        style="background-color:navy; color:white">

                        <h4 class="mb-0"><b>Room Type Details</b></h4>

                        <a href="{{ route('admin.roomType.index') }}" class="btn"
                            style="background-color:white; color:navy;">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>

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
                            <div class="col-12 mb-3">
                                <h5>Status:</h5>
                                <p>{{ $roomType->status }}</p>
                            </div>
                        </div>

                        <!-- Room Features -->
                        <h5 class="mb-3">Room Features:</h5>






<div class="mb-3">
    <div id="allPreview" class="d-flex flex-wrap gap-3">
        @forelse($roomType->RoomTypeImages ?? [] as $img)
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
            color: black;
        }
    </style>
@endsection
