<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1F1F1F">
    <div class="container">
        <a class="navbar-brand logo fs-3" href="{{ route('show-home') }}">
            Netplix
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-light" aria-current="page" href="{{ route('show-home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" aria-current="page"
                        href="{{ request()->is('/') ? '' : '/' }}#movie-section">Movies</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link text-light" aria-current="page" href="{{ route('show-watchlist') }}">My
                            Watchlist</a>
                    </li>
                    <li class="nav-item dropdown fs-3 d-flex align-items-center mx-3">
                        @if (Auth::user()->image_url)
                            <span class="nav-link p-0 d-flex" href="#" id="navbarDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ Auth::user()->image_url }}" class="rounded-circle"
                                    style="width : 1.5rem;height : 1.5rem;object-fit: cover">
                            </span>
                        @else
                            <span class="nav-link p-0" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fas fa-user-circle"></i>
                            </span>

                        @endif
                        <ul class="dropdown-menu dropdown-menu-end p-3">
                            <li><a class="dropdown-item" href=" {{ route('show-profile') }} ">Profile</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endauth
                @guest
                    <li class="nav-item px-lg-3">
                        <a class="btn btn-primary" role="button" href="{{ route('show-register') }}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-primary" role="button" href="{{ route('show-login') }}">Login</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
