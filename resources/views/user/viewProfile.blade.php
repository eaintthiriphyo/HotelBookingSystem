@extends('layouts.userLayout')

@section('content')
<div class="container col-lg-8 py-5">

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

                <!-- Header -->
                <div class="card-header text-white d-flex justify-content-between align-items-center"  style="background-color:navy;">
                    <h4 class="mb-0"><i class="fa fa-user me-2"></i>Profile Details</h4>
                    <a href="{{ route('user.viewEditProfile', Auth::user()->email) }}" class="btn  shadow-sm"  style="background-color:white; color:navy">
                        <i class="fa fa-edit me-1"></i> Edit
                    </a>
                </div>

                <!-- Body -->
                <div class="card-body p-4">

                    <!-- Profile Image -->
                    <div class="text-center mb-4">
                        @if ($profile->image && $profile->image != 'default.png')
                            <img src="{{ asset('images/user/'.$profile->image) }}"
                                class="rounded-circle shadow-lg mb-3"
                                width="140" height="140" style="object-fit:cover;">
                        @else
                            <img src="{{ asset('images/user/default.png') }}"
                                class="rounded-circle shadow-lg mb-3"
                                width="140" height="140">
                        @endif
                        <h5 class="fw-bold mb-0">{{ $profile->name }}</h5>
                        <p class="text-muted mb-0">{{ $profile->email }}</p>
                    </div>

                    <!-- Profile Info -->
                    <div class="row mb-3">
                        <div class="col-4 fw-bold text-secondary">📞 Phone</div>
                        <div class="col-8">{{ $profile->phone }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-4 fw-bold text-secondary">🏠 Address</div>
                        <div class="col-8">{{ $profile->address }}</div>
                    </div>

                   
                </div>

            </div>

        </div>
    </div>

</div>

<style>
    /* Card hover effect */
    .card:hover {
        transform: translateY(-3px);
        transition: all 0.3s ease;
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }

    /* Text colors */
    .text-secondary {
        color: #6c757d;
    }
</style>
@endsection
