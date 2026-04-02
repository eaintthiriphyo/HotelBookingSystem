@extends('layouts.adminLayout')

@section('content')
    <div class="container pt-4">

        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="card shadow">

                   <div class="card-header d-flex justify-content-between align-items-center" style="background-color:navy;color:white">
                <h3 class="mb-0"><b>Profile's Details</b></h3>
                <a href="{{ route('admin.staff.viewEditProfile',Auth::user()->id) }}" class="btn  btn-sm" style="background-color:white;color:navy">Edit</a>
            </div>


                    <div class="card-body">


                        <div class="mb-4">
                            <h5 style="color: black">Profile Image:</h5>
                            <div class="d-flex align-items-center justify-content-center">
                                @if ($profile->image && $profile->image != 'default.png')
                                    <img src="{{ asset('images/user/' . $profile->image) }}"
                                        class="img-fluid rounded shadow" style="max-width:150px;">
                                @else
                                    <img src="{{ asset('images/user/default.png') }}" class="img-fluid rounded shadow"
                                        style="max-width:150px;">
                                @endif
                            </div>
                        </div>


                        <table class="table ">
                            <tr>
                                <th width="30%" style="color: black">Name</th>
                                <td style="color: black">{{ $profile->name }}</td>
                            </tr>
                            <tr>
                                <th style="color: black">Email</th>
                                <td style="color: black">{{ $profile->email }}</td>
                            </tr>
                            <tr>
                                <th style="color: black">Phone</th>
                                <td style="color: black">{{ $profile->phone }}</td>
                            </tr>
                            <tr>
                                <th style="color: black">Address</th>
                                <td style="color: black">{{ $profile->address }}</td>
                            </tr>
                              <tr>
                                <th style="color: black">Credential</th>
                                <td style="color: black">{{ $profile->credential}}</td>
                            </tr>
                        </table>



                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection
