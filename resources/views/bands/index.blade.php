@extends('layouts.app')

@section('content')

    <section class="px-2 px-lg-0">

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

        <div class="d-flex flex-column gap-3">
            @if (Auth::user())
                <h1>Welcome back, <span class="text-decoration-underline text-success">{{ $user->name }}</span></h1>
            @else
                <span class="alert alert-warning w-50 py-2">You're not logged yet. <a href="{{ route('login') }}"
                        class="alert-link">Sign in.</a>
                </span>
            @endif
            <h2 class="text-secondary mb-3 fs-3">Find Your Favorite Bands</h2>
        </div>

        <div class="search-container d-flex flex-column justify-content-center">
            <div class="mb-3 search-input d-flex">
                <form action="{{ route('bands.list') }}" method="GET" class="d-flex w-100 w-sm-75 mx-auto">
                    <div class="input-group me-2">
                        <input type="text" class="form-control" name="search" placeholder="Search"
                            aria-label="Search input" aria-describedby="button-search" value="{{ request('search') }}">
                        <button class="btn" type="submit" id="button-addon2">Search</button>
                    </div>
                    @if (request('search'))
                        <a href="{{ route('bands.list') }}" class="btn btn-secondary">Clear</a>
                    @endif
                </form>
            </div>


            @if ($genres->count() > 0)
                <div class="mb-5 w-100">
                    <div class="genres-scroll-effect">
                        <div class="genres-container">
                            <form action="{{ route('bands.list') }}" method="GET"
                                class="d-flex flex-row flex-wrap gap-3 w-75">
                                @foreach ($genres as $genre)
                                    <div class="genre-item">
                                        <input class="form-check-input d-none flex-wrap genres-check" type="checkbox"
                                            name="genres[]" value="{{ $genre->id }}" id="genre-{{ $genre->id }}"
                                            {{ in_array($genre->id, request()->get('genres', [])) ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <label
                                            class="form-check-label btn btn-outline-success btn-sm {{ in_array($genre->id, request()->get('genres', [])) ? 'active' : '' }} "
                                            for="genre-{{ $genre->id }}">{{ $genre->name }}</label>
                                    </div>
                                @endforeach
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="bands-container mb-5 d-flex flex-wrap justify-content-lg-start justify-content-center align-content-center gap-5 ">
            @if ($bands->count() > 0)
                @foreach ($bands as $band)
                    <div class="card card_effect" style="width: 18rem;">

                        <img src="{{ $band->image ? asset('storage/' . $band->image) : asset('images/soad.png') }}"
                            class="card-img-top" alt="{{ $band->name }}">
                        <div class="card-body">

                            <p class="card-text">{{ $band->name }}</p>

                            <div class="d-flex flex-row gap-3">
                                @if (Auth::user())
                                    @if ($band->isFavoritedBy($user))
                                        <form method="POST" action="{{ route('favorites.remove', $band->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="band_id" value="{{ $band->id }}">
                                            <input type="submit" value="&#10060;" class="favorite-button rounded-circle">
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('favorites.add', $band->id) }}">
                                            @csrf
                                            <input type="hidden" name="band_id" value="{{ $band->id }}">
                                            <input type="submit" value="&#x2665;&#xfe0f;"
                                                class="favorite-button rounded-circle">
                                        </form>
                                    @endif
                                @endif
                                <a href="{{ route('bands.show', $band->id) }}" class="btn btn-success">Infos</a>

                                @if (auth()->check() && $user->role === 'admin')
                                    <button
                                    data-band-id="{{ $band->id }}"
                                    data-action="{{ route('bands.remove', $band->id) }}"
                                    class="btn btn-danger openBandDeleteModal">Remove</button>
                                @endif

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

        <div class="d-flex justify-content-center justify-content-lg-start mt-4">
            {{ $bands->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
        </div>

        {{-- DELETE MODAL --}}
        <div class="modal fade" id="deleteBandModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this band?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form method="POST" id="deleteBandForm">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
