@extends('layouts.adminLayout')

@section('content')
<div class="container pt-4">

    {{-- Success Message --}}
    @if(session('succCus'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('succCus') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif



    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><b>Add Customer</b></h3>
                    <a href="{{ route('admin.customer.index') }}" class="btn btn-dark btn-sm">View Lists</a>
                </div>


                <div class="card-body">

                    <form action="{{ route('admin.customer.store') }}" method="post">
                        @csrf

                        <table class="table table-bordered">

                            <tr>
                                <td><label for="name">Customer Name</label></td>
                                <td>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Enter Name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                            </tr>

                            <tr>
                                <td><label for="email">Customer Email</label></td>
                                <td>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Enter Email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                            </tr>

                            <tr>
                                <td><label for="phone">Customer Phone</label></td>
                                <td>
                                    <input type="tel" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" placeholder="Enter Phone Number">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                            </tr>

                            <tr>
                                <td><label for="credential">Customer Credential</label></td>
                                <td>
                                    <input type="text" name="credential" id="credential" class="form-control" value="{{ old('credential') }}" placeholder="Enter NRC No /Passport No">
                                    @error('credential')
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
