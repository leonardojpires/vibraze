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
                        <option value="" disabled>Seleciona um utilizador</option>
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

                <div class="mb-3">
                    <label for="image_url" class="form-label">Image URL</label>
                    <input type="text" name="image_url" class="form-control" id="image_url">
                </div>

                <button type="submit" class="btn btn-success">Submit</button>

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
