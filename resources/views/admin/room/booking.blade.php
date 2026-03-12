@extends('layouts.adminLayout')
@section('content')

<div class="container pt-4">
    <h3 class="text-center mb-4">Room Booking</h3>

    <!-- Room Details -->
    <table class="table table-bordered">
        <tr><td><b>Room Number</b></td><td>{{ $room->room_number }}</td></tr>
        <tr><td><b>Room Type</b></td><td>{{ $room->room_type->room_type }}</td></tr>
        <tr><td><b>Booking Date</b></td><td>{{ \Carbon\Carbon::now()->format('Y-m-d') }}</td></tr>
    </table>

    <div class="card p-3">
        <!-- Email Check -->
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" id="checkEmail" class="form-control" placeholder="Enter email" required>
            <div class="mt-2">
                <button type="button" id="checkEmailBtn" class="btn btn-primary">Check Email</button>
            </div>
            <div id="emailStatus" class="mt-2"></div>
        </div>

        <!-- Full Form (for new user) -->
        <form id="fullBookingForm" action="{{ route('admin.booking.store') }}" method="post" style="display:none;">
            @csrf
            <input type="hidden" name="room_id" value="{{ $room->id }}">
    <input type="hidden" name="email" id="formEmailHidden">

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" id="formName" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" id="formEmail" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" id="formPhone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>NRC/Passport</label>
                <input type="text" name="credential" class="form-control" required>
            </div>
            
            <!-- Check-in/Check-out for new user -->
            <div class="mb-3">
                <label>Check-In</label>
                <input type="date" name="check_in" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
            </div>
            <div class="mb-3">
                <label>Check-Out</label>
                <input type="date" name="check_out" class="form-control" value="{{ \Carbon\Carbon::now()->addDay()->format('Y-m-d') }}" required>
            </div>

            <button type="submit" class="btn btn-success">Book Room</button>
        </form>

        <!-- Quick Form (for existing user) -->
        <form id="quickBookingForm" action="{{ route('admin.booking.store') }}" method="POST" style="display:none;">
            @csrf
            <input type="hidden" name="room_id" value="{{ $room->id }}">
            <input type="hidden" name="user_email" id="existingUserEmail">

            <div class="mb-3">
                <label>Check-In</label>
                <input type="date" name="check_in" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
            </div>
            <div class="mb-3">
                <label>Check-Out</label>
                <input type="date" name="check_out" class="form-control" value="{{ \Carbon\Carbon::now()->addDay()->format('Y-m-d') }}" required>
            </div>

            <button type="submit" class="btn btn-success">Book Room</button>
        </form>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#checkEmailBtn').click(function() {
        var email = $('#checkEmail').val();

        if(email.length < 3){
            alert("Please enter a valid email!");
            return;
        }

        $.get("{{ route('admin.booking.checkUser') }}", { email: email }, function(data){
            if(data.user){
                // Existing user → show quick booking only
                $('#quickBookingForm').show();
                $('#fullBookingForm').hide();
                $('#existingUserEmail').val(email);
                $('#emailStatus').html('<span class="text-success">User exists! Just select dates and book.</span>');
            } else {
                // New user → show full form
                $('#fullBookingForm').show();
                $('#quickBookingForm').hide();
                $('#formEmail').val(email);
                $('#formName').val('');
                $('#formPhone').val('');
                $('#emailStatus').html('<span class="text-danger">New user. Please fill details to create and book.</span>');
            }
        });
    });
});
</script>

@endsection