@extends('layouts.adminLayout')

@section('content')
<div class="container pt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white">
            <h3>Message Details</h3>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $contact->name }}</p>
            <p><strong>Email:</strong> {{ $contact->email }}</p>
            <p><strong>Phone:</strong> {{ $contact->phone }}</p>
            <p><Strong>Message:</strong> {{ $contact->message }}</p>
        </div>
        <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary m-3">Back to list</a>
    </div>
</div>
@endsection
