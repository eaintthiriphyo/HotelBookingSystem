@extends('layouts.adminLayout')

@section('content')

<div class="container-fluid pt-4">

<div class="card shadow">



</div>

<div class="card-body">
  <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><b>Room Lists</b></h3>
                    <a href="{{ route('admin.room.create') }}" class="btn btn-dark btn-sm">Add New</a>
                </div>

<div class="mb-3">

<a href="{{route('admin.room.avaliableList')}}" class="btn btn-primary btn-sm">Available</a>
<a href="{{route('admin.room.pendingList')}}" class="btn btn-warning btn-sm">Pending</a>
<a href="{{route('admin.room.bookingList')}}" class="btn btn-success btn-sm">Booked</a>
<a href="{{route('admin.room.unavaliableList')}}" class="btn btn-danger btn-sm">Unavailable</a>

</div>

<table class="table table-bordered table-striped text-center">

<thead class="table-dark">
<tr>
<th>Room Number</th>
<th>Room Type</th>
<th>Status</th>
<th width="220">Action</th>
</tr>
</thead>

<tbody>

@foreach($rooms as $room)

<tr>

<td>{{$room->room_number}}</td>

<td>{{$room->room_type->room_type}}</td>

<td>

@if($room->is_avaliable == 'avaliable')

<span class="badge bg-primary text-white">Available</span>

@elseif($room->is_avaliable == 'pending')

<span class="badge bg-warning text-white">Pending</span>

@elseif($room->is_avaliable == 'booked')

<span class="badge bg-success text-white">Booked</span>

@elseif($room->is_avaliable == 'unavaliable')

<span class="badge bg-dange text-whiter">Unavailable</span>

@endif

</td>

<td>

<div class="btn-group">

<a href="{{route('admin.room.show',$room->id)}}" class="btn btn-sm btn-warning">
View
</a>

<a href="{{route('admin.room.edit',$room->id)}}" class="btn btn-sm btn-primary">
Edit
</a>

<form action="{{route('admin.room.destroy',$room->id)}}" method="POST">
@csrf
@method('DELETE')

<button class="btn btn-sm btn-danger">Delete</button>

</form>

</div>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

</div>

@endsection
