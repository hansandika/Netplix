@extends('layouts.app',['title' => 'Movie Show'])
@section('library')
    <link rel="stylesheet" href="{{ asset('css/movie.css') }}">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{ asset('js/lightslider.js') }}"></script>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/lightslider.css') }}" />
    <script src="{{ asset('js/movie.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"
        integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('content')
    <section class='main-class container-fluid'>
        <div class="bg-image" style='background-image: url({{ $movie->bg_url }});'>
            <div class="row show-detail" id='show-detail'>
                <div class='col'>
                    <img src="{{ $movie->image_url }}" class='show-image'>
                </div>
                <div class='col-lg-8 text-light container'>
                    <div class='show-title d-flex roboto'>
                        <h1 class="w-75">{{ $movie->title }}</h1>
                        @auth
                            @can('addWatchList', $movie)
                                <div class="d-flex w-50">
                                    <button class='btn btn-danger top-addbtn'>+ Add to Watchlist</button>
                                </div>
                            @endcan
                        @endauth
                    </div>
                    <div class='d-flex poppins'>
                        @foreach ($genres as $genre)
                            <button href='#' class="genre">{{ $genre->name }}</button>
                        @endforeach
                    </div>
                    <div class='d-flex show-info poppins'>
                        <div>
                            <div><i class="fas fa-star text-warning"></i></div>
                            <div class='show-info-tag'>Rating</div>
                            <div class='show-info-score'>{{ $movie->rating }}</div>
                        </div>
                        <div>
                            <div><i class="far fa-calendar-alt text-primary"></i></div>
                            <div class='show-info-tag'>Release Year</div>
                            <div class='show-info-score'>{{ $movie->release_date->format('Y') }}</div>
                        </div>
                    </div>
                    <div class='show-description roboto'>
                        <h4>Storyline</h4>
                        <p>{{ $movie->description }}</p>
                        <h4>{{ $movie->director }}</h4>
                        <p>Director</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="show-detail text-light" id='cast'>
            <h2 class='section-title mb-5'>Cast</h2>
            <div class="card-group cast-carousel cs-hidden text-light" id="autoWidth2">
                @forelse ($actors as $actor)
                    <div class="cast-card card">
                        <img src="{{ $actor->image_url }}" class="cast-image">
                        <div class="card-body p-3">
                            <h5 class="card-title">{{ $actor->name }}</h5>
                            <p class="card-text">{{ $actor->character_name }}</p>
                        </div>
                    </div>
                @empty
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <p>There is No Casts</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        <div class="show-detail text-light" id='reviews'>
            <h2 class='section-title mb-5'>Review</h2>
            <div class="card-group review-carousel cs-hidden text-light" id="autoWidth3">
                @forelse ($reviews as $review)
                    <div class="card review-card">
                        <div class="d-flex align-items-center mb-3">
                            @if ($review->user->image_url)
                                <img src="{{ $review->user->image_url }}" class='reviewer'>
                            @else
                                <span style="font-size:5.5rem">
                                    <i class="fas fa-user-circle"></i>
                                </span>
                            @endif
                            <div class="flex-column reviewer-detail">
                                <h4>{{ $review->user->name }}</h4>
                                <p>{{ $review->review_date->format('d-M-Y') }}</p>
                            </div>
                        </div>
                        <p class="lead text-muted">{{ $review->body }}</p>
                        <div class="d-flex justify-content-between">
                            <p class='review-rating fw-bolder'><i class="text-warning fas fa-star yellow"></i>
                                {{ $review->rating }} / 10 </p>
                            @auth
                                @can('deleteReview', $review)
                                    <form action="{{ route('delete-review', $movie->show_id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger p-2" style="border-radius: 5px">Delete</button>
                                    </form>
                                @endcan
                            @endauth
                        </div>
                    </div>
                @empty
                    <div class="row">
                        <div class="col-md-6">
                            <div class="alert alert-danger">
                                <p>There is No Review</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            @can('review', $movie)
                <div class="d-flex justify-content-center mt-3" id="review-container">
                    <button class="btn btn-danger add-review-btn"><i class="far fa-edit"></i> Add a
                        Review</button>
                </div>
            @endcan
        </div>
        <section class='container p-3 text-light'>
            <h2 class='section-title mb-5'>More</h2>
            <ul class="movie-carousel card-group list-unstyled cs-hidden text-light" id="autoWidth">
                @foreach ($movies as $currMovie)
                    @if ($currMovie != $movie)
                        <li class="card movie-card">
                            <a href="{{ route('show-movie', $currMovie->show_id) }}"><img
                                    src="{{ $currMovie->image_url }}" class="card-img-top" alt="..."></a>
                            <div class="card-body">
                                <h5 class="card-title">{{ Str::limit($currMovie->title, 20) }}</h5>
                                <div class="d-flex justify-content-between">
                                    <p class="text-muted">{{ $currMovie->release_date->format('Y') }}</p>
                                    <p class="card-info">
                                        @auth
                                            @can('addWatchList', $currMovie)
                                                <button class="btn p-0 addBtn" id="addWatchButton"
                                                    value="{{ $currMovie->show_id }}">
                                                    <i class="fas fa-plus text-muted"></i>
                                                </button>
                                            @else
                                                <button class="btn p-0 addBtn added" id="addWatchButton"
                                                    value="{{ $currMovie->show_id }}">
                                                    <i class="fas fa-check text-danger"></i>
                                                </button>
                                            @endcan
                                        @endauth
                                        <span class="text-warning"><i class="fas fa-star text-warning"></i>
                                            {{ $currMovie->rating }}</span>
                                    </p>
                                </div>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </section>
        <script>
            const reivewContainer = document.querySelector('#review-container');
            const addButton = document.querySelector('.add-review-btn');
            if (addButton) {
                addButton.addEventListener('click', (e) => {
                    e.preventDefault();
                    addButton.style.display = "none";
                    reivewContainer.classList.remove('justify-content-center');
                    reivewContainer.innerHTML += `
                    <form action="{{ route('store-review', $movie->show_id) }}" method="POST" class="mb-4 w-75">
                    @csrf
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating (1 To 10)</label>
                        <input type="number" class="form-control @error('rating')is-invalid @enderror" name="rating"
                            value="{{ old('rating') ?? '' }}" min="1" max="10">
                        @error('rating')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description"
                            class="form-label @error('description')is-invalid @enderror">Body</label>
                        <textarea class="form-control" name="description"
                            rows="3">{{ old('description') ?? '' }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary form-control">Submit</button>
                </form>
                    `;
                })
            }

            const addMovies = $('.addBtn');
            addMovies.each(function() {
                $(this).on('click', function() {
                    var movie_id = $(this).val();
                    console.log(movie_id);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    if ($(this).hasClass('added')) {
                        $.ajax({
                            url: "/api/addWatchlist/" + movie_id,
                            type: "DELETE",
                            contentType: false,
                            processData: false,
                            success: (data) => {
                                $(this).html('<i class="fas fa-plus text-muted"></i>');
                                $(this).removeClass('added');
                                $.notify("Removed from watchlist", "warn");
                            },
                            error: (data) => {
                                console.log(data.responseJSON);
                            },
                        });
                    } else {
                        $.ajax({
                            url: "/api/addWatchlist/" + movie_id,
                            type: "POST",
                            contentType: false,
                            processData: false,
                            success: (data) => {
                                $(this).html('<i class="fas fa-check text-danger"></i>');
                                $(this).addClass('added');
                                $.notify("Added to watchlist", "success");
                            },
                            error: (data) => {
                                console.log(data.responseJSON);
                            },
                        });
                    }
                })
            });

            const topButton = document.querySelector('.top-addbtn');
            if (topButton) {
                topButton.addEventListener('click', () => {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "/api/addWatchlist/{{ $movie->show_id }}",
                        type: "POST",
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            topButton.remove();
                            $.notify("Added to watchlist", "success");
                        },
                        error: (data) => {
                            console.log(data.responseJSON);
                        },
                    });
                });
            }
        </script>
    @endsection
