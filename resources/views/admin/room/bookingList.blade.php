@extends('layouts.adminLayout')

@section('content')
<div class="container-fluid pt-4">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-dark text-white">
            <h3 class="mb-0 fw-bold" style="color:#f8f9fa; text-shadow:1px 1px 2px #000;">Rooms Lists</h3>
        </div>

        <div class="card-body">

            <a href="{{ route('admin.room.index') }}">
                <button class="btn btn-success mb-3">Back</button>
            </a>

            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center">

                    <thead class="table-dark text-white">
                        <tr>
                            <th>Room Number</th>
                            <th>Room Type</th>
                            <th>Room Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody class="text-dark">
                        @foreach($room as $r)
                            @if($r->is_avaliable == 'booked')
                            <tr>
                                <td class="fw-bold">{{ $r->room_number }}</td>
                                <td>{{ $r->room_type->room_type }}</td>
                                <td>
                                    <form action="{{ route('admin.room.bookingListUpdate', $r->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="is_avaliable" class="form-select text-dark" onchange="this.form.submit()">
                                            <option value="booked" {{ $r->is_avaliable == 'booked' ? 'selected' : '' }}>Booked</option>
                                            <option value="unavaliable" {{ $r->is_avaliable == 'unavaliable' ? 'selected' : '' }}>Check In</option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <!-- Example action buttons -->
                                    <a href="{{ route('admin.room.show', $r->id) }}" class="btn btn-sm btn-warning">View</a>
                                    <a href="{{ route('admin.room.edit', $r->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>

                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $room->links() }}
            </div>

        </div>

    </div>

</div>

<style>
    .table td, .table th {
        color: #212529; 
        vertical-align: middle;
    }
    .form-select.text-dark {
        color: #212529; 
    }
    .btn {
        color: #fff; 
    }
</style>
@endsection