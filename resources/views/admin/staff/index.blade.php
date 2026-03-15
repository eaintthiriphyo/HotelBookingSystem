@extends('layouts.adminLayout')

@section('content')
    <div class="container pt-4">

        <div class="card p-3">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><b>Customers Lists</b></h3>
                <a href="{{ route('admin.staff.create') }}" class="btn btn-dark btn-sm">Add New</a>
            </div>




            <div class="table-responsive ">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-dark">
                      
                            <th>Image</th>
                            <th>Staff Name</th>
                            <th>Staff Email</th>
                            <th>Staff Phone</th>

                            <th>Staff Role</th>
                            <th>Staff Department</th>

                            <th>Staff Address</th>
                            <th>Staff Credential</th>
                            <th>Status</th>
                            <th>Action</th>

                            </tr>
                    </thead>

                    <tbody>

                        @foreach ($staff as $s)
                            <tr>
                                 <td>


                                @if ($s->image)
                                    <img src="{{ asset('images/user/' . $s->image) }}" width="60"
                                        class="img-fluid rounded shadow">
                                @else
                                    <img src="{{ asset('images/user/default.png') }}" width="60"
                                        class="img-fluid rounded shadow">
                                @endif
                            </td>
                                <td>{{ $s->name }}</td>
                                <td>{{ $s->email }}</td>
                                <td>{{ $s->phone }}</td>
                                <td>{{ $s->role }}</td>
                                <td>{{ $s->department ? $s->department->title : '-' }}</td>
                                <td>{{ $s->address }}</td>
                                <td>{{ $s->credential }}</td>
                                <td>{{ $s->acc_status }}</td>

                                 <td>

                                <div class="btn-group">



                                    <a href="{{route('admin.staff.edit',$s->id)}}" class="btn btn-sm btn-primary">
                                        Edit
                                    </a>

                                  @if($s->status!="0" && $s->acc_status=="active")
                                    <form action="" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger">Delete</button>

                                    </form>
                                  @endif

                                </div>

                            </td>


                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </div>
@endsection
