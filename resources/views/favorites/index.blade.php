@extends('layouts.app')

@section('title', 'Your favorites — Vibraze')

@section('content')
    <section class="page-shell page-section">
        @include('partials.flash')

        <div class="page-heading">
            <div>
                <span class="eyebrow">Favorites</span>
                <h1>Your saved bands.</h1>
                <p>Everything you’ve saved, in one place.</p>
            </div>
            <a class="button button--secondary" href="{{ route('bands.list') }}">Discover more</a>
        </div>

        @if ($bands->count())
            <div class="results-meta"><p><strong>{{ $bands->total() }}</strong> saved {{ Str::plural('band', $bands->total()) }}</p></div>
            <div class="band-grid">
                @foreach ($bands as $band)
                    @php
                        $bandInitials = collect(preg_split('/\s+/', trim($band->name)))
                            ->filter()->take(2)->map(fn ($part) => strtoupper(substr($part, 0, 1)))->implode('');
                    @endphp
                    <article class="band-card band-card--favorite">
                        <a class="band-card__identity" href="{{ route('bands.show', $band->id) }}">
                            <span class="band-monogram">{{ $bandInitials ?: 'B' }}</span>
                            <span class="band-card__meta"><span>{{ $band->genre->name ?? 'Uncategorized' }}</span><span>{{ $band->formation_year ?: 'Year unknown' }}</span></span>
                        </a>
                        <div class="band-card__body">
                            <div><h2><a href="{{ route('bands.show', $band->id) }}">{{ $band->name }}</a></h2><p>{{ Str::limit($band->description, 105) }}</p></div>
                            <div class="band-card__actions">
                                <a class="text-link" href="{{ route('bands.show', $band->id) }}">View details <span aria-hidden="true">→</span></a>
                                <form method="POST" action="{{ route('favorites.remove', $band->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button button--quiet button--small" type="submit">Remove</button>
                                </form>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="pagination-wrap">{{ $bands->appends(request()->except('page'))->links('pagination::bootstrap-5') }}</div>
        @else
            <div class="empty-state">
                <span class="empty-state__mark">♡</span>
                <h2>No saved bands yet.</h2>
                <p>Browse the catalog and save one to see it here.</p>
                <a class="button button--primary" href="{{ route('bands.list') }}">Explore bands</a>
            </div>
        @endif
    </section>
@endsection
