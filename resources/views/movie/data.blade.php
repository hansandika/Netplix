@foreach ($movies as $movie)
    <div class="col-xl-2 col-5 me-5">
        <a href="{{ route('show-movie', $movie->show_id) }}"><img src="{{ $movie->image_url }}"
                class="movie-image" alt="..."></a>
        <div class="movie-title fs-5 py-2">{{ Str::limit($movie->title, 19) }}</div>
        <div class="d-flex justify-content-between">
            <p class="text-muted">{{ $movie->release_date->format('Y') }}</p>
            <p class="card-info">
                @auth
                    @can('addWatchList', $movie)
                        <button class="btn p-0 addBtn" id="addWatchButton" value="{{ $movie->show_id }}">
                            <i class="fas fa-plus text-muted"></i>
                        </button>
                    @else
                        <button class="btn p-0 addBtn added" id="addWatchButton" value="{{ $movie->show_id }}">
                            <i class="fas fa-check text-danger"></i>
                        </button>
                    @endcan
                @endauth
                <span class="text-warning"><i class="fas fa-star text-warning"></i>
                    {{ $movie->rating }}</span>
            </p>
        </div>
    </div>
@endforeach
