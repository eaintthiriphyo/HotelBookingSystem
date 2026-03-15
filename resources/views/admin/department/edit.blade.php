@extends('layouts.adminLayout')

@section('content')
    <div class="container pt-4">
       @if (session('updateDep'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('updateDep') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <div class="row justify-content-center">
            <div class="col-md-8">





                <div class="card shadow">

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0"><b>Add Department</b></h3>
                        <a href="{{ route('admin.department.index') }}" class="btn btn-dark btn-sm">View Lists</a>
                    </div>

                    <div class="card-body">

                        <form action="{{route('admin.department.update',$dep->id)}}" method="post">
                            @csrf

                            @method('PUT')
                            <table class="table table-bordered">

                                <tr>
                                    <td><label for="title">Department Title</label></td>
                                    <td>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ $dep->title }}">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="details">Details</label></td>
                                    <td>
                                        <input type="text" name="details" class="form-control"
                                            value="{{ $dep->details }}">
                                        @error('details')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </td>
                                </tr>

                                <!-- Button Row -->
                                <tr>
                                    <td colspan="2" class="">
                                        <button type="submit" class="btn btn-primary px-5">Update</button>
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
