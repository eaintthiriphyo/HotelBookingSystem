@extends('layouts.adminLayout')
@section('content')
<div class="container pt-4">
    <div class="row justify-content-center">
      <a href="{{route('admin.room.index')}}" class="btn btn-dark">Back</a>

        <div class="col-md-8">

            <div class="card p-3 ">
          
                            
             <form action="{{route('admin.room.store')}}" method="post" >
                @csrf
                <h3>Add Room </h3>

                <label for="room_number" class="form-label" >Room Number</label>

                <input type="text" name="room_number" class="form-control"><br>


                  <label for="room_type" class="form-label">Room Type</label>


                  <select name="room_type_id" id="" class="form-control">
                    <option value="">Select Room Type</option>
                    @foreach($roomType as $type)
                    <option value="{{$type->id}}">{{$type->room_type}}</option>
                    @endforeach
                  </select><br>
                
                <button type="submit" class="btn btn-primary">Create</button>
                
            </form>
           </div>
            
        </div>
    </div>
</div>
@endsection
