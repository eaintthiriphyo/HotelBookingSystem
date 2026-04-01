@extends('layouts.app')

@section('content')

<!-- Review List -->
<section class="container py-5" id="reviews">
    <h2 class="section-title text-center mb-5">Guest Reviews</h2>

    <div class="row">
        @foreach($review ?? [] as $review)
        <div class="col mb-4">
            <div class="card shadow-sm border-0 h-100 hover-card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <!-- User Image -->
                        <img src="{{ $review->user->image ? asset('images/user/' . $review->user->image) : asset('images/user/default.png') }}" class="rounded-circle me-3" width="50" height="50">

                        <div>
                            <strong class="d-block">{{ $review->user->name }}</strong>
                            <!-- Star Rating -->
                            <div class="text-warning">
                                @for($i = 0; $i < $review->rating; $i++)
                                    <i class="fas fa-star"></i>
                                    @endfor
                                    @for($i = $review->rating; $i < 5; $i++)
                                        <i class="far fa-star"></i>
                                        @endfor
                            </div>

                        </div>
                    </div>
                    <p class="mb-0">{{ $review->comment }}</p>
                </div>
            </div>
        </div>
        @endforeach

        @if(empty($review) )
        <div class="col-12">
            <p class="text-center text-muted">No reviews yet. Be the first to leave a review!</p>
        </div>
        @endif
    </div>
</section>

<!-- Write Review -->
<section class="py-5 bg-light" id="reviews">
    <div class="container">
        <div class="card p-5">
        <h3 class="text-center mb-4">Write a Review</h3>

        @auth
        <div class="row ">
            <div class="col-md-6">
                <form method="POST" action="{{route('review.store')}}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label d-block">Rating</label>
                        <div class="star-rating-js">
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

            </div>
        </div>
        <input type="hidden" name="user_id" id="" value="{{Auth::user()->id}}">

        <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea name="comment" class="form-control" rows="4" placeholder="Write your review here..."></textarea>
        </div>
        @error('comment')
        <p class="text-danger">{{$message}}</p>
        @enderror

        <button class="btn  w-100" type="submit"  style="background-color: navy;color:white">Submit Review</button>
        </form>
    </div>
    </div>
    </div>
    @else
    <div class="text-center">
        <p>Please login to write a review</p>
        <a href="{{ route('login') }}" class="btn " style="background-color:navy;color:white">Login</a>
    </div>
    @endauth
    </div>
</section>


<style>
    .hover-card {
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .section-title:after {
        content: '';
        display: block;
        width: 80px;
        height: 3px;
        background: #ffc107;
        margin: 10px auto 0;
        border-radius: 2px;
    }





    .star-rating-js i {
        font-size: 2rem;
        color: #ccc;
        cursor: pointer;
        transition: color 0.2s;
    }

    .star-rating-js i.hover,
    .star-rating-js i.selected {
        color: #ffc107;
        /* gold */
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
                const value = parseInt(this.getAttribute('data-value'));
                highlightStars(value);
            });

            star.addEventListener('mouseout', function() {
                highlightStars(selectedRating);
            });

            star.addEventListener('click', function() {
                selectedRating = parseInt(this.getAttribute('data-value'));
                ratingInput.value = selectedRating;
                highlightStars(selectedRating);
            });
        });

        function highlightStars(rating) {
            stars.forEach(star => {
                const starValue = parseInt(star.getAttribute('data-value'));
                if (starValue <= rating) {
                    star.classList.add('selected');
                } else {
                    star.classList.remove('selected');
                }
            });
        }
    });
       const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

    navLinks.forEach(link => {
        link.addEventListener('click', function () {
            // Remove active from all links
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Optional: Highlight based on scroll
    const sections = document.querySelectorAll('section');
    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop - 80;
            if (pageYOffset >= sectionTop) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === '#' + current) {
                link.classList.add('active');
            }
        });
    });
</script>
@endsection
