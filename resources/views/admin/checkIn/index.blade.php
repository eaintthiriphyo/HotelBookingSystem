@extends('layouts.adminLayout')

@section('content')

<div class="container-fluid pt-4">

    <div class="card shadow-sm border-0 rounded-3">

        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color:navy;color:white">
            <h4 class="mb-0 fw-bold">Check-In Lists</h4>
        </div>

        <!-- Table -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center">

                    <thead style="background-color:navy;color:white">
                        <tr>
                            <th>User Email</th>
                            <th>User Name</th>
                            <th>Room No</th>
                            <th>Room Type</th>
                            <th>Booking Date</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($checkInList as $c)
                        <tr>
                            <td>{{ $c->user->email }}</td>
                            <td>{{ $c->user->name }}</td>
                            <td><span class="badge bg-secondary">{{ $c->room->room_number }}</span></td>
                            <td>{{ $c->room->room_type->room_type }}</td>
                            <td>{{ $c->created_at->format('d M Y') }}</td>
                            <td>{{ $c->check_in }}</td>
                            <td>{{ $c->check_out }}</td>
                            <td>
                                <form action="{{ route('admin.checkOut.update', $c->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="room_id" value="{{ $c->room->id }}">

                                    <input type="hidden" name="status" value="check-out">
                                   <button class="btn btn-primary" type="submit">Check-out</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $checkInList->links() }}
            </div>
        </div>

    </div>
</div>

<!-- Style -->
<style>
    body {
        color: #212529 !important;
    }

    .card {
        border-radius: 10px;
    }

    .table td
     {
        vertical-align: middle;
        color: #212529;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .badge {
        font-size: 12px;
        padding: 5px 10px;
        color: white;
    }

    .form-select {
        cursor: pointer;
    }

    .btn-dark {
        background-color: #343a40;
        border-color: #343a40;
    }

    .btn-dark:hover {
        background-color: #23272b;
        border-color: #23272b;
    }
</style>

@endsection
