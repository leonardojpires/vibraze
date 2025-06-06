@extends('layouts.app')

@section('content')

    <section>
        <div class="mb-5 px-3 px-lg-0 py-5">
            <div class="w-100 w-md-50 mx-auto">
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
                {{-- ADMIN --}}
                @if (Auth::user() && Auth::user()->role === 'admin')
                    <div class="bands-container d-flex justify-content-center">
                        <div class="card border-success shadow w-100" style="max-width: 700px;">
                            <div class="card-header bg-success text-white">
                                <h4 class="mb-0">User Details</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('users.role', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between flex-wrap">
                                            <strong>Name:</strong>
                                            <span>{{ $user->name }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between flex-wrap">
                                            <strong>E-mail:</strong>
                                            <span>{{ $user->email }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between flex-wrap">
                                            <strong>Created At:</strong>
                                            <span>{{ $user->created_at }}</span>
                                        </li>
                                        <li class="list-group-item d-flex flex-column gap-3 justify-content-center">
                                            <strong>Favorited Bands:</strong>
                                            @if (!$user->favoriteBands->isEmpty())
                                                <p>
                                                    @foreach ($user->favoriteBands as $band)
                                                        <span>{{ $band->name }}</span>
                                                    @endforeach
                                                </p>
                                            @else
                                                <span>This user has no favorite bands.</span>
                                            @endif
                                        </li>
                                        <li class="list-group-item d-flex flex-column justify-content-between">
                                            <label for="role" class="form-label"><strong>Role:</strong></label>
                                            <select name="role" id="role" class="form-select">
                                                @foreach (['user', 'admin'] as $role)
                                                    <option value="{{ $role }}"
                                                        {{ $user->role == $role ? 'selected' : '' }}>
                                                        {{ ucfirst($role) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </li>
                                    </ul>
                                    <div>
                                        <button type="submit" class="btn btn-outline-success">Update Role</button>
                                    </div>
                                </form>
                                <div class="mt-4 d-flex justify-content-end gap-2">
                                    <a href="{{ route('users.list') }}" class="btn btn-success">Go Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- USER --}}
                @elseif (Auth::user() && Auth::user()->role === 'user')
                    <div class=" ms-auto w-100 mb-5 darkmode-container justify-content-center justify-content-lg-start">
                        <div class="row">
                            <div class="col-12 d-flex flex-column">
                                <div class="d-flex justify-content-center justify-content-md-start align-items-start mb-3">
                                    <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('images/profile/user_profile.png') }}"
                                        class="rounded-circle shadow" alt="Profile Picture"
                                        style="width: 250px; height: 250px; max-width: 100%; object-fit: cover;">
                                </div>
                                <h1 class="display-4 text-center text-md-start">{{ $user->name }}</h1>
                                <p class="lead text-muted text-center text-md-start">{{ $user->email }}</p>
                                <div class="mt-1 text-center text-md-start">
                                    <p><strong>Member since:</strong> {{ $user->created_at->format('F Y') }}</p>
                                </div>
                                <div class="mt-4">
                                    <h4>Favorite Bands</h4>
                                    @if (!$user->favoriteBands->isEmpty())
                                        <div class="d-flex flex-wrap gap-4">
                                            @foreach ($user->favoriteBands as $band)
                                                <span>{{ $band->name }}</span>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center text-lg-start">
                                            <span>You have no favorite bands.</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="mt-4">
                                    <h4>Favorite Genre</h4>
                                    @if ($favoriteGenre !== 'None')
                                        <p>{{ $favoriteGenre }}</p>
                                    @endif
                                </div>
                                <div class="d-flex gap-2 mt-4 justify-content-center justify-content-md-start">
                                    <a href="{{ route('home') }}" class="btn btn-outline-secondary">Back to Home</a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success">Edit Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
    </section>

@endsection
