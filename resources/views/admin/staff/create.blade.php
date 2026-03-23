@extends('layouts.adminLayout')

@section('content')
<div class="container-fluid pt-4">

    {{-- Success Message --}}
    @if (session('succStaff'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('succStaff') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm border-0">
                <div class="card-header d-flex justify-content-between align-items-center" style="background-color:navy;color:white">
                    <h3 class="mb-0"><b>Add New Staff</b></h3>
                    <a href="{{ route('admin.staff.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-list"></i> View Lists
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.staff.store') }}" method="post">
                        @csrf
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label for="name" class="form-label text-dark">Staff Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Enter Name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label  text-dark">Staff Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Enter Email">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="phone" class="form-label  text-dark">Staff Phone</label>
                                <input type="tel" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" placeholder="Enter Phone Number">
                                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="address" class="form-label  text-dark">Address</label>
                                <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" placeholder="Enter Address">
                                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="credential" class="form-label  text-dark">Staff Credential</label>
                                <input type="text" name="credential" id="credential" class="form-control" value="{{ old('credential') }}" placeholder="Enter NRC No / Passport No">
                                @error('credential') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="roles" class="form-label  text-dark">Staff Role</label>
                                <input type="text" name="roles" id="roles" class="form-control" value="{{ old('roles') }}" placeholder="Enter Role">
                                @error('roles') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="department_id" class="form-label  text-dark">Department</label>
                                <select name="department_id" class="form-select form-control">
                                    <option value="">Select Department</option>
                                    @foreach ($department as $type)
                                        <option value="{{ $type->id }}" {{ old('department_id') == $type->id ? 'selected' : '' }}>
                                            {{ $type->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('department_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="btn px-5 mt-3"style="background-color:navy;color:white">
                                    <i class="fas fa-plus-circle"></i> Create
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>

<style>
    .card {
        border-radius: 12px;
    }

    .form-label {
        font-weight: 500;
    }

    .btn-primary {
        font-weight: 500;
    }

    .text-danger {
        font-size: 0.85rem;
    }

    .alert {
        border-radius: 10px;
    }

</style>
@endsection
