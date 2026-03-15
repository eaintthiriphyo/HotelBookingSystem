@extends('layouts.adminLayout')

@section('content')
    <div class="container-fluid pt-4">

        <div class="card shadow">



        </div>

        <div class="card-body">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><b>Department Lists</b></h3>
                <a href="{{ route('admin.department.create') }}" class="btn btn-dark btn-sm">Add New</a>
            </div>


            <table class="table table-bordered table-striped text-center">

                <thead class="table-dark">
                    <tr>
                        <th>Department Title</th>
                        <th>Details</th>
                        <th>Action</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($dep as $d)
                        <tr>

                            <td>{{ $d->title }}</td>
                            <td>{{ $d->details }}</td>

                            <td>

                                <div class="btn-group">



                                    <a href="{{ route('admin.department.edit', $d->id) }}" class="btn btn-sm btn-primary">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.department.destroy', $d->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger">Delete</button>

                                    </form>

                                </div>

                            </td>
                        </tr>
                    @endforeach



                </tbody>

            </table>

        </div>

    </div>

    </div>
@endsection
