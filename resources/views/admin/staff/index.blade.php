@extends('layouts.adminLayout')

@section('content')
<div class="container pt-4">

    <div class="card p-3">

        <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
            <h3 class="mb-0 fw-bold">Staff Lists</h3>
            <a href="{{ route('admin.staff.create') }}" class="btn btn-light btn-sm">
                <i class="fas fa-plus"></i> Add New
            </a>
        </div>

        <div class="table-responsive mt-3">
            <table class="table table-bordered table-hover text-center">
                <thead class="table-dark text-white">
                    <tr>
                        <th>Image</th>
                        <th>Staff Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Department</th>
                        <th>Address</th>
                        <th>Credential</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody class="text-dark">
                    @foreach ($staff as $s)
                        @if($s->status != 0)
                        <tr>
                            <td>
                                @if ($s->image)
                                    <img src="{{ asset('images/user/' . $s->image) }}" width="60" class="img-fluid rounded shadow">
                                @else
                                    <img src="{{ asset('images/user/default.png') }}" width="60" class="img-fluid rounded shadow">
                                @endif
                            </td>
                            <td>{{ $s->name }}</td>
                            <td>{{ $s->email }}</td>
                            <td>{{ $s->phone }}</td>
                            <td>{{ $s->roles }}</td>
                            <td>{{ $s->department ? $s->department->title : '-' }}</td>
                            <td>{{ $s->address }}</td>
                            <td>{{ $s->credential }}</td>

                            <td>
                                <div class="btn-group" role="group">
                                    @if($s->status != "0" && $s->acc_status == "active")
                                        <!-- Edit Icon -->
                                        <a href="{{ route('admin.staff.edit', $s->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- Delete Icon -->
                                        <form action="{{ route('admin.staff.destroy', $s->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $staff->links() }}
        </div>
    </div>

</div>

<style>
    body, .text-dark {
        color: #212529 !important;
    }

    .table td {
        vertical-align: middle;
        color: #212529;
    }

    .btn-group .btn {
        margin-right: 3px;
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