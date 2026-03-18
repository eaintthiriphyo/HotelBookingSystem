@extends('layouts.adminLayout')

@section('content')

<div class="container-fluid ">

           <div class="container pt-4">

        <div class="card p-3">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><b>Bookings Lists</b></h3>
                <a href="{{route('admin.booking.index')}}" class="btn btn-dark btn-sm">Add New</a>
                 <a href="{{route('admin.booking.todayBook')}}" class="btn btn-dark btn-sm">Today Booking List</a>

            </div>

                  <div class="table-responsive ">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-dark">
                            <tr>

                                <th>User Eamil</th>
                                <th>User Name</th>
                                <th>Room Number</th>
                                 <th>Room Type</th>
                                 <th>Booking Date</th>
                                 <th>Check In </th>
                                 <th>Check Out </th>
                                 <th>Details</th>

                            </tr>
                        </thead>
                     <tbody>

                        @foreach($bookList as $bl)
                       <tr>

                       <td>{{$bl->user->email}}</td>
                      <td>{{$bl->user->name}}</td>
                    <td>{{$bl->room->room_number}}</td>
                     <td>{{$bl->room->room_type->room_type}}</td>

                     <td>{{$bl->created_at}}</td>
                    <td>{{$bl->check_in}}</td>
                    <td>{{$bl->check_out}}</td>
                      <td>
                                <form action="{{route('admin.booking.checkIn',$bl->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                   <input type="hidden" name="room_id" value="{{$bl->room->id}}">

                                    <select name="status" class="form-control" onchange="this.form.submit()">

                                        <option value="">Change Status</option>
                                        <option value="check-in" {{$bl->status=='check-in' ? 'selected':''}}>Check In</option>





                                    </select>
                                </form>
                            </td>



                       </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
              <div class="d-flex justify-content-center mt-3">
       {{ $bookList->links() }} 
    </div>
        </div>

<style>
    body,
    .text-dark {
        color: #212529 !important;
        /* darker text */
    }


    .table td {
        vertical-align: middle;
        color: #212529;

    }

    .btn-dark {
        background-color: #343a40;
        border-color: #343a40;
    }

    .btn-dark:hover {
        background-color: #23272b;
        border-color: #23272b;
    }

    .form-control.border-dark {
        border: 1px solid #343a40;
    }

    /* Increase spacing between buttons inside table if needed */
    .btn-group .btn {
        margin-right: 3px;
    }
</style>
@endsection
