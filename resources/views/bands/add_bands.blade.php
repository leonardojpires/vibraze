@extends('layouts.app')

@section('content')

    <div class="w-75">
        <div class="w-50">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @elseif (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <div>
            <div class="d-flex gap-3 align-items-center">
                <h1 class="mb-3">Add Bands</h1>
                <button id="darkModeToggle" class="btn btn-outline-secondary ms-3">
                    <span id="darkModeIcon" class="material-icons">
                        light_mode
                    </span>
                </button>
            </div>

            <form method="POST" action="{{ route('bands.store') }}" >
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="nome" aria-describedby="name" required>
                </div>

                <div class="mb-3">
                    <label for="genre_id" class="form-label">Genre</label>
                    <select name="genre_id" class="form-control" id="genre_id" required>
                        <option value="" disabled>Select the genre</option>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="formation_year" class="form-label">Formation Year</label>
                    <input type="number" name="formation_year" class="form-control" id="formation_year" required minlength="4" maxlength="4">
                </div>

                <div class="mb-3">
                  <label for="description" class="form-label">Description</label>
                  <textarea name="description" class="form-control" id="description" aria-describedby="description" required></textarea>
                </div>

                <div class="d-flex flex-wrap flex-row gap-3 w-100">
                    <div class="mb-3 w-25">
                        <label for="singer" class="form-label">Singer</label>
                        <input type="text" name="singer" class="form-control" id="singer" aria-describedby="singer" required>
                    </div>
                    <div class="mb-3 w-25">
                        <label for="backing_vocals" class="form-label">Backing Vocals</label>
                        <input type="text" name="backing_vocals" class="form-control" id="backing_vocals" aria-describedby="backing_vocals" required>
                    </div>
                    <div class="mb-3 w-25">
                        <label for="rythm_guitarist" class="form-label">Rythm Guitarist</label>
                        <input type="text" name="rythm_guitarist" class="form-control" id="rythm_guitarist" aria-describedby="rythm_guitarist" required>
                    </div>
                    <div class="mb-3 w-25">
                        <label for="lead_guitarist" class="form-label">Lead Guitarist</label>
                        <input type="text" name="lead_guitarist" class="form-control" id="lead_guitarist" aria-describedby="lead_guitarist" required>
                    </div>
                    <div class="mb-3 w-25">
                        <label for="bassist" class="form-label">Bassist</label>
                        <input type="text" name="bassist" class="form-control" id="bassist" aria-describedby="bassist" required>
                    </div>
                    <div class="mb-3 w-25">
                        <label for="drummer" class="form-label">Drummer</label>
                        <input type="text" name="drummer" class="form-control" id="drummer" aria-describedby="drummer" required>
                    </div>
                    <div class="mb-3 w-25">
                        <label for="percurssionist" class="form-label">Percussionist</label>
                        <input type="text" name="percurssionist" class="form-control" id="percurssionist" aria-describedby="percurssionist" required>
                    </div>
                    <div class="mb-3 w-25">
                        <label for="keyboardist" class="form-label">Keyboardist</label>
                        <input type="text" name="keyboardist" class="form-control" id="keyboardist" aria-describedby="keyboardist" required>
                    </div>
                    <div class="mb-3 w-25">
                        <label for="dj" class="form-label">DJ</label>
                        <input type="text" name="dj" class="form-control" id="dj" aria-describedby="dj" required>
                    </div>
                </div>

                <div class="mb-3 w-50">
                    <label for="best_selled_album" class="form-label">Best-Selled Album</label>
                    <input type="text" name="best_selled_album" class="form-control" id="best_selled_album" aria-describedby="best_selled_album" required>
                </div>

                <div class="mb-3">
                    <label for="image_url" class="form-label">Image URL</label>
                    <input type="text" name="image_url" class="form-control" id="image_url">
                </div>

                <button type="submit" class="btn btn-success mb-5">Submit</button>

            </form>

              <div class="text-danger">
                @error('name')
                    Invalid Name!
                @enderror
                @error('genre_id')
                    Invalid Genre!
                @enderror
                @error('formation_year')
                    Invalid Year!
                @enderror
                @error('description')
                    Invalid Description!
                @enderror
                @error('image_url')
                    Invalid Image!
                @enderror

        </div>
    </div>
    <script src="{{ asset('js/darkmode.js') }}"></script>

@endsection
