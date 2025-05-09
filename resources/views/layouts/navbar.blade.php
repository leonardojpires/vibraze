    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <header>
        <nav
            class="d-flex flex-column justify-content-center align-items-center gap-3 navbar navbar-expand-lg navbar-light flex-column ms-auto ">
            <div class="text-center mt-3 mb-3">
                <a class="mb-3 fs-2" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo/vibraze_logo_letters_only.png') }}" alt="Vibraze"
                        class="navbar-brand img-fluid w-50 zoom-hover">
                </a>
            </div>

            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse d-lg-flex flex-lg-column align-items-center justify-content-between" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto d-flex justify-content-center align-items-center text-center w-100">
                <li class="nav-item active">
                    <a class="nav-link text-white underline-hover" href="{{ route('bands.list') }}">Bands</a>
                </li>

                @if (Auth::user())
                    <li class="nav-item">
                        <a class="nav-link text-white underline-hover" href="{{ route('favorites.list') }}">Favorites</a>
                    </li>
                @endif

                @if (Auth::user() && Auth::user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link text-white underline-hover" href="{{ route('bands.add') }}">Add Bands</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white underline-hover" href="{{ route('genres.add') }}">Add Genres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white underline-hover" href="{{ route('users.list') }}">All Users</a>
                    </li>
                @endif
                <li>
                    <button id="darkModeToggle" class="btn btn-outline-secondary">
                        <span id="darkModeIcon" class="material-icons">light_mode</span>
                    </button>
                </li>
            </ul>

            <div class="d-flex flex-column align-items-center justify-content-center gap-2 mb-3 mt-3">
                @if (Auth::user())
                    <a href="{{ route('users.show', Auth::user()->id) }}" class="mb-2">
                        <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('images/profile/user_profile.png') }}" alt="User Profile" class="profile-icon shadow">
                    </a>
                @endif

                @if (Route::has('login.store'))
                    @auth
                        <form class="d-flex mt-auto mb-5" role="logout" method="POST" action="{{ route('users.logout') }}">
                            @csrf
                            <button class="btn btn-outline-danger" type="submit">Log Out</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-success">Log in</a>
                        @if (Route::has('users.add'))
                            <a href="{{ route('users.add') }}" class="btn btn-outline-success">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
        </nav>
    </header>
    <script src="{{ asset('js/darkmode.js') }}"></script>
