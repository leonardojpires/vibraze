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

        <div class="">
            <div class="d-flex gap-3 align-items-center">
                <h1 class="mb-3">Add Genres</h1>
                <button id="darkModeToggle" class="btn btn-outline-secondary ms-3">
                    <span id="darkModeIcon" class="material-icons">
                        light_mode
                    </span>
                </button>
            </div>

            <form method="POST" action="{{ route('genres.store') }}" >
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="nome" aria-describedby="name" required>
                </div>

                <button type="submit" class="btn btn-success">Submit</button>

            </form>
            <hr>
            <div class="d-flex flex-row flex-wrap gap-3 mt-5">
                @foreach ($genres as $genre)
                    <span class="btn btn-outline-secondary">{{ $genre->name }}</span>
                @endforeach
            </div>

              <div class="text-danger">
                @error('name')
                    Invalid Name!
                @enderror

        </div>
    </div>
    <script src="{{ asset('js/darkmode.js') }}"></script>

@endsection
