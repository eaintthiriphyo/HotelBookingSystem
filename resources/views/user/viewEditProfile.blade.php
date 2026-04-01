@extends('layouts.userLayout')

@section('content')
<div class="container col-lg-7 py-5">

    {{-- Success Message --}}
    @if (session('succUpdateProfile'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3">
            {{ session('succUpdateProfile') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <!-- Header -->
        <div class="card-header text-white d-flex justify-content-between align-items-center" style="background-color:navy;" >
            <h4 class="mb-0"><i class="fa fa-user-edit me-2"></i>Edit Profile</h4>
            <a href="{{ route('user.viewProfile', Auth::user()->email) }}" class="btn  shadow-sm" style="background-color:white;color:navy">
                <i class="fa fa-user me-1"></i> View Profile
            </a>
        </div>

        <!-- Body -->
        <div class="card-body p-4">
            <form action="{{ route('user.profileUpdate', Auth::user()->email) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" value="{{ Auth::user()->email }}" name="email" id="email">
                <input type="hidden" value="{{ $profile->role }}" name="role" id="role">
                <input type="hidden" value="{{ $profile->department_id }}" name="department_id" id="department_id">

                <!-- Profile Image -->
                <div class="text-center mb-4">
                    @if ($profile->image && $profile->image != 'default.png')
                        <img src="{{ asset('images/user/' . $profile->image) }}" class="rounded-circle shadow-lg"
                            width="140" height="140" style="object-fit:cover;">
                    @else
                        <img src="{{ asset('images/user/default.png') }}" class="rounded-circle shadow-lg"
                            width="140" height="140">
                    @endif

                    <div class="mt-3">
                        <input type="file" name="image" class="form-control rounded-3 shadow-sm">
                    </div>
                </div>

                <!-- Name -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Name</label>
                    <input type="text" name="name" class="form-control rounded-3 shadow-sm" value="{{ $profile->name }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control rounded-3 shadow-sm" value="{{ $profile->email }}" disabled>
                </div>

                <!-- Phone -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Phone</label>
                    <input type="text" name="phone" class="form-control rounded-3 shadow-sm" value="{{ $profile->phone }}">
                    @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Address -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Address</label>
                    <input type="text" name="address" class="form-control rounded-3 shadow-sm" value="{{ $profile->address }}">
                    @error('address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <!-- Submit -->
                <div class="text-center">
                    <button type="submit" class="btn px-5 py-2 shadow-sm rounded-3"  style="background-color:navy;color:white">
                        <i class="fa fa-save me-1"></i> Update Profile
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

<style>
    /* Form inputs focus effect */
    .form-control:focus {
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
        border-color: #0d6efd;
    }

    /* Card hover shadow */
    .card:hover {
        transform: translateY(-2px);
        transition: all 0.3s ease;
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }

    /* Buttons hover effect */
    .btn-primary:hover {
        background-color: #0b5ed7;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection


