@extends('layouts.app')

@section('title', 'Add a band — Vibraze')

@section('content')
    <section class="page-shell page-section page-section--narrow">
        @include('partials.flash')
        <div class="page-heading">
            <div><span class="eyebrow">Catalog management</span><h1>Add a band.</h1><p>Create a complete, useful entry for the Vibraze catalog.</p></div>
            <a class="button button--quiet" href="{{ route('bands.list') }}">Back to catalog</a>
        </div>

        <form class="form-card" method="POST" action="{{ route('bands.store') }}">
            @csrf
            <div class="form-section">
                <div class="form-section__heading"><span>01</span><div><h2>Core details</h2><p>The information people use to identify this band.</p></div></div>
                <div class="form-grid">
                    <div class="field field--wide"><label for="name">Band name</label><input id="name" name="name" type="text" value="{{ old('name') }}" required>@error('name')<span class="field-error">{{ $message }}</span>@enderror</div>
                    <div class="field"><label for="genre_id">Genre</label><select id="genre_id" name="genre_id" required><option value="" disabled {{ old('genre_id') ? '' : 'selected' }}>Select a genre</option>@foreach ($genres as $genre)<option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>@endforeach</select>@error('genre_id')<span class="field-error">{{ $message }}</span>@enderror</div>
                    <div class="field"><label for="formation_year">Formation year</label><input id="formation_year" name="formation_year" type="number" min="1900" max="{{ date('Y') }}" value="{{ old('formation_year') }}" required>@error('formation_year')<span class="field-error">{{ $message }}</span>@enderror</div>
                    <div class="field field--wide"><label for="description">Description</label><textarea id="description" name="description" rows="6" required>{{ old('description') }}</textarea><span class="field-hint">A concise overview of the band's sound and history.</span>@error('description')<span class="field-error">{{ $message }}</span>@enderror</div>
                    <div class="field field--wide"><label for="best_selled_album">Best-selling album <span>Optional</span></label><input id="best_selled_album" name="best_selled_album" type="text" value="{{ old('best_selled_album') }}">@error('best_selled_album')<span class="field-error">{{ $message }}</span>@enderror</div>
                </div>
            </div>

            <div class="form-section">
                <div class="form-section__heading"><span>02</span><div><h2>Lineup</h2><p>Add the relevant members. Leave roles blank when they do not apply.</p></div></div>
                <div class="form-grid form-grid--three">
                    @foreach (['singer' => 'Lead singer', 'backing_vocals' => 'Backing vocals', 'lead_guitarist' => 'Lead guitarist', 'rythm_guitarist' => 'Rhythm guitarist', 'bassist' => 'Bassist', 'drummer' => 'Drummer', 'percussionist' => 'Percussionist', 'keyboardist' => 'Keyboardist', 'dj' => 'DJ'] as $field => $label)
                        <div class="field"><label for="{{ $field }}">{{ $label }}</label><input id="{{ $field }}" name="{{ $field }}" type="text" value="{{ old($field) }}">@error($field)<span class="field-error">{{ $message }}</span>@enderror</div>
                    @endforeach
                </div>
            </div>
            <div class="form-actions"><button class="button button--primary" type="submit">Add band</button><a class="button button--quiet" href="{{ route('bands.list') }}">Cancel</a></div>
        </form>
    </section>
@endsection
