@extends('layouts.userLayout')

@section('content')
<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow border-0">

                <!-- Header -->
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fa fa-user me-2"></i>Profile Details</h4>
                    <a href="{{ route('user.viewEditProfile',Auth::user()->email) }}" class="btn btn-light btn-sm">
                        <i class="fa fa-edit me-1"></i> Edit
                    </a>
                </div>

                <!-- Card Body -->
                <div class="card-body">

                    <!-- Profile Image -->
                    <div class="text-center mb-4">
                        @if ($profile->image && $profile->image != 'default.png')
                        <img src="{{ asset('images/user/'.$profile->image) }}"
                            class="rounded-circle shadow mb-3"
                            width="140" height="140" style="object-fit:cover;">
                        @else
                        <img src="{{ asset('images/user/default.png') }}"
                            class="rounded-circle shadow mb-3"
                            width="140" height="140">
                        @endif
                        <h5 class="fw-bold">{{ $profile->name }}</h5>
                        <p class="text-muted">{{ $profile->email }}</p>
                    </div>

                    <!-- Profile Details -->
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold text-end">Phone:</div>
                        <div class="col-md-8">{{ $profile->phone }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold text-end">Address:</div>
                        <div class="col-md-8">{{ $profile->address }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold text-end">Credential:</div>
                        <div class="col-md-8">{{ $profile->credential }}</div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>
@endsection
