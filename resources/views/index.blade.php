@extends('layouts.app',['title' => 'Home'])
@section('library')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <script src="{{ asset('js/index.js') }}" defer></script>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/lightslider.css') }}" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{ asset('js/lightslider.js') }}"></script>

@endsection
@section('content')
    <section class="main-header">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div
                class="container px-5 carousel-content position-absolute text-light h-100 d-flex flex-column justify-content-center">
                <p class="carousel-sub"><i class="fas fa-star text-warning"></i> 8.1 | Thriller | 2020</p>
                <h1 class="carousel-title fw-bolder">Money Heist</h1>
                <p class="carousel-text">Eight thieves take hostages and lock themselves in the Royal Mint of Spain as a
                    criminal mastermind
                    manipulates the police to carry out his plan.</p>
                <button class="btn btn-danger btn-add-watchlist"><i class="fas fa-plus"></i> Add To Watchlists</button>
            </div>
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                    class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://picsum.photos/200/300?random=1" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://picsum.photos/200/300?random=2" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://picsum.photos/200/300?random=3" class="d-block w-100" alt="...">
                </div>
            </div>
        </div>
    </section>
    <section class="main-body">
        <ul class="movie-carousel card-group cs-hidden text-light" id="autoWidth">
            <li class="card">
                <img src=" https://picsum.photos/200/300?random=5" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Squid Game</h5>
                    <div class="d-flex justify-content-between">
                        <p class="text-muted">2021</p>
                        <p class="card-info"><i class="fas fa-plus text-muted"></i> <span class="text-warning"><i
                                    class="fas fa-star text-warning"></i> 8.5</span></p>
                    </div>
                </div>
            </li>
            <li class="card">
                <img src=" https://picsum.photos/200/300?random=10" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Money heist</h5>
                    <div class="d-flex justify-content-between">
                        <p class="text-muted">2021</p>
                        <p class="card-info"><i class="fas fa-check text-danger"></i> <span class="text-warning"><i
                                    class="fas fa-star text-warning"></i> 8.5</span></p>
                    </div>
                </div>

            </li>
            <li class="card">
                <img src=" https://picsum.photos/200/300?random=10" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Money heist</h5>
                    <div class="d-flex justify-content-between">
                        <p class="text-muted">2021</p>
                        <p class="card-info"><i class="fas fa-check text-danger"></i> <span class="text-warning"><i
                                    class="fas fa-star text-warning"></i> 8.5</span></p>
                    </div>
                </div>

            </li>
            <li class="card">
                <img src=" https://picsum.photos/200/300?random=10" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Money heist</h5>
                    <div class="d-flex justify-content-between">
                        <p class="text-muted">2021</p>
                        <p class="card-info"><i class="fas fa-check text-danger"></i> <span class="text-warning"><i
                                    class="fas fa-star text-warning"></i> 8.5</span></p>
                    </div>
                </div>

            </li>
            <li class="card">
                <img src=" https://picsum.photos/200/300?random=10" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Money heist</h5>
                    <div class="d-flex justify-content-between">
                        <p class="text-muted">2021</p>
                        <p class="card-info"><i class="fas fa-check text-danger"></i> <span class="text-warning"><i
                                    class="fas fa-star text-warning"></i> 8.5</span></p>
                    </div>
                </div>

            </li>
            <li class="card">
                <img src=" https://picsum.photos/200/300?random=10" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Money heist</h5>
                    <div class="d-flex justify-content-between">
                        <p class="text-muted">2021</p>
                        <p class="card-info"><i class="fas fa-check text-danger"></i> <span class="text-warning"><i
                                    class="fas fa-star text-warning"></i> 8.5</span></p>
                    </div>
                </div>

            </li>
        </ul>
    </section>
@endsection
