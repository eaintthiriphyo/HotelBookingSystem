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
        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><b>Add Room</b></h3>
                    <a href="{{ route('admin.room.index') }}" class="btn btn-dark btn-sm">View Lists</a>
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.room.store') }}" method="post">
                        @csrf

                        <table class="table table-bordered">

                            <tr>
                                <td><label for="room_number">Room Number</label></td>
                                <td>
                                    <input type="text" name="room_number" class="form-control" value="{{ old('room_number') }}">
                                    @error('room_number')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                            </tr>

                            <tr>
                                <td><label for="room_type_id">Room Type</label></td>
                                <td>
                                    <select name="room_type_id" class="form-control">
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
                                </td>
                            </tr>

                            <!-- Button Row -->
                            <tr>
                                <td colspan="2" class="">
                                    <button type="submit" class="btn btn-primary px-5">Create</button>
                                </td>
                            </tr>

                        </table>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>
@endsection
