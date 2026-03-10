@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-3">
            @include('layouts.sidebar')
        </div>
        <div class="col-8">
            <div class="card p-3">
                <div class="card-header"><h3><b> Rooms Lists</b></h3></div>
                <div class="card-body">

              <a href="{{route('admin.room.create')}}">
                <button class="btn btn-success">Add Rooms</button>
              </a>
               

              <table class="table mt-3">
                 
               
          
              <thead>
                <tr>
                    <th>Room Number</th>
                    <th>Room Type</th>
                    
                    <th>Action</th>
                </tr>
              </thead>
           
              <tbody>
                @foreach($rooms as $room)
                

                <tr>

                <td>{{$room->room_number}}</td>
                <td>{{$room->room_type->room_type}}</td>
                <!-- <td>{{$room->is_avaliable ? 'avaliable' : 'full'}}</td> -->

                <td>
                      <a href=""><button>View</button>
                    </a>
                    <a href=""><button>Edit</button>
                    </a>
                      <a href=""><button>Delete</button>
                    </a>
                </td>
                </tr>
                
                @endforeach
              </tbody>
             
              
              </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection