@extends('layouts.adminLayout')

@section('content')

<div class="container pt-4">
    
            <div class="card p-3">
                <div class="card-header">
                    <h3><b>Room Type's Details</b></h3>
                </div>
                <div class="card-body">
                    <div class="col-10">
                        <table class="table">
                            <tr>
                                <td><b>Room Number</b> </td>
                                <td>{{$room->room_number}}</td>
                            </tr>
                            <tr>
                                <td><b>Room Type</b> </td>
                                <td>{{$room->room_type->room_type}}</td>
                            </tr>
                            <tr>
                                <td><b>Room Status</b> </td>

                                <td>
                                    @if($room->is_avaliable == 'avaliable')
                                    <span class=" bg-primary text-white px-2 rounded">Available</span>

                                    @elseif($room->is_avaliable == 'pending')
                                    <span class=" bg-warning text-white px-2 rounded">Pending</span>

                                    @elseif($room->is_avaliable == 'booked')
                                    <span class=" bg-success text-white px-2 rounded">Booked</span>

                                    @elseif($room->is_avaliable == 'unavailable')
                                    <span class=" bg-danger text-white px-2 rounded">Unavailable</span>

                                    @endif
                                </td>
                              
                            </tr>
                            <tr>
                                <td><b>Kitchen</b> </td>
                                <td>
                                    @if($room->room_type->kitchen && $room->room_type->kitchen != 'default.jpg')
                                    <img src="{{ asset('images/'.$room->room_type->kitchen) }}" width="150">
                                    @else
                                    <span>Kitchen not include</span>

                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><b>Bed Room</b> </td>
                                <td>
                                    @if($room->room_type->bedroom && $room->room_type->bedroom != 'default.jpg')
                                    <img src="{{ asset('images/'.$room->room_type->bedroom) }}" width="150">

                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td><b>Bath Room</b> </td>
                                <td>
                                    @if($room->room_type->bathroom && $room->room_type->bathroom != 'default.jpg')
                                    <img src="{{ asset('images/'.$room->room_type->bathroom) }}" width="150">


                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><b>View</b> </td>
                                <td>
                                    @if($room->room_type->view && $room->room_type->view != 'default.jpg')
                                    <img src="{{ asset('images/'.$room->room_type->view) }}" width="150">


                                    @endif
                                </td>
                            </tr>

                        </table>
                        <a href="{{route('admin.room.index')}}"> <button class="btn btn-primary">Back</button><a>

                    </div>
                </div>
            </div>
        </div>
   
@endsection