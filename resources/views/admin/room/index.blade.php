@extends('layouts.adminLayout')

@section('content')
<div class="container pt-4">

    <!-- Card Header -->
    <div class="card shadow-sm p-3 border-0">
        <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
            <h3 class="mb-0 fw-bold" style="color:#f8f9fa; text-shadow:1px 1px 2px #000;">Room Lists</h3>
            <a href="{{ route('admin.room.create') }}" class="btn btn-light btn-sm">Add New</a>
        </div>

     
        <div class="card-body mb-3">
            <div class="d-flex justify-content-between align-items-center gap-3">
                <form action="{{ route('admin.room.search') }}" method="GET" class="d-flex align-items-center gap-2 flex-wrap">
                    <select name="room_type_id" class="form-select " style="width:auto;">
                        <option value="">Select Room Type</option>
                        @foreach($roomType as $type)
                            <option value="{{ $type->id }}" {{ request('room_type_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->room_type }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-dark btn-sm">Search</button>
                </form>
                <a href="{{ route('admin.room.index') }}" class="btn btn-dark btn-sm">All Lists</a>
            </div>
        </div>

        <!-- Room Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th class="text-white">Room Number</th>
                        <th class="text-white">Room Type</th>
                        <th width="220" class="text-white">Action</th>
                    </tr>
                </thead>
                <tbody class="text-dark">
                    @forelse($rooms as $room)
                        <tr>
                            <td class="fw-bold">{{ $room->room_number }}</td>
                            <td>{{ $room->room_type->room_type }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.room.show', $room->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.room.edit', $room->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.room.destroy', $room->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">No rooms found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $rooms->links() }}
        </div>
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