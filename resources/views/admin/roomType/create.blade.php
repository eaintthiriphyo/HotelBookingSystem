@extends('layouts.adminLayout')
@section('content')
<div class="container pt-4">

  <a href="{{route('admin.roomType.index')}}" class="btn btn-dark">Back</a>
  <div class="card p-3 ">


    <form action="{{route('admin.roomType.store')}}" method="post" enctype="multipart/form-data">
      @csrf
      <h3>Add Room Type</h3>

      <label for="room_type" class="form-label">Room Type</label>

      <input type="text" name="room_type" class="form-control">
      @error('room_type')
      <br>
      <span class="text-danger">{{$message}}</span>
      @enderror
      <br>

      <label for="price" class="form-label">Price</label>

      <input type="text" name="price" class="form-control">
      @error('price')
      <br>
      <span class="text-danger">{{$message}}</span>
      @enderror
      <br>

      <label for="description" class="form-label">Description</label>

      <input type="text" name="description" class="form-control">
      @error('description')
      <br>
      <span class="text-danger">{{$message}}</span>
      @enderror
      <br>
      <label for="kitchen" class="form-label">Kitchen</label>

      <input type="file" name="kitchen" class="form-control"><br>
      <label for="bedroom" class="form-label">BedRoom</label>

      <input type="file" name="bedroom" class="form-control"><br>

      <label for="bathroom" class="form-label">BathRooom</label>

      <input type="file" name="bathroom" class="form-control"><br>

      <label for="bathroom" class="form-label">View</label>

      <input type="file" name="view" class="form-control"><br>

      <button type="submit" class="btn btn-primary">Create</button>

    </form>
  </div>

</div>

@endsection