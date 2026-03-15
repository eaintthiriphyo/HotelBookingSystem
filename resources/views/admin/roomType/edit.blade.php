@extends('layouts.adminLayout')
@section('content')
<div class="container ">

    <div class="card p-3 my-2">
 <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><b>Edit Room Type</b></h3>
                <a href="{{ route('admin.roomType.index') }}" class="btn btn-dark btn-sm">View Lists</a>
            </div>
            <div class="card-body">

        <form action="{{route('admin.roomType.update',$roomType->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <table class="table table-bordered">

                <tr>
                    <td>Room Type</td>
                    <td>
                        <input type="text" name="room_type" class="form-control" value="{{$roomType->room_type}}">
                    </td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td>
                        <input type="text" name="price" class="form-control" value="{{$roomType->price}}">
                    </td>
                </tr>

                <tr>
                    <td>Description</td>
                    <td>
                        <input type="text" name="description" class="form-control" value="{{$roomType->description}}">
                    </td>
                </tr>

                <tr>
                    <td>Kitchen Image</td>
                    <td>
                        <input type="file" name="kitchen" class="form-control"><br>
                        @if($roomType->kitchen)
                            <img src="{{ asset('images/'.$roomType->kitchen) }}" width="100">
                        @endif
                    </td>
                </tr>

                <tr>
                    <td>Bedroom Image</td>
                    <td>
                        <input type="file" name="bedroom" class="form-control"><br>
                        @if($roomType->bedroom)
                            <img src="{{ asset('images/'.$roomType->bedroom) }}" width="100">
                        @endif
                    </td>
                </tr>

                <tr>
                    <td>Bathroom Image</td>
                    <td>
                        <input type="file" name="bathroom" class="form-control"><br>
                        @if($roomType->bathroom)
                            <img src="{{ asset('images/'.$roomType->bathroom) }}" width="100">
                        @endif
                    </td>
                </tr>

                <tr>
                    <td>View Image</td>
                    <td>
                        <input type="file" name="view" class="form-control"><br>
                        @if($roomType->view)
                            <img src="{{ asset('images/'.$roomType->view) }}" width="100">
                        @endif
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>
</div>
@endsection
