@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-3">
            @include('layouts.sidebar')
        </div>
        <div class="col-8">
            <h3>User Dashboard</h3>
        </div>
    </div>
</div>
@endsection