@extends('layouts.adminLayout')

@section('content')
<div class="container-fluid pt-4">

    {{-- Success Message --}}
    @if (session('successDep'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('successDep') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm border-0">
                <div class="card-header d-flex justify-content-between align-items-center" style="background-color:navy;color:white">
                    <h3 class="mb-0" ><b>Add Department</b></h3>
                    <a href="{{ route('admin.department.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-list"></i> View Lists
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.department.store') }}" method="post">
                        @csrf
                        <div class="row g-3">

                            <div class="col-md-12">
                                <label for="title" class="form-label">Department Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" placeholder="Enter Department Title">
                                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="details" class="form-label">Details</label>
                                <input type="text" name="details" id="details" class="form-control" value="{{ old('details') }}" placeholder="Enter Department Details">
                                @error('details') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-12 text-center mt-3">
                                <button type="submit" class="btn px-5" style="background-color:navy;color:white">
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
    label{
        color: black;
    }
</style>
@endsection
