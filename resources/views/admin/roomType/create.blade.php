@extends('layouts.adminLayout')
@section('content')
<div class="container-fluid pt-4">

    {{-- Success Message --}}
    @if(session('succRT'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('succRT') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <!-- Card Header -->
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0 fw-bold" style="text-shadow:1px 1px 2px #000;">Add Room Type</h3>
            <a href="{{ route('admin.roomType.index') }}" class="btn btn-light btn-sm">
                <i class="fas fa-list"></i> View Lists
            </a>
        </div>

        <!-- Card Body / Form -->
        <div class="card-body">
            <form action="{{ route('admin.roomType.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="room_type" class="form-label">Room Type</label>
                        <input type="text" name="room_type" id="room_type" class="form-control" placeholder="Enter room type" value="{{ old('room_type') }}">
                        @error('room_type') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" name="price" id="price" class="form-control" placeholder="Enter price" value="{{ old('price') }}">
                        @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" name="description" id="description" class="form-control" placeholder="Enter description" value="{{ old('description') }}">
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Image Uploads --}}
                    @php $images = ['kitchen', 'bedroom', 'bathroom', 'view']; @endphp
                    @foreach ($images as $img)
                        <div class="col-md-6">
                            <label for="{{ $img }}" class="form-label">{{ ucfirst($img) }} Image</label>
                            <input type="file" name="{{ $img }}" id="{{ $img }}" class="form-control mb-2">
                            <img id="{{ $img }}Preview" src="#" alt="Preview" class="img-thumbnail d-none" width="120">
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create Room Type
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

{{-- Optional: Live Image Preview Script --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const images = ['kitchen', 'bedroom', 'bathroom', 'view'];
        images.forEach(id => {
            const input = document.getElementById(id);
            const preview = document.getElementById(id + 'Preview');
            input.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if(file) {
                    preview.src = URL.createObjectURL(file);
                    preview.classList.remove('d-none');
                } else {
                    preview.src = '#';
                    preview.classList.add('d-none');
                }
            });
        });
    });
</script>

<style>
    .card {
        border-radius: 0.5rem;
    }
    .form-label {
        font-weight: 500;
    }
    .img-thumbnail {
        border-radius: 8px;
        margin-top: 5px;
    }
    .text-danger {
        font-size: 0.85rem;
    }
    .btn-primary i {
        margin-right: 5px;
    }
</style>
@endsection