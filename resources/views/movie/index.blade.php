@extends('layouts.app',['title' => 'Home'])
@section('library')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <script src="{{ asset('js/index.js') }}" defer></script>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/lightslider.css') }}" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{ asset('js/lightslider.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"
        integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('content')
    <section class="main-header">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                @foreach ($randomMovies as $randMovie)
                    <div class="carousel-item carousel-header{{ $randomMovies->first() == $randMovie ? ' active' : '' }}">
                        <img src="{{ $randMovie->bg_url }}" class="d-block w-100 header-image" alt="...">
                        <div class="carousel-caption d-none d-md-block fw-bolder">
                            <div class="container px-3 carousel-content text-light d-flex flex-column align-items-start">
                                <p class="carousel-sub"><i class="fas fa-star text-warning"></i> {{ $randMovie->rating }}
                                    |
                                    {{ $randMovie->category->name }} | {{ $randMovie->release_date->format('Y') }}</p>
                                <h1 class="carousel-title fw-bolder">{{ $randMovie->title }}</h1>
                                <p class="carousel-text">{{ Str::limit($randMovie->description, 200) }}</p>
                                @auth
                                    @can('addWatchList', $randMovie)
                                        <button class="btn btn-danger btn-add-watchlist" value="{{ $randMovie->show_id }}"><i
                                                class="fas fa-plus"></i> Add
                                            To
                                            Watchlists</button>
                                    @else
                                        <button class="btn btn-success btn-add-watchlist added"
                                            value="{{ $randMovie->show_id }}"><i class="fas fa-check"></i> Already
                                            in Watchlist</button>
                                    @endcan
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="main-body">
        <div class="container-fluid py-3">
            <div class="ps-3 text-light">
                <i class="fas fa-fire fs-3"></i>
                <span class="fs-3 ms-3 fw-bold">Trending</span>
            </div>
            <hr class="dropdown-divider mb-3 text-light">
        </div>
        <ul class="movie-carousel card-group list-unstyled cs-hidden text-light" id="autoWidth">
            @foreach ($trendingMovies as $trendMovie)
                <li class="card">
                    <a href="{{ route('show-movie', $trendMovie->show_id) }}"><img src="{{ $trendMovie->image_url }}"
                            class="card-img-top" alt="..."></a>
                    <div class="card-body">
                        <h5 class="card-title">{{ Str::limit($trendMovie->title, 19) }}</h5>
                        <div class="d-flex justify-content-between">
                            <p class="text-muted">{{ $trendMovie->release_date->format('Y') }}</p>
                            <p class="card-info"> <span class="text-warning"><i class="fas fa-star text-warning"></i>
                                    {{ $trendMovie->rating }}</span></p>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="container-fluid p-3 text-light">
            <div class="row movie-title mb-3">
                <div class="col d-flex flex-row justify-content-between">
                    <div class="ps-3">
                        <i class="fas fa-film fs-3"></i>
                        <span class="fs-3 ms-3 fw-bold">Movies</span>
                    </div>
                    <input type="text" class="search-movie p-3" id="search-input"
                        style="background: transparent; outline: none;color : #fff;border: none; background-color: #2D2D2D; width: 20vw; border-radius: 18px;"
                        placeholder="Search movie...">
                </div>
            </div>
            <hr class="dropdown-divider">
            <div class="movie-genre w-100 position-relative px-2 mt-5">
                <ul class="movie-genre-carousel d-flex list-unstyled text-light cs-hidden text-light" id="autoWidth2">
                    @foreach ($genres as $genre)
                        <li><button class="btn genre btn-genre w-100" role="button">{{ $genre->name }}</button></li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-5 row movie-sort">
                <div class="col d-flex align-items-center">
                    <span>Sort By:</span>
                    <button class="btn sort btn-sort">Latest</button>
                    <button class="btn sort btn-sort">A-Z</button>
                    <button class="btn sort btn-sort">Z-A</button>
                    <button class="btn sort btn-sort">Rating</button>
                </div>
            </div>
            <div class="container-fluid movie-body" id="movie-section">
                <div class="row mt-5 mb-5 gy-3 movie-content d-flex justify-content-center" id='movie-section-container'>
                    @include('movie.data')
                </div>
            </div>
            <div class="ajax-load auto-load text-center" style="display: none">
                <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                    <path fill="#000"
                        d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                        <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                            from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                    </path>
                </svg>
            </div>
            <script type="text/javascript">
                const genreButtons = document.querySelectorAll('.btn-genre');
                let activeButton = false;
                let activeButtonIndex = -1;

                const sortButtons = document.querySelectorAll('.btn-sort');
                let activeButtonSort = false;
                let activeButtonSortIndex = -1;

                var page = 1;
                $(window).scroll(function() {
                    if ($(window).scrollTop() + $(window).height() + 1 >= $(document).height() &&
                        {{ $pages }} > page && activeButton == false && activeButtonSort == false) {
                        page++;
                        loadMoreData(page);
                    }
                });

                function loadMoreData(page) {
                    $.ajax({
                            url: '?page=' + page,
                            type: "get",
                            beforeSend: function() {
                                $('.ajax-load').show();
                            }
                        })
                        .done(function(data) {
                            if (data.html == " ") {
                                $('.ajax-load').html("No more records found");
                                return;
                            }
                            $('.ajax-load').hide();
                            $("#movie-section-container").append(data.html);
                            loadAddMovieButton();
                        })
                        .fail(function(jqXHR, ajaxOptions, thrownError) {
                            alert('server not responding...');
                        });
                }

                genreButtons.forEach((button, index) => {
                    button.addEventListener('click', (e) => {
                        e.preventDefault();
                        if (button.classList.contains('active-genre')) {
                            button.classList.remove('active-genre');
                            if (activeButton && !activeButtonSort && $('#search-input').val() ==
                                '') { // teken matiin reset semua
                                $("#movie-section-container").empty();
                                page = 1;
                                loadMoreData(page);
                            } else if (activeButton && activeButtonSort) {
                                $("#movie-section-container").empty();
                                loadSort(sortButtons[activeButtonSortIndex].textContent);
                            }
                            activeButton = false;
                        } else {
                            if (activeButton) { // teken dan tombol lain juga nyala
                                genreButtons[activeButtonIndex].classList.remove('active-genre');
                            }
                            button.classList.add('active-genre');
                            loadGenre(button.textContent);
                            activeButton = true;
                            activeButtonIndex = index;
                        }
                    })
                });

                function loadGenre(genreParam) {
                    if (!activeButtonSort) {
                        $.ajax({
                                url: '?genre=' + genreParam + '&search=' + $('#search-input').val(),
                                type: "get",
                            })
                            .done(function(data) {
                                $("#movie-section-container").empty();
                                $("#movie-section-container").append(data.html);
                                loadAddMovieButton();
                            })
                            .fail(function(jqXHR, ajaxOptions, thrownError) {
                                console.log(jqXHR.responseJSON);
                                alert('server not responding...');
                            });
                    } else {
                        $.ajax({
                                url: '?genre=' + genreParam + '&sort=' +
                                    sortButtons[activeButtonSortIndex].textContent + '&search=' + $('#search-input').val(),
                                type: "get",
                            })
                            .done(function(data) {
                                $("#movie-section-container").empty();
                                $("#movie-section-container").append(data.html);
                                loadAddMovieButton();
                            })
                            .fail(function(jqXHR, ajaxOptions, thrownError) {
                                console.log(jqXHR.responseJSON);
                                alert('server not responding...');
                            });
                    }
                }

                function loadSort(sortParam) {
                    if (!activeButton) {
                        $.ajax({
                                url: '?sort=' + sortParam + '&search=' + $('#search-input').val(),
                                type: "get",
                            })
                            .done(function(data) {
                                $("#movie-section-container").empty();
                                $("#movie-section-container").append(data.html);
                                loadAddMovieButton();
                            })
                            .fail(function(jqXHR, ajaxOptions, thrownError) {
                                console.log(jqXHR.responseJSON);
                                alert('server not responding...');
                            });
                    } else {
                        $.ajax({
                                url: '?sort=' + sortParam + '&genre=' + genreButtons[activeButtonIndex].textContent +
                                    '&search=' + $('#search-input').val(),
                                type: "get",
                            })
                            .done(function(data) {
                                $("#movie-section-container").empty();
                                $("#movie-section-container").append(data.html);
                                loadAddMovieButton();
                            })
                            .fail(function(jqXHR, ajaxOptions, thrownError) {
                                console.log(jqXHR.responseJSON);
                                alert('server not responding...');
                            });
                    }
                }

                sortButtons.forEach((sortButton, index) => {
                    sortButton.addEventListener('click', (e) => {
                        e.preventDefault();
                        if (sortButton.classList.contains('active-sort')) {
                            sortButton.classList.remove('active-sort');
                            if (activeButtonSort && !activeButton && $('#search-input').val() ==
                                '') { // teken matiin reset semua
                                $("#movie-section-container").empty();
                                page = 1;
                                loadMoreData(page);
                            } else if (activeButtonSort && activeButton) {
                                $("#movie-section-container").empty();
                                loadGenre(genreButtons[activeButtonIndex].textContent)
                            }
                            activeButtonSort = false;
                        } else {
                            if (activeButtonSort) { // teken dan tombol lain juga nyala
                                sortButtons[activeButtonSortIndex].classList.remove('active-sort');
                            }
                            sortButton.classList.add('active-sort');
                            loadSort(sortButton.textContent);
                            activeButtonSort = true;
                            activeButtonSortIndex = index;
                        }
                    })
                });

                function loadAddMovieButton() {
                    const addMovies = $('.addBtn');
                    addMovies.each(function() {
                        $(this).off('click')
                        $(this).on('click', function() {
                            var movie_id = $(this).val();
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
                                        console.log(data);
                                    },
                                    error: (data) => {
                                        console.log(data.responseJSON);
                                    },
                                });
                            }
                        })
                    });
                }

                loadAddMovieButton();

                const randMovies = $('.btn-add-watchlist');
                randMovies.each(function() {
                    $(this).on('click', function() {
                        var movie_id = $(this).val();
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
                                    $(this).html(`<i class="fas fa-plus"></i> Add To Watchlists`);
                                    $(this).removeClass('added');
                                    $(this).removeClass('btn-success');
                                    $(this).addClass('btn-danger');
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
                                    $(this).html(`<i class="fas fa-check"></i> Already in Watchlist`);
                                    $(this).addClass('added');
                                    $(this).removeClass('btn-danger');
                                    $(this).addClass('btn-success');
                                    $.notify("Added to watchlist", "success");
                                },
                                error: (data) => {
                                    console.log(data.responseJSON);
                                },
                            });
                        }
                    })
                });

                $('#search-input').keyup(function() {
                    var search = $(this).val();
                    if (!activeButton && !activeButtonSort) {
                        $.ajax({
                                url: '?search=' + search,
                                type: "get",
                            })
                            .done(function(data) {
                                $("#movie-section-container").empty();
                                $("#movie-section-container").append(data.html);
                                loadAddMovieButton();
                            })
                            .fail(function(jqXHR, ajaxOptions, thrownError) {
                                console.log(jqXHR.responseJSON);
                                alert('server not responding...');
                            });
                    } else if (activeButton && !activeButtonSort) {
                        $.ajax({
                                url: '?search=' + search + '&genre=' + genreButtons[activeButtonIndex].textContent,
                                type: "get",
                            })
                            .done(function(data) {
                                $("#movie-section-container").empty();
                                $("#movie-section-container").append(data.html);
                                loadAddMovieButton();
                            })
                            .fail(function(jqXHR, ajaxOptions, thrownError) {
                                console.log(jqXHR.responseJSON);
                                alert('server not responding...');
                            });
                    } else if (!activeButton && activeButtonSort) {
                        $.ajax({
                                url: '?search=' + search + '&sort=' +
                                    sortButtons[activeButtonSortIndex].textContent,
                                type: "get",
                            })
                            .done(function(data) {
                                $("#movie-section-container").empty();
                                $("#movie-section-container").append(data.html);
                                loadAddMovieButton();
                            })
                            .fail(function(jqXHR, ajaxOptions, thrownError) {
                                console.log(jqXHR.responseJSON);
                                alert('server not responding...');
                            });
                    } else if (activeButton && activeButtonSort) {
                        $.ajax({
                                url: '?search=' + search + '&sort=' +
                                    sortButtons[activeButtonSortIndex].textContent + '&genre=' + genreButtons[
                                        activeButtonIndex].textContent,
                                type: "get",
                            })
                            .done(function(data) {
                                $("#movie-section-container").empty();
                                $("#movie-section-container").append(data.html);
                                loadAddMovieButton();
                            })
                            .fail(function(jqXHR, ajaxOptions, thrownError) {
                                console.log(jqXHR.responseJSON);
                                alert('server not responding...');
                            });
                    }
                });
            </script>
        </div>
    </section>

@endsection
