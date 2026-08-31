@extends('layouts.app')

@section('title', 'Vibraze — Browse and save bands')

@section('content')
    @if (session('error') || session('success'))
        <div class="page-shell landing-notice">@include('partials.flash')</div>
    @endif
    <section class="hero">
        <div class="page-shell hero-grid">
            <div class="hero-copy">
                <span class="eyebrow">Your music catalog</span>
                <h1>Keep track of the bands you love.</h1>
                <p class="hero-lead">Search the catalog, filter by genre, and save the bands you want to hear again.</p>
                <div class="hero-actions">
                    <a class="button button--primary button--large" href="{{ route('bands.list') }}">Browse bands</a>
                    @guest
                        <a class="button button--secondary button--large" href="{{ route('users.add') }}">Create an account</a>
                    @else
                        <a class="button button--secondary button--large" href="{{ route('favorites.list') }}">My favorites</a>
                    @endguest
                </div>
                <div class="hero-proof" aria-label="Vibraze highlights">
                    <div><strong>Browse</strong><span>Search by name or genre</span></div>
                    <div><strong>Save</strong><span>Keep your favorites together</span></div>
                    <div><strong>Learn</strong><span>Read about each band</span></div>
                </div>
            </div>
        </div>
    </section>

    <section class="section page-shell" aria-labelledby="how-it-works">
        <div class="section-heading">
            <div>
                <span class="eyebrow">How it works</span>
                <h2 id="how-it-works">A simple place for your favorite bands.</h2>
            </div>
            <p>Look up a band, read the details, and save it for later. That’s all there is to it.</p>
        </div>

        <div class="feature-grid">
            <article class="feature-card">
                <span class="feature-number">01</span>
                <h3>Find a band</h3>
                <p>Search by name or use a genre filter to narrow down the list.</p>
                <a class="text-link" href="{{ route('bands.list') }}">Open the catalog <span aria-hidden="true">→</span></a>
            </article>
            <article class="feature-card">
                <span class="feature-number">02</span>
                <h3>Save it</h3>
                <p>Add any band to your favorites and come back to it whenever you like.</p>
                @auth
                    <a class="text-link" href="{{ route('favorites.list') }}">Open your favorites <span aria-hidden="true">→</span></a>
                @else
                    <a class="text-link" href="{{ route('login') }}">Sign in to start <span aria-hidden="true">→</span></a>
                @endauth
            </article>
            <article class="feature-card">
                <span class="feature-number">03</span>
                <h3>See the pattern</h3>
                <p>Your profile shows which genre appears most often in your saved bands.</p>
                @auth
                    <a class="text-link" href="{{ route('users.show', auth()->id()) }}">View your profile <span aria-hidden="true">→</span></a>
                @else
                    <a class="text-link" href="{{ route('users.add') }}">Create an account <span aria-hidden="true">→</span></a>
                @endauth
            </article>
        </div>
    </section>

    <section class="section section--compact page-shell">
        <div class="editorial-panel">
            <div>
                <span class="eyebrow eyebrow--light">Keep it simple</span>
                <h2>Your shortlist.<br>Nothing else.</h2>
            </div>
            <div>
                <p>No feeds or recommendations to manage. Just a clean list of bands and the ones you decided to save.</p>
                <a class="button button--light" href="{{ route('bands.list') }}">Browse bands</a>
            </div>
        </div>
    </section>
@endsection
