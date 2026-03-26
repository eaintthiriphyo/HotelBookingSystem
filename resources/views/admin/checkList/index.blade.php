@extends('layouts.adminLayout')

@section('content')
<div class="container-fluid">
    <div class="container pt-4">
        <div class="card shadow-sm border-0">
            <div class="card-header  d-flex justify-content-between align-items-center" style="background-color:navy;color:white">
                <h3 class="mb-0"><b>Today Check In Lists</b></h3>


            </div>

            <div class="table-responsive p-3">
                <table class="table table-hover table-bordered align-middle text-center">
                    <thead style="background-color:navy;color:white">
                        <tr>
                            <th>User Email</th>
                            <th>User Name</th>
                            <th>Room Number</th>
                            <th>Room Type</th>
                            <th>Booking Date</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($todayBooks as $c)
                        <tr>
                            <td>{{ $c->user->email }}</td>
                            <td>{{ $c->user->name }}</td>
                            <td> <span class="badge bg-dark text-white">{{ $c->room->room_number }}</span></td>
                            <td>{{ $c->room->room_type->room_type }}</td>
                            <td>{{ $c->created_at->format('d M Y') }}</td>
                            <td>{{ $c->check_in }}</td>
                            <td>{{ $c->check_out }}</td>
                            <td>
                                <form action="{{route('admin.booking.update',$c->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="room_id" value="{{ $c->room->id }}">
                                   
                                        <input type="hidden" name="status" id="statusInput" value="">

                                        <button type="submit" class="btn btn-primary" onclick="document.getElementById('statusInput').value='check-in'">
                                            Check-in
                                        </button>

                                        <button type="submit" class="btn btn-danger" onclick="document.getElementById('statusInput').value='cancel'">
                                            Cancel
                                        </button>
                                   
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">No bookings for today.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $todayBooks->links() }}
            </div>
        </div>
    </div>
</div>

<style>
    body,
    .text-dark {
        color: #212529 !important;
    }

    .table td,
    .table th {
        vertical-align: middle;
    }

    .table td {
        vertical-align: middle;
        color: #212529;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
        transition: 0.3s;
    }

    .card {
        border-radius: 12px;
    }

    .form-select-sm {
        min-width: 120px;
    }

    .btn-light,
    .btn-outline-light {
        font-size: 0.85rem;
    }

    /* Optional: fix pagination styling */
    .pagination .page-link {
        color: #343a40;
    }

    .pagination .page-item.active .page-link {
        background-color: #343a40;
        border-color: #343a40;
    }
</style>
@endsection