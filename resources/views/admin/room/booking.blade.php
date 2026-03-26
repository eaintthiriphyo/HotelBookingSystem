@extends('layouts.adminLayout')
@section('content')
<div class="container pt-4">
    <h3 class="fw-bold text-dark mb-4">Room Booking</h3>

    <!-- Booking Form -->
    <div class="card p-4 shadow-sm">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form id="fullBookingForm" action="{{ route('admin.booking.store') }}" method="post">
            @csrf
            <input type="hidden" name="room_id" id="fullFinalRoomId" value="{{ old('room_id') }}">
            <input type="hidden" name="credential" id="fullCredential" value="{{ old('credential') }}">

            <h5 class="mb-3 text-dark">Customer Details</h5>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" id="fullName" name="name" class="form-control" value="{{ old('name') }}">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email" id="fullEmail" name="email" class="form-control" value="{{ old('email') }}">
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

            <div class="mb-4">
                <label class="form-label fw-bold">Choose Room Type</label>
                <div id="fullRoomTypeButtons" class="d-flex flex-wrap gap-2 mt-2">
                    @foreach ($roomTypes as $type)
                        <button type="button" class="room-type-btn btn btn-outline-dark" 
                                data-id="{{ $type->id }}" 
                                data-images='@json($type->images)' 
                                data-price="{{ $type->price }}">
                            {{ $type->room_type }}
                        </button>
                    @endforeach
                </div>
                @error('room_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Available Rooms</label>
                <div id="fullAvailableRooms" class="d-flex flex-wrap gap-2 mt-2"></div>
            </div>

            <button type="submit" class="btn w-100" style="background-color:navy;color:white">Book Room</button>
        </form>
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

    console.log('Fetching rooms for type:', selectedRoomType, 'from', checkIn, 'to', checkOut);

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

});
</script>
@endsection