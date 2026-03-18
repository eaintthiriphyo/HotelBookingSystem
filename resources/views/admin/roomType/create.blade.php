@extends('layouts.adminLayout')
@section('content')
<div class="container pt-4">

    @if(session('succRT'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('succRT') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">

        <!-- Card Header -->
        <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
            <h3 class="mb-0 fw-bold" style="color:#f8f9fa; text-shadow:1px 1px 2px #000;">Add Room Type</h3>
            <a href="{{ route('admin.roomType.index') }}" class="btn btn-light btn-sm">
                <i class="fas fa-list"></i> View Lists
            </a>
        </div>

        <!-- Card Body / Form -->
        <div class="card-body">

            <form action="{{ route('admin.roomType.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="room_type" class="form-label text-dark">Room Type</label>
                    <input type="text" name="room_type" class="form-control text-dark" placeholder="Enter room type">
                    @error('room_type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label text-dark">Price</label>
                    <input type="text" name="price" class="form-control text-dark" placeholder="Enter price">
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label text-dark">Description</label>
                    <input type="text" name="description" class="form-control text-dark" placeholder="Enter description">
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kitchen" class="form-label text-dark">Kitchen Image</label>
                        <input type="file" name="kitchen" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="bedroom" class="form-label text-dark">Bedroom Image</label>
                        <input type="file" name="bedroom" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="bathroom" class="form-label text-dark">Bathroom Image</label>
                        <input type="file" name="bathroom" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="view" class="form-label text-dark">View Image</label>
                        <input type="file" name="view" class="form-control">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create Room Type
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

<style>
    body, .text-dark {
        color: #212529 !important; /* Dark text for readability */
    }

    .form-label {
        font-weight: 500;
    }

    .card-body input[type="file"] {
        padding: 5px 8px;
    }

    .card {
        border-radius: 0.5rem;
    }

    .btn-primary i {
        margin-right: 5px;
    }
</style>
@endsection