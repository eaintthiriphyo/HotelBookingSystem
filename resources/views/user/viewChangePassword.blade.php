@extends('layouts.userLayout')

@section('content')
<div class="container col-lg-8 py-5">

    {{-- Success Message --}}
    @if (session('succPass'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('succPass') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow border-0">

        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="fa fa-lock me-2"></i>Change Password</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('user.changePassword') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="current_password" class="form-label fw-bold">Current Password</label>
                    <input type="password" name="current_password" id="current_password"
                           class="form-control" placeholder="Enter Current Password">
                    @error('current_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label fw-bold">New Password</label>
                    <input type="password" name="new_password" id="new_password"
                           class="form-control" placeholder="Enter New Password">
                    @error('new_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="confirm_password" class="form-label fw-bold">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password"
                           class="form-control" placeholder="Confirm New Password">
                    @error('confirm_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5">
                        <i class="fa fa-save me-2"></i>Update Password
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
