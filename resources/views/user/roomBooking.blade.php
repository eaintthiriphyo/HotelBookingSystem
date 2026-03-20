@extends('layouts.userLayout')

@section('content')
<div class="container pt-4">
    <h3 class="fw-bold text-dark mb-4">Room Booking</h3>

    <!-- Room Details -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-dark text-white">
            <b>Room Details</b>
        </div>
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

    <!-- STEP 1 -->
    <div class="card p-4 shadow-sm mb-4" id="bookingStep">
        <h5 class="mb-3 text-secondary">Booking Details</h5>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Check-In</label>
                <input type="date" id="checkIn" class="form-control"
                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Check-Out</label>
                <input type="date" id="checkOut" class="form-control"
                    value="{{ \Carbon\Carbon::now()->addDay()->format('Y-m-d') }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label"><b>Choose Room Type</b></label>
            <div id="roomTypeButtons">
                @foreach($roomTypes as $type)
                    <button type="button"
                        class="btn btn-outline-dark me-2 mb-2 room-type-btn"
                        data-id="{{ $type->id }}">
                        {{ $type->room_type }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Available Rooms -->
        <!-- <div class="mb-3">
            <label><b>Available Rooms</b></label>
            <select id="availableRooms" class="form-control">
                <option value="">Select Room</option>
            </select>
        </div> -->

          <div class="mb-3">
            <label><b>Available Rooms</b></label>
            <select id="availableRooms" class="form-control">
                <option value="">Select Room</option>
            </select>
        </div>

        <button type="button" id="goToCustomer" class="btn btn-dark w-100">
            Book Room
        </button>
    </div>

    <!-- STEP 2 -->
    <div class="card p-4 shadow-sm" id="customerStep" style="display:none;">
        <form id="bookingForm" action="" method="POST">
            @csrf

            <!-- Hidden Data -->
            <input type="hidden" name="check_in" id="finalCheckIn">
            <input type="hidden" name="check_out" id="finalCheckOut">
            <input type="hidden" name="room_id" id="finalRoomId">

            <h5 class="mb-3 text-secondary">Customer Details</h5>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control">
                    <span class="text-danger error-text name_error"></span>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                    <span class="text-danger error-text email_error"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control">
                    <span class="text-danger error-text phone_error"></span>
                </div>

                <div class="col-md-6 mb-3">
                    <label>NRC / Passport</label>
                    <input type="text" name="credential" class="form-control">
                    <span class="text-danger error-text credential_error"></span>
                </div>
            </div>

            <button type="submit" class="btn btn-success w-100">
                Confirm Booking
            </button>
        </form>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){

    let selectedRoomType = null;

    // Click Room Type Button
    $('.room-type-btn').click(function(){
        selectedRoomType = $(this).data('id');

        // Highlight button
        $('.room-type-btn').removeClass('btn-dark').addClass('btn-outline-dark');
        $(this).removeClass('btn-outline-dark').addClass('btn-dark');

        fetchAvailableRooms();
    });

    // When dates change, update available rooms
    $('#checkIn, #checkOut').change(function(){
        fetchAvailableRooms();
    });

    function fetchAvailableRooms(){
        let checkIn = $('#checkIn').val();
        let checkOut = $('#checkOut').val();

        if(!selectedRoomType || !checkIn || !checkOut) return;

        if(checkOut < checkIn){
            alert('Check-out must be after check-in!');
            $('#checkOut').val('');
            return;
        }

        $.get("{{ route('user.booking.availableRooms') }}", {
            room_type_id: selectedRoomType,
            check_in: checkIn,
            check_out: checkOut
        }, function(data){
            let options = '<option value="">Select Room</option>';
            data.rooms.forEach(function(room){
                options += `<option value="${room.id}">Room ${room.room_number}</option>`;
            });
            $('#availableRooms').html(options);
        });
    }

    
    $('#goToCustomer').click(function(){
        let checkIn = $('#checkIn').val();
        let checkOut = $('#checkOut').val();
        let roomId = $('#availableRooms').val();

        if(!checkIn || !checkOut || !roomId){
            alert('Please select all booking details!');
            return;
        }

        $('#finalCheckIn').val(checkIn);
        $('#finalCheckOut').val(checkOut);
        $('#finalRoomId').val(roomId);

        $('#bookingStep').hide();
        $('#customerStep').show();
    });

    // Submit form
    $('#bookingForm').submit(function(e){
        e.preventDefault();

        let form = $(this);
        form.find('.error-text').text('');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),

            success: function(res){
                $('#successMsg').show();
                $('#successText').text(res.message);

                $('#customerStep').hide();
                $('#bookingStep').show();

                form.trigger('reset');
                $('#availableRooms').html('<option value="">Select Room</option>');
                $('.room-type-btn').removeClass('btn-dark').addClass('btn-outline-dark');
                selectedRoomType = null;
            },

            error: function(xhr){
                if(xhr.status === 422){
                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function(key, val){
                        form.find('.'+key+'_error').text(val[0]);
                    });
                } else {
                    alert('Something went wrong!');
                }
            }
        });
    });

});
</script>
@endsection