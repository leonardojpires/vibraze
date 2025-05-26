@extends('layouts.app')

@section('content')

<div>
    <div class="d-flex gap-3 align-items-center mb-4">
        <h1 class="mb-3">Favorited Bands</h1>
    </div>

{{--     <div class="mb-5 search-input d-flex">
        <form action="{{ route('bands.list') }}" method="GET" class="d-flex w-100">
            <div class="input-group me-2">
                <input type="text" class="form-control" name="search" placeholder="Search" aria-label="Search input" aria-describedby="button-search" value="{{ request('search') }}">
                <button class="btn" type="submit" id="button-addon2">Search</button>
            </div>
            @if (request('search'))
                <a href="{{ route('bands.list') }}" class="btn btn-secondary">Clear</a>
            @endif
        </form> --}}

    </div>

    <div class="bands-container mb-5 d-flex flex-row flex-wrap justify-content-start align-content-center gap-5">
        @if ($bands->count() > 0)
            @foreach ($bands as $band)

                <div class="card card_effect" style="width: 18rem;">

                    <img src="{{ $band->image ? asset('storage/' . $band->image) : asset('images/soad.png') }}" class="card-img-top" alt="{{ $band->name }}">
                    <div class="card-body">

                    <p class="card-text">{{ $band->name }}</p>

                    <form method="POST" action="{{ route('favorites.remove', $band->id) }}">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="band_id" value="{{ $band->id }}">
                        <input type="submit" value="&#10060;" class="favorite-button rounded-circle">
                    </form>

                    </div>

                </div>

            @endforeach
        @else
            <div>
                <p>You don't have any favorite bands.</p>
            </div>
        @endif
    </div>
    <div class="d-flex justify-content-start mt-4">
        {{ $bands->appends(request()->except('page'))->links() }}
    </div>

</div>

<script src="{{ asset('js/darkmode.js') }}"></script>

@endsection
