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
        .sidebar .nav-item.active>.nav-link {
            background-color: #ffffff !important;
            color: #4e73df !important;
        }

        .sidebar .nav-item.active>.nav-link i {
            color: #4e73df !important;
        }

        .collapse-inner .collapse-item.active {
            color: #4e73df;
            font-weight: 600;
        }
    </style>


</head>




<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">

                <div class="sidebar-brand-text mx-1">Hotel Booking </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->routeIs('admin.viewDashboard') ? 'active' : '' }}">
                <a class="nav-link  " href="{{route('admin.viewDashboard')}}">
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
                <a class="nav-link {{ request()->routeIs('admin.roomType.*') ? '' : 'collapsed' }}"
                    href="#"
                    data-toggle="collapse"
                    data-target="#collapseRoomType"
                    aria-expanded="{{ request()->routeIs('admin.roomType.*') ? 'true' : 'false' }}"
                    aria-controls="collapseRoomType">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Room Type</span>
                </a>

                <div id="collapseRoomType" class="collapse {{ request()->routeIs('admin.roomType.*') ? 'show' : '' }}" data-parent="#accordionSidebar">
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
                <a class="nav-link {{ request()->routeIs('admin.room.*') ? '' : 'collapsed' }}"
                    href="#"
                    data-toggle="collapse"
                    data-target="#collapseRoom"
                    aria-expanded="{{ request()->routeIs('admin.room.*') ? 'true' : 'false' }}"
                    aria-controls="collapseRoom">
                    <i class="fas fa-fw fa-bed"></i>
                    <span>Rooms</span>
                </a>

                <div id="collapseRoom" class="collapse {{ request()->routeIs('admin.room.*') ? 'show' : '' }}" data-parent="#accordionSidebar">
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
                <a class="nav-link {{ request()->routeIs('admin.booking*') ? '' : 'collapsed' }}"
                    href="#"
                    data-toggle="collapse"
                    data-target="#collapseBooking"
                    aria-expanded="{{ request()->routeIs('admin.booking*') ? 'true' : 'false' }}"
                    aria-controls="collapseBooking">
                    <i class="fas fa-fw fa-calendar-check"></i>
                    <span>Bookings</span>
                </a>

                <div id="collapseBooking" class="collapse {{ request()->routeIs('admin.booking*') ? 'show' : '' }}" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Bookings</h6>

                        <a class="collapse-item {{ request()->routeIs('admin.bookingList.*') ? 'active' : '' }}"
                            href="{{ route('admin.bookingList.index') }}">
                            All Booking List
                        </a>

                         <a class="collapse-item {{ request()->routeIs('admin.booking.booking.todayBook') ? 'active' : '' }}"
                            href="{{ route('admin.booking.todayBook') }}">
                            Today Booking List
                        </a>
                        <a class="collapse-item {{ request()->routeIs('admin.booking.create') ? 'active' : '' }}"
                            href="{{ route('admin.booking.create') }}">
                            Add Booking
                        </a>
                    </div>
                </div>
            </li>


            <li class="nav-item {{ request()->routeIs('admin.checkin.*') ? 'active' : '' }}">
                <a class="nav-link {{ request()->routeIs('admin.checkin.*') ? '' : 'collapsed' }}"
                    href="#"
                    data-toggle="collapse"
                    data-target="#collapseCheckIn"
                    aria-expanded="{{ request()->routeIs('admin.checkin.*') ? 'true' : 'false' }}"
                    aria-controls="collapseCheckIn">
                    <i class="fas fa-fw {{ request()->routeIs('admin.checkin.*') ? 'fa-calendar-day' : 'fa-calendar-check' }}"></i>
                    <span>Check In</span>
                </a>

                <div id="collapseCheckIn" class="collapse {{ request()->routeIs('admin.checkin.*') ? 'show' : '' }}" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Check In</h6>

                        <a class="collapse-item {{ request()->routeIs('admin.checkin.list') ? 'active' : '' }}"
                            href="{{ route('admin.checkin.index') }}">
                            CheckIn List
                        </a>

                    </div>
                </div>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.customer.*') ? 'active' : '' }}">
                <a class="nav-link {{ request()->routeIs('admin.customer.*') ? '' : 'collapsed' }}"
                    href="#"
                    data-toggle="collapse"
                    data-target="#collapseCustomers"
                    aria-expanded="{{ request()->routeIs('admin.customer.*') ? 'true' : 'false' }}"
                    aria-controls="collapseCustomers">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Customers</span>
                </a>

                <div id="collapseCustomers" class="collapse {{ request()->routeIs('admin.customer.*') ? 'show' : '' }}" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Customers</h6>
                        <a class="collapse-item {{ request()->routeIs('admin.customer.index') ? 'active' : '' }}"
                            href="{{ route('admin.customer.index') }}">Customer List</a>
                        <a class="collapse-item {{ request()->routeIs('admin.customer.create') ? 'active' : '' }}"
                            href="{{ route('admin.customer.create') }}">Add Customer</a>
                    </div>
                </div>
            </li>


            @auth
            @if(Auth::user()->status =="0")
            <li class="nav-item {{ request()->routeIs('admin.department.*') ? 'active' : '' }}">
                <a class="nav-link {{ request()->routeIs('admin.department.*') ? '' : 'collapsed' }}"
                    href="#"
                    data-toggle="collapse"
                    data-target="#collapseDepartments"
                    aria-expanded="{{ request()->routeIs('admin.department.*') ? 'true' : 'false' }}"
                    aria-controls="collapseDepartments">
                    <i class="fas fa-fw fa-building"></i>
                    <span>Departments</span>
                </a>

                <div id="collapseDepartments" class="collapse {{ request()->routeIs('admin.department.*') ? 'show' : '' }}" data-parent="#accordionSidebar">
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
                <a class="nav-link {{ request()->routeIs('admin.staff.*') ? '' : 'collapsed' }}"
                    href="#"
                    data-toggle="collapse"
                    data-target="#collapseStaff"
                    aria-expanded="{{ request()->routeIs('admin.staff.*') ? 'true' : 'false' }}"
                    aria-controls="collapseStaff">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Staff Management</span>
                </a>

                <div id="collapseStaff" class="collapse {{ request()->routeIs('admin.staff.*') ? 'show' : '' }}" data-parent="#accordionSidebar">
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
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small"
                                placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
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

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to
                                            download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All
                                    Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy
                                            with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle"
                                            src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More
                                    Messages</a>
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
                                <a class="dropdown-item" href="{{route('admin.staff.viewProfile',Auth::user()->email)}}"><i
                                        class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Profile</a>


                                <a class="dropdown-item" href="{{route('admin.staff.viewEditProfile',Auth::user()->email)}}"><i
                                        class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>Edit Profile</a>


                                <a class="dropdown-item" href="{{route('admin.staff.viewChangePassword',Auth::user()->email)}}"><i
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




                @yield('content')
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2021</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

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