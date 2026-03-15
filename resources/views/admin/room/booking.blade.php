@extends('layouts.adminLayout')
@section('content')
<div class="container pt-4">
    <h3 class="text-center mb-4">Room Booking</h3>

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

    <!-- Email Check -->
    <div class="card p-4 shadow-sm">
        <div class="mb-4">
            <label for="checkEmail" class="form-label"><b>Check Customer Email</b></label>
            <div class="d-flex">
                <input type="email" name="email" id="checkEmail" class="form-control me-2" placeholder="Enter email">
                <button type="button" id="checkEmailBtn" class="btn btn-primary">Check</button>
            </div>
            <div id="emailStatus" class="mt-2"></div>
        </div>


        <div id="successMsg" class="alert alert-success alert-dismissible fade show" role="alert" style="display:none;">
            <span id="successText"></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <p>Booking Successful.</p>
        </div>

        <!-- New Customer Form -->
        <form id="fullBookingForm" action="{{ route('admin.booking.store') }}" method="post" style="display:none;">
            @csrf
            <input type="hidden" name="room_id" id="fullRoomId">
            <h5 class="mb-3 text-secondary">New Customer Details</h5>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    <span class="text-danger error-text name_error"></span>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    <span class="text-danger error-text email_error"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                    <span class="text-danger error-text phone_error"></span>
                </div>
                <div class="col-md-6 mb-3">
                    <label>NRC/Passport</label>
                    <input type="text" name="credential" class="form-control" value="{{ old('credential') }}">
                    <span class="text-danger error-text credential_error"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Check-In</label>
                    <input type="date" name="check_in" id="fullCheckIn" class="form-control"
                        value="{{ old('check_in', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                    <span class="text-danger error-text check_in_error"></span>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Check-Out</label>
                    <input type="date" name="check_out" id="fullCheckOut" class="form-control"
                        value="{{ old('check_out', \Carbon\Carbon::now()->addDay()->format('Y-m-d')) }}">
                    <span class="text-danger error-text check_out_error"></span>
                </div>
            </div>

            <div class="mb-3">
                <label>Available Rooms</label>
                <select name="room_id" id="fullAvailableRooms" class="form-control">
                    <option value="">Select Room</option>
                </select>
                <span class="text-danger error-text room_id_error"></span>
            </div>

            <button type="submit" class="btn btn-dark w-100">Book Room</button>
        </form>

        <!-- Existing Customer Form -->
        <form id="quickBookingForm" action="{{ route('admin.booking.store') }}" method="post" style="display:none;">
            @csrf
            <input type="hidden" name="room_id" id="quickRoomId">
            <h5 class="mb-3 text-secondary">Existing Customer Booking</h5>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" id="existingUserEmail" class="form-control" readonly>
                <span class="text-danger error-text email_error"></span>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Check-In</label>
                    <input type="date" name="check_in" id="quickCheckIn" class="form-control"
                        value="{{ old('check_in', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                    <span class="text-danger error-text check_in_error"></span>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Check-Out</label>
                    <input type="date" name="check_out" id="quickCheckOut" class="form-control"
                        value="{{ old('check_out', \Carbon\Carbon::now()->addDay()->format('Y-m-d')) }}">
                    <span class="text-danger error-text check_out_error"></span>
                </div>
            </div>

            <div class="mb-3">
                <label>Available Rooms</label>
                <select name="room_id" id="quickAvailableRooms" class="form-control">
                    <option value="">Select Room</option>
                </select>
                <span class="text-danger error-text room_id_error"></span>
            </div>

            <button type="submit" class="btn btn-dark w-100">Book Room</button>
        </form>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){

    // Show correct form if validation fails (after reload fallback)
    @if($errors->any())
        @if(old('name'))
            $('#fullBookingForm').show();
            $('#quickBookingForm').hide();
        @else
            $('#quickBookingForm').show();
            $('#fullBookingForm').hide();
        @endif
    @endif

    // Check user email
    $('#checkEmailBtn').click(function(){
        var email = $('#checkEmail').val().trim();
        if(email.length < 3){
            $('#emailStatus').html('<span class="text-danger">Please enter a valid email!</span>');
            return;
        }

        $.get("{{ route('admin.booking.checkUser') }}", {email: email}, function(data){
            if(data.user){
                $('#quickBookingForm').show();
                $('#fullBookingForm').hide();
                $('#existingUserEmail').val(email);
                $('#emailStatus').html('<span class="text-success">Existing user! Choose dates and available rooms.</span>');
                fetchRooms('#quickCheckIn', '#quickCheckOut', '#quickAvailableRooms');
            } else {
                $('#fullBookingForm').show();
                $('#quickBookingForm').hide();
                $('#formEmail').val(email);
                $('#formName').val('');
                $('#formPhone').val('');
                $('#emailStatus').html('<span class="text-danger">New user! Fill details to create and book.</span>');
                fetchRooms('#fullCheckIn', '#fullCheckOut', '#fullAvailableRooms');
            }
        });
    });

    // Fetch available rooms
    function fetchRooms(checkInSelector, checkOutSelector, roomSelectSelector){
        $(checkInSelector + ',' + checkOutSelector).off('change').on('change', function(){
            var checkIn = $(checkInSelector).val();
            var checkOut = $(checkOutSelector).val();
            if(checkIn && checkOut){
                if(checkOut < checkIn){
                    alert('Check-out must be after check-in!');
                    $(checkOutSelector).val('');
                    return;
                }

                $.get("{{ route('admin.booking.availableRooms') }}", {check_in: checkIn, check_out: checkOut}, function(data){
                    var options = '<option value="">Select Room</option>';
                    data.rooms.forEach(function(room){
                        options += '<option value="'+room.id+'">'+room.room_number+' ('+room.room_type+')</option>';
                    });
                    $(roomSelectSelector).html(options);
                });
            }
        }).trigger('change');
    }

    fetchRooms('#fullCheckIn', '#fullCheckOut', '#fullAvailableRooms');
    fetchRooms('#quickCheckIn', '#quickCheckOut', '#quickAvailableRooms');

    // AJAX Booking
    function ajaxBooking(formSelector){
        $(formSelector).submit(function(e){
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var formData = form.serialize();

            // Clear previous errors
            form.find('.error-text').text('');

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function(response){
                    $('#successMsg').show();
                    $('#successText').text(response.message);
                    form.trigger('reset');
                    form.find('select').html('<option value="">Select Room</option>');
                    $('#emailStatus').html('');
                },
                error: function(xhr){
                    if(xhr.status === 422){
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value){
                            form.find('.'+key+'_error').text(value[0]);
                        });
                    } else {
                        alert('Something went wrong. Please try again.');
                    }
                }
            });
        });
    }

    ajaxBooking('#fullBookingForm');
    ajaxBooking('#quickBookingForm');

});
</script>
@endsection
