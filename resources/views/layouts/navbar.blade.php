<header class="site-header">
    <div class="page-shell nav-wrap">
        <a class="brand" href="{{ route('home') }}" aria-label="Vibraze home">
            <img class="brand-logo" src="{{ asset('images/logo/vibraze_logo.png') }}" alt="Vibraze">
        </a>

        <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-navigation">
            <span class="sr-only">Toggle navigation</span>
            <svg aria-hidden="true" viewBox="0 0 24 24" width="22" height="22">
                <path d="M4 7h16M4 12h16M4 17h16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            </svg>
        </button>

        <div class="nav-panel" id="primary-navigation">
            <nav class="primary-nav" aria-label="Primary navigation">
                <a class="nav-link {{ request()->routeIs('home') ? 'is-active' : '' }}" href="{{ route('home') }}">Home</a>
                <a class="nav-link {{ request()->routeIs('bands.*') && !request()->routeIs('bands.add') ? 'is-active' : '' }}" href="{{ route('bands.list') }}">Discover</a>
                @auth
                    <a class="nav-link {{ request()->routeIs('favorites.*') ? 'is-active' : '' }}" href="{{ route('favorites.list') }}">Favorites</a>
                @endauth
                @if (auth()->check() && auth()->user()->role === 'admin')
                    <a class="nav-link {{ request()->routeIs('bands.add') || request()->routeIs('genres.*') || request()->routeIs('users.list') ? 'is-active' : '' }}" href="{{ route('bands.add') }}">Manage</a>
                @endif
            </nav>

            <div class="nav-actions">
                <button class="icon-button theme-toggle" type="button" aria-label="Switch color theme">
                    <svg class="theme-icon theme-icon--light" aria-hidden="true" viewBox="0 0 24 24" width="19" height="19">
                        <circle cx="12" cy="12" r="3.5" fill="none" stroke="currentColor" stroke-width="1.7"/>
                        <path d="M12 2v2M12 20v2M4.93 4.93l1.42 1.42M17.65 17.65l1.42 1.42M2 12h2M20 12h2M4.93 19.07l1.42-1.42M17.65 6.35l1.42-1.42" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                    </svg>
                    <svg class="theme-icon theme-icon--dark" aria-hidden="true" viewBox="0 0 24 24" width="19" height="19">
                        <path d="M20 15.2A8.4 8.4 0 0 1 8.8 4a8.5 8.5 0 1 0 11.2 11.2Z" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                    </svg>
                </button>

                @auth
                    @php
                        $navInitials = collect(preg_split('/\s+/', trim(auth()->user()->name)))
                            ->filter()->take(2)->map(fn ($part) => strtoupper(substr($part, 0, 1)))->implode('');
                    @endphp
                    <a class="profile-link" href="{{ route('users.show', auth()->id()) }}" aria-label="Open your profile">
                        <span class="avatar avatar--small">{{ $navInitials ?: 'U' }}</span>
                        <span class="profile-link__name">{{ auth()->user()->name }}</span>
                    </a>
                    <form method="POST" action="{{ route('users.logout') }}">
                        @csrf
                        <button class="button button--quiet button--small" type="submit">Log out</button>
                    </form>
                @else
                    <a class="button button--quiet button--small" href="{{ route('login') }}">Log in</a>
                    <a class="button button--primary button--small" href="{{ route('users.add') }}">Create account</a>
                @endauth
            </div>
        </div>
    </div>
</header>
