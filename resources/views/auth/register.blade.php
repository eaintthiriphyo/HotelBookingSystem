@extends('layouts.app')

@section('content')

<style>
    .register-page {
        min-height: 100vh;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 120px 20px 60px;
        background-image:
            linear-gradient(
                rgba(11, 31, 51, 0.70),
                rgba(11, 31, 51, 0.78)
            ),
            url('{{ asset('images/banner.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .register-wrapper {
        width: 100%;
        max-width: 650px;
    }

    .register-card {
        background: rgba(255, 255, 255, 0.96);
        border: none;
        border-radius: 18px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.30);
        overflow: hidden;
    }

    .register-card-body {
        padding: 40px 45px;
    }

    .hotel-title {
        color: #0b1f33;
        text-align: center;
        font-family: 'Playfair Display', serif;
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .register-subtitle {
        color: #737b85;
        text-align: center;
        font-size: 15px;
        margin-bottom: 30px;
    }

    .form-label-custom {
        color: #0b1f33;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .register-card .form-control {
        height: 48px;
        border: 1px solid #e1e5e8;
        border-radius: 8px;
        padding: 10px 14px;
        color: #1d2733;
        background: #fff;
        transition: all 0.2s ease;
    }

    .register-card .form-control:focus {
        border-color: #c8a45d;
        box-shadow: 0 0 0 3px rgba(200, 164, 93, 0.15);
    }

    .register-card .form-control.is-invalid {
        border: 2px solid #dc3545;
        background-image: none;
    }

    .invalid-feedback {
        display: block;
        color: #dc3545;
        font-size: 13px;
        margin-top: 6px;
    }

    .register-btn {
        width: 100%;
        height: 50px;
        border: none;
        border-radius: 8px;
        background: #0b1f33;
        color: white;
        font-size: 15px;
        font-weight: 600;
        letter-spacing: 0.3px;
        transition: all 0.3s ease;
    }

    .register-btn:hover {
        background: #163a5c;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(11, 31, 51, 0.25);
    }

    .login-link {
        color: #0b1f33;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s ease;
    }

    .login-link:hover {
        color: #c8a45d;
    }

    .gold-line {
        width: 55px;
        height: 3px;
        background: #c8a45d;
        margin: 0 auto 15px;
        border-radius: 5px;
    }

    @media (max-width: 768px) {
        .register-page {
            padding: 110px 15px 40px;
        }

        .register-card-body {
            padding: 30px 25px;
        }

        .hotel-title {
            font-size: 27px;
        }
    }

    @media (max-width: 480px) {
        .register-card-body {
            padding: 25px 20px;
        }

        .hotel-title {
            font-size: 25px;
        }
    }
</style>


<section class="register-page">

    <div class="register-wrapper">

        <div class="card register-card">

            <div class="register-card-body">

                <div class="gold-line"></div>

                <h3 class="hotel-title">
                    Create Your Account
                </h3>

                <p class="register-subtitle">
                    Join Paradise Hotel and start your booking journey
                </p>


                <form method="POST" action="{{ route('register') }}">
                    @csrf


                    {{-- Name --}}
                    <div class="mb-3">

                        <label class="form-label-custom">
                            Name
                        </label>

                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Enter your name"
                        >

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Email --}}
                    <div class="mb-3">

                        <label class="form-label-custom">
                            Email Address
                        </label>

                        <input
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Enter your email address"
                        >

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Phone --}}
                    <div class="mb-3">

                        <label class="form-label-custom">
                            Phone
                        </label>

                        <input
                            type="text"
                            class="form-control @error('phone') is-invalid @enderror"
                            name="phone"
                            value="{{ old('phone') }}"
                            placeholder="Enter your phone number"
                        >

                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Password --}}
                    <div class="mb-3">

                        <label class="form-label-custom">
                            Password
                        </label>

                        <input
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password"
                            placeholder="Enter your password"
                        >

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Confirm Password --}}
                    <div class="mb-4">

                        <label class="form-label-custom">
                            Confirm Password
                        </label>

                        <input
                            type="password"
                            class="form-control"
                            name="password_confirmation"
                            placeholder="Confirm your password"
                        >

                    </div>


                    {{-- Register Button --}}
                    <button type="submit" class="register-btn">
                        Register
                    </button>


                    {{-- Login --}}
                    <div class="text-center mt-4">

                        <span style="color:#737b85; font-size:14px;">
                            Already have an account?
                        </span>

                        <a href="{{ route('login') }}" class="login-link">
                            Login
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</section>

@endsection