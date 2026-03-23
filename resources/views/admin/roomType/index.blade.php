@extends('layouts.adminLayout')

@section('content')
<div class="container pt-4">

    <div class="card shadow-sm p-3 border-0">

        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center "style="background-color:navy;color:white">
            <h3 class="mb-0 fw-bold fw-semibold">Room Types</h3>
            <a href="{{ route('admin.roomType.create') }}" class="btn btn-light btn-sm"><i class="fas fa-plus"></i>Add New</a>
        </div>

        <!-- Search & Filter -->
        <div class="card-body">
           <div class="d-flex mb-3 justify-content-between  align-items-center gap-3">
    <form action="{{ route('admin.roomTypes.search') }}" method="GET" class="d-flex">
        <input type="text" name="search" value="{{ request('search') }}"
            class="form-control border-dark" placeholder="Search room type...">
        <button type="submit" class="btn btn-dark ms-2">Search</button>
    </form>

    <a href="{{ route('admin.roomType.index') }}" class="btn ms-3" style="background-color:navy;color:white"><i class="fas fa-list"></i>All </a>
</div>

            <!-- Room Types Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead style="background-color:navy;color:white">
                        <tr >
                            <th>Room Type</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-dark">
                        @forelse ($roomTypes as $rt)
                        <tr>
                            <td class="fw-semibold">{{ $rt->room_type }}</td>
                            <td>${{ number_format($rt->price, 2) }}</td>
                            <td>{{ $rt->description }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <!-- View Icon -->
                                    <a href="{{ route('admin.roomType.show', $rt->id) }}" class="btn btn-sm btn-warning" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <!-- Edit Icon -->
                                    <a href="{{ route('admin.roomType.edit', $rt->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <!-- Delete Icon -->
                                    <form action="{{ route('admin.roomType.destroy', $rt->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No room types found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $roomTypes->links() }}
            </div>
        </div>

    </div>
</div>

<style>
    body,
    .text-dark {
        color: #212529 !important;
        /* darker text */
    }

    .table th,
    .table td {
        vertical-align: middle;
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
