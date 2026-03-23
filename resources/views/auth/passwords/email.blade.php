@extends('layouts.app')

@section('content')
<style>
    .hero-section {
        min-height: 100vh; /* full screen */
        display: flex;
        justify-content: center;
        align-items: center;
        background-image: url('{{ asset('images/banner.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .reset-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
        color: white;
        padding: 30px;
        width: 100%;
        max-width: 500px;
    }

    .reset-card label {
        color: white;
    }

    .hotel-title {
        text-align: center;
        color: white;
        margin-bottom: 20px;
        font-size: 1.8rem;
        font-weight: 700;
    }

    .form-control.is-invalid {
        border: 2px solid #ff4d4d;
    }

    .invalid-feedback {
        color: #ffb3b3;
        font-size: 14px;
    }

    .btn-primary {
        background-color: navy;
        border-color: navy;
    }

    .btn-primary:hover {
        background-color: #ff4500;
        border-color: #ff4500;
    }
</style>

<section class="hero-section">
    <div class="reset-card">
        <h3 class="hotel-title">{{ __('Reset Password') }}</h3>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <label for="email">{{ __('Email Address') }}</label>
                <input id="email" type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="d-grid mt-3">
                <button type="submit" class="btn btn-primary">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
