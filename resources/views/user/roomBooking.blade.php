@extends('layouts.userLayout')

@section('content')
<div class="container pt-4">
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

    <!-- Success Message -->
    <div id="successMsg" class="alert alert-success alert-dismissible fade show" role="alert" style="display:none;">
        <span id="successText"></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <!-- STEP 1: Booking Details -->
    <div class="card p-4 shadow-sm mb-4" id="bookingStep">
        <h5 class="mb-3 text-secondary">Booking Details</h5>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Check-In</label>
                <input type="date" id="checkIn" class="form-control"
                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                <span class="text-danger error-text check_in_error"></span>
            </div>

            <div class="col-md-6 mb-3">
                <label>Check-Out</label>
                <input type="date" id="checkOut" class="form-control"
                    value="{{ \Carbon\Carbon::now()->addDay()->format('Y-m-d') }}">
                <span class="text-danger error-text check_out_error"></span>
            </div>
        </div>

        <!-- Room Type Selection -->
        <div class="mb-3">
            <label class="form-label"><b>Choose Room Type</b></label>
            <div id="roomTypeButtons">
                @foreach($roomTypes as $type)
                    <button type="button" class="btn btn-outline-dark me-2 mb-2 room-type-btn"
                        data-id="{{ $type->id }}">
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

    <!-- STEP 2: Customer Details -->
    <div class="card p-4 shadow-sm" id="customerStep" style="display:none;">
        <form id="bookingForm" action="{{ route('user.booking.store') }}" method="POST">
            @csrf
            <input type="hidden" name="check_in" id="finalCheckIn">
            <input type="hidden" name="check_out" id="finalCheckOut">
            <input type="hidden" name="room_id" id="finalRoomIdForm">

            <h5 class="mb-3 text-secondary">Customer Details</h5>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" readonly>
                    <span class="text-danger error-text name_error"></span>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                    <span class="text-danger error-text email_error"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ Auth::user()->phone }}">
                    <span class="text-danger error-text phone_error"></span>
                </div>

                <div class="col-md-6 mb-3">
                    <label>NRC / Passport</label>
                    <input type="text" name="credential" class="form-control" value="{{ Auth::user()->credential }}">
                    <span class="text-danger error-text credential_error"></span>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" value="{{ Auth::user()->address }}">
                    <span class="text-danger error-text address_error"></span>
                </div>
            </div>

            <button type="submit" class="btn btn-success w-100">Confirm Booking</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){

    let selectedRoomType = null;
    let selectedRoomId = null;
    const today = new Date();
    today.setHours(0,0,0,0);

    // Check-in / Check-out validation
    $('#checkIn').change(function(){
        const checkInVal = new Date($(this).val());
        if(checkInVal < today){
            $('.check_in_error').text('Check-in date cannot be before today.');
            $(this).val('');
        } else $('.check_in_error').text('');

        const minCheckOut = new Date(checkInVal);
        minCheckOut.setDate(minCheckOut.getDate() + 1);
        const year = minCheckOut.getFullYear();
        const month = ("0"+(minCheckOut.getMonth()+1)).slice(-2);
        const day = ("0"+minCheckOut.getDate()).slice(-2);
        const minDateStr = `${year}-${month}-${day}`;
        $('#checkOut').attr('min', minDateStr);
        if($('#checkOut').val() < minDateStr) $('#checkOut').val(minDateStr);

        fetchAvailableRooms();
    });

    $('#checkOut').change(function(){
        const checkInVal = new Date($('#checkIn').val());
        const checkOutVal = new Date($(this).val());
        if(checkOutVal <= checkInVal){
            $('.check_out_error').text('Check-out must be after check-in.');
            $(this).val('');
        } else $('.check_out_error').text('');
        fetchAvailableRooms();
    });

    // Room type selection
    $(document).on('click', '.room-type-btn', function(){
        selectedRoomType = $(this).data('id');
        $('.room-type-btn').removeClass('btn-dark').addClass('btn-outline-dark');
        $(this).removeClass('btn-outline-dark').addClass('btn-dark');
        fetchAvailableRooms();
    });

    // Fetch available rooms
    function fetchAvailableRooms(){
        const checkIn = $('#checkIn').val();
        const checkOut = $('#checkOut').val();
        if(!selectedRoomType || !checkIn || !checkOut) return;

        $.get("{{ route('user.booking.availableRooms') }}", {
            room_type_id: selectedRoomType,
            check_in: checkIn,
            check_out: checkOut
        }, function(data){
            const container = $('#availableRooms');
            container.empty();
            selectedRoomId = null;
            $('#finalRoomId').val('');

            if(data.rooms.length === 0){
                container.append('<span class="text-danger">No rooms available</span>');
                return;
            }

            data.rooms.forEach(function(room){
                const btn = $('<button>')
                    .addClass('btn btn-outline-primary me-2 mb-2 room-btn')
                    .text(room.room_number)
                    .data('id', room.id);
                container.append(btn);
            });
        });
    }

    // Select room
    $(document).on('click', '.room-btn', function(){
        $('.room-btn').removeClass('btn-primary').addClass('btn-outline-primary');
        $(this).removeClass('btn-outline-primary').addClass('btn-primary');
        selectedRoomId = $(this).data('id');
        $('#finalRoomId').val(selectedRoomId);
    });

    // Go to customer step
    $('#goToCustomer').click(function(){
        if(!$('#checkIn').val() || !$('#checkOut').val() || !$('#finalRoomId').val()){
            alert('Please select all booking details!');
            return;
        }

        $('#finalCheckIn').val($('#checkIn').val());
        $('#finalCheckOut').val($('#checkOut').val());
        $('#finalRoomIdForm').val($('#finalRoomId').val());

        $('#bookingStep').hide();
        $('#customerStep').show();
    });

    // AJAX booking submission
    $('#bookingForm').submit(function(e){
        e.preventDefault();
        const form = $(this);
        form.find('.error-text').text('');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(res){
                $('#successText').text(res.message);
                $('#successMsg').show();

                $('#customerStep').hide();
                $('#bookingStep').show();

                form.trigger('reset');
                $('#availableRooms').empty();
                $('.room-type-btn').removeClass('btn-dark').addClass('btn-outline-dark');
                selectedRoomType = null;
                selectedRoomId = null;
            },
            error: function(xhr){
                if(xhr.status === 422){
                    const errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, val){
                        form.find('.'+key+'_error').text(val[0]);
                    });
                } else {
                    alert('Something went wrong! Check console.');
                    console.log(xhr.responseText);
                }
            }
        });
    });

});
</script>
@endsection