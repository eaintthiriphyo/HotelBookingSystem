@extends('layouts.userLayout')

@section('content')

<!-- Review List -->
<section class="container py-5">
<h2 class="section-title text-center mb-4">Guest Reviews</h2>

<div class="row">


<div class="col-md-6 mb-4">
<div class="card shadow-sm border-0">
<div class="card-body">

<div class="d-flex align-items-center mb-2">
<strong>Review Name</strong>
</div>

<p>Review Message</p>

<div>

</div>

</div>
</div>
</div>


</div>
</section>

<!-- Write Review -->
<section class="py-5 bg-light">
<div class="container">
<h3 class="text-center mb-4">Write a Review</h3>

@auth
<!-- Logged In User -->
<div class="row justify-content-center">
<div class="col-md-6">

<form method="POST" action="">
@csrf

<div class="mb-3">
<label class="form-label">Rating</label>
<select name="rating" class="form-select">
<option value="1">1 Star</option>
<option value="2">2 Stars</option>
<option value="3">3 Stars</option>
<option value="4">4 Stars</option>
<option value="5">5 Stars</option>
</select>
</div>

<div class="mb-3">
<label class="form-label">Message</label>
<textarea name="message" class="form-control" rows="4"></textarea>
</div>

<button class="btn btn-primary">Submit Review</button>

</form>

</div>
</div>

@else
<!-- Not Logged In -->
<div class="text-center">
<p>Please login to write a review</p>
<a href="{{ route('login') }}" class="btn btn-primary">Login</a>
</div>
@endauth

</div>
</section>

@endsection