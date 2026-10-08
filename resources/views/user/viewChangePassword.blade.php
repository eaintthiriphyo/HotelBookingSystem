@extends('layouts.userLayout')

@section('content')

<style>
    /* ================================
       PARADISE HOTEL THEME
    ================================= */
    .change-password-page {
        --primary: #0b1f33;
        --primary-light: #163a5c;
        --accent: #c8a45d;
        --background: #f7f7f5;
        --white: #ffffff;
        --text: #1d2733;
        --muted: #737b85;
        --border: #e7e7e4;

        min-height: 100vh;
        background: var(--background);
        padding: 110px 15px 150px;
    }

    /* Success Alert */
    .change-password-page .success-alert {
        background: var(--primary);
        color: white;
        border: 1px solid var(--accent);
        border-radius: 10px;
        font-weight: 500;
        padding: 14px 18px;
        box-shadow: 0 5px 18px rgba(11, 31, 51, 0.08);
    }

    .change-password-page .success-alert .btn-close {
        filter: brightness(0) invert(1);
    }

    /* Main Card */
    .change-password-page .password-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 10px 35px rgba(11, 31, 51, 0.10);
    }

    /* Header */
    .change-password-page .password-header {
        background: var(--primary);
        color: white;
        padding: 20px 25px;
        border: none;
        position: relative;
        overflow: hidden;
    }

    .change-password-page .password-header::after {
        content: "";
        position: absolute;
        width: 150px;
        height: 150px;
        border: 1px solid rgba(200, 164, 93, 0.25);
        border-radius: 50%;
        right: -45px;
        top: -70px;
    }

    .change-password-page .password-header h4 {
        margin: 0;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 24px;
        font-weight: 600;
        position: relative;
        z-index: 1;
    }

    .change-password-page .password-header i {
        color: var(--accent);
    }

    /* Body */
    .change-password-page .password-body {
        padding: 32px;
    }

    /* Labels */
    .change-password-page .form-label {
        color: var(--text);
        font-weight: 600;
        margin-bottom: 8px;
    }

    /* Inputs */
    .change-password-page .form-control {
        min-height: 48px;
        border: 1px solid var(--border);
        border-radius: 9px;
        color: var(--text);
        background: #fff;
        padding: 11px 14px;
        transition: all 0.25s ease;
        box-shadow: none !important;
    }

    .change-password-page .form-control::placeholder {
        color: #9a9fa5;
    }

    .change-password-page .form-control:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(200, 164, 93, 0.15) !important;
    }

    /* Error Messages */
    .change-password-page .error-message {
        display: block;
        margin-top: 6px;
        font-size: 13px;
        color: #b33a3a;
    }

    /* Update Button */
    .change-password-page .update-btn {
        background: var(--primary);
        color: white;
        border: 1px solid var(--primary);
        border-radius: 9px;
        padding: 11px 28px;
        font-weight: 600;
        transition: all 0.25s ease;
    }

    .change-password-page .update-btn i {
        color: var(--accent);
    }

    .change-password-page .update-btn:hover {
        background: var(--primary-light);
        border-color: var(--primary-light);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 6px 15px rgba(11, 31, 51, 0.15);
    }

    /* Small gold line under header */
    .change-password-page .header-line {
        width: 45px;
        height: 3px;
        background: var(--accent);
        border-radius: 5px;
        margin-top: 8px;
    }

    /* Mobile */
    @media (max-width: 576px) {
        .change-password-page {
            padding: 90px 12px 100px;
        }

        .change-password-page .password-header {
            padding: 18px 20px;
        }

        .change-password-page .password-header h4 {
            font-size: 21px;
        }

        .change-password-page .password-body {
            padding: 24px 20px;
        }

        .change-password-page .update-btn {
            width: 100%;
        }
    }
</style>

<div class="change-password-page mt-5">

    <div class="container col-lg-6">

        {{-- Success Message --}}
        @if (session('succPass'))
            <div class="alert success-alert alert-dismissible fade show mb-4" role="alert">
                <i class="fa fa-check-circle me-2"></i>
                {{ session('succPass') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>
            </div>
        @endif

        <div class="password-card">

            {{-- Header --}}
            <div class="password-header">
                <h4>
                    <i class="fa fa-lock me-2"></i>
                    Change Password
                </h4>

                <div class="header-line"></div>
            </div>

            {{-- Body --}}
            <div class="password-body">

                <form action="{{ route('user.changePassword') }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Current Password --}}
                    <div class="mb-4">
                        <label for="current_password" class="form-label">
                            Current Password
                        </label>

                        <input
                            type="password"
                            name="current_password"
                            id="current_password"
                            class="form-control"
                            placeholder="Enter Current Password"
                        >

                        @error('current_password')
                            <small class="error-message">
                                <i class="fa fa-circle-exclamation me-1"></i>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    {{-- New Password --}}
                    <div class="mb-4">
                        <label for="new_password" class="form-label">
                            New Password
                        </label>

                        <input
                            type="password"
                            name="new_password"
                            id="new_password"
                            class="form-control"
                            placeholder="Enter New Password"
                        >

                        @error('new_password')
                            <small class="error-message">
                                <i class="fa fa-circle-exclamation me-1"></i>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mb-4">
                        <label for="confirm_password" class="form-label">
                            Confirm Password
                        </label>

                        <input
                            type="password"
                            name="confirm_password"
                            id="confirm_password"
                            class="form-control"
                            placeholder="Confirm New Password"
                        >

                        @error('confirm_password')
                            <small class="error-message">
                                <i class="fa fa-circle-exclamation me-1"></i>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    {{-- Button --}}
                    <div class="text-center pt-2">
                        <button
                            type="submit"
                            class="update-btn"
                        >
                            <i class="fa fa-save me-2"></i>
                            Update Password
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

</div>

@endsection