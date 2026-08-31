@extends('layouts.app')

@section('title', 'Discover bands — Vibraze')

@section('content')
    <section class="page-shell page-section">
        @include('partials.flash')

        <div class="page-heading">
            <div>
                <span class="eyebrow">Band catalog</span>
                <h1>Find a band.</h1>
                <p>Search by name or filter the list by genre.</p>
            </div>
            @if (auth()->check() && $user->role === 'admin')
                <a class="button button--secondary" href="{{ route('bands.add') }}">Add a band</a>
            @endif
        </div>

        @guest
            <div class="inline-prompt">Sign in to save bands. <a href="{{ route('login') }}">Log in</a></div>
        @endguest

        <div class="catalog-tools">
            <form class="search-form" action="{{ route('bands.list') }}" method="GET" role="search">
                @foreach ((array) request('genres', []) as $genreId)
                    <input type="hidden" name="genres[]" value="{{ $genreId }}">
                @endforeach
                <svg aria-hidden="true" viewBox="0 0 24 24" width="20" height="20"><circle cx="11" cy="11" r="6.5" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="m16 16 4 4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                <label class="sr-only" for="band-search">Search bands</label>
                <input id="band-search" type="search" name="search" value="{{ request('search') }}" placeholder="Search by band name">
                <button class="button button--primary" type="submit">Search</button>
                @if (request('search') || request('genres'))
                    <a class="button button--quiet" href="{{ route('bands.list') }}">Clear</a>
                @endif
            </form>

            @if ($genres->isNotEmpty())
                <form class="filter-form" action="{{ route('bands.list') }}" method="GET">
                    @if (request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <span class="filter-label">Filter by genre</span>
                    <div class="filter-list">
                        @foreach ($genres as $genre)
                            <label class="filter-chip">
                                <input type="checkbox" name="genres[]" value="{{ $genre->id }}" {{ in_array($genre->id, (array) request('genres', [])) ? 'checked' : '' }} onchange="this.form.submit()">
                                <span>{{ $genre->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </form>
            @endif
        </div>

        <div class="results-meta">
            <p><strong>{{ $bands->total() }}</strong> {{ Str::plural('band', $bands->total()) }} found</p>
            @auth
                <span>Welcome back, {{ Str::before($user->name, ' ') }}.</span>
            @endauth
        </div>

        @if ($bands->count())
            <div class="band-grid">
                @foreach ($bands as $band)
                    @php
                        $bandInitials = collect(preg_split('/\s+/', trim($band->name)))
                            ->filter()->take(2)->map(fn ($part) => strtoupper(substr($part, 0, 1)))->implode('');
                    @endphp
                    <article class="band-card">
                        <a class="band-card__identity" href="{{ route('bands.show', $band->id) }}" aria-label="View {{ $band->name }}">
                            <span class="band-monogram">{{ $bandInitials ?: 'B' }}</span>
                            <span class="band-card__meta">
                                <span>{{ $band->genre->name ?? 'Uncategorized' }}</span>
                                <span>{{ $band->formation_year ?: 'Year unknown' }}</span>
                            </span>
                        </a>
                        <div class="band-card__body">
                            <div>
                                <h2><a href="{{ route('bands.show', $band->id) }}">{{ $band->name }}</a></h2>
                                <p>{{ Str::limit($band->description, 105) }}</p>
                            </div>
                            <div class="band-card__actions">
                                <a class="text-link" href="{{ route('bands.show', $band->id) }}">View details <span aria-hidden="true">→</span></a>
                                <div class="card-controls">
                                    @auth
                                        @if ($band->isFavoritedBy($user))
                                            <form method="POST" action="{{ route('favorites.remove', $band->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="icon-button is-favorite" type="submit" aria-label="Remove {{ $band->name }} from favorites" title="Remove from favorites">
                                                    <svg aria-hidden="true" viewBox="0 0 24 24" width="19" height="19"><path d="M20.8 5.8a5.5 5.5 0 0 0-7.8 0L12 6.9l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8L12 22l8.8-8.4a5.5 5.5 0 0 0 0-7.8Z" fill="currentColor"/></svg>
                                                </button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('favorites.add', $band->id) }}">
                                                @csrf
                                                <button class="icon-button" type="submit" aria-label="Add {{ $band->name }} to favorites" title="Add to favorites">
                                                    <svg aria-hidden="true" viewBox="0 0 24 24" width="19" height="19"><path d="M20.8 5.8a5.5 5.5 0 0 0-7.8 0L12 6.9l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8L12 22l8.8-8.4a5.5 5.5 0 0 0 0-7.8Z" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>
                                                </button>
                                            </form>
                                        @endif
                                        @if ($user->role === 'admin')
                                            <button class="icon-button icon-button--danger" type="button" data-dialog-open="delete-band-dialog" data-action="{{ route('bands.remove', $band->id) }}" aria-label="Delete {{ $band->name }}" title="Delete band">
                                                <svg aria-hidden="true" viewBox="0 0 24 24" width="19" height="19"><path d="M4 7h16M9 7V4h6v3M7 7l1 13h8l1-13M10 11v5M14 11v5" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            </button>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="pagination-wrap">
                {{ $bands->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="empty-state">
                <span class="empty-state__mark">—</span>
                <h2>No bands matched your search.</h2>
                <p>Try a different name, remove a genre filter, or return to the full catalog.</p>
                <a class="button button--secondary" href="{{ route('bands.list') }}">Reset filters</a>
            </div>
        @endif
    </section>

    @if (auth()->check() && $user->role === 'admin')
        <dialog class="dialog" id="delete-band-dialog">
            <div class="dialog__content">
                <span class="eyebrow">Confirm deletion</span>
                <h2>Delete this band?</h2>
                <p>This will remove the band from the catalog and cannot be undone.</p>
                <div class="dialog__actions">
                    <button class="button button--quiet" type="button" data-dialog-close>Cancel</button>
                    <form method="POST" data-dialog-form>
                        @csrf
                        @method('DELETE')
                        <button class="button button--danger" type="submit">Delete band</button>
                    </form>
                </div>
            </div>
        </dialog>
    @endif
@endsection
