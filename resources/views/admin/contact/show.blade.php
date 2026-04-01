@extends('layouts.adminLayout')

@section('content')
<div class="container pt-4">
    <div class="card  col-8 shadow-sm border-0 mx-auto">
        <div class="card-header " style="background-color:navy;color:white">
            <h3>Message Details</h3>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $contact->name }}</p>
            <p><strong>Email:</strong> {{ $contact->email }}</p>
            <p><strong>Phone:</strong> {{ $contact->phone }}</p>
            <p><Strong>Message:</strong> <div style=" height: 120px; overflow: auto; border: 1px solid #ccc; padding: 8px;">
    {{ $contact->message }}
</div></p>
        </div>
        <a href="{{ route('admin.contact.index') }}" class="btn  m-3" style="background-color:navy;color:white">Back to list</a>
    </div>
</div>
@endsection
