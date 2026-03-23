@extends('layouts.userLayout')

@section('content')
    <div class="container pt-4 mt-5" style="margin-bottom: 200px;">
        <h3 class="fw-bold text-dark mb-4">Room Booking</h3>


        <!-- Room Details -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-dark text-white"><b>Room Details</b></div>
            <div class="card-body">
                <table class="table table-bordered mb-0">
                    <tr>
                        <td><b>Booking Date</b></td>
                        <td>{{ \Carbon\Carbon::now()->format('Y-m-d') }}</td>
                    </tr>
                </table>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- STEP 1: Select Room Type & Room -->
        <div class="row mb-5" style="margin-bottom: 250px">
            <!-- LEFT: Carousel -->
            <div class="col-md-6 mb-4">

                <div class="card">
                    <div class="card card-header card-room">
                        <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner" id="carouselImages">
                                <div class="carousel-item active">
                                    <img src="https://via.placeholder.com/500x500" class="d-block w-100">
                                </div>
                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title" id="roomName"></h5>
                        <p id="roomPrice"></p>
                        <p id="roomDescription"></p>
                    </div>

                </div>
            </div>



            <!-- RIGHT: Booking Form -->
            <div class="col-md-6">



                <div class="card p-5 shadow-sm" id="customerStep" style="display:none;">

                    <form id="bookingForm" action="{{ route('user.booking.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="check_in" id="finalCheckIn">
                        <input type="hidden" name="check_out" id="finalCheckOut">
                        <input type="hidden" name="room_id" id="finalRoomIdForm">

                        <h5 class="mb-3 text-secondary">Customer Details</h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}"
                                    readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}"
                                    readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{ Auth::user()->phone }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>NRC / Passport</label>
                                <input type="text" name="credential" class="form-control"
                                    value="{{ Auth::user()->credential }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control"
                                    value="{{ Auth::user()->address }}">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Confirm Booking</button>
                    </form>
                </div>

                <div class="card p-4 shadow-sm mb-4" id="bookingStep">
                    <h5 class="mb-3 text-secondary">Booking Details</h5>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Check-In</label>
                            <input type="date" id="checkIn" class="form-control"
                                value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Check-Out</label>
                            <input type="date" id="checkOut" class="form-control"
                                value="{{ \Carbon\Carbon::now()->addDay()->format('Y-m-d') }}">
                        </div>
                    </div>

                    <!-- Room Type -->
                    <div class="mb-3">
                        <label><b>Choose Room Type</b></label>
                        <div id="roomTypeButtons">
                            @foreach ($roomTypes as $type)
                                <button type="button" class="btn btn-outline-dark me-2 mb-2 room-type-btn"
                                    data-id="{{ $type->id }}" data-images='@json($type->images)'>
                                    {{ $type->room_type }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Available Rooms -->
                    <div class="mb-3">
                        <label><b>Available Rooms</b></label>
                        <div id="availableRooms" class="d-flex flex-wrap"></div>
                        <input type="hidden" id="finalRoomId">
                    </div>

                    <button type="button" id="goToCustomer" class="btn btn-dark w-100">Book Room</button>
                </div>
            </div>

            <!-- STEP 2: Customer Details -->

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            let selectedRoomType = null;
            let selectedRoomId = null;

            // Get room_type_id from URL if coming from "Book Now"
            const urlParams = new URLSearchParams(window.location.search);
            const initialRoomTypeId = "{{ $initialRoomTypeId ?? '' }}";

            // Select Room Type
            function selectRoomType(btn) {
                selectedRoomType = btn.data('id');
                $('.room-type-btn').removeClass('btn-dark').addClass('btn-outline-dark');
                btn.removeClass('btn-outline-dark').addClass('btn-dark');

                // Update carousel
                let images = btn.data('images');
                let carousel = $('#carouselImages');
                carousel.empty();

                if (images && images.length > 0) {
                    images.forEach(function(img, index) {
                        carousel.append(`
                    <div class="carousel-item ${index === 0 ? 'active' : ''}">
                        <img src="/images/${img}" class="d-block w-100" style="height:265px; object-fit:cover;">
                    </div>


                `);
                    });
                } else {
                    carousel.append(`
                <div class="carousel-item active">
                    <img src="https://via.placeholder.com/500x300" class="d-block w-100">
                </div>
            `);
                }

                let room = @json($roomTypes->keyBy('id'));
                let selected = room[selectedRoomType];
                $('#roomName').text(selected.room_type);
                $('#roomPrice').text('$ ' + selected.price);
                $('#roomDescription').text(selected.description);
                fetchAvailableRooms();
            }

            // Room type click
            $(document).on('click', '.room-type-btn', function() {
                selectRoomType($(this));
            });

            // Automatically select first or passed room type
            let firstBtn = initialRoomTypeId ?
                $(`.room-type-btn[data-id='${initialRoomTypeId}']`) :
                $('.room-type-btn').first();

            if (firstBtn.length) selectRoomType(firstBtn);

            // Fetch available rooms
            function fetchAvailableRooms() {
                const checkIn = $('#checkIn').val();
                const checkOut = $('#checkOut').val();

                if (!selectedRoomType || !checkIn || !checkOut) return;

                $.get("{{ route('user.booking.availableRooms') }}", {
                    room_type_id: selectedRoomType,
                    check_in: checkIn,
                    check_out: checkOut
                }, function(data) {
                    let container = $('#availableRooms');
                    container.empty();

                    if (data.rooms.length === 0) {
                        container.append('<span class="text-danger">No rooms available</span>');
                        return;
                    }

                    data.rooms.forEach(function(room, index) {
                        let activeClass = index === 0 ? 'btn-primary' : 'btn-outline-primary';
                        container.append(`
                    <button class="btn ${activeClass} me-2 mb-2 room-btn" data-id="${room.id}">
                        ${room.room_number}
                    </button>
                `);

                        if (index === 0) {
                            selectedRoomId = room.id;
                            $('#finalRoomId').val(selectedRoomId);
                        }
                    });
                });
            }

            // Select room
            $(document).on('click', '.room-btn', function() {
                $('.room-btn').removeClass('btn-primary').addClass('btn-outline-primary');
                $(this).removeClass('btn-outline-primary').addClass('btn-primary');
                selectedRoomId = $(this).data('id');
                $('#finalRoomId').val(selectedRoomId);
            });

            // Go to customer step
            $('#goToCustomer').click(function() {
                if (!$('#checkIn').val() || !$('#checkOut').val() || !$('#finalRoomId').val()) {
                    alert('Please select all booking details!');
                    return;
                }

                $('#finalCheckIn').val($('#checkIn').val());
                $('#finalCheckOut').val($('#checkOut').val());
                $('#finalRoomIdForm').val($('#finalRoomId').val());

                $('#bookingStep').hide();
                $('#customerStep').show();
            });

        });
    </script>
@endsection
