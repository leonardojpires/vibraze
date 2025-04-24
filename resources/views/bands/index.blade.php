@extends('layouts.app')

@section('content')

<div>

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

    <h1 class="mb-3">Find Your Favorite Bands</h1>

    <div class="mb-3 search-input d-flex">
        <form action="{{ route('bands.list') }}" method="GET" class="d-flex w-100">
            <div class="input-group me-2">
                <input type="text" class="form-control" name="search" placeholder="Search" aria-label="Search input" aria-describedby="button-search" value="{{ request('search') }}">
                <button class="btn" type="submit" id="button-addon2">Search</button>
            </div>
            @if (request('search'))
                <a href="{{ route('bands.list') }}" class="btn btn-secondary">Clear</a>
            @endif
        </form>

        <button id="darkModeToggle" class="btn btn-outline-secondary ms-3">
            <span id="darkModeIcon" class="material-icons">
                light_mode
            </span>
        </button>

    </div>

    @if ($genres->count() > 0)
        <div class="mb-5 w-100">
            <form action="{{ route('bands.list') }}" method="GET" class="d-flex flex-row flex-wrap gap-3 w-75">
                @foreach ($genres as $genre)

                    <div>
                        <input
                            class="form-check-input d-none flex-wrap genres-check"
                            type="checkbox"
                            name="genres[]"
                            value="{{ $genre->id }}"
                            id="genre-{{ $genre->id }}" {{ in_array($genre->id, request()->get('genres', [])) ? 'checked' : '' }}
                            onchange="this.form.submit()"
                        >

                        <label
                            class="form-check-label btn btn-outline-success btn-sm {{ in_array($genre->id, request()->get('genres', [])) ? 'active' : '' }} "
                            for="genre-{{ $genre->id }}">{{ $genre->name }}</label
                        >

                    </div>
                @endforeach
            </form>
        </div>
    @endif

    <div class="mb-5 d-flex flex-row flex-wrap justify-content-start align-content-center gap-5">
        @if ($bands->count() > 0)
            @foreach ($bands as $band)

                <div class="card" style="width: 18rem;">

                    <img src="{{ asset("images/$band->image_url.png") }}" class="card-img-top" alt="{{ $band->name }}">
                    <div class="card-body">

                    <p class="card-text">{{ $band->name }}</p>

                    <div class="d-flex flex-row gap-3">
                        @if ($band->isFavoritedBy($user))
                            <form method="POST" action="{{ route('favorites.remove', $band->id) }}">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="band_id" value="{{ $band->id }}">
                                <input type="submit" value="&#8212;" class="favorite-button rounded-circle">
                            </form>
                        @else
                            <form method="POST" action="{{ route('favorites.add', $band->id) }}">
                                @csrf
                                <input type="hidden" name="band_id" value="{{ $band->id }}">
                                <input type="submit" value="&#x2665;&#xfe0f;" class="favorite-button rounded-circle">
                            </form>
                        @endif
                        <a href="{{ route('bands.show', $band->id) }}" class="btn btn-primary">View</a>
                    </div>

                    </div>

                </div>

            @endforeach
        @else
            <div>
                <p>No bands found.</p>
            </div>
        @endif
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $bands->appends(request()->except('page'))->links() }}
    </div>
</div>

<script src="{{ asset('js/darkmode.js') }}"></script>

@endsection
