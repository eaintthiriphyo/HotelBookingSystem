@extends('layouts.adminLayout')

@section('content')

<div class="container pt-4">
   
            <div class="card p-3">
                <div class="card-header"><h3><b> Room Types</b></h3></div>
                <div class="card-body">

              <a href="{{route('admin.roomType.create')}}">
                <button class="btn btn-success">Add Room Types</button>
              </a>
               

              <table class="table mt-3">
                 
               
          
              <thead>
                <tr>
                    <th>Room Type</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
              </thead>
           
              <tbody>


               @foreach($roomTypes as $rt)

               <tr>
                <td>{{$rt->room_type}}</td>
                <td>{{$rt->price}}</td>
                <td>{{$rt->description}}</td>
                <td>
                   <a href="{{route('admin.roomType.show',$rt->id)}}" class="btn btn-sm btn-warning">View</a>
                    <a href="{{route('admin.roomType.edit',$rt->id)}}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{route('admin.roomType.destroy',$rt->id)}}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
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