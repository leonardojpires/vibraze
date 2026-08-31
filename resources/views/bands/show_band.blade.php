@extends('layouts.app')

@section('title', $band->name . ' — Vibraze')

@section('content')
    @php
        $bandInitials = collect(preg_split('/\s+/', trim($band->name)))
            ->filter()->take(2)->map(fn ($part) => strtoupper(substr($part, 0, 1)))->implode('');
        $members = collect([
            'Lead singer' => $band->singer,
            'Backing vocals' => $band->backing_vocals,
            'Lead guitarist' => $band->lead_guitarist,
            'Rhythm guitarist' => $band->rythm_guitarist,
            'Bassist' => $band->bassist,
            'Drummer' => $band->drummer,
            'Keyboardist' => $band->keyboardist,
            'Percussionist' => $band->percussionist,
            'DJ' => $band->dj,
        ])->filter();
    @endphp

    <section class="page-shell page-section">
        @include('partials.flash')

        <a class="back-link" href="{{ route('bands.list') }}"><span aria-hidden="true">←</span> Back to catalog</a>

        <div class="band-profile">
            <div class="band-profile__mark"><span class="band-monogram band-monogram--large">{{ $bandInitials ?: 'B' }}</span></div>
            <div class="band-profile__intro">
                <span class="eyebrow">{{ $genreName }}</span>
                <h1>{{ $band->name }}</h1>
                <div class="band-profile__facts">
                    <span>Formed {{ $band->formation_year }}</span>
                    @if ($band->best_selled_album)<span>Known for <strong>{{ $band->best_selled_album }}</strong></span>@endif
                </div>
                <p>{{ $band->description }}</p>
                @auth
                    @if ($band->isFavoritedBy($user))
                        <form method="POST" action="{{ route('favorites.remove', $band->id) }}">@csrf @method('DELETE')<button class="button button--secondary" type="submit">Remove from favorites</button></form>
                    @else
                        <form method="POST" action="{{ route('favorites.add', $band->id) }}">@csrf <button class="button button--primary" type="submit">Add to favorites</button></form>
                    @endif
                @else
                    <a class="button button--secondary" href="{{ route('login') }}">Log in to save</a>
                @endauth
            </div>
        </div>

        @if ($members->isNotEmpty())
            <section class="detail-section" aria-labelledby="members-heading">
                <div class="detail-section__heading"><span class="eyebrow">The people</span><h2 id="members-heading">Band lineup</h2></div>
                <dl class="member-grid">
                    @foreach ($members as $role => $member)
                        <div><dt>{{ $role }}</dt><dd>{{ $member }}</dd></div>
                    @endforeach
                </dl>
            </section>
        @endif

        @if (auth()->check() && $user->role === 'admin')
            <section class="detail-section admin-editor" aria-labelledby="edit-band-heading">
                <div class="detail-section__heading"><span class="eyebrow">Administrator</span><h2 id="edit-band-heading">Edit catalog entry</h2><p>Changes are published as soon as you save them.</p></div>
                <form class="form-card" method="POST" action="{{ route('bands.update', ['bandId' => $band->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-grid">
                        <div class="field field--wide"><label for="name">Band name</label><input id="name" name="name" type="text" value="{{ old('name', $band->name) }}" required>@error('name')<span class="field-error">{{ $message }}</span>@enderror</div>
                        <div class="field"><label for="genre_id">Genre</label><select id="genre_id" name="genre_id" required>@foreach ($genres as $genre)<option value="{{ $genre->id }}" {{ old('genre_id', $band->genre_id) == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>@endforeach</select>@error('genre_id')<span class="field-error">{{ $message }}</span>@enderror</div>
                        <div class="field"><label for="formation_year">Formation year</label><input id="formation_year" name="formation_year" type="number" min="1900" max="{{ date('Y') }}" value="{{ old('formation_year', $band->formation_year) }}" required>@error('formation_year')<span class="field-error">{{ $message }}</span>@enderror</div>
                        <div class="field field--wide"><label for="description">Description</label><textarea id="description" name="description" rows="6" required>{{ old('description', $band->description) }}</textarea>@error('description')<span class="field-error">{{ $message }}</span>@enderror</div>
                        <div class="field field--wide"><label for="best_selled_album">Best-selling album</label><input id="best_selled_album" name="best_selled_album" type="text" value="{{ old('best_selled_album', $band->best_selled_album) }}"></div>
                    </div>
                    <div class="form-divider"><span>Lineup</span></div>
                    <div class="form-grid form-grid--three">
                        @foreach (['singer' => 'Lead singer', 'backing_vocals' => 'Backing vocals', 'lead_guitarist' => 'Lead guitarist', 'rythm_guitarist' => 'Rhythm guitarist', 'bassist' => 'Bassist', 'drummer' => 'Drummer', 'percussionist' => 'Percussionist', 'keyboardist' => 'Keyboardist', 'dj' => 'DJ'] as $field => $label)
                            <div class="field"><label for="{{ $field }}">{{ $label }}</label><input id="{{ $field }}" name="{{ $field }}" type="text" value="{{ old($field, $band->$field) }}">@error($field)<span class="field-error">{{ $message }}</span>@enderror</div>
                        @endforeach
                    </div>
                    <div class="form-actions"><button class="button button--primary" type="submit">Save changes</button><a class="button button--quiet" href="{{ route('bands.list') }}">Cancel</a></div>
                </form>
            </section>
        @endif
    </section>
@endsection
