@extends('layouts.userLayout')

@section('content')
<style>

    .room-btn{
        padding: 20px 30px;
border-radius: 20%;
font-size: 1rem;

    }
    .room-type-btn {
    background-color: white;       /* default bg */
    color: orangered;
    border: 2px solid orangered;
    padding: 10px 18px;
    border-radius: 10px;
    transition: 0.3s;
}

/* Hover effect */
.room-type-btn:hover {
    background-color: orangered;
    color: white;
}

/* Selected (active) */
.room-type-btn.active {
    background-color: orangered;
    color: white;
}
</style>
<div class="container pt-4 mt-5" style="margin-bottom: 200px;">




    <!-- Room Details -->
    <div class="card  shadow-sm mb-4">
        <div class="card-header text-white d-flex justify-content-between align-items-center" style="background-color: navy;">
        <h3 class="mb-0">Room Booking</h3>
        <a href="{{ route('user.booking.viewAllList', Auth::user()->id) }}" class="btn  " style="background-color: orangered ;color:white">
            All My Bookings
        </a>

        </div>

        <div class="card-body">
            <table class="table  mb-0">
                <tr>
                    <td><h5>Booking Date</h5></td>
                    <td><h5>{{ \Carbon\Carbon::now()->format('Y-m-d') }}</h5></td>
                </tr>
            </table>
            </div>
        </div>






    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row mb-5">
        <!-- LEFT: Carousel -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header card-room">
                    <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner" id="carouselImages">
                            <div class="carousel-item active">
                                <img src="https://via.placeholder.com/500x300" class="d-block w-100" style="height:265px; object-fit:cover;">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
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

        <!-- RIGHT: Booking Steps -->
        <div class="col-md-8">

            <!-- Step 1: Booking Details -->
         <div class="card shadow-sm mb-4 border-0" id="bookingStep" style="border-radius:12px;">

    <!-- Header -->
    <div class="card-header text-white" style="background-color: navy; border-top-left-radius:12px; border-top-right-radius:12px;">
        <h4 class="mb-0">Booking Details</h4>
    </div>

    <div class="card-body">

        <!-- Dates -->
        <div class="row g-3 mb-4">

            <div class="col-md-6">
                <label class="form-label fw-bold">Check-In</label>
                <input type="date" id="checkIn"
                    class="form-control form-control-lg"
                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">Check-Out</label>
                <input type="date" id="checkOut"
                    class="form-control form-control-lg"
                    value="{{ \Carbon\Carbon::now()->addDay()->format('Y-m-d') }}">
            </div>

        </div>

        <!-- Room Type -->
        <div class="mb-4">
            <label class="form-label fw-bold">Choose Room Type</label>

            <div id="roomTypeButtons" class="d-flex flex-wrap gap-2 mt-2">
                @foreach($roomTypes as $type)
                    <button type="button"
                        class="room-type-btn "
                        data-id="{{ $type->id }}"
                        data-images='@json($type->images)'
                        data-price="{{ $type->price }}">
                        {{ $type->room_type }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Available Rooms -->
        <div class="mb-4">
            <label class="form-label fw-bold">Available Rooms</label>

            <div id="availableRooms" class="d-flex flex-wrap gap-2 mt-2"></div>
            <input type="hidden" id="finalRoomId">
        </div>

        <!-- Button -->
        <button type="button" id="goToCustomer"
            class="w-100 mt-2"
            style="background-color: orangered; color:white; padding:12px; border:none; border-radius:10px; font-size:16px;">
            Continue →
        </button>

    </div>
</div>
            <!-- Step 2: Customer Details -->
          <div class="card shadow-sm mb-4 border-0" id="customerStep" style="display:none; border-radius:12px;">

    <!-- Header -->
    <div class="card-header text-white" style="background-color: navy; border-top-left-radius:12px; border-top-right-radius:12px;">
        <h4 class="mb-0">Customer Details</h4>
    </div>

    <div class="card-body">

        <div class="row g-3">

            <!-- Name -->
            <div class="col-md-6">
                <label class="form-label fw-bold">Full Name</label>
                <input type="text" id="inputName" class="form-control form-control-lg"
                    placeholder="Enter your name"
                    value="{{ Auth::user()->name }}">
            </div>

            <!-- Email -->
            <div class="col-md-6">
                <label class="form-label fw-bold">Email Address</label>
                <input type="email" id="inputEmail" class="form-control form-control-lg"
                    placeholder="example@gmail.com" name="email"
                    value="{{ Auth::user()->email }}">
            </div>

            <!-- Phone -->
            <div class="col-md-6">
                <label class="form-label fw-bold">Phone Number</label>
                <input type="text" id="inputPhone" class="form-control form-control-lg"
                    placeholder="09xxxxxxxxx" name="phone"
                    value="{{ Auth::user()->phone }}">
            </div>

            <!-- NRC -->
            <div class="col-md-6">
                <label class="form-label fw-bold">NRC / Passport</label>
                <input type="text" id="inputCredential" class="form-control form-control-lg"
                    placeholder="Enter NRC or Passport" name="credential"
                    value="{{ Auth::user()->credential }}">
            </div>

            <!-- Address -->
            <div class="col-12">
                <label class="form-label fw-bold">Address</label>
                <textarea id="inputAddress" rows="2" name="address"
                    class="form-control form-control-lg"
                    placeholder="Enter your address">{{ Auth::user()->address }}</textarea>
            </div>

        </div>

        <!-- Button -->
        <button type="button" id="saveProfile"
            class="w-100 mt-4"
            style="background-color: orangered; color:white; padding:12px; border:none; border-radius:10px; font-size:16px;">
            Continue to Summary →
        </button>

    </div>
</div>

            <!-- Step 3: Booking Summary -->
         <div class="card shadow-sm mb-4 border-0" id="bookingSummary" style="display:none; border-radius:12px;">

    <!-- Header -->
    <div class="card-header text-white" style="background-color: navy; border-top-left-radius:12px; border-top-right-radius:12px;">
        <h4 class="mb-0">Booking Summary</h4>
    </div>

    <div class="card-body">

            <!-- Customer Info -->
        <div class="mb-3 p-3 rounded" style="background-color:#f8f9fa;">
            <p class="mb-1"><b>Name:</b> <span id="summaryName"></span></p>
            <p class="mb-1"><b>Email:</b> <span id="summaryEmail"></span></p>
            <p class="mb-0"><b>Phone:</b> <span id="summaryPhone"></span></p>
        </div>
        <!-- Room Info -->
        <div class="mb-3 p-3 rounded" style="background-color:#f8f9fa;">
            <h5 class="mb-2" id="summaryRoom"></h5>
            <p class="mb-1"><b>Check-In:</b> <span id="summaryCheckIn"></span></p>
            <p class="mb-1"><b>Check-Out:</b> <span id="summaryCheckOut"></span></p>
            <p class="mb-0"><b>Nights:</b> <span id="summaryNights"></span></p>
        </div>


        <!-- Price Section -->
        <div class="mb-3 p-3 rounded" style="background-color:#fff3f0;">
            <div class="d-flex justify-content-between">
                <span>Price / Night</span>
                <span id="summaryPrice"></span>
            </div>
            <div class="d-flex justify-content-between">
                <span>Total Nights</span>
                <span id="summaryNights"></span>
            </div>
            <hr>
            <div class="d-flex justify-content-between fw-bold" style="font-size:18px;">
                <span>Total Cost</span>
                <span style="color:orangered;" id="summaryTotal"></span>
            </div>
        </div>



        <!-- Form -->
        <form id="bookingForm" action="{{ route('user.booking.store') }}" method="POST">
            @csrf

            <input type="hidden" name="check_in" id="finalCheckIn">
            <input type="hidden" name="check_out" id="finalCheckOut">
            <input type="hidden" name="room_id" id="finalRoomIdForm">
            <input type="hidden" name="name" id="finalName">
            <input type="hidden" name="email" id="finalEmail">
            <input type="hidden" name="phone" id="finalPhone">
            <input type="hidden" name="credential" id="finalCredential">
            <input type="hidden" name="address" id="finalAddress">

            <button type="button" id="confirmBooking"
                class="w-100 mt-3"
                style="background-color: orangered; color:white; padding:12px; border:none; border-radius:10px; font-size:16px;">
                Confirm Booking
            </button>
        </form>

    </div>
</div>

        </div>
    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

    $(document).on('click', '.room-type-btn', function () {

    // remove active from all
    $('.room-type-btn').removeClass('active');

    // add active to clicked button
    $(this).addClass('active');

});

    let selectedRoomType = null;
    let selectedRoomId = null;

    // Check-in / Check-out min date
    function updateCheckOutMin() {
        const checkIn = $('#checkIn').val();
        if(!checkIn) return;
        const next = new Date(checkIn);
        next.setDate(next.getDate()+1);
        const dd = String(next.getDate()).padStart(2,'0');
        const mm = String(next.getMonth()+1).padStart(2,'0');
        const yyyy = next.getFullYear();
        $('#checkOut').attr('min', `${yyyy}-${mm}-${dd}`);
        if($('#checkOut').val() < $('#checkOut').attr('min')) $('#checkOut').val($('#checkOut').attr('min'));
    }
    updateCheckOutMin();
    $('#checkIn').on('change', function(){ updateCheckOutMin(); fetchAvailableRooms(); });
    $('#checkOut').on('change', fetchAvailableRooms);

    // Select room type
    function selectRoomType(btn){
        selectedRoomType = btn.data('id');
        $('.room-type-btn').removeClass('btn-dark').addClass('btn-outline-dark');
        btn.removeClass('btn-outline-dark').addClass('btn-dark');

        let images = btn.data('images');
        let carousel = $('#carouselImages');
        carousel.empty();
        if(images && images.length>0){
            images.forEach((img,index)=>{
                carousel.append(`<div class="carousel-item ${index===0?'active':''}"><img src="/images/${img}" class="d-block w-100" style="height:265px; object-fit:cover;"></div>`);
            });
        } else {
            carousel.append(`<div class="carousel-item active"><img src="https://via.placeholder.com/500x300" class="d-block w-100"></div>`);
        }

        let roomData = @json($roomTypes->keyBy('id'));
        let selected = roomData[selectedRoomType];
        $('#roomName').text(selected.room_type);
        $('#roomPrice').text(selected.price);
        $('#roomDescription').text(selected.description);

        fetchAvailableRooms();
    }
    $(document).on('click','.room-type-btn', function(){ selectRoomType($(this)); });
    selectRoomType($('.room-type-btn').first());

    // Fetch available rooms
    function fetchAvailableRooms(){
        const checkIn = $('#checkIn').val();
        const checkOut = $('#checkOut').val();
        if(!selectedRoomType || !checkIn || !checkOut) return;

        $.get("{{ route('user.booking.availableRooms') }}", { room_type_id:selectedRoomType, check_in:checkIn, check_out:checkOut }, function(data){
            let container = $('#availableRooms');
            container.empty();
            if(data.rooms.length===0){ container.append('<span class="text-danger">No rooms available</span>'); return; }
            data.rooms.forEach((room,index)=>{
                let activeClass = index===0?'btn-primary':'btn-outline-primary';
                container.append(`<button class="btn ${activeClass} me-2 mb-2 room-btn" data-id="${room.id}">${room.room_number}</button>`);
                if(index===0){ selectedRoomId = room.id; $('#finalRoomId').val(selectedRoomId); }
            });
        });
    }

    $(document).on('click','.room-btn',function(){
        $('.room-btn').removeClass('btn-primary').addClass('btn-outline-primary');
        $(this).removeClass('btn-outline-primary').addClass('btn-primary');
        selectedRoomId = $(this).data('id');
        $('#finalRoomId').val(selectedRoomId);
    });

    // Step navigation
    $('#goToCustomer').click(function(){
        if(!$('#checkIn').val() || !$('#checkOut').val() || !$('#finalRoomId').val()){
            alert('Please select all booking details!');
            return;
        }
        $('#bookingStep').hide();
        $('#customerStep').show();
    });

    // Save profile -> show summary
    $('#saveProfile').click(function(){
        const checkIn = $('#checkIn').val();
        const checkOut = $('#checkOut').val();
        const roomName = $('#roomName').text();
        const price = parseFloat($('#roomPrice').text());
        const nights = Math.ceil((new Date(checkOut)-new Date(checkIn))/(1000*60*60*24));
        const total = price*nights;

        const name = $('#inputName').val();
        const email = $('#inputEmail').val();
        const phone = $('#inputPhone').val();
        const credential = $('#inputCredential').val();
        const address = $('#inputAddress').val();

        $('#summaryRoom').text(roomName);
        $('#summaryCheckIn').text(checkIn);
        $('#summaryCheckOut').text(checkOut);
        $('#summaryNights').text(nights);
        $('#summaryPrice').text(`$ ${price}`);
        $('#summaryTotal').text(`$ ${total}`);
        $('#summaryName').text(name);
        $('#summaryEmail').text(email);
        $('#summaryPhone').text(phone);
        $('#summaryCredential').text(credential);
        $('#summaryAddress').text(address);

        $('#finalCheckIn').val(checkIn);
        $('#finalCheckOut').val(checkOut);
        $('#finalRoomIdForm').val($('#finalRoomId').val());
        $('#finalName').val(name);
        $('#finalEmail').val(email);
        $('#finalPhone').val(phone);
        $('#finalCredential').val(credential);
        $('#finalAddress').val(address);

        $('#customerStep').hide();
        $('#bookingSummary').show();
    });

    // Confirm booking -> submit form
    $('#confirmBooking').click(function(){
        $('#bookingForm').submit();
    });

});
</script>
@endsection
