<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1F1F1F">
    <div class="container">
        <a class="navbar-brand logo fs-3" href="" style="">
            Netplix
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-light" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" aria-current="page" href="#">Movies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" aria-current="page" href="#">My Watchlist</a>
                </li>
                @guest
                    <li class="nav-item px-lg-3">
                        <a class="btn btn-primary" role="button" href="">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-primary" role="button" href="">Login</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
