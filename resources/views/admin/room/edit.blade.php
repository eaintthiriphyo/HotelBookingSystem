@extends('layouts.adminLayout')

@section('content')
<div class="container pt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">


            <div class="card p-3 my-2">

                  <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><b>Edit Room</b></h3>
                    <a href="{{ route('admin.room.index') }}" class="btn btn-dark btn-sm">View Lists</a>
                </div>

                <form action="{{route('admin.room.update',$room->id)}}" method="POST">
                    @csrf
                    @method('PUT')

                    <label class="form-label">Room Number</label>
                    <input type="text" name="room_number" class="form-control" value="{{$room->room_number}}">
                    <br>

                    <label class="form-label">Room Type</label>
                    <select name="room_type" class="form-control">
                    <option value="{{$room->room_type_id}}" >{{$room->room_type->room_type}}</option>

                        @foreach($roomType as $rt)
                        <option value="{{$rt->id}}" >
                            {{$rt->room_type}}
                        </option>
                        @endforeach
                    </select>
                    <br>

                    <button type="submit" class="btn btn-primary">Update</button>

                </form>

            </div>

        </div>
    </div>
</div>
@endsection
