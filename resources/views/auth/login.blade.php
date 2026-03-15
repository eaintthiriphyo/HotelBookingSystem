@extends('layouts.app')

@section('content')
    <style>
        body {
            background: url('https://images.unsplash.com/photo-1566073771259-6a8506099945') no-repeat center center/cover;
            height: 100vh;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
            color: white;
        }

        .login-card label {
            color: white;
        }

        .hotel-title {
            color: white;
        }

        .invalid-feedback {
            color: #ffb3b3;

            font-size: 14px;
        }

        .form-control.is-invalid {
            border: 2px solid #ff4d4d;
        }
    </style>

    <div class="container d-flex justify-content-center align-items-center" style="height:90vh;">
        <div class="col-md-5">
            <div class="card login-card p-3">
                <div class="card-body">

                    <h3 class="hotel-title">Hotel Booking </h3>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label>Email Address</label>

                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" >

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label>Password</label>

                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" >

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" class="form-check-input">
                            <label class="form-check-label">Remember Me</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Login
                        </button>

                        <div class="text-center mt-3">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    Forgot Password?
                                </a>
                            @endif
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
