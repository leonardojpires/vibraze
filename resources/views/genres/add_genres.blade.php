@extends('layouts.app')

@section('title', 'Manage genres — Vibraze')

@section('content')
    <section class="page-shell page-section page-section--narrow">
        @include('partials.flash')
        <div class="page-heading"><div><span class="eyebrow">Catalog management</span><h1>Genres.</h1><p>Keep the vocabulary of the catalog focused and useful.</p></div><a class="button button--quiet" href="{{ route('bands.add') }}">Add a band</a></div>

        <div class="management-grid">
            <form class="form-card form-card--compact" method="POST" action="{{ route('genres.store') }}">
                @csrf
                <div class="form-section__heading"><span>+</span><div><h2>Add genre</h2><p>Create a new filter for the catalog.</p></div></div>
                <div class="field"><label for="name">Genre name</label><input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="e.g. Alternative rock" required>@error('name')<span class="field-error">{{ $message }}</span>@enderror</div>
                <button class="button button--primary" type="submit">Add genre</button>
            </form>

            <div class="form-card form-card--compact">
                <div class="form-section__heading"><span>{{ $genres->count() }}</span><div><h2>Current genres</h2><p>Delete only genres with no associated bands.</p></div></div>
                @if ($genres->isNotEmpty())
                    <div class="genre-list">
                        @foreach ($genres as $genre)
                            <div class="genre-row"><span>{{ $genre->name }}</span><form action="{{ route('genres.remove', $genre->id) }}" method="POST">@csrf @method('DELETE')<button class="icon-button icon-button--danger" type="submit" aria-label="Delete {{ $genre->name }}"><svg aria-hidden="true" viewBox="0 0 24 24" width="18" height="18"><path d="M4 7h16M9 7V4h6v3M7 7l1 13h8l1-13" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></button></form></div>
                        @endforeach
                    </div>
                @else
                    <p class="muted">No genres have been added yet.</p>
                @endif
            </div>
        </div>
    </section>
@endsection
