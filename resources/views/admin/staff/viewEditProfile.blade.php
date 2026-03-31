@extends('layouts.adminLayout')

@section('content')
<div class="container pt-4">

    {{-- Success Message --}}
    @if (session('succUpdateProfile'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('succUpdateProfile') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center " style="background-color: navy; color:white">
                    <h4 class="mb-0"><b>Edit Profile</b></h4>
                    <a href="{{ route('admin.staff.viewProfile', Auth::user()->email) }}" class="btn btn-light btn-sm text-primary">View Profile</a>
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.staff.profileUpdate', Auth::user()->email) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Profile Picture --}}
                        <div class="text-center mb-4">
                            @php
                                $imgSrc = $profile->image && $profile->image != 'default.png'
                                    ? asset('images/user/' . $profile->image)
                                    : asset('images/user/default.png');
                            @endphp
                            <img src="{{ $imgSrc }}" class="rounded-circle shadow mb-2" width="150">
                            <div>
                                <input type="file" name="image" class="form-control form-control-sm mt-2">
                                @error('image') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Name & Phone --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Staff Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $profile->name) }}">
                                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone', $profile->phone) }}">
                                @error('phone') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Address --}}
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address', $profile->address) }}">
                            @error('address') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        {{-- Roles --}}
                       

                        {{-- NRC / Credential --}}
                        <div class="mb-3">
                            <label class="form-label">Credential / NRC</label>
                            <div class="row g-2">
                                {{-- State --}}
                                <div class="col-3">
                                    <select id="fullNrcCode" class="form-control">
                                        <option value="">State/Region</option>
                                        @for($i=1; $i<=14; $i++)
                                            <option value="{{ $i }}">{{ $i }}/</option>
                                        @endfor
                                    </select>
                                </div>
                                {{-- Township --}}
                                <div class="col-5">
                                    <select id="fullNrcTownship" class="form-control">
                                        <option value="">Township</option>
                                        @foreach($nrcData['data'] as $item)
                                            <option value="{{ $item['name_en'] }}" data-state="{{ $item['nrc_code'] }}">
                                                {{ $item['name_mm'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- Type --}}
                                <div class="col-2">
                                    <select id="fullNrcType" class="form-control">
                                        <option value="N">(N)</option>
                                        <option value="E">(E)</option>
                                        <option value="P">(P)</option>
                                    </select>
                                </div>
                                {{-- Number --}}
                                <div class="col-2">
                                    <input type="text" id="fullNrcNumber" class="form-control" maxlength="6" placeholder="123456">
                                </div>
                            </div>
                            @error('credential') <span class="text-danger mt-1">{{ $message }}</span> @enderror

                            {{-- Hidden field for form submission --}}
                            <input type="hidden" name="credential" id="fullCredential">
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn  px-5" style="background-color: navy; color:white">Update Profile</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- jQuery + NRC script --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    function generateNRC(){
        const code = $('#fullNrcCode').val();
        const township = $('#fullNrcTownship').val();
        const type = $('#fullNrcType').val();
        const number = $('#fullNrcNumber').val();

        if(code && township && type && number){
            $('#fullCredential').val(`${code}/${township}(${type})${number}`);
        } else {
            $('#fullCredential').val('');
        }
    }

    // Trigger generate on change
    $('#fullNrcCode, #fullNrcTownship, #fullNrcType, #fullNrcNumber').on('change keyup', generateNRC);

    // Filter Townships by selected state
    $('#fullNrcCode').on('change', function(){
        const code = $(this).val();
        $('#fullNrcTownship option').each(function(){
            const state = $(this).data('state');
            $(this).toggle(state == code || $(this).val() == '');
        });
    });

    // Initialize with old credential if exists
    @if($profile->credential)
        const cred = "{{ $profile->credential }}";
        const match = cred.match(/(\d+)\/(.+)\((\w)\)(\d+)/);
        if(match){
            $('#fullNrcCode').val(match[1]);
            $('#fullNrcTownship').val(match[2]);
            $('#fullNrcType').val(match[3]);
            $('#fullNrcNumber').val(match[4]);
            generateNRC();
        }
    @endif
});
</script>

@endsection
