@foreach ($watchlists as $watchlist)
    <div class="watchlist-card cust-row">
        <a href="{{ route('show-movie', $watchlist->show_id) }}" class="watchlist-card__poster row-item"
            style="background-image : url('{{ $watchlist->image_url }}');background-size: contain;background-repeat: no-repeat;background-position: left;min-height: 150px;">
        </a>
        <h4 class="watchlist-card__title row-item">{{ $watchlist->title }}</h4>

        <h4
            class="watchlist-card__status row-item {{ ucfirst($watchlist->status) == 'Finished' ? 'textRed' : (ucfirst($watchlist->status) == 'Planning' ? 'textGreen' : 'textBlue') }}">
            {{ ucfirst($watchlist->status) }}</h4>
        <div class=" 
                            rating row-item ">
            <i class="fa fa-star"></i>
            {{ $watchlist->ownRating }}
        </div>
        <div class="rating row-item">
            <i class="fa fa-star"></i>
            {{ $watchlist->rating }}
        </div>
        <div class="actions row-item">
            <button type="button" class="btn btn-primary status-btn" data-bs-toggle="modal"
                data-bs-target="#{{ $watchlist->show_id }}">
                &#8943;
            </button>

            <div class="modal fade" id="{{ $watchlist->show_id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('action-watchlist', [$watchlist->show_id, request()->page ?? 1]) }}"
                            method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="cbo-wrapper">
                                    <select name="status" class="status-cbo">
                                        <option value="planning">Planned</option>
                                        <option value="watching">Watching</option>
                                        <option value="finished" selected>Finished</option>
                                        <option value="remove">Remove</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary save-btn">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
