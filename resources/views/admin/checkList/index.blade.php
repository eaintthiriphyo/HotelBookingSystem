@extends('layouts.adminLayout')

@section('content')

<div class="container-fluid ">

    <div class="container pt-4">

        <div class="card p-3">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><b>Check-In Lists</b></h3>
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
                        @foreach($todayBooks as $c)
                        <tr>
                        <td>{{$c->user->email}}</td>
                        <td>{{$c->user->name}}</td>
                        <td>{{$c->room->room_number}}</td>
                        <td>{{$c->room->room_type->room_type}}</td>

                        <td>{{$c->created_at}}</td>
                        <td>{{$c->check_in}}</td>
                        <td>{{$c->check_out}}</td>
                        <td>
                             <form action="" method="POST">
                                    @csrf
                                    @method('PUT')
                                   <input type="hidden" name="room_id" value="{{$c->room->id}}">

                                    <select name="status" class="form-control" onchange="this.form.submit()">

                                        <option value="">Change Status</option>
                                        <option value="check-out" {{$c->status=='avaliable' ? 'selected':''}}>Cancle</option>





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
       {{ $todayBooks->links() }} 
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