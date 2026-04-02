@extends('layouts.userLayout')

@section('content')

<!-- Guest Reviews -->
<section class="container py-5" id="reviews">
    <h2 class="section-title text-center mb-5"> Guest Reviews</h2>

    <div class="row ">
        @forelse($review ?? [] as $r)
            <div class="col-10 mx-auto mb-3">
                <div class="card shadow-sm border-0 h-100 hover-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ $r->user->image ? asset('images/user/' . $r->user->image) : asset('images/user/default.png') }}"
                                 class="rounded-circle me-3" width="50" height="50">
                            <div>
                                <strong class="d-block">{{ $r->user->name }}</strong>
                                <div class="text-warning">
                                    @for($i = 0; $i < $r->rating; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                    @for($i = $r->rating; $i < 5; $i++)
                                        <i class="far fa-star"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p class="mb-0">{{ $r->comment }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center text-muted">No reviews yet. Be the first to leave a review!</p>
            </div>
        @endforelse
    </div>
</section>

<!-- Write Review Form -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="card p-4 p-md-5 shadow-sm rounded-4">
            <h3 class="text-center mb-4">Write a Review</h3>

            @auth
                <form method="POST" action="{{ route('user.dashboard.review.store') }}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="mb-4">
                        <label class="form-label d-block"><b>Rating</b></label>
                        <div class="star-rating-js mb-2">
                            <i class="far fa-star" data-value="1"></i>
                            <i class="far fa-star" data-value="2"></i>
                            <i class="far fa-star" data-value="3"></i>
                            <i class="far fa-star" data-value="4"></i>
                            <i class="far fa-star" data-value="5"></i>
                        </div>
                        <input type="hidden" name="rating" id="rating-value" required>
                        @error('rating')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label"><b>Message</b></label>
                        <textarea name="comment" class="form-control" rows="4" placeholder="Write your review here..." required></textarea>
                        @error('comment')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button class="btn w-100" type="submit" style="background-color: navy; color:white;">Submit Review</button>
                </form>
            @else
                <div class="text-center py-4">
                    <p>Please login to write a review</p>
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                </div>
            @endauth
        </div>
    </div>
</section>

<style>
/* Section title underline */
.section-title:after {
    content: '';
    display: block;
    width: 80px;
    height: 4px;
    background: #ffc107;
    margin: 10px auto 0;
    border-radius: 2px;
}

/* Review Card hover effect */
.hover-card {
    transition: transform 0.3s, box-shadow 0.3s;
}
.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 25px rgba(0,0,0,0.2);
}

/* Star rating */
.star-rating-js i {
    font-size: 2rem;
    color: #ccc;
    cursor: pointer;
    transition: color 0.2s;
}
.star-rating-js i.hover,
.star-rating-js i.selected {
    color: #ffc107;
}

/* Responsive spacing */
@media (max-width: 767px) {
    .card-body p {
        font-size: 0.9rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.star-rating-js i');
    const ratingInput = document.getElementById('rating-value');
    let selectedRating = 1;
    ratingInput.value = selectedRating;
    highlightStars(selectedRating);

    stars.forEach(star => {
        star.addEventListener('mouseover', function() {
            highlightStars(parseInt(this.dataset.value));
        });
        star.addEventListener('mouseout', function() {
            highlightStars(selectedRating);
        });
        star.addEventListener('click', function() {
            selectedRating = parseInt(this.dataset.value);
            ratingInput.value = selectedRating;
            highlightStars(selectedRating);
        });
    });

    function highlightStars(rating) {
        stars.forEach(star => {
            star.classList.toggle('selected', parseInt(star.dataset.value) <= rating);
        });
    }
});
</script>

@endsection
