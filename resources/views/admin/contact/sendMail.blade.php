@extends('layouts.adminLayout')

@section('content')
<div class="container pt-4">

    <div class="card shadow-sm border-0 rounded-3">
        <!-- Header -->
        <div class="card-header  text-center" style="background-color:navy;color:white">
            <h2 class="mb-0">Send Email to {{ $mail->name }}</h2>
        </div>

        <!-- Body -->
        <div class="card-body">
            <form method="POST" action="{{ route('admin.sendMail', $mail->id) }}">
                @csrf

                <!-- Greeting -->
                <div class="mb-3 row">
                    <label class="col-md-3 col-form-label fw-bold">Greeting</label>
                    <div class="col-md-9">
                        <input type="text" name="greeting" class="form-control" value="Hello {{ $mail->name }}" required>
                    </div>
                </div>

                <!-- Mail Body -->
                <div class="mb-3 row">
                    <label class="col-md-3 col-form-label fw-bold">Mail Body</label>
                    <div class="col-md-9">
                        <textarea name="body" class="form-control" rows="5" placeholder="Your booking is confirmed..." required></textarea>
                    </div>
                </div>

                <!-- Action Text -->
                <div class="mb-3 row">
                    <label class="col-md-3 col-form-label fw-bold">Action Text</label>
                    <div class="col-md-9">
                        <input type="text" name="action_text" class="form-control" placeholder="View Booking" required>
                    </div>
                </div>

                <!-- Action URL -->
                <div class="mb-3 row">
                    <label class="col-md-3 col-form-label fw-bold">Action URL</label>
                    <div class="col-md-9">
                        <input type="url" name="action_url" class="form-control" value="mailto:{{ $mail->email }}" required>
                    </div>
                </div>

                <!-- End Line -->
                <div class="mb-3 row">
                    <label class="col-md-3 col-form-label fw-bold">End Line</label>
                    <div class="col-md-9">
                        <input type="text" name="end_line" class="form-control" placeholder="Thank you for booking with us!" required>
                    </div>
                </div>

                <!-- Submit -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn  px-5" style="background-color:navy;color:white">Send Email</button>
                </div>

            </form>
        </div>
    </div>
</div>

<style>
.card-header h2 {
    font-weight: 700;
    font-size: 28px;
}

.form-control {
    border-radius: 8px;
    padding: 10px 12px;
}

label.fw-bold {
    font-weight: 600;
}

button.btn-primary {
    border-radius: 8px;
    font-weight: 600;
    padding: 10px 25px;
    font-size: 16px;
}

.card {
    margin-bottom: 20px;
}
</style>
@endsection
