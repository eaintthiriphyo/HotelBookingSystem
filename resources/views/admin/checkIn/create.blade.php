@extends('layouts.adminLayout')
@section('content')
<div class="container pt-4">
    <h3 class="fw-bold text-dark mb-4">Room Check-In</h3>

    <!-- Booking Form -->
    <div class="card p-4 shadow-sm">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <form id="fullBookingForm" method="post">
            @csrf
            <input type="hidden" name="room_id" id="fullFinalRoomId" value="{{ old('room_id') }}">
            <input type="hidden" name="credential" id="fullCredential" value="{{ old('credential') }}">

            <!-- Customer Details -->
            <h5 class="mb-3 text-dark">Customer Details</h5>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" id="fullName" name="name" class="form-control" value="{{ old('name') }}">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email" id="fullEmail" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Phone</label>
                    <input type="text" id="fullPhone" name="phone" class="form-control" value="{{ old('phone') }}">
                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label>NRC</label>
                    <div class="row g-2">
                        <div class="col-3">
                            <select id="fullNrcCode" class="form-control">
                                <option value="">State/Region</option>
                                @for($i=1; $i<=14; $i++)
                                    <option value="{{ $i }}" {{ old('nrc_code')==$i ? 'selected' : '' }}>{{ $i }}/</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-5">
                            <select id="fullNrcTownship" class="form-control">
                                <option value="">Township</option>
                                @foreach($nrcData['data'] as $item)
                                    <option value="{{ $item['name_en'] }}" data-state="{{ $item['nrc_code'] }}" {{ old('nrc_township')==$item['name_en'] ? 'selected' : '' }}>
                                        {{ $item['name_mm'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <select id="fullNrcType" class="form-control">
                                <option value="N" {{ old('nrc_type')=='N' ? 'selected' : '' }}>(N)</option>
                                <option value="E" {{ old('nrc_type')=='E' ? 'selected' : '' }}>(E)</option>
                                <option value="P" {{ old('nrc_type')=='P' ? 'selected' : '' }}>(P)</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <input type="text" id="fullNrcNumber" class="form-control" maxlength="6" placeholder="123456" value="{{ old('nrc_number') }}">
                        </div>
                        @error('credential') <span class="text-danger mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label>Address</label>
                <input type="text" id="fullAddress" name="address" class="form-control" value="{{ old('address') }}">
                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Dates -->
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Check-In</label>
                    <input type="date" id="fullCheckIn" name="check_in" class="form-control form-control-lg" value="{{ old('check_in', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                    @error('check_in') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Check-Out</label>
                    <input type="date" id="fullCheckOut" name="check_out" class="form-control form-control-lg" value="{{ old('check_out', \Carbon\Carbon::now()->addDay()->format('Y-m-d')) }}">
                    @error('check_out') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Room Type -->
            <div class="mb-4">
                <label class="form-label fw-bold">Choose Room Type</label>
                <div id="fullRoomTypeButtons" class="d-flex flex-wrap gap-2 mt-2">
                    @foreach ($roomTypes as $type)
                        <button type="button" class="room-type-btn btn btn-outline-dark"
                                data-id="{{ $type->id }}"
                                data-images='@json($type->images)'
                                data-price="{{ $type->price }}">
                            {{ $type->room_type }}
                        <input type="hidden" id="price" value="{{$type->price}}">
                        </button>
                    @endforeach
                </div>
                @error('room_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Available Rooms -->
            <div class="mb-4">
                <label class="form-label fw-bold">Available Rooms</label>
                <div id="fullAvailableRooms" class="d-flex flex-wrap gap-2 mt-2"></div>
            </div>

            <!-- Book Room Button -->
            <button type="button" id="btnBookRoom" class="btn w-100" style="background-color:navy;color:white">
                Check-in Room
            </button>
        </form>

        <!-- Booking Summary -->
        <div class="card shadow-sm mb-4 border-0" id="bookingSummary" style="display:none; border-radius:12px;">
            <div class="card-header text-white d-flex justify-content-between align-items-center" style="background-color: navy;">
                <h3 class="mb-0">Check-in Summary</h3>
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

                <!-- Confirm Booking Form -->
                <form id="bookingForm" action="{{ route('admin.checkin.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="check_in" id="finalCheckIn">
                    <input type="hidden" name="check_out" id="finalCheckOut">
                    <input type="hidden" name="room_id" id="finalRoomIdForm">
                    <input type="hidden" name="name" id="finalName">
                    <input type="hidden" name="email" id="finalEmail">
                    <input type="hidden" name="phone" id="finalPhone">
                    <input type="hidden" name="credential" id="finalCredential">
                    <input type="hidden" name="address" id="finalAddress">

                    <button type="submit" class="w-100 mt-3" style="background-color: navy; color:white; padding:12px; border:none; border-radius:10px; font-size:16px;">
                        Confirm Check-in
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    label { color: black; }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    let selectedRoomType = null;

    // Generate NRC
    function generateNRC(){
        const code = $('#fullNrcCode').val();
        const township = $('#fullNrcTownship').val();
        const type = $('#fullNrcType').val();
        const number = $('#fullNrcNumber').val();
        if(code && township && type && number){
            $('#fullCredential').val(`${code}/${township}(${type})${number}`);
        }
    }
    $('#fullNrcCode, #fullNrcTownship, #fullNrcType, #fullNrcNumber').on('change keyup', generateNRC);

    // Filter Townships by State
    $('#fullNrcCode').on('change', function(){
        const code = $(this).val();
        $('#fullNrcTownship option').each(function(){
            const state = $(this).data('state');
            $(this).toggle(state == code || $(this).val() == '');
        });
    });

    // Update min dates
    function updateDates(){
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth()+1).padStart(2,'0');
        const dd = String(today.getDate()).padStart(2,'0');
        const minCheckIn = `${yyyy}-${mm}-${dd}`;
        $('#fullCheckIn').attr('min', minCheckIn);
        if($('#fullCheckIn').val() < minCheckIn) $('#fullCheckIn').val(minCheckIn);

        const checkInDate = new Date($('#fullCheckIn').val());
        checkInDate.setDate(checkInDate.getDate()+1);
        const yyyy2 = checkInDate.getFullYear();
        const mm2 = String(checkInDate.getMonth()+1).padStart(2,'0');
        const dd2 = String(checkInDate.getDate()).padStart(2,'0');
        const minCheckOut = `${yyyy2}-${mm2}-${dd2}`;
        $('#fullCheckOut').attr('min', minCheckOut);
        if($('#fullCheckOut').val() < minCheckOut) $('#fullCheckOut').val(minCheckOut);
    }
    updateDates();
    $('#fullCheckIn, #fullCheckOut').on('change', updateDates);

    // Room Type Selection
    $('.room-type-btn').on('click', function(){
        $('.room-type-btn').removeClass('btn-dark').addClass('btn-outline-dark');
        $(this).removeClass('btn-outline-dark').addClass('btn-dark');
        selectedRoomType = $(this).data('id');
        fetchRooms();
    });

    // Fetch Available Rooms
    function fetchRooms() {
        if (!selectedRoomType) return;
        const checkIn = $('#fullCheckIn').val();
        const checkOut = $('#fullCheckOut').val();

        $.get("{{ route('admin.booking.availableRooms') }}", {
            room_type_id: selectedRoomType,
            check_in: checkIn,
            check_out: checkOut
        }, function(data) {
            const container = $('#fullAvailableRooms');
            container.empty();

            if (!data.rooms || data.rooms.length === 0) {
                container.append('<span class="text-danger">No rooms available</span>');
                $('#fullFinalRoomId').val('');
                return;
            }

            data.rooms.forEach((room, i) => {
                const btnClass = i === 0 ? 'btn-primary' : 'btn-outline-primary';
                container.append(`<button type="button" class="btn ${btnClass} me-2 mb-2 room-btn" data-id="${room.id}">${room.room_number}</button>`);
                if (i === 0) $('#fullFinalRoomId').val(room.id);
            });
        });
    }

    // Room Selection
    $(document).on('click', '.room-btn', function(){
        $('.room-btn').removeClass('btn-primary').addClass('btn-outline-primary');
        $(this).removeClass('btn-outline-primary').addClass('btn-primary');
        $('#fullFinalRoomId').val($(this).data('id'));
    });

    // Validate form
    function validateBookingForm() {
        let name = $('#fullName').val().trim();
        let phone = $('#fullPhone').val().trim();
        let address = $('#fullAddress').val().trim();
        let credential = $('#fullCredential').val().trim();
        let checkIn = $('#fullCheckIn').val();
        let checkOut = $('#fullCheckOut').val();
        let roomTypeSelected = $('.room-type-btn.btn-dark').length > 0;
        let roomId = $('#fullFinalRoomId').val();

        if(name === ''){ alert('Please enter your name.'); return false; }
        if(phone === ''){ alert('Please enter your phone number.'); return false; }
        if(credential === ''){ alert('Please complete your NRC information.'); return false; }
        if(address === ''){ alert('Please enter your address.'); return false; }
        if(checkIn === '' || checkOut === ''){ alert('Please select check-in and check-out dates.'); return false; }
        if(!roomTypeSelected){ alert('Please select a room type.'); return false; }
        if(!roomId){ alert('Please select a room.'); return false; }

        return true;
    }

    // Show summary
    function showSummary() {
        const name = $('#fullName').val();
        const email = $('#fullEmail').val();
        const phone = $('#fullPhone').val();
        const address = $('#fullAddress').val();
        const credential = $('#fullCredential').val();
        const roomText = $('.room-type-btn.btn-dark').text() || 'N/A';
        const roomId = $('#fullFinalRoomId').val();
        const checkIn = $('#fullCheckIn').val();
        const checkOut = $('#fullCheckOut').val();
        const nights = (new Date(checkOut) - new Date(checkIn)) / (1000*60*60*24);
        const price = $('.room-type-btn.btn-dark').data('price') || 0;

        // Fill summary
        $('#summaryName').text(name);
        $('#summaryEmail').text(email);
        $('#summaryPhone').text(phone);
        $('#summaryRoom').text(roomText);
        $('#summaryCheckIn').text(checkIn);
        $('#summaryCheckOut').text(checkOut);
        $('#summaryNights').text(nights);
        $('#summaryPrice').text(price);
        $('#summaryTotal').text(price * nights);

        // Fill final form
        $('#finalName').val(name);
        $('#finalEmail').val(email);
        $('#finalPhone').val(phone);
        $('#finalAddress').val(address);
        $('#finalCredential').val(credential);
        $('#finalCheckIn').val(checkIn);
        $('#finalCheckOut').val(checkOut);
        $('#finalRoomIdForm').val(roomId);

        $('#bookingSummary').show();
        $('html, body').animate({scrollTop: $('#bookingSummary').offset().top}, 500);
    }

    // Book Room button click
    $('#btnBookRoom').on('click', function(){
        if(validateBookingForm()){
            showSummary();
        }
    });

});
</script>
@endsection