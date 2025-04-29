@extends('layouts.app')

@section('content')

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
                    <li><strong>Percussionist:</strong> {{ $band->percurssionist }}</li>
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
                <img src="{{ asset("images/$band->image_url.png") }}" class="img-fluid rounded" alt="{{ $band->name }}">
            </div>
        </div>
    </div>
    @elseif (auth()->check() && $user->role == 'admin')
        <p>Admin!</p>
    @endif

    <script src="{{ asset('js/darkmode.js') }}"></script>

@endsection
