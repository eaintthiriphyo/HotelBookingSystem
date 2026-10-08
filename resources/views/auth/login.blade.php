@extends('layouts.app')

@section('content')

<style>

    /* =========================================
       LOGIN PAGE
    ========================================= */

    .login-page {
        min-height: 100vh;

        margin-top: -20px;

        padding: 120px 20px 80px;

        position: relative;

        background-image:
            linear-gradient(
                rgba(11, 31, 51, 0.55),
                rgba(11, 31, 51, 0.55)
            ),
            url('{{ asset('images/banner.jpg') }}');

        background-size: cover;

        background-position: center;

        background-repeat: no-repeat;

        display: flex;

        align-items: center;

        justify-content: center;
    }


    /* =========================================
       LOGIN CARD
    ========================================= */

    .login-card {
        width: 100%;

        max-width: 460px;

        background: rgba(255, 255, 255, 0.96);

        border: none;

        border-radius: 18px;

        box-shadow:
            0 20px 50px rgba(0, 0, 0, 0.25);

        overflow: hidden;
    }


    .login-card-body {
        padding: 40px;
    }


    /* =========================================
       TITLE
    ========================================= */

    .hotel-title {
        color: var(--primary);

        font-family: 'Playfair Display', serif;

        font-size: 2rem;

        font-weight: 600;

        text-align: center;

        margin-bottom: 8px;
    }


    .login-subtitle {
        color: var(--muted);

        text-align: center;

        font-size: 0.9rem;

        margin-bottom: 30px;
    }


    /* =========================================
       FORM
    ========================================= */

    .login-label {
        color: var(--primary);

        font-size: 0.9rem;

        font-weight: 600;

        margin-bottom: 7px;
    }


    .login-input {
        height: 48px;

        border: 1px solid var(--border);

        border-radius: 9px;

        padding: 10px 14px;

        font-size: 0.92rem;

        transition: all 0.2s ease;
    }


    .login-input:focus {
        border-color: var(--accent);

        box-shadow:
            0 0 0 3px rgba(200, 164, 93, 0.15);
    }


    /* =========================================
       REMEMBER ME
    ========================================= */

    .remember-label {
        color: var(--muted);

        font-size: 0.88rem;
    }


    .remember-checkbox {
        border-color: #cfcfcf;
    }


    .remember-checkbox:checked {
        background-color: var(--primary);

        border-color: var(--primary);
    }


    /* =========================================
       LOGIN BUTTON
    ========================================= */

    .login-button {
        width: 100%;

        height: 48px;

        border: none;

        border-radius: 9px;

        background: var(--primary);

        color: white;

        font-size: 0.95rem;

        font-weight: 600;

        transition: all 0.25s ease;
    }


    .login-button:hover {
        background: var(--primary-light);

        color: white;

        transform: translateY(-1px);

        box-shadow:
            0 7px 18px rgba(11, 31, 51, 0.2);
    }


    /* =========================================
       FORGOT PASSWORD
    ========================================= */

    .forgot-password {
        color: var(--primary);

        font-size: 0.88rem;

        text-decoration: none;

        transition: color 0.2s ease;
    }


    .forgot-password:hover {
        color: var(--accent);

        text-decoration: underline;
    }


    /* =========================================
       VALIDATION
    ========================================= */

    .invalid-feedback {
        color: #dc3545;

        font-size: 0.82rem;

        margin-top: 5px;
    }


    .form-control.is-invalid {
        border: 1px solid #dc3545;

        background-image: none;
    }


    .form-control.is-invalid:focus {
        border-color: #dc3545;

        box-shadow:
            0 0 0 3px rgba(220, 53, 69, 0.1);
    }


    /* =========================================
       MOBILE
    ========================================= */

    @media (max-width: 575px) {

        .login-page {
            padding: 110px 15px 60px;
        }

        .login-card-body {
            padding: 30px 22px;
        }

        .hotel-title {
            font-size: 1.7rem;
        }

    }

</style>


<!-- =========================================
     LOGIN PAGE
========================================= -->

<section class="login-page">


    <!-- =====================================
         LOGIN CARD
    ====================================== -->

    <div class="login-card mt-5">


        <div class="login-card-body">


            <!-- =================================
                 TITLE
            ================================== -->

            <h3 class="hotel-title">
                Welcome Back
            </h3>

            <p class="login-subtitle">
                Login to your Paradise Hotel account
            </p>


            <!-- =================================
                 LOGIN FORM
            ================================== -->

            <form method="POST" action="{{ route('login') }}">

                @csrf


                <!-- =============================
                     EMAIL
                ============================== -->

                <div class="mb-3">

                    <label class="login-label">
                        Email Address
                    </label>

                    <input
                        type="email"
                        class="form-control login-input @error('email') is-invalid @enderror"
                        name="email"
                        value="{{ old('email') }}"
                        autocomplete="email"
                    >

                    @error('email')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                <!-- =============================
                     PASSWORD
                ============================== -->

                <div class="mb-3">

                    <label class="login-label">
                        Password
                    </label>

                    <input
                        type="password"
                        class="form-control login-input @error('password') is-invalid @enderror"
                        name="password"
                        autocomplete="current-password"
                    >

                    @error('password')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                <!-- =============================
                     REMEMBER ME
                ============================== -->

                <div class="mb-4 form-check">

                    <input
                        type="checkbox"
                        name="remember"
                        class="form-check-input remember-checkbox"
                        id="remember"
                    >

                    <label
                        class="form-check-label remember-label"
                        for="remember"
                    >
                        Remember Me
                    </label>

                </div>


                <!-- =============================
                     LOGIN BUTTON
                ============================== -->

                <button
                    type="submit"
                    class="login-button"
                >
                    Login
                </button>


                <!-- =============================
                     FORGOT PASSWORD
                ============================== -->

                <div class="text-center mt-4">

                    @if (Route::has('password.request'))

                        <a
                            href="{{ route('password.request') }}"
                            class="forgot-password"
                        >
                            Forgot Password?
                        </a>

                    @endif

                </div>


            </form>


        </div>

    </div>


</section>

@endsection