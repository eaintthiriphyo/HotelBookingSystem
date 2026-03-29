@extends('layouts.adminLayout')
@section('content')
    <div class="container pt-4">

        <div class="card shadow-sm border-0">
            <div class="card-header d-flex justify-content-between align-items-center"
                style="background-color:navy;color:white">
                <h3 class="mb-0"><b>Edit Room Type</b></h3>
                <a href="{{ route('admin.roomType.index') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-list"></i> View Lists
                </a>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.roomType.update', $roomType->id) }}" method="post"
                    enctype="multipart/form-data" id="roomTypeForm">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="room_type" class="form-label">Room Type</label>
                            <input type="text" name="room_type" id="room_type" class="form-control"
                                value="{{ old('room_type', $roomType->room_type) }}" placeholder="Enter Room Type">
                            @error('room_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" name="price" id="price" class="form-control"
                                value="{{ old('price', $roomType->price) }}" placeholder="Enter Price">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                                 <div class="col-12">
                            <label for="bed" class="form-label">Bed Type</label>
                            <input type="text" name="bed" id="bed" class="form-control"
                                placeholder="Enter bed type" value="{{ old('bed',$roomType->bed) }}">
                            @error('bed')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                         <div class="col-12">
                            <label for="capacity" class="form-label">Capacity</label>
                            <input type="text" name="capacity" id="capacity" class="form-control"
                                placeholder="Enter capacity" value="{{ old('capacity', $roomType->capacity) }}">
                            @error('capacity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                         <div class="col-12">
                            <label for="facility" class="form-label">Facility</label>
                            <input type="text" name="facility" id="facility" class="form-control"
                                placeholder="Enter facility" value="{{ old('facility', $roomType->facility) }}">
                            @error('facility')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                      


                        <div class="col-12">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" name="description" id="description" class="form-control"
                                value="{{ old('description', $roomType->description) }}" placeholder="Enter Description">
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Existing Images --}}
                        <div class="mb-3">
                            <label>Images</label>
                            <div id="allPreview" class="d-flex flex-wrap gap-2">
                                @forelse($roomType->RoomTypeImages ?? [] as $img)
                                    <div class="position-relative" style="display:inline-block"
                                        data-id="{{ $img->id }}">
                                        <img src="{{ asset($img->img_src) }}" width="120" class="img-thumbnail">
                                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0"
                                            onclick="removeExistingImage({{ $img->id }}, this)">X</button>
                                        <input type="file" class="form-control mt-1"
                                            onchange="replaceImage({{ $img->id }}, this)">
                                    </div>
                                @empty
                                    <p>No images available.</p>
                                @endforelse
                            </div>
                        </div>


                        {{-- New Images --}}
                        <div class="col-12">
                            <label class="form-label">Add New Images</label>

                            <div id="imageContainer">
                                <div class="mb-2 input-group">
                                    <input type="file" name="image[]" class="form-control" multiple
                                        onchange="previewImage(this)">
                                    <button type="button" class="btn btn-danger"
                                        onclick="removeInput(this)">Remove</button>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary mb-2" onclick="addMoreImage()">Add More
                                Image</button>

                            <!-- Preview container -->
                            <div id="previewContainer" class="mt-2 d-flex flex-wrap gap-2"></div>

                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 text-center mt-3">
                            <button type="submit" class="btn  px-5" style="background-color:navy;color:white">
                                <i class="fas fa-save"></i> Update
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>

    <style>
        .card {
            border-radius: 12px;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-primary {
            font-weight: 500;
        }

        .text-danger {
            font-size: 0.85rem;
        }

        .img-thumbnail {
            border-radius: 8px;
        }

        label {
            color: black;
        }
    </style>

    <script>
        // For new images
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

        function previewImage(input) {
            const previewContainer = document.getElementById('previewContainer');
            previewContainer.innerHTML = ''; // clear previous previews
            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.width = 120;
                    img.className = 'img-thumbnail me-2 mb-2';
                    previewContainer.appendChild(img);
                }
                reader.readAsDataURL(file);
            });
        }

        // For existing images
        let imagesToDelete = [];
        let imagesToReplace = {}; // key = image_id, value = file

        function removeExistingImage(id, button) {
            if (confirm("Are you sure you want to remove this image?")) {
                imagesToDelete.push(id);
                button.parentElement.remove();
            }
        }

        function replaceImage(id, input) {
            if (input.files.length > 0) {
                imagesToReplace[id] = input.files[0];
                const reader = new FileReader();
                reader.onload = function(e) {
                    input.previousElementSibling.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Before submit, attach hidden inputs for delete/replace
        document.getElementById('roomTypeForm').addEventListener('submit', function(e) {
            // images to delete
            if (imagesToDelete.length > 0) {
                const inputDelete = document.createElement('input');
                inputDelete.type = 'hidden';
                inputDelete.name = 'images_to_delete';
                inputDelete.value = JSON.stringify(imagesToDelete);
                this.appendChild(inputDelete);
            }

            // images to replace
            for (let id in imagesToReplace) {
                const fileInput = document.createElement('input');
                fileInput.type = 'file';
                fileInput.name = `replace_images[${id}]`;
                fileInput.style.display = 'none';
                const dt = new DataTransfer();
                dt.items.add(imagesToReplace[id]);
                fileInput.files = dt.files;
                this.appendChild(fileInput);
            }
        });
    </script>
@endsection
