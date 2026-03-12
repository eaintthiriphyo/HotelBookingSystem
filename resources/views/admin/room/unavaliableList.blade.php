@extends('layouts.adminLayout')

@section('content')

<div class="container pt-4">
    
            <div class="card ">
                <div class="card-header">
                    <h3><b> Rooms Lists</b></h3>
                </div>
                <div class="card-body">

                    <a href="{{route('admin.room.index')}}">
                        <button class="btn btn-success">Back</button>
                    </a>

                    <br><br>


                    <table class="table mt-3">



                        <thead>
                            <tr>
                                <th>Room Number</th>
                                <th>Room Type</th>
                                <th>Room Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach($room as $r)
                        @if($r->is_avaliable=='unavaliable')
                        <tr>
                            <td>{{$r->room_number}}</td>
                            <td>{{$r->room_type->room_type}}</td>

                            <td>
                                <form action="{{route('admin.room.unavaliableListUpdate',$r->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                   
                                    <select name="is_avaliable" class="form-control" onchange="this.form.submit()">

                                         <option value="unavaliable" {{$r->is_avaliable=='unavaliable' ? 'selected':''}}>Unavailable</option>

                                        <option value="avaliable" {{$r->is_avaliable=='avaliable' ? 'selected':''}}>Check Out</option>



                                    </select>
                                </form>
                            </td>
                        </tr>
                        @endif
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
   
@endsection