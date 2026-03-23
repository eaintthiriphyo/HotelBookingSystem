@extends('layouts.adminLayout')

@section('content')
<div class="container pt-4">

    {{-- Success Message --}}
    @if (session('succPass'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('succPass') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><b>Change Password</b></h4>
                </div>

                <div class="card-body">

                    <form action="{{route('admin.staff.changePassword')}}" method="POST">
                        @csrf
                        @method('PUT')

                        <table class="table table-bordered">

                            <tr>
                                <th width="35%">Current Password</th>
                                <td>
                                    <input type="password" name="current_password" class="form-control" placeholder="Enter Current Password">
                                    @error('current_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                            </tr>

                            <tr>
                                <th>New Password</th>
                                <td>
                                    <input type="password" name="new_password" class="form-control" placeholder="Enter New Password">
                                    @error('new_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                            </tr>

                            <tr>
                                <th>Confirm Password</th>
                                <td>
                                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm New Password">
                                    @error('confirm_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2" class="text-center">
                                    <button type="submit" class="btn px-4" style="background-color:navy;color:white">
                                        Update Password
                                    </button>
                                </td>
                            </tr>

                        </table>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>
@endsection
