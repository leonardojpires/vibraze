@extends('layouts.app')

@section('content')
    <section
        class="d-flex flex-column align-items-center justify-content-center align-items-lg-start justify-content-lg-start mb-5">
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
                <h1 class="mb-3">Add a Band</h1>
                <form method="POST" action="{{ route('bands.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="nome" aria-describedby="name"
                            required>
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
                        <input type="number" name="formation_year" class="form-control" id="formation_year" required
                            minlength="4" maxlength="4">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="description" aria-describedby="description" required></textarea>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-3">
                            <label for="singer" class="form-label">Singer</label>
                            <input type="text" name="singer" class="form-control" id="singer"
                                aria-describedby="singer">
                        </div>
                        <div class="col-md-3">
                            <label for="backing_vocals" class="form-label">Backing Vocals</label>
                            <input type="text" name="backing_vocals" class="form-control" id="backing_vocals"
                                aria-describedby="backing_vocals">
                        </div>
                        <div class="col-md-3">
                            <label for="rythm_guitarist" class="form-label">Rythm Guitarist</label>
                            <input type="text" name="rythm_guitarist" class="form-control" id="rythm_guitarist"
                                aria-describedby="rythm_guitarist">
                        </div>
                        <div class="col-md-3">
                            <label for="lead_guitarist" class="form-label">Lead Guitarist</label>
                            <input type="text" name="lead_guitarist" class="form-control" id="lead_guitarist"
                                aria-describedby="lead_guitarist">
                        </div>
                        <div class="col-md-3">
                            <label for="bassist" class="form-label">Bassist</label>
                            <input type="text" name="bassist" class="form-control" id="bassist"
                                aria-describedby="bassist">
                        </div>
                        <div class="col-md-3">
                            <label for="drummer" class="form-label">Drummer</label>
                            <input type="text" name="drummer" class="form-control" id="drummer"
                                aria-describedby="drummer">
                        </div>
                        <div class="col-md-3">
                            <label for="percurssionist" class="form-label">Percussionist</label>
                            <input type="text" name="percurssionist" class="form-control" id="percurssionist"
                                aria-describedby="percurssionist">
                        </div>
                        <div class="col-md-3">
                            <label for="keyboardist" class="form-label">Keyboardist</label>
                            <input type="text" name="keyboardist" class="form-control" id="keyboardist"
                                aria-describedby="keyboardist">
                        </div>
                        <div class="col-md-3">
                            <label for="dj" class="form-label">DJ</label>
                            <input type="text" name="dj" class="form-control" id="dj"
                                aria-describedby="dj">
                        </div>
                    </div>

                    <div class="mb-3 w-50">
                        <label for="best_selled_album" class="form-label">Best-Selled Album</label>
                        <input type="text" name="best_selled_album" class="form-control" id="best_selled_album"
                            aria-describedby="best_selled_album">
                    </div>
                    <div class="input-group mb-3">
                        <input type="file" name="image" accept="image/*" class="form-control" id="image">
                        <label class="input-group-text" for="image_url">Upload</label>
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
    </section>
@endsection
