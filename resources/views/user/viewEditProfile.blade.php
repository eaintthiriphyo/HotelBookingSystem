@extends('layouts.userLayout')

@section('content')

<style>
    /* ========================================
       PARADISE HOTEL - EDIT PROFILE THEME
    ======================================== */

    .edit-profile-page {
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

    /* Success Message */
    .edit-profile-page .success-alert {
        background: var(--primary);
        color: white;
        border: 1px solid var(--accent);
        border-radius: 10px;
        font-weight: 500;
        padding: 14px 18px;
        box-shadow: 0 5px 18px rgba(11, 31, 51, 0.08);
    }

    .edit-profile-page .success-alert .btn-close {
        filter: brightness(0) invert(1);
    }

    /* Main Card */
    .edit-profile-page .profile-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 10px 35px rgba(11, 31, 51, 0.10);
        transition: all 0.3s ease;
    }

    .edit-profile-page .profile-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 40px rgba(11, 31, 51, 0.13);
    }

    /* Header */
    .edit-profile-page .profile-header {
        background: var(--primary);
        color: white;
        padding: 20px 25px;
        border: none;
        position: relative;
        overflow: hidden;
    }

    .edit-profile-page .profile-header::after {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        border: 1px solid rgba(200, 164, 93, 0.25);
        border-radius: 50%;
        right: -60px;
        top: -85px;
    }

    .edit-profile-page .profile-header h4 {
        margin: 0;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 24px;
        font-weight: 600;
        position: relative;
        z-index: 1;
    }

    .edit-profile-page .profile-header h4 i {
        color: var(--accent);
    }

    /* View Profile Button */
    .edit-profile-page .view-profile-btn {
        background: transparent;
        color: var(--accent);
        border: 1px solid var(--accent);
        border-radius: 8px;
        padding: 8px 15px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.25s ease;
        position: relative;
        z-index: 2;
    }

    .edit-profile-page .view-profile-btn:hover {
        background: var(--accent);
        color: var(--primary);
    }

    /* Body */
    .edit-profile-page .profile-body {
        padding: 32px;
    }

    /* Profile Image */
    .edit-profile-page .profile-image-wrapper {
        position: relative;
        display: inline-block;
    }

    .edit-profile-page .profile-image {
        width: 140px;
        height: 140px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid white;
        outline: 2px solid var(--accent);
        box-shadow: 0 8px 25px rgba(11, 31, 51, 0.15);
    }

    .edit-profile-page .image-title {
        color: var(--primary);
        font-weight: 600;
        margin-top: 15px;
        margin-bottom: 8px;
    }

    .edit-profile-page .image-input {
        max-width: 450px;
        margin: auto;
    }

    /* Labels */
    .edit-profile-page .form-label {
        color: var(--text);
        font-weight: 600;
        margin-bottom: 8px;
    }

    /* Inputs */
    .edit-profile-page .form-control {
        min-height: 47px;
        border: 1px solid var(--border);
        border-radius: 9px;
        color: var(--text);
        background: var(--white);
        padding: 10px 13px;
        transition: all 0.25s ease;
        box-shadow: none !important;
    }

    .edit-profile-page .form-control:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(200, 164, 93, 0.15) !important;
    }

    /* Disabled Email */
    .edit-profile-page .form-control:disabled {
        background: #f3f3f0;
        color: var(--muted);
        cursor: not-allowed;
    }

    /* File Input */
    .edit-profile-page input[type="file"] {
        padding: 9px 12px;
        background: #faf9f5;
    }

    .edit-profile-page input[type="file"]:focus {
        border-color: var(--accent);
    }

    /* Error */
    .edit-profile-page .error-message {
        display: block;
        margin-top: 6px;
        color: #b33a3a;
        font-size: 13px;
    }

    /* Update Button */
    .edit-profile-page .update-profile-btn {
        background: var(--primary);
        color: white;
        border: 1px solid var(--primary);
        border-radius: 9px;
        padding: 11px 28px;
        font-weight: 600;
        transition: all 0.25s ease;
    }

    .edit-profile-page .update-profile-btn i {
        color: var(--accent);
    }

    .edit-profile-page .update-profile-btn:hover {
        background: var(--primary-light);
        border-color: var(--primary-light);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 6px 15px rgba(11, 31, 51, 0.15);
    }

    /* Gold Divider */
    .edit-profile-page .gold-divider {
        width: 45px;
        height: 3px;
        background: var(--accent);
        border-radius: 5px;
        margin: 8px auto 25px;
    }

    /* Mobile */
    @media (max-width: 576px) {

        .edit-profile-page {
            padding: 90px 12px 100px;
        }

        .edit-profile-page .profile-header {
            padding: 18px 20px;
        }

        .edit-profile-page .profile-header h4 {
            font-size: 21px;
        }

        .edit-profile-page .view-profile-btn {
            padding: 7px 10px;
            font-size: 13px;
        }

        .edit-profile-page .profile-body {
            padding: 24px 20px;
        }

        .edit-profile-page .profile-image {
            width: 125px;
            height: 125px;
        }

        .edit-profile-page .update-profile-btn {
            width: 100%;
        }
    }
</style>


<div class="edit-profile-page mt-5">

    <div class="container col-lg-7">

        {{-- Success Message --}}
        @if (session('succUpdateProfile'))
            <div class="alert success-alert alert-dismissible fade show mb-4" role="alert">
                <i class="fa fa-check-circle me-2"></i>
                {{ session('succUpdateProfile') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>
            </div>
        @endif


        <div class="profile-card">

            {{-- Header --}}
            <div class="profile-header d-flex justify-content-between align-items-center">

                <div>
                    <h4>
                        <i class="fa fa-user-edit me-2"></i>
                        Edit Profile
                    </h4>

                    <div class="gold-divider mb-0"></div>
                </div>

                <a href="{{ route('user.viewProfile', Auth::user()->id) }}"
                   class="view-profile-btn">
                    <i class="fa fa-user me-1"></i>
                    View Profile
                </a>

            </div>


            {{-- Body --}}
            <div class="profile-body">

                <form action="{{ route('user.profileUpdate', Auth::user()->id) }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PUT')


                    {{-- Hidden Fields --}}
                    <input type="hidden"
                           value="{{ Auth::user()->email }}"
                           name="email"
                           id="email">

                    <input type="hidden"
                           value="{{ $profile->role }}"
                           name="role"
                           id="role">

                    <input type="hidden"
                           value="{{ $profile->department_id }}"
                           name="department_id"
                           id="department_id">


                    {{-- Profile Image --}}
                    <div class="text-center mb-5">

                        <div class="profile-image-wrapper">

                            @if ($profile->image && $profile->image != 'default.png')

                                <img src="{{ asset('images/user/' . $profile->image) }}"
                                     class="profile-image"
                                     alt="Profile Image">

                            @else

                                <img src="{{ asset('images/user/default.png') }}"
                                     class="profile-image"
                                     alt="Default Profile Image">

                            @endif

                        </div>

                        <div class="image-title">
                            Profile Picture
                        </div>

                        <div class="image-input">
                            <input type="file"
                                   name="image"
                                   class="form-control">
                        </div>

                    </div>


                    {{-- Name --}}
                    <div class="mb-4">

                        <label class="form-label">
                            <i class="fa fa-user me-1"></i>
                            Name
                        </label>

                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ $profile->name }}">

                        @error('name')
                            <small class="error-message">
                                <i class="fa fa-circle-exclamation me-1"></i>
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    {{-- Email --}}
                    <div class="mb-4">

                        <label class="form-label">
                            <i class="fa fa-envelope me-1"></i>
                            Email
                        </label>

                        <input type="email"
                               class="form-control"
                               value="{{ $profile->email }}"
                               disabled>

                    </div>


                    {{-- Phone --}}
                    <div class="mb-4">

                        <label class="form-label">
                            <i class="fa fa-phone me-1"></i>
                            Phone
                        </label>

                        <input type="text"
                               name="phone"
                               class="form-control"
                               value="{{ $profile->phone }}">

                        @error('phone')
                            <small class="error-message">
                                <i class="fa fa-circle-exclamation me-1"></i>
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    {{-- Address --}}
                    <div class="mb-4">

                        <label class="form-label">
                            <i class="fa fa-location-dot me-1"></i>
                            Address
                        </label>

                        <input type="text"
                               name="address"
                               class="form-control"
                               value="{{ $profile->address }}">

                        @error('address')
                            <small class="error-message">
                                <i class="fa fa-circle-exclamation me-1"></i>
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    {{-- Submit --}}
                    <div class="text-center pt-2">

                        <button type="submit"
                                class="update-profile-btn">

                            <i class="fa fa-save me-1"></i>
                            Update Profile

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection