@extends('layouts.adminLayout')

@section('content')
<div class="container pt-4">

    @if(session('successRoom'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('successRoom') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm border-0">

                <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                    <h3 class="mb-0 fw-bold" style="color:#f8f9fa; text-shadow:1px 1px 2px #000;">Add Room</h3>
                    <a href="{{ route('admin.room.index') }}" class="btn btn-light btn-sm">View Lists</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.room.store') }}" method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="room_number" class="form-label text-dark">Room Number</label>
                            <input type="text" name="room_number" class="form-control text-dark" value="{{ old('room_number') }}" placeholder="Enter room number">
                            @error('room_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="room_type_id" class="form-label text-dark">Room Type</label>
                            <select name="room_type_id" class="form-select text-dark form-control">
                                <option value="">Select Room Type</option>
                                @foreach($roomType as $type)
                                    <option value="{{ $type->id }}" {{ old('room_type_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->room_type }}
                                    </option>
                                @endforeach
                            </select>
                            @error('room_type_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-5">Create Room</button>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>

</div>

<style>
    .form-label {
        font-weight: 500;
        color: #212529; 
    }
    .card-body input, 
    .card-body select {
        padding: 8px 10px;
        color: #212529; 
    }
    ::placeholder {
        color: #495057; 
        opacity: 1;
    }
</style>
@endsection