@extends('layouts.adminLayout')

@section('content')

<div class="container pt-4">
  
            <div class="card p-3">
                <div class="card-header"><h3><b>Room Type's Details</b></h3></div>
                <div class="card-body">
                    <div class="col-10">
                            <table class="table">
                                 <tr>
                                    <td><b>Room Type</b> </td> 
                                    <td>{{$roomType->room_type}}</td>
                                </tr>
                                <tr>
                                    <td><b>Price</b> </td> 
                                    <td>{{$roomType->price}}</td>
                                </tr>
                                  <tr>
                                    <td><b>Description</b> </td> 
                                    <td>{{$roomType->description}}</td>
                                </tr>
                                <tr>
                                    <td><b>Kitchen</b> </td> 
                                    <td>
                                        @if($roomType->kitchen && $roomType->kitchen != 'default.jpg')
                                                    <img src="{{ asset('images/'.$roomType->kitchen) }}" width="150">
                                        @else
                                         <span>Kitchen not include</span>

                                        @endif
                                    </td>
                                </tr>


                                 <tr>
                                    <td><b>Bed Room</b> </td> 
                                    <td>
                                        @if($roomType->bedroom && $roomType->bedroom != 'default.jpg')
                                                    <img src="{{ asset('images/'.$roomType->bedroom) }}" width="150">
                                        @else
                                         <span>bed Room not include</span>

                                        @endif
                                    </td>
                                </tr>
                                 
                                 <tr>
                                    <td><b>Bath Room</b> </td> 
                                    <td>
                                        @if($roomType->bathroom && $roomType->bathroom != 'default.jpg')
                                                    <img src="{{ asset('images/'.$roomType->bathroom) }}" width="150">
                                        @else
                                         <span>bath Room not include</span>

                                        @endif
                                    </td>
                                </tr>

                                  <tr>
                                    <td><b>View</b> </td> 
                                    <td>
                                        @if($roomType->view && $roomType->view != 'default.jpg')
                                                    <img src="{{ asset('images/'.$roomType->view) }}" width="150">
                                        @else
                                         <span>View not show</span>

                                        @endif
                                    </td>
                                </tr>
                           
                            </table>
                           <a href="{{route('admin.roomType.index')}}"> <button class="btn btn-primary">Back</button><a>
                            
                    </div>
                </div>
            </div>
        </div>
  
@endsection