@extends('layouts.adminLayout')

@section('content')

<div class="container-fluid pt-4">

  <div class="card ">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h3><b>Rooms Lists</b></h3>

      <a href="{{ route('admin.room.create') }}">
        <button class="btn btn-lg btn-dark">Add Rooms</button>
      </a>
    </div>
    <div class="card-body">

      <div class="row">
        <div class="col-md-3 col-4">
          <a href="{{route('admin.room.avaliableList')}}" class="m-2">
            <button class="btn btn-primary">Avaliable</button>
          </a>
        </div>
        <div class="col-md-3 col-4">
          <a href="{{route('admin.room.pendingList')}}" class="m-2">
            <button class="btn btn-warning">Pending</button>
          </a>
        </div>
        <div class="col-md-3 col-4">
          <a href="{{route('admin.room.bookingList')}}" class="m-2">
            <button class="btn btn-success">Booked</button>
          </a>
        </div>
        <div class="col-md-3 col-4 mt-2">
          <a href="{{route('admin.room.unavaliableList')}}" class="m-2">
            <button class="btn btn-danger">Unavaliable</button>
          </a>
        </div>
      </div>

      <table class="table mt-3">



        <thead>
          <tr>
            <th>Room Number</th>
            <th>Room Type</th>
            <th>Room Status</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          @foreach($rooms as $room)


          <tr>

            <td>{{$room->room_number}}</td>
            <td>{{$room->room_type->room_type}}</td>
            <td>
              @if($room->is_avaliable == 'avaliable')
              <span class=" bg-primary text-white px-2 rounded">Available</span>

              @elseif($room->is_avaliable == 'pending')
              <span class=" bg-warning text-white px-2 rounded">Pending</span>

              @elseif($room->is_avaliable == 'booked')
              <span class=" bg-success text-white px-2 rounded">Booked</span>

              @elseif($room->is_avaliable == 'unavaliable')
              <span class=" bg-danger text-white px-2 rounded">Unavailable</span>

              @endif
            </td>


            <td>
              <a href="{{route('admin.room.show',$room->id)}}"><button class="btn btn-warning d-inline">View</button>
              </a>
              <a href="{{route('admin.room.edit',$room->id)}}"><button class="btn btn-primary d-inline">Edit</button>
              </a>
              <form action="{{route('admin.room.destroy',$room->id)}}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')

                <button class="btn btn-danger" type="submit">Delete</button>
              </form>
            </td>
          </tr>

          @endforeach
        </tbody>


      </table>
    </div>
  </div>
</div>

@endsection