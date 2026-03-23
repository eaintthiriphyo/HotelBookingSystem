@extends('layouts.app')

@section('content')
<style>
    .hero-section {
        min-height: 100vh; /* full viewport */
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
        <h3 class="hotel-title">{{ __('Confirm Password') }}</h3>
        <p class="text-center">{{ __('Please confirm your password before continuing.') }}</p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="mb-3">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password"
                    class="form-control @error('password') is-invalid @enderror" name="password" required
                    autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <button type="submit" class="btn btn-primary">
                    {{ __('Confirm Password') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link text-white" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </form>
    </div>
</section>
@endsection
