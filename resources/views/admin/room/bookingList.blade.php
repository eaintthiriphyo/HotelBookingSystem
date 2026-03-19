@extends('layouts.adminLayout')

@section('content')
<div class="container-fluid pt-4">

    <div class="card shadow border-0 rounded-4">

        <!-- Header -->
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center px-4 py-3 rounded-top-4">
            <h4 class="mb-0 fw-semibold">Booked Rooms</h4>

            <a href="{{ route('admin.room.index') }}" class="btn btn-light btn-sm px-3">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="card-body">

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center mb-0">

                    <thead class="bg-dark text-white">
                        <tr>
                            <th>Room No</th>
                            <th>Room Type</th>
                            <th>Status</th>
                            <th width="180">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($room as $r)
                            @if($r->is_avaliable == 'booked')
                            <tr>

                                <td class="fw-semibold">{{ $r->room_number }}</td>

                                <td>{{ $r->room_type->room_type }}</td>

                                <!-- Status Dropdown -->
                                <td>
                                    <form action="{{ route('admin.room.bookingListUpdate', $r->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <select name="is_avaliable"
                                                class="form-select form-select-sm shadow-sm border-0 status-dropdown"
                                                onchange="this.form.submit()">

                                            <option value="booked" {{ $r->is_avaliable == 'booked' ? 'selected' : '' }}>
                                                🔴 Booked
                                            </option>

                                            <option value="unavaliable" {{ $r->is_avaliable == 'unavaliable' ? 'selected' : '' }}>
                                                🟢 Check In
                                            </option>

                                        </select>
                                    </form>
                                </td>

                                <!-- Actions -->
                                <td>
                                    <div class="d-flex justify-content-center gap-2">

                                        <a href="{{ route('admin.room.show', $r->id) }}"
                                            class="btn btn-sm btn-warning rounded-circle">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('admin.room.edit', $r->id) }}"
                                            class="btn btn-sm btn-primary rounded-circle">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                    </div>
                                </td>

                            </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="4" class="text-muted py-4">No booked rooms found.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $room->links() }}
            </div>

        </div>

    </div>
</div>

<style>
    .card {
        background: #ffffff;
    }

    .table thead {
        font-size: 14px;
        letter-spacing: 0.5px;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
        transition: 0.2s;
    }

    .btn-circle {
        width: 35px;
        height: 35px;
        padding: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Status Dropdown Colors */
    .status-dropdown {
        font-weight: 500;
        border-radius: 8px;
    }

    .status-dropdown option[value="booked"] {
        color: red;
    }

    .status-dropdown option[value="unavaliable"] {
        color: green;
    }

</style>
@endsection