@extends('layouts.app')

@section('content')

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

    {{-- USER --}}
    @if (auth()->check() && $user->role == 'user')
        <div class="container mb-3 darkmode-container">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="display-4">{{ $band->name }}</h1>
                    <p class="lead">{{ $genreName }}</p>
                    <p><strong>Formation Year:</strong> {{ $band->formation_year }}</p>
                    <p><strong>Description: </strong> {{ $band->description }}</p>

                    <h3>Members</h3>
                    <ul>
                        <li><strong>Lead Singer:</strong> {{ $band->singer }}</li>
                        <li><strong>Backing Vocals:</strong> {{ $band->backing_vocals }}</li>
                        <li><strong>Lead Guitarist:</strong> {{ $band->lead_guitarist }}</li>
                        <li><strong>Rythm Guitarist:</strong> {{ $band->rythm_guitarist }}</li>
                        <li><strong>Bassist:</strong> {{ $band->bassist }}</li>
                        <li><strong>Drummer:</strong> {{ $band->drummer }}</li>
                        <li><strong>Keyboardist:</strong> {{ $band->keyboardist }}</li>
                        <li><strong>Percussionist:</strong> {{ $band->percussionist }}</li>
                        <li><strong>DJ:</strong> {{ $band->dj }}</li>
                    </ul>

                    <h3>Best-Selled Album</h3>
                    <ul>
                        <li><strong>{{ $band->best_selled_album }}</strong></li>
                    </ul>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="/list-bands" class="btn btn-outline-secondary">Go Back</a>
                    </div>
                </div>

                <div class="col-md-6">
                    <img src="{{ $band->image ? asset('storage/' . $band->image) : asset('images/soad.png') }}" class="img-fluid rounded" alt="{{ $band->name }}">
                </div>
            </div>
        </div>

        {{-- ADMIN --}}
        @elseif (auth()->check() && $user->role == 'admin')
            <div class="container mb-3 darkmode-container">
                <form method="POST" action="{{ route('bands.update', ['bandId' => $band->id]) }}"  class="w-50" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="band_id" value="{{ $band->id }}">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $band->name }}">
                    </div>

                    <div class="mb-3 w-50">
                        <label for="genre_id" class="form-label">Genre</label>
                        <select name="genre_id" class="form-control" id="genre_id" required>
                            <option value="" disabled>Select the genre</option>
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}" {{ $band->genre_id == $genre->id ? 'selected' : '' }} >{{ $genre->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 w-25">
                        <label for="formation_year" class="form-label">Formation Year</label>
                        <input type="number" class="form-control" id="formation_year" name="formation_year" value="{{ $band->formation_year }}">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description">{{ $band->description }}</textarea>
                    </div>

                    <div class="d-flex flex-wrap flex-row gap-3 w-100">
                        <div class="mb-3 w-25">
                            <label for="singer" class="form-label">Singer</label>
                            <input type="text" name="singer" class="form-control" id="singer" aria-describedby="singer" value="{{ $band->singer }}">
                        </div>
                        <div class="mb-3 w-25">
                            <label for="backing_vocals" class="form-label">Backing Vocals</label>
                            <input type="text" name="backing_vocals" class="form-control" id="backing_vocals" aria-describedby="backing_vocals" value="{{ $band->backing_vocals }}">
                        </div>
                        <div class="mb-3 w-25">
                            <label for="rythm_guitarist" class="form-label">Rythm Guitarist</label>
                            <input type="text" name="rythm_guitarist" class="form-control" id="rythm_guitarist" aria-describedby="rythm_guitarist" value="{{ $band->rythm_guitarist }}">
                        </div>
                        <div class="mb-3 w-25">
                            <label for="lead_guitarist" class="form-label">Lead Guitarist</label>
                            <input type="text" name="lead_guitarist" class="form-control" id="lead_guitarist" aria-describedby="lead_guitarist" value="{{ $band->lead_guitarist }}">
                        </div>
                        <div class="mb-3 w-25">
                            <label for="bassist" class="form-label">Bassist</label>
                            <input type="text" name="bassist" class="form-control" id="bassist" aria-describedby="bassist" value="{{ $band->bassist }}">
                        </div>
                        <div class="mb-3 w-25">
                            <label for="drummer" class="form-label">Drummer</label>
                            <input type="text" name="drummer" class="form-control" id="drummer" aria-describedby="drummer" value="{{ $band->drummer }}">
                        </div>
                        <div class="mb-3 w-25">
                            <label for="percussionist" class="form-label">Percussionist</label>
                            <input type="text" name="percussionist" class="form-control" id="percussionist" aria-describedby="percussionist" value="{{ $band->percussionist }}">
                        </div>
                        <div class="mb-3 w-25">
                            <label for="keyboardist" class="form-label">Keyboardist</label>
                            <input type="text" name="keyboardist" class="form-control" id="keyboardist" aria-describedby="keyboardist" value="{{ $band->keyboardist }}">
                        </div>
                        <div class="mb-3 w-25">
                            <label for="dj" class="form-label">DJ</label>
                            <input type="text" name="dj" class="form-control" id="dj" aria-describedby="dj" value="{{ $band->dj }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="best_selled_album" class="form-label">Best-Selled Album</label>
                        <input type="text" class="form-control" id="best_selled_album" name="best_selled_album" value="{{ $band->best_selled_album }}">
                    </div>

                    <div class="input-group mb-3">
                        <input type="file" name="image" accept="image/*" class="form-control" id="image">
                    </div>

                    <input type="submit" class="btn btn-success" value="Save">
                    <a href="{{ route('bands.list') }}" class="btn btn-outline-secondary">Go Back</a>
                </div>
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

                    @error('singer')
                        Invalid Singer!
                    @enderror

                    @error('backing_vocals')
                        Invalid Backing Vocals!
                    @enderror

                    @error('rythm_guitarist')
                        Invalid Rhythm Guitarist!
                    @enderror

                    @error('lead_guitarist')
                        Invalid Lead Guitarist!
                    @enderror

                    @error('bassist')
                        Invalid Bassist!
                    @enderror

                    @error('drummer')
                        Invalid Drummer!
                    @enderror

                    @error('percurssionist')
                        Invalid Percussionist!
                    @enderror

                    @error('keyboardist')
                        Invalid Keyboardist!
                    @enderror

                    @error('dj')
                        Invalid DJ!
                    @enderror

                    @error('best_selled_album')
                        Invalid Album!
                    @enderror

                    @error('image')
                        Invalid Image!
                    @enderror
                </div>

            </div>
    @endif

    <script src="{{ asset('js/darkmode.js') }}"></script>

@endsection
