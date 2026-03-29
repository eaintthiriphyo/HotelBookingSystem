<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Google Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Chart -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }




        .sidebar {
            background-color:navy!important;
            color:white !important;
        }

        .sidebar .nav-item {
            color:white;
        }

        .sidebar .nav-link {
            font-size: 1.2rem;
            padding: 1rem 1.5rem;
        }

        .sidebar .nav-item.active>.nav-link {
            background-color: white !important;
            color: navy!important;
        }

        .sidebar .nav-item.active>.nav-link i {
            color: #4e73df !important;
            font-size: 1.2rem;
        }



        .collapse-inner .collapse-item.active {
            color: #4e73df;
            font-weight: 600;
            font-size: 1rem;

        }

        footer {
            background-color: navy;
            color: black;
        }

        footer ul li {
            margin-bottom: 0.5rem;
        }

        .hover-underline:hover {
            text-decoration: underline;
            color: #ffcd00;
        }


        footer i {
            width: 20px;
        }


        @media (max-width: 768px) {
            footer .col-md-4 {
                text-align: center;
            }
        }
    </style>


</head>




<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center "
                href="{{ route('admin.viewDashboard') }}">

                <div class="sidebar-brand-text mx-1"><h5>Paradise Hotel</h5> </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->routeIs('admin.viewDashboard') ? 'active' : '' }}">
                <a class="nav-link  " href="{{ route('admin.viewDashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <li class="nav-item {{ request()->routeIs('admin.roomType.*') ? 'active' : '' }}">
                <a class="nav-link {{ request()->routeIs('admin.roomType.*') ? '' : 'collapsed' }}" href="#"
                    data-toggle="collapse" data-target="#collapseRoomType"
                    aria-expanded="{{ request()->routeIs('admin.roomType.*') ? 'true' : 'false' }}"
                    aria-controls="collapseRoomType">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Room Type</span>
                </a>

                <div id="collapseRoomType" class="collapse {{ request()->routeIs('admin.roomType.*') ? 'show' : '' }}"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Room Types</h6>
                        <a class="collapse-item {{ request()->routeIs('admin.roomType.index') ? 'active' : '' }}"
                            href="{{ route('admin.roomType.index') }}">Room Type</a>
                        <a class="collapse-item {{ request()->routeIs('admin.roomType.create') ? 'active' : '' }}"
                            href="{{ route('admin.roomType.create') }}">Add Room Type</a>
                    </div>
                </div>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.room.*') ? 'active' : '' }}">
                <a class="nav-link {{ request()->routeIs('admin.room.*') ? '' : 'collapsed' }}" href="#"
                    data-toggle="collapse" data-target="#collapseRoom"
                    aria-expanded="{{ request()->routeIs('admin.room.*') ? 'true' : 'false' }}"
                    aria-controls="collapseRoom">
                    <i class="fas fa-fw fa-bed"></i>
                    <span>Rooms</span>
                </a>

                <div id="collapseRoom" class="collapse {{ request()->routeIs('admin.room.*') ? 'show' : '' }}"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Rooms</h6>
                        <a class="collapse-item {{ request()->routeIs('admin.room.index') ? 'active' : '' }}"
                            href="{{ route('admin.room.index') }}">Rooms</a>
                        <a class="collapse-item {{ request()->routeIs('admin.room.create') ? 'active' : '' }}"
                            href="{{ route('admin.room.create') }}">Add Room</a>
                    </div>
                </div>
            </li>


            <li class="nav-item {{ request()->routeIs('admin.booking*') ? 'active' : '' }}">
                <a class="nav-link {{ request()->routeIs('admin.booking*') ? '' : 'collapsed' }}" href="#"
                    data-toggle="collapse" data-target="#collapseBooking"
                    aria-expanded="{{ request()->routeIs('admin.booking*') ? 'true' : 'false' }}"
                    aria-controls="collapseBooking">
                    <i class="fas fa-fw fa-calendar-check"></i>
                    <span>Bookings</span>
                </a>

                <div id="collapseBooking" class="collapse {{ request()->routeIs('admin.booking*') ? 'show' : '' }}"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Bookings</h6>

                        <a class="collapse-item {{ request()->routeIs('admin.bookingList.*') ? 'active' : '' }}"
                            href="{{ route('admin.bookingList.index') }}">
                            All Booking List
                        </a>

                        <a class="collapse-item {{ request()->routeIs('admin.booking.todayBook') ? 'active' : '' }}"
                            href="{{ route('admin.booking.todayBook') }}">
                            Today Booking List
                        </a>

                        <a class="collapse-item {{ request()->routeIs('admin.booking.pending') ? 'active' : '' }}"
                            href="{{ route('admin.booking.pending') }}">
                            Pending Booking List
                        </a>
                        <a class="collapse-item {{ request()->routeIs('admin.booking.create') ? 'active' : '' }}"
                            href="{{ route('admin.booking.create') }}">
                            Add Booking
                        </a>
                    </div>
                </div>
            </li>


            <li class="nav-item {{ request()->routeIs('admin.checkin.*') ? 'active' : '' }}">
                <a class="nav-link {{ request()->routeIs('admin.checkin.*') ? '' : 'collapsed' }}" href="#"
                    data-toggle="collapse" data-target="#collapseCheckIn"
                    aria-expanded="{{ request()->routeIs('admin.checkin.*') ? 'true' : 'false' }}"
                    aria-controls="collapseCheckIn">
                    <i
                        class="fas fa-fw {{ request()->routeIs('admin.checkin.*') ? 'fa-calendar-day' : 'fa-calendar-check' }}"></i>
                    <span>Check In</span>
                </a>


                <div id="collapseCheckIn" class="collapse {{ request()->routeIs('admin.checkin.*') ? 'show' : '' }}"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Check In</h6>

                        <a class="collapse-item {{ request()->routeIs('admin.checkin.list') ? 'active' : '' }}"
                            href="{{ route('admin.checkin.index') }}">
                            CheckIn List
                        </a>

                        <a class="collapse-item {{ request()->routeIs('admin.checkin.create') ? 'active' : '' }}"
                            href="{{ route('admin.checkin.create') }}">
                            Add CheckIn
                        </a>
                    </div>
                </div>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.customer.*') ? 'active' : '' }}">
                <a class="nav-link {{ request()->routeIs('admin.customer.*') ? '' : 'collapsed' }}" href="#"
                    data-toggle="collapse" data-target="#collapseCustomers"
                    aria-expanded="{{ request()->routeIs('admin.customer.*') ? 'true' : 'false' }}"
                    aria-controls="collapseCustomers">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Customers</span>
                </a>

                <div id="collapseCustomers"
                    class="collapse {{ request()->routeIs('admin.customer.*') ? 'show' : '' }}"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Customers</h6>
                        <a class="collapse-item {{ request()->routeIs('admin.customer.index') ? 'active' : '' }}"
                            href="{{ route('admin.customer.index') }}">Customer List</a>

                    </div>
                </div>
            </li>


            @auth
                @if (Auth::user()->role != 'Staff' || Auth::user()->roles != 'staff'))
                    <li class="nav-item {{ request()->routeIs('admin.department.*') ? 'active' : '' }}">
                        <a class="nav-link {{ request()->routeIs('admin.department.*') ? '' : 'collapsed' }}"
                            href="#" data-toggle="collapse" data-target="#collapseDepartments"
                            aria-expanded="{{ request()->routeIs('admin.department.*') ? 'true' : 'false' }}"
                            aria-controls="collapseDepartments">
                            <i class="fas fa-fw fa-building"></i>
                            <span>Departments</span>
                        </a>

                        <div id="collapseDepartments"
                            class="collapse {{ request()->routeIs('admin.department.*') ? 'show' : '' }}"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Departments</h6>
                                <a class="collapse-item {{ request()->routeIs('admin.department.index') ? 'active' : '' }}"
                                    href="{{ route('admin.department.index') }}">Department List</a>
                                <a class="collapse-item {{ request()->routeIs('admin.department.create') ? 'active' : '' }}"
                                    href="{{ route('admin.department.create') }}">Add Department</a>
                            </div>
                        </div>
                    </li>


                    <li class="nav-item {{ request()->routeIs('admin.staff.*') ? 'active' : '' }}">
                        <a class="nav-link {{ request()->routeIs('admin.staff.*') ? '' : 'collapsed' }}" href="#"
                            data-toggle="collapse" data-target="#collapseStaff"
                            aria-expanded="{{ request()->routeIs('admin.staff.*') ? 'true' : 'false' }}"
                            aria-controls="collapseStaff">
                            <i class="fas fa-fw fa-users"></i>
                            <span>Staff Management</span>
                        </a>

                        <div id="collapseStaff" class="collapse {{ request()->routeIs('admin.staff.*') ? 'show' : '' }}"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Staff Management</h6>
                                <a class="collapse-item {{ request()->routeIs('admin.staff.index') ? 'active' : '' }}"
                                    href="{{ route('admin.staff.index') }}">Staff List</a>
                                <a class="collapse-item {{ request()->routeIs('admin.staff.create') ? 'active' : '' }}"
                                    href="{{ route('admin.staff.create') }}">Add Staff</a>
                            </div>
                        </div>

                    </li>


                @endif
            @endauth





            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>



        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column ">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand  topbar mb-4 static-top shadow "
                    style="background-color:navy;color:white ">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link btn-light d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle " href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw "></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw text-white"></i>
                                <!-- Counter - Alerts -->
                                @if ($newBookingsCount > 0)
                                    <span class="badge badge-danger badge-counter">{{ $newBookingsCount }}</span>
                                @endif
                            </a>

                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    New Bookings
                                </h6>

                                @forelse($newBookings as $booking)
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{{ route('admin.booking.pending', ['highlight' => $booking->id]) }}">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-primary">
                                                <i class="fas fa-calendar-check text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">
                                                {{ $booking->created_at->format('d M, Y H:i') }}</div>
                                            <span class="font-weight-bold">{{ $booking->user->name ?? 'Guest' }}
                                                booked {{ $booking->room->room_type->room_type ?? 'a room' }}</span>
                                        </div>
                                    </a>
                                @empty
                                    <a class="dropdown-item text-center small text-gray-500" href="#">No new
                                        bookings</a>
                                @endforelse

                            </div>
                        </li>






                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <i class="fas fa-envelope fa-fw text-white"></i>


                                @if ($newMessagesCount > 0)
                                    <span class="badge badge-danger badge-counter">
                                        {{ $newMessagesCount }}
                                    </span>
                                @endif
                            </a>

                            <!-- Dropdown -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">

                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>


                                @if ($newMessagesCount > 0)

                                    @foreach ($newMessages as $message)
                                        <a class="dropdown-item {{ $message->status == 'unread' ? 'font-weight-bold bg-light' : '' }}"
                                            href="{{ route('admin.contact.show', $message->id) }}">

                                            <strong>{{ $message->name }}</strong>

                                            <div class="text-truncate">
                                                {{ $message->message }}
                                            </div>

                                            <small class="text-muted">
                                                {{ $message->created_at->diffForHumans() }}
                                            </small>
                                        </a>
                                    @endforeach
                                @else
                                    <a class="dropdown-item text-center small text-gray-500">
                                        No new messages
                                    </a>
                                @endif

                                <a class="dropdown-item text-center small text-gray-500"
                                    href="{{ route('admin.contact.index') }}">
                                    Read More Messages
                                </a>

                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        @auth
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown">
                                    <img class="img-profile rounded-circle"
                                        src="{{ Auth::user()->image ? asset('images/user/' . Auth::user()->image) : asset('images/user/default.png') }}"
                                        width="40" height="40">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
                                    <div class="text-center p-3 border-bottom">
                                        <img class="rounded-circle mb-2"
                                            src="{{ Auth::user()->image ? asset('images/user/' . Auth::user()->image) : asset('images/user/default.png') }}"
                                            width="60" height="60">
                                        <div class="fw-bold">{{ Auth::user()->name }}</div>
                                        <div class="text-muted small">{{ Auth::user()->email }}</div>
                                    </div>
                                    <a class="dropdown-item"
                                        href="{{ route('admin.staff.viewProfile', Auth::user()->email) }}"><i
                                            class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Profile</a>


                                    <a class="dropdown-item"
                                        href="{{ route('admin.staff.viewEditProfile', Auth::user()->email) }}"><i
                                            class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>Edit Profile</a>


                                    <a class="dropdown-item"
                                        href="{{ route('admin.staff.viewChangePassword', Auth::user()->email) }}"><i
                                            class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>Change Password</a>
                                    <div class="dropdown-divider"></div>

                                    <div class="dropdown-divider"> </div> <a class="dropdown-item"
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>

                                </div>




                            </li>
                        @endauth




                </nav>
                <!-- End of Topbar -->




                <div class="mb-5">
                    @yield('content')
                </div>
                <!-- End of Main Content -->

                <!-- Footer -->

                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->
            <footer class=" text-white pt-5 pb-4" style="margin-top: 100px">
                <div class="container ">
                    <div class="row mt-5">

                        <!-- About / Hotel Name -->
                        <div class="col-md-4 mb-4">
                            <h5 class="fw-bold mb-3" style="font-size: 1.3rem;">Hotel Paradise</h5>
                            <p style="font-size: 0.95rem; line-height: 1.6;">
                                Your luxurious stay in the heart of the city. Experience comfort, elegance, and
                                exceptional service at our hotel.
                            </p>
                        </div>

                        <!-- Contact Info -->
                        <div class="col-md-4 mb-4">
                            <h5 class="fw-bold mb-3" style="font-size: 1.3rem;">Contact</h5>
                            <ul class="list-unstyled" style="font-size: 0.95rem; line-height: 2;">
                                <li><i class="fas fa-phone-alt me-2"></i> +95 123 456 789</li>
                                <li><i class="fas fa-envelope me-2"></i> info@hotelparadise.com</li>
                                <li><i class="fab fa-facebook me-2"></i> facebook.com/hotelparadise</li>
                                <li><i class="fab fa-instagram me-2"></i> @hotelparadise</li>
                            </ul>
                        </div>

                        <!-- Quick Links -->
                        <div class="col-md-4 mb-4">
                            <h5 class="fw-bold mb-3" style="font-size: 1.3rem;">Quick Links</h5>
                            <ul class="list-unstyled" style="font-size: 0.95rem; line-height: 2;">
                                <li><a href="#" class="text-white text-decoration-none hover-underline">Home</a>
                                </li>
                                <li><a href="#"
                                        class="text-white text-decoration-none hover-underline">Services</a></li>
                                <li><a href="#"
                                        class="text-white text-decoration-none hover-underline">Reviews</a></li>
                                <li><a href="#" class="text-white text-decoration-none hover-underline">Email &
                                        Address</a></li>
                            </ul>
                        </div>

                    </div>

                    <hr class="bg-light">

                    <div class="text-center" style="font-size: 0.9rem;">
                        <span>&copy; {{ date('Y') }} Hotel Paradise. All rights reserved.</span>
                    </div>
                </div>


            </footer>

        </div>
        <!-- End of Page Wrapper -->


        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

        <!-- Page level plugins -->
        <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

</body>

</html>
