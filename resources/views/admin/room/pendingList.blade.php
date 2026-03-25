@extends('layouts.adminLayout')

@section('content')
    <div class="container pt-4">

        <div class="card shadow border-0 rounded-3">

            <!-- Header -->
            <div class="card-header d-flex justify-content-between align-items-center rounded-top"
                style="background-color:navy;color:white">
                <h4 class="mb-0 fw-bold">Bookings Lists</h4>

                <div>
                    <a href="{{ route('admin.booking.index') }}" class="btn btn-light btn-sm me-2">
                        <i class="fa fa-plus"></i> Add New
                    </a>

                    <a href="{{ route('admin.booking.todayBook') }}" class="btn btn-outline-light btn-sm">
                        <i class="fa fa-list"></i> Pending Booking Lists
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
                            {{-- Show highlighted booking first --}}
                            @if ($highlightBooking)
                                <tr style="background-color: #57b6ee;">
                                    <td>{{ $highlightBooking->user->email ?? 'Guest' }}</td>
                                    <td>{{ $highlightBooking->user->name ?? 'Guest' }}</td>
                                    <td><span
                                            class="badge bg-secondary">{{ $highlightBooking->room->room_number ?? '-' }}</span>
                                    </td>
                                    <td>{{ $highlightBooking->room->room_type->room_type ?? 'Room' }}</td>
                                    <td>{{ $highlightBooking->created_at->format('d M Y') }}</td>
                                    <td>{{ $highlightBooking->check_in ?? '-' }}</td>
                                    <td>{{ $highlightBooking->check_out ?? '-' }}</td>
                                    <td>
                                        <form action="{{ route('admin.booking.changePending', $highlightBooking->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="room_id"
                                                value="{{ $highlightBooking->room->id ?? '' }}">
                                            <button type="submit" name="status" value="booked"
                                                class="btn btn-warning btn-sm">Approve</button>
                                            <button type="submit" name="status" value="cancle"
                                                class="btn btn-danger btn-sm">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif

                            @foreach ($pending as $bl)
                                @if (!$highlightBooking || $bl->id != $highlightBooking->id)
                                    <tr>
                                        <td>{{ $bl->user->email ?? 'Guest' }}</td>
                                        <td>{{ $bl->user->name ?? 'Guest' }}</td>
                                        <td><span class="badge bg-secondary">{{ $bl->room->room_number ?? '-' }}</span>
                                        </td>
                                        <td>{{ $bl->room->room_type->room_type ?? 'Room' }}</td>
                                        <td>{{ $bl->created_at->format('d M Y') }}</td>
                                        <td>{{ $bl->check_in ?? '-' }}</td>
                                        <td>{{ $bl->check_out ?? '-' }}</td>
                                        <td>
                                            <form action="{{ route('admin.booking.changePending', $bl->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="d-flex justify-content-between">
                                                    <input type="hidden" name="room_id" value="{{ $bl->room->id ?? '' }}">

                                                    <!-- Approve Button -->
                                                    <button type="submit" name="status" value="booked"
                                                        class="btn btn-warning btn-sm"
                                                        onclick="return confirm('Are you sure you want to approve this booking?')"
                                                        title="Approve Booking">
                                                        <i class="fas fa-check-circle me-1"></i> Approve
                                                    </button>

                                                    <!-- Reject Button -->
                                                    <button type="submit" name="status" value="cancel"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to reject this booking?')"
                                                        title="Reject Booking">
                                                        <i class="fas fa-times-circle me-1"></i> Reject
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $pending->links() }}
                </div>

            </div>
        </div>
    </div>

    <!-- Scroll to Highlighted Row -->
    @if ($highlightId)
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const row = document.querySelector('tr[style*="background-color"]');
                if (row) row.scrollIntoView({
                    behavior: "smooth",
                    block: "center"
                });
            });
        </script>
    @endif

    <!-- Style -->
    <style>
        body {
            color: #212529;
        }

        .card {
            border-radius: 10px;
        }

        .table td {
            vertical-align: middle;
            color: #212529;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }

        .badge {
            font-size: 13px;
            padding: 6px 10px;
            color: white;
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
