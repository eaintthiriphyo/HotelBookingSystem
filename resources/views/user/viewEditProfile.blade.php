@extends('layouts.userLayout')

@section('content')
    <div class="container py-5">

        @if (session('succUpdateProfile'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('succUpdateProfile') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row justify-content-center">

            <div class="col-lg-7">

                <div class="card shadow border-0">

                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><i class="fa fa-user-edit me-2"></i>Edit Profile</h4>

                        <a href="{{ route('user.viewProfile', Auth::user()->email) }}" class="btn btn-light btn-sm">
                            <i class="fa fa-user"></i> View Profile
                        </a>

                    </div>

                    <div class="card-body">

                        <form action="{{ route('user.profileUpdate', Auth::user()->email) }}" method="POST"
                            enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <!-- Profile Image -->

                            <div class="text-center mb-4">

                                @if ($profile->image && $profile->image != 'default.png')
                                    <img src="{{ asset('images/user/' . $profile->image) }}" class="rounded-circle shadow"
                                        width="140" height="140" style="object-fit:cover;">
                                @else
                                    <img src="{{ asset('images/user/default.png') }}" class="rounded-circle shadow"
                                        width="140" height="140">
                                @endif

                                <div class="mt-3">

                                    <input type="file" name="image" class="form-control">

                                </div>

                            </div>

                            <!-- Name -->

                            <div class="mb-3">

                                <label class="form-label fw-bold">Name</label>

                                <input type="text" name="name" class="form-control" value="{{ $profile->name }}">

                                @error('name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror

                            </div>

                            <!-- Email -->

                            <div class="mb-3">

                                <label class="form-label fw-bold">Email</label>

                                <input type="email" class="form-control" value="{{ $profile->email }}" disabled>

                            </div>

                            <!-- Phone -->

                            <div class="mb-3">

                                <label class="form-label fw-bold">Phone</label>

                                <input type="text" name="phone" class="form-control" value="{{ $profile->phone }}">

                                @error('phone')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror

                            </div>

                            <!-- Address -->

                            <div class="mb-3">

                                <label class="form-label fw-bold">Address</label>

                                <input type="text" name="address" class="form-control" value="{{ $profile->address }}">

                                @error('address')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror

                            </div>

                            <!-- Credential -->

                            <div class="mb-4">

                                <label class="form-label fw-bold">Credential</label>

                                <input type="text" name="credential" class="form-control"
                                    value="{{ $profile->credential }}">

                                @error('credential')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror

                            </div>

                            <!-- Submit -->

                            <div class="text-center">

                                <button type="submit" class="btn btn-primary px-5">
                                    <i class="fa fa-save me-1"></i> Update Profile
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
