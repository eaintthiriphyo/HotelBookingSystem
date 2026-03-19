@extends('layouts.adminLayout')

@section('content')
<div class="container pt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0"><b>Customers Lists</b></h3>
        </div>

        <div class="table-responsive p-3">
            <table class="table table-hover table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Image</th>
                        <th>Customer Name</th>
                        <th>Customer Email</th>
                        <th>Customer Phone</th>
                        <th>Customer Credential</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $c)
                    <tr>
                        <td>
                            @if($c->image)
                            <img src="{{ asset('images/user/' . $c->image) }}" width="60" class="img-fluid rounded-circle shadow">
                            @else
                            <img src="{{ asset('images/user/default.png') }}" width="60" class="img-fluid rounded-circle shadow">
                            @endif
                        </td>
                        <td>{{ $c->name }}</td>
                        <td>{{ $c->email }}</td>
                        <td>{{ $c->phone }}</td>
                        <td>{{ $c->credential }}</td>
                      
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No customers found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $customers->links() }}
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

    .table td{
        color:black;
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