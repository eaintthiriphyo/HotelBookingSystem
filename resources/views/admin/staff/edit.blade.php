@extends('layouts.adminLayout')

@section('content')
<div class="container pt-4">

    {{-- Success Message --}}
    @if (session('succStaff'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('succStaff') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif



    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><b>Edit Staff</b></h3>
                    <a href="{{ route('admin.staff.index') }}" class="btn btn-dark btn-sm">View Lists</a>
                </div>


                <div class="card-body">

                    <form action="{{ route('admin.staff.update',$staff->id) }}" method="post">
                        @csrf

                        @method('PUT')
                        <table class="table table-bordered">

                            <tr>
                                <td><label for="name">Staff Name</label></td>
                                <td>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{$staff->name}}" placeholder="Enter Name">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                            </tr>

                            <tr>
                                <td><label for="email">Staff Email</label></td>
                                <td>
                                    <input type="email" name="email" id="email" class="form-control"
                                        value="{{$staff->email}}" placeholder="Enter Email">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                            </tr>

                            <tr>
                                <td><label for="phone">Staff Phone</label></td>
                                <td>
                                    <input type="tel" name="phone" id="phone" class="form-control"
                                        value="{{$staff->phone}}" placeholder="Enter Phone Number">
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td><label for="address">Address</label></td>
                                <td>
                                    <input type="tel" name="address" id="address" class="form-control"
                                        value="{{$staff->address}}" placeholder="Enter address Number">
                                    @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                            </tr>


                            <tr>
                                <td><label for="credential">Staff Credential</label></td>
                                <td>
                                    <input type="text" name="credential" id="credential" class="form-control"
                                        value="{{$staff->credential}}" placeholder="Enter NRC No /Passport No">
                                    @error('credential')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                            </tr>


                            <tr>
                                <td><label for="roles">Staff Role</label></td>
                                <td>
                                    <input type="text" name="roles" id="roles" class="form-control"
                                        value="{{$staff->roles}}" placeholder="Enter Role">
                                    @error('roles')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                            </tr>


                            <tr>
                                <td><label for="department_id">Room Type</label></td>
                                <td>
                                    <select name="department_id" class="form-control">
                                        <option value="">Select Department Type</option>
                                        @foreach ($departments as $type)
                                        <option value="{{ $type->id }}"
                                            {{ (old('department_id') ? old('department_id') : $staff->department_id) == $type->id ? 'selected' : '' }}>
                                            {{ $type->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2" class="text-center">
                                    <button type="submit" class="btn btn-primary px-5">Create</button>
                                </td>
                            </tr>

                        </table>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>
@endsection