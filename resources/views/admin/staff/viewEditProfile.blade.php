@extends('layouts.adminLayout')

@section('content')
    <div class="container pt-4">

        @if (session('succUpdateProfile'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('succUpdateProfile') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow">
                     <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><b>Profile's Edit</b></h3>
                <a href="{{ route('admin.staff.viewProfile',Auth::user()->email) }}" class="btn  btn-sm" style="background-color:navy;color:white">Profile</a>
            </div>

                    <div class="card-body">

                        <form action="{{ route('admin.staff.profileUpdate', Auth::user()->email) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <div class="text-center mb-4">

                                @if ($profile->image && $profile->image != 'default.png')
                                    <img src="{{ asset('images/user/' . $profile->image) }}" class="rounded-circle shadow"
                                        width="150">
                                @else
                                    <img src="{{ asset('images/user/default.png') }}" class="rounded-circle shadow"
                                        width="150">
                                @endif

                                <div class="mt-3">
                                    <input type="file" name="image" class="form-control">
                                </div>

                            </div>

                            <table class="table">

                                <tr>
                                    <th width="30%">Staff Name</th>
                                    <td>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $profile->name }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <th>Email</th>
                                    <td>
                                        <input type="email" class="form-control" value="{{ $profile->email }}" disabled>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Phone</th>
                                    <td>
                                        <input type="text" name="phone" class="form-control"
                                            value="{{ $profile->phone }}">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <th>Address</th>
                                    <td>
                                        <input type="text" name="address" class="form-control"
                                            value="{{ $profile->address }}">
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <th>Credential</th>
                                    <td>
                                        <input type="text" name="credential" class="form-control"
                                            value="{{ $profile->credential }}">
                                        @error('credential')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2" class="text-center">
                                        <button type="submit" class="btn px-5" style="background-color:navy;color:white">
                                            Update Profile
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
