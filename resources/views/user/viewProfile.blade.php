@extends('layouts.userLayout')

@section('content')

<style>
    /* ========================================
       PARADISE HOTEL - PROFILE DETAILS
    ======================================== */

    .profile-details-page {
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

    /* Main Card */
    .profile-details-page .profile-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 10px 35px rgba(11, 31, 51, 0.10);
        transition: all 0.3s ease;
    }

    .profile-details-page .profile-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(11, 31, 51, 0.14);
    }

    /* Header */
    .profile-details-page .profile-header {
        background: var(--primary);
        color: white;
        padding: 20px 25px;
        border: none;
        position: relative;
        overflow: hidden;
    }

    .profile-details-page .profile-header::after {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        border: 1px solid rgba(200, 164, 93, 0.25);
        border-radius: 50%;
        right: -60px;
        top: -85px;
    }

    .profile-details-page .profile-header h4 {
        margin: 0;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 24px;
        font-weight: 600;
        position: relative;
        z-index: 1;
    }

    .profile-details-page .profile-header h4 i {
        color: var(--accent);
    }

    /* Edit Button */
    .profile-details-page .edit-btn {
        background: transparent;
        color: var(--accent);
        border: 1px solid var(--accent);
        border-radius: 8px;
        padding: 8px 17px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.25s ease;
        position: relative;
        z-index: 2;
    }

    .profile-details-page .edit-btn:hover {
        background: var(--accent);
        color: var(--primary);
    }

    /* Body */
    .profile-details-page .profile-body {
        padding: 35px;
    }

    /* Profile Image */
    .profile-details-page .profile-image {
        width: 140px;
        height: 140px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid var(--white);
        outline: 2px solid var(--accent);
        box-shadow: 0 8px 25px rgba(11, 31, 51, 0.15);
    }

    /* Name */
    .profile-details-page .profile-name {
        color: var(--primary);
        font-family: Georgia, "Times New Roman", serif;
        font-size: 25px;
        font-weight: 600;
        margin-top: 8px;
        margin-bottom: 4px;
    }

    /* Email */
    .profile-details-page .profile-email {
        color: var(--muted);
        margin-bottom: 0;
    }

    /* Gold Divider */
    .profile-details-page .gold-divider {
        width: 45px;
        height: 3px;
        background: var(--accent);
        border-radius: 5px;
        margin: 15px auto 30px;
    }

    /* Information Box */
    .profile-details-page .info-box {
        background: #faf9f5;
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 17px 20px;
        margin-bottom: 15px;
        transition: all 0.25s ease;
    }

    .profile-details-page .info-box:hover {
        border-color: var(--accent);
        transform: translateX(3px);
    }

    /* Icon */
    .profile-details-page .info-icon {
        width: 42px;
        height: 42px;
        min-width: 42px;
        border-radius: 50%;
        background: rgba(200, 164, 93, 0.15);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 13px;
    }

    .profile-details-page .info-icon i {
        color: var(--accent);
    }

    /* Label */
    .profile-details-page .info-label {
        color: var(--muted);
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        margin-bottom: 3px;
    }

    /* Value */
    .profile-details-page .info-value {
        color: var(--text);
        font-size: 16px;
        font-weight: 500;
        word-break: break-word;
    }

    /* Mobile */
    @media (max-width: 576px) {

        .profile-details-page {
            padding: 90px 12px 100px;
        }

        .profile-details-page .profile-header {
            padding: 18px 20px;
        }

        .profile-details-page .profile-header h4 {
            font-size: 21px;
        }

        .profile-details-page .edit-btn {
            padding: 7px 12px;
            font-size: 13px;
        }

        .profile-details-page .profile-body {
            padding: 25px 20px;
        }

        .profile-details-page .profile-image {
            width: 125px;
            height: 125px;
        }

        .profile-details-page .profile-name {
            font-size: 22px;
        }
    }
</style>

<div class="profile-details-page mt-5">


<div class="container col-lg-8">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="profile-card">

                <!-- Header -->
                <div class="profile-header d-flex justify-content-between align-items-center">

                    <h4>
                        <i class="fa fa-user me-2"></i>
                        Profile Details
                    </h4>

                    <a href="{{ route('user.viewEditProfile', Auth::user()->id) }}"
                       class="edit-btn">

                        <i class="fa fa-edit me-1"></i>
                        Edit

                    </a>

                </div>


                <!-- Body -->
                <div class="profile-body">

                    <!-- Profile Image -->
                    <div class="text-center mb-4">

                        @if ($profile->image && $profile->image != 'default.png')

                            <img src="{{ asset('images/user/'.$profile->image) }}"
                                 class="profile-image mb-3"
                                 alt="Profile Image">

                        @else

                            <img src="{{ asset('images/user/default.png') }}"
                                 class="profile-image mb-3"
                                 alt="Default Profile Image">

                        @endif

                        <h5 class="profile-name">
                            {{ $profile->name }}
                        </h5>

                        <p class="profile-email">
                            <i class="fa fa-envelope me-1"></i>
                            {{ $profile->email }}
                        </p>

                        <div class="gold-divider"></div>

                    </div>


                    <!-- Phone -->
                    <div class="info-box">

                        <div class="d-flex align-items-center">

                            <div class="info-icon">
                                <i class="fa fa-phone"></i>
                            </div>

                            <div>
                                <div class="info-label">
                                    Phone
                                </div>

                                <div class="info-value">
                                    {{ $profile->phone }}
                                </div>
                            </div>

                        </div>

                    </div>


                    <!-- Address -->
                    <div class="info-box">

                        <div class="d-flex align-items-center">

                            <div class="info-icon">
                                <i class="fa fa-location-dot"></i>
                            </div>

                            <div>
                                <div class="info-label">
                                    Address
                                </div>

                                <div class="info-value">
                                    {{ $profile->address }}
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
```

</div>

@endsection
