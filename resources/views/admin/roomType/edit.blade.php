@extends('layouts.adminLayout')
@section('content')
<div class="container pt-4">

    <div class="card shadow-sm border-0">
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color:navy;color:white">
            <h3 class="mb-0"><b>Edit Room Type</b></h3>
            <a href="{{ route('admin.roomType.index') }}" class="btn btn-light btn-sm">
                <i class="fas fa-list"></i> View Lists
            </a>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.roomType.update', $roomType->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <div class="col-md-6">
                        <label for="room_type" class="form-label">Room Type</label>
                        <input type="text" name="room_type" id="room_type" class="form-control" value="{{ old('room_type', $roomType->room_type) }}" placeholder="Enter Room Type">
                        @error('room_type') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" name="price" id="price" class="form-control" value="{{ old('price', $roomType->price) }}" placeholder="Enter Price">
                        @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" name="description" id="description" class="form-control" value="{{ old('description', $roomType->description) }}" placeholder="Enter Description">
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    @php
                        $images = ['kitchen', 'bedroom', 'bathroom', 'view'];
                    @endphp

                    @foreach ($images as $img)
                        <div class="col-md-6">
                            <label for="{{ $img }}" class="form-label"> Image</label>
                            <input type="file" name="{{ $img }}" id="{{ $img }}" class="form-control mb-2">
                            @if($roomType->$img)
                                <img src="{{ asset('images/' . $roomType->$img) }}" width="120" class="img-thumbnail">
                            @endif
                        </div>
                    @endforeach

                    <div class="col-12 text-center mt-3">
                        <button type="submit" class="btn  px-5"  style="background-color:navy;color:white">
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
    label{
        color: black;
    }
</style>
@endsection
