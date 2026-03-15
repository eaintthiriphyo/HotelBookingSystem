@extends('layouts.adminLayout')
@section('content')
<div class="container pt-4">

      @if(session('succRT'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('succRT') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <div class="card p-3">

  <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><b>Add Room Types</b></h3>
                <a href="{{ route('admin.roomType.index') }}" class="btn btn-dark btn-sm">View Lists</a>
            </div>

<div class="card-body">
        <form action="{{ route('admin.roomType.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <table class="table table-bordered">
                <tr>
                    <td><label for="room_type">Room Type</label></td>
                    <td>
                        <input type="text" name="room_type" class="form-control">
                        @error('room_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>

                <tr>
                    <td><label for="price">Price</label></td>
                    <td>
                        <input type="text" name="price" class="form-control">
                        @error('price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>

                <tr>
                    <td><label for="description">Description</label></td>
                    <td>
                        <input type="text" name="description" class="form-control">
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>

                <tr>
                    <td><label>Kitchen Image</label></td>
                    <td>
                        <input type="file" name="kitchen" class="form-control">
                    </td>
                </tr>

                <tr>
                    <td><label>Bedroom Image</label></td>
                    <td>
                        <input type="file" name="bedroom" class="form-control">
                    </td>
                </tr>

                <tr>
                    <td><label>Bathroom Image</label></td>
                    <td>
                        <input type="file" name="bathroom" class="form-control">
                    </td>
                </tr>

                <tr>
                    <td><label>View Image</label></td>
                    <td>
                        <input type="file" name="view" class="form-control">
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </td>
                </tr>

            </table>

        </form>
    </div>

</div>
</div>
@endsection
