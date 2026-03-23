@extends('layouts.adminLayout')

@section('content')
    <div class="container pt-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><b>Contact Lists</b></h3>
            </div>

            <div class="table-responsive p-3">
                <table class="table table-hover table-bordered align-middle text-center">
                    <thead class="table-dark">
                        <tr>

                            <th> Name</th>
                            <th> Email</th>
                            <th> Phone</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                     <tbody>
@forelse($contact as $c)
<tr class="{{ $c->status == 'unread' ? 'table-warning font-weight-bold' : '' }}">
    <td>{{ $c->name }}</td>
    <td>{{ $c->email }}</td>
    <td>{{ $c->phone }}</td>
    <td>{{ $c->message }}</td>
    <td>
        <div class="btn btn-group">
      <a href="{{route('admin.viewMail',$c->id)}}" class="btn btn-success">Send Mail</a>

            <a href="{{route('admin.contact.view', $c->id) }}" class="btn btn-warning">View</a>
        <form action="{{route('admin.contact.destroy',$c->id)}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="4" class="text-center">No contact found.</td>
</tr>
@endforelse
</tbody>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $contact->links() }}
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
            color: black;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
            transition: 0.3s;
        }

        .card {
            border-radius: 12px;
        }

        .img-fluid.rounded-circle {
            object-fit: cover;
        }

        .pagination .page-link {
            color: #343a40;
        }

        .pagination .page-item.active .page-link {
            background-color: #343a40;
            border-color: #343a40;
        }
    </style>
@endsection
