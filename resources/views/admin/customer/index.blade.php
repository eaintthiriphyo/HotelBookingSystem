@extends('layouts.adminLayout')

@section('content')
    <div class="container pt-4">

        <div class="card p-3">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><b>Customers Lists</b></h3>
                <a href="{{ route('admin.customer.create') }}" class="btn btn-dark btn-sm">Add New</a>
            </div>




            <div class="table-responsive ">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-dark">
                        <>
                            <th>Image</th>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Customer Phone</th>
                            <th>Customer Credential</th>
                            <th>Status</th>
                            </tr>
                    </thead>

                    <tbody>

                        @foreach ($customers as $c)
                        <tr>
                            <td>


                                @if ($c->image)
                                    <img src="{{ asset('images/user/' . $c->image) }}" width="60"
                                        class="img-fluid rounded shadow">
                                @else
                                    <img src="{{ asset('images/user/default.png') }}" width="60"
                                        class="img-fluid rounded shadow">
                                @endif
                            </td>
                            <td>{{ $c->name }}</td>
                            <td>{{ $c->email }}</td>
                            <td>{{ $c->phone }}</td>
                            <td>{{ $c->credential }}</td>
                            <td>Active</td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </div>
@endsection
