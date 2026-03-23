@extends('layouts.userLayout')

@section('content')
<div class="container col-lg-6 py-5">

    {{-- Success Message --}}
    @if (session('succPass'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3">
            {{ session('succPass') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <!-- Header -->
        <div class="card-header text-white d-flex justify-content-between align-items-center" style="background-color: navy">
            <h4 class="mb-0"><i class="fa fa-lock me-2"></i>Change Password</h4>
        </div>

        <!-- Body -->
        <div class="card-body p-4">
            <form action="{{ route('user.changePassword') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="current_password" class="form-label fw-bold">Current Password</label>
                    <input type="password" name="current_password" id="current_password"
                           class="form-control rounded-3 shadow-sm" placeholder="Enter Current Password">
                    @error('current_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label fw-bold">New Password</label>
                    <input type="password" name="new_password" id="new_password"
                           class="form-control rounded-3 shadow-sm" placeholder="Enter New Password">
                    @error('new_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="confirm_password" class="form-label fw-bold">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password"
                           class="form-control rounded-3 shadow-sm" placeholder="Confirm New Password">
                    @error('confirm_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn px-5 py-2 shadow-sm rounded-3" style="background-color: orangered ;color:white">
                        <i class="fa fa-save me-2"></i>Update Password
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<style>
    /* Smooth card shadow hover */
    .card-body .form-control {
        transition: all 0.3s ease;
    }
    .card-body .form-control:focus {
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
        border-color: #0d6efd;
    }

    /* Success alert style */
    .alert-success {
        font-weight: 500;
        border-radius: 0.5rem;
        background: linear-gradient(45deg, #28a745, #218838);
        color: #fff;
    }

    /* Button hover effect */
    .btn-primary:hover {
        background: #0056b3;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
</style>
@endsection
