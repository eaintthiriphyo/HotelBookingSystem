@extends('layouts.adminLayout')

@section('content')

<div class="container pt-4">

    <div class="card shadow border-0 rounded-3">

        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center rounded-top "style="background-color:navy;color:white">
            <h4 class="mb-0 fw-bold">Bookings Lists</h4>

            <div>
                <a href="{{ route('admin.booking.index') }}" class="btn btn-light btn-sm me-2">
                    <i class="fa fa-plus"></i> Add New
                </a>

                <a href="{{ route('admin.booking.todayBook') }}" class="btn btn-outline-light btn-sm">
                    <i class="fa fa-list"></i>Today Booking Lists
                </a>
            </div>
        </div>

        <!-- Table -->
        <div class="card-body bg-white">

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">

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
                        @foreach($bookList as $bl)
                        <tr>

                            <td>{{ $bl->user->email }}</td>
                            <td>{{ $bl->user->name }}</td>
                            <td><span class="badge bg-secondary">{{ $bl->room->room_number }}</span></td>
                            <td>{{ $bl->room->room_type->room_type }}</td>
                            <td>{{ $bl->created_at->format('d M Y') }}</td>
                            <td>{{ $bl->check_in }}</td>
                            <td>{{ $bl->check_out }}</td>

                            <td>
                                <form action="{{ route('admin.booking.checkIn', $bl->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="room_id" value="{{ $bl->room->id }}">

                                    <select name="status"
                                        class="form-select form-select-sm border-dark"
                                        onchange="this.form.submit()">

                                        <option value="">Change</option>

                                        <option value="check-in"
                                            {{ $bl->status == 'check-in' ? 'selected' : '' }}>
                                            ✔ Check In
                                        </option>

                                    </select>
                                </form>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $bookList->links() }}
            </div>

        </div>
    </div>
</div>

<!-- Style -->
<style>
    body {
        color: #212529;
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
        font-size: 13px;
        padding: 6px 10px;
        color:white;
    }

    .form-select {
        cursor: pointer;
    }

    .btn-light {
        font-weight: 500;
    }

    .btn-outline-light:hover {
        background-color: #fff;
        color: #000;
    }
</style>

@endsection
