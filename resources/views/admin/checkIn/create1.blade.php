@extends('layouts.adminLayout')
@section('content')
    <div class="container pt-4">
        <h2 class="fw-bold text-dark mb-4">Room Check In</h2>

        <!-- Room Details -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header " style="background-color:navy;color:white"><b>Room Details</b></div>
            <div class="card-body">
                <table class="table table-bordered mb-0">
                    <tr>
                        <td><b>Check-In Date</b></td>
                        <td>{{ \Carbon\Carbon::now()->format('Y-m-d') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        @if(session('success'))
    <div id="successMsg" class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
        <!-- Email Check -->
        <div class="card p-4 shadow-sm">
            <div class="mb-4">
                <label for="checkEmail" class="form-label"><b>Check Customer Email</b></label>
                <div class="d-flex">
                    <input type="email" name="email" id="checkEmail" class="form-control me-2"
                        placeholder="Enter email">
                    <button type="button" id="checkEmailBtn" class="btn btn-dark"><i class="fa fa-search"></i></button>
                </div>
                <div id="emailStatus" class="mt-2"></div>
            </div>


            <div id="successMsg" class="alert alert-success alert-dismissible fade show" role="alert"
                style="display:none;">
                <span id="successText"></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <p>Booking Successful.</p>
            </div>

            <!-- New Customer Form -->
     <form id="fullBookingForm" action="{{ route('admin.checkin.store') }}" method="post" style="display:none;">
            @csrf
            <input type="hidden" name="room_id" id="fullFinalRoomId">

            <h5 class="mb-3 text-dark">New Customer Details</h5>
            <div class="row">
                <input type="hidden" name="room_id" id="fullFinalRoomId">
                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" id="fullName" name="name" class="form-control" value="{{ old('name') }}">
                    <span class="text-danger error-text name_error">@error('name') {{ $message }} @enderror</span>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email" id="fullEmail" name="email" class="form-control" value="{{ old('email') }}">
                    <span class="text-danger error-text email_error">@error('email') {{ $message }} @enderror</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Phone</label>
                    <input type="text" id="fullPhone" name="phone" class="form-control" >
                    <span class="text-danger error-text phone_error">@error('phone') {{ $message }} @enderror</span>
                </div>
                <div class="col-md-6 mb-3">
                    <label>NRC/Passport</label>
                    <input type="text" id="fullCredential" name="credential" class="form-control" >
                    <span class="text-danger error-text credential_error">@error('credential') {{ $message }} @enderror</span>
                </div>
            </div>

            <div class="mb-3">
                <label>Address</label>
                <input type="text" id="fullAddress" name="address" class="form-control" value="{{ old('address') }}">
                <span class="text-danger error-text address_error">@error('address') {{ $message }} @enderror</span>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Check-In</label>
                    <input type="date" id="fullCheckIn" name="check_in" class="form-control form-control-lg" value="{{ old('check_in', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Check-Out</label>
                    <input type="date" id="fullCheckOut" class="form-control form-control-lg" name="check_out" value="{{ old('check_out', \Carbon\Carbon::now()->addDay()->format('Y-m-d')) }}">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Choose Room Type</label>
                <div id="fullRoomTypeButtons" class="d-flex flex-wrap gap-2 mt-2">
                    @foreach ($roomTypes as $type)
                        <button type="button" class="room-type-btn btn btn-outline-dark" data-id="{{ $type->id }}" data-images='@json($type->images)' data-price="{{ $type->price }}">
                            {{ $type->room_type }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Available Rooms</label>
                <div id="fullAvailableRooms" class="d-flex flex-wrap gap-2 mt-2"></div>
            </div>

            <button type="submit" class="btn w-100" style="background-color:navy;color:white">Book Room</button>
        </form>

        <!-- Existing Customer Form -->
        <form id="quickBookingForm" action="{{ route('admin.checkin.store') }}" method="post" style="display:none;">
            @csrf
            <input type="hidden" name="room_id" id="quickFinalRoomId">


            <h5 class="mb-3 text-secondary">Existing Customer Booking</h5>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" id="quickEmail" class="form-control" value="{{ old('email') }}" readonly>
                <span class="text-danger error-text email_error">@error('email') {{ $message }} @enderror</span>
            </div>

              <div class="mb-3">
                <label>Name</label>
                <input type="name" name="name" id="quickName" class="form-control" value="{{ old('name') }}" >
                <span class="text-danger error-text name_error">@error('name') {{ $message }} @enderror</span>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Phone</label>
                    <input type="text" name="phone" id="quickPhone" class="form-control" value="{{ old('phone') }}">
                    <span class="text-danger error-text phone_error">@error('phone') {{ $message }} @enderror</span>
                </div>
                <div class="col-md-6 mb-3">
                    <label>NRC/Passport</label>
                    <input type="text" name="credential" id="quickCredential" class="form-control" value="{{ old('credential') }}">
                    <span class="text-danger error-text credential_error">@error('credential') {{ $message }} @enderror</span>
                </div>
            </div>

            <div class="mb-3">
                <label>Address</label>
                <input type="text" name="address" id="quickAddress" class="form-control" value="{{ old('address') }}">
                <span class="text-danger error-text address_error">@error('address') {{ $message }} @enderror</span>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Check-In</label>
                    <input type="date" id="quickCheckIn" class="form-control form-control-lg" name="check_in" value="{{ old('check_in', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Check-Out</label>
                    <input type="date" id="quickCheckOut" class="form-control form-control-lg" name="check_out"  value="{{ old('check_out', \Carbon\Carbon::now()->addDay()->format('Y-m-d')) }}">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Choose Room Type</label>
                <div id="quickRoomTypeButtons" class="d-flex flex-wrap gap-2 mt-2">
                    @foreach ($roomTypes as $type)
                        <button type="button" class="room-type-btn btn btn-outline-dark" data-id="{{ $type->id }}" data-images='@json($type->images)' data-price="{{ $type->price }}">
                            {{ $type->room_type }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Available Rooms</label>
                <div id="quickAvailableRooms" class="d-flex flex-wrap gap-2 mt-2"></div>
            </div>

            <button type="submit" class="btn w-100" style="background-color:navy;color:white">Check In Room</button>
        </form>

    </div>
</div>

<style>
    label { color: black; }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {

    // === Show correct form if validation fails ===
    @if ($errors->any())
        @if (old('name'))
            $('#fullBookingForm').show();
            $('#quickBookingForm').hide();
        @elseif (old('email'))
            $('#quickBookingForm').show();
            $('#fullBookingForm').hide();
        @endif
    @endif

    // Date constraints
    function updateDates(formPrefix) {
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth()+1).padStart(2,'0');
        const dd = String(today.getDate()).padStart(2,'0');
        const minCheckIn = `${yyyy}-${mm}-${dd}`;

        const checkIn = $(`#${formPrefix}CheckIn`);
        const checkOut = $(`#${formPrefix}CheckOut`);
        checkIn.attr('min', minCheckIn);
        if(checkIn.val() < minCheckIn) checkIn.val(minCheckIn);

        const checkInDate = new Date(checkIn.val());
        const nextDay = new Date(checkInDate);
        nextDay.setDate(checkInDate.getDate()+1);
        const dd2 = String(nextDay.getDate()).padStart(2,'0');
        const mm2 = String(nextDay.getMonth()+1).padStart(2,'0');
        const yyyy2 = nextDay.getFullYear();
        const minCheckOut = `${yyyy2}-${mm2}-${dd2}`;
        checkOut.attr('min', minCheckOut);
        if(checkOut.val() < minCheckOut) checkOut.val(minCheckOut);
    }

    updateDates('full'); updateDates('quick');

    $('#fullCheckIn, #quickCheckIn').on('change', function() {
        const prefix = $(this).attr('id').includes('full') ? 'full' : 'quick';
        updateDates(prefix);
        fetchRoomsForForm(prefix);
    });
    $('#fullCheckOut, #quickCheckOut').on('change', function() {
        const prefix = $(this).attr('id').includes('full') ? 'full' : 'quick';
        fetchRoomsForForm(prefix);
    });

    // Email check
    $('#checkEmailBtn').click(function() {
        let email = $('#checkEmail').val().trim();
        if(email.length < 3){
            $('#emailStatus').html('<span class="text-danger">Please enter a valid email!</span>');
            return;
        }
        $.get("{{ route('admin.booking.checkUser') }}", {email: email}, function(data){
            if(data.user){
                $('#quickBookingForm').show(); $('#fullBookingForm').hide();
                $('#quickEmail').val(email);
                $('#emailStatus').html('<span class="text-success">Existing user! Choose dates and available rooms.</span>');
                fetchRoomsForForm('quick');
            } else {
                $('#fullBookingForm').show(); $('#quickBookingForm').hide();
                $('#fullEmail').val(email);
                $('#fullName').val(''); $('#fullPhone').val(''); $('#fullCredential').val(''); $('#fullAddress').val('');
                $('#emailStatus').html('<span class="text-danger">New user! Fill details to create and book.</span>');
                fetchRoomsForForm('full');
            }
        });
    });

    // Track selected room type per form
    let selectedRoomType = { fullBookingForm: null, quickBookingForm: null };

    // Room type selection
    $(document).on('click', '.room-type-btn', function(){
        const formPrefix = $(this).closest('form').attr('id') === 'fullBookingForm' ? 'full' : 'quick';
        const formId = formPrefix + 'BookingForm';
        selectedRoomType[formId] = $(this).data('id');

        $(this).siblings('.room-type-btn').removeClass('btn-dark').addClass('btn-outline-dark');
        $(this).removeClass('btn-outline-dark').addClass('btn-dark');

        fetchRoomsForForm(formPrefix);
    });

    // Fetch available rooms
    function fetchRoomsForForm(formPrefix){
        const containerSelector = formPrefix === 'full' ? '#fullAvailableRooms' : '#quickAvailableRooms';
        const roomIdInput = formPrefix === 'full' ? '#fullFinalRoomId' : '#quickFinalRoomId';
        const checkIn = $(`#${formPrefix}CheckIn`).val();
        const checkOut = $(`#${formPrefix}CheckOut`).val();
        const roomTypeId = selectedRoomType[formPrefix+'BookingForm'];

        if(!roomTypeId){
            $(containerSelector).html('<span class="text-danger">Please select a room type first.</span>');
            return;
        }

        $.get("{{ route('admin.booking.availableRooms') }}", {room_type_id: roomTypeId, check_in: checkIn, check_out: checkOut}, function(data){
            const container = $(containerSelector); container.empty();
            if(!data.rooms || data.rooms.length===0){
                container.append('<span class="text-danger">No rooms available</span>');
                $(roomIdInput).val('');
                return;
            }
            data.rooms.forEach((room,index)=>{
                const btnClass = index===0 ? 'btn-primary' : 'btn-outline-primary';
                container.append(`<button type="button" class="btn ${btnClass} me-2 mb-2 room-btn" data-id="${room.id}">${room.room_number}</button>`);
                if(index===0) $(roomIdInput).val(room.id);
            });
        });
    }

    // Room button click
    $(document).on('click','.room-btn', function(){
        const form = $(this).closest('form');
        form.find('.room-btn').removeClass('btn-primary').addClass('btn-outline-primary');
        $(this).removeClass('btn-outline-primary').addClass('btn-primary');
        form.find('input[name=room_id]').val($(this).data('id'));
    });

});
</script>
@endsection
