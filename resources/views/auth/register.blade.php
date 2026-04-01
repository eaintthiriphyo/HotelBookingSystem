@extends('layouts.app')

@section('content')

<style>
body{
    height:100vh;
}

.register-card{
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border-radius:12px;
    box-shadow:0 8px 25px rgba(0,0,0,0.4);
    color:white;
}

.register-card label{
    color:white;
}

.hotel-title{
    color:white;
    text-align:center;
    font-weight:bold;
    margin-bottom:20px;
}

.invalid-feedback{
    color:#ffb3b3;
    display:block;
}

.form-control.is-invalid{
    border:2px solid #ff4d4d;
}
</style>

        <section class="hero-section"
            style="background-image: url('{{ asset('images/banner.jpg') }}');
           background-size: cover;
           background-position: center;
           background-repeat: no-repeat;">

<div class="container d-flex justify-content-center align-items-center" style="min-height:90vh;">
    <div class="col-md-6">
        <div class="card register-card p-4">
            <h3 class="hotel-title">Hotel Booking Register</h3>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label>Name</label>
                <input type="text"
                class="form-control @error('name') is-invalid @enderror"
                name="name"
                value="{{ old('name') }}">

                @error('name')
                <div class="invalid-feedback ">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Email Address</label>
                <input type="email"
                class="form-control @error('email') is-invalid @enderror"
                name="email"
                value="{{ old('email') }}">

                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Phone</label>
                <input type="text"
                class="form-control @error('phone') is-invalid @enderror"
                name="phone"
                value="{{ old('phone') }}">

                @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password"
                class="form-control @error('password') is-invalid @enderror"
                name="password">

                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Confirm Password</label>
                <input type="password"
                class="form-control"
                name="password_confirmation">
            </div>

            <button type="submit" class="btn w-100" style="background-color:navy;color:white">
                Register
            </button>

            <div class="text-center mt-3">
                <a href="{{ route('login') }}" class="text-white">
                    Already have an account? Login
                </a>
            </div>

        </form>
    </div>
</div>

</div>
        </section>

@endsection
