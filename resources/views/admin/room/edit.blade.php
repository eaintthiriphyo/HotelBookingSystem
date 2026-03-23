@extends('layouts.adminLayout')

@section('content')
<div class="container pt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm border-0 mb-4">
                <!-- Card Header -->
                <div class="card-header d-flex justify-content-between align-items-center" style="background-color:navy;color:white">
                    <h3 class="mb-0 fw-bold"><b>Edit Room</b></h3>
                    <a href="{{ route('admin.room.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-list"></i> View Lists
                    </a>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <form action="{{ route('admin.room.update', $room->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label" for="room_number">Room Number</label>
                            <input type="text" name="room_number" id="room_number" class="form-control" value="{{ $room->room_number }}">
                            @error('room_number') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="room_type">Room Type</label>
                            <select name="room_type" id="room_type" class="form-select form-control">
                                <option value="{{ $room->room_type_id }}" selected>{{ $room->room_type->room_type }}</option>
                                @foreach($roomType as $rt)
                                    @if($rt->id != $room->room_type_id)
                                        <option value="{{ $rt->id }}">{{ $rt->room_type }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('room_type') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn " style="background-color:navy;color:white">
                                <i class="fas fa-save"></i> Update Room
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 0.6rem;
    }
    .form-label {
        font-weight: 500;
    }
    .btn-primary i {
        margin-right: 5px;
    }
    .form-select, .form-control {
        border-radius: 0.4rem;
    }
</style>
@endsection
