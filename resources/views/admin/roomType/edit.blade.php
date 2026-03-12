@extends('layouts.adminLayout')
@section('content')
<div class="container pt-4">
   
            <a href="{{route('admin.roomType.index')}}" class="btn btn-dark ">Back</a>
            <div class="card p-3 my-2">


                <form action="{{route('admin.roomType.update',$roomType->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <h3>Add Room Type</h3>

                    <label for="room_type" class="form-label">Room Type</label>

                    <input type="text" name="room_type" class="form-control" value="{{$roomType->room_type}}"><br>

                    <label for="price" class="form-label">Price</label>

                    <input type="text" name="price" class="form-control" value="{{$roomType->price}}"><br>

                    <label for="description" class="form-label">Description</label>

                    <input type="text" name="description" class="form-control" value="{{$roomType->description}}"><br>
                    <label for="kitchen" class="form-label">Kitchen</label>

                    <input type="file" name="kitchen" class="form-control">
                    @if($roomType->kitchen)
                    <img src="{{ asset('images/'.$roomType->kitchen) }}" width="100">
                    @endif
                    <br>
                    <label for="bedroom" class="form-label">BedRoom</label>

                    <input type="file" name="bedroom" class="form-control">
                    @if($roomType->bedroom)
                    <img src="{{ asset('images/'.$roomType->bedroom) }}" width="100">
                    @endif
                    <br>

                    <label for="bathroom" class="form-label">BathRoom</label>

                    <input type="file" name="bathroom" class="form-control">
                    @if($roomType->bathroom)
                    <img src="{{ asset('images/'.$roomType->bathroom) }}" width="100">
                    @endif
                    <br>

                    <label for="view" class="form-label">View</label>

                    <input type="file" name="view" class="form-control">
                    @if($roomType->view)
                    <img src="{{ asset('images/'.$roomType->view) }}" width="100">
                    @endif
                    <br>

                    <button type="submit" class="btn btn-primary">Update</button>

                </form>
            </div>

        </div>
   
@endsection