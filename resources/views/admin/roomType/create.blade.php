@extends('layouts.adminLayout')
@section('content')
    <div class="container-fluid pt-4">

        {{-- Success Message --}}
        @if (session('succRT'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('succRT') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <!-- Card Header -->
            <div class="card-header d-flex justify-content-between align-items-center"
                style="background-color:navy;color:white">
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
                            <input type="text" name="room_type" id="room_type" class="form-control"
                                placeholder="Enter room type" value="{{ old('room_type') }}">
                            @error('room_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" name="price" id="price" class="form-control"
                                placeholder="Enter price" value="{{ old('price') }}">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" name="description" id="description" class="form-control"
                                placeholder="Enter description" value="{{ old('description') }}">
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-12">
                            <label class="form-label">Gallery Images</label>

                            <div id="imageContainer">
                                <div class="mb-2 input-group">
                                    <input type="file" name="image[]" class="form-control" onchange="previewImage(this)">
                                    <button type="button" class="btn btn-danger"
                                        onclick="removeInput(this)">Remove</button>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary mb-2" onclick="addMoreImage()">Add More
                                Image</button>

                            <!-- Preview container -->
                            <div id="previewContainer" class="mt-2"></div>

                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn "style="background-color:navy;color:white">
                            <i class="fas fa-plus"></i> Create Room Type
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>



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
    <script>
        function addMoreImage() {
            const container = document.getElementById('imageContainer');

            const div = document.createElement('div');
            div.className = 'mb-2 input-group';
            div.innerHTML = `
        <input type="file" name="image[]" class="form-control" onchange="previewImage(this)">
        <button type="button" class="btn btn-danger" onclick="removeInput(this)">Remove</button>
    `;
            container.appendChild(div);
        }

        function removeInput(button) {
            button.parentElement.remove();
        }

        // Preview selected images
        function previewImage(input) {
            const previewContainer = document.getElementById('previewContainer');

            // Clear previews and show all selected files
            previewContainer.innerHTML = '';
            const files = document.querySelectorAll('input[name="image[]"]');

            files.forEach(fileInput => {
                if (fileInput.files && fileInput.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.width = 120;
                        img.className = 'img-thumbnail me-2 mb-2';
                        previewContainer.appendChild(img);
                    }
                    reader.readAsDataURL(fileInput.files[0]);
                }
            });
        }
    </script>
@endsection
