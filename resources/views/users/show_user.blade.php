@extends('layouts.app')

@section('title', $user->name . ' — Vibraze')

@section('content')
    @php
        $userInitials = collect(preg_split('/\s+/', trim($user->name)))->filter()->take(2)->map(fn ($part) => strtoupper(substr($part, 0, 1)))->implode('');
    @endphp
    <section class="page-shell page-section page-section--narrow">
        @include('partials.flash')

        @if (auth()->user()->role === 'admin')
            <a class="back-link" href="{{ route('users.list') }}"><span aria-hidden="true">←</span> Back to users</a>
        @else
            <a class="back-link" href="{{ route('home') }}"><span aria-hidden="true">←</span> Back to home</a>
        @endif

        <div class="profile-header">
            <span class="avatar avatar--large">{{ $userInitials ?: 'U' }}</span>
            <div><span class="eyebrow">{{ auth()->user()->role === 'admin' ? 'Account review' : 'Your profile' }}</span><h1>{{ $user->name }}</h1><p>{{ $user->email }}</p><span class="profile-date">Member since {{ optional($user->created_at)->format('F Y') ?? '—' }}</span></div>
        </div>

        @if (auth()->user()->role === 'admin')
            <div class="profile-grid">
                <section class="info-card"><span class="eyebrow">Account access</span><h2>Role and permissions</h2><form method="POST" action="{{ route('users.role', $user->id) }}">@csrf @method('PUT')<div class="field"><label for="role">Account role</label><select id="role" name="role">@foreach (['user', 'admin'] as $role)<option value="{{ $role }}" {{ $user->role === $role ? 'selected' : '' }}>{{ ucfirst($role) }}</option>@endforeach</select></div><button class="button button--primary" type="submit">Update role</button></form></section>
                <section class="info-card"><span class="eyebrow">Saved music</span><h2>{{ $user->favoriteBands->count() }} favorite {{ Str::plural('band', $user->favoriteBands->count()) }}</h2>@if ($user->favoriteBands->isNotEmpty())<div class="tag-list">@foreach ($user->favoriteBands as $band)<a href="{{ route('bands.show', $band->id) }}">{{ $band->name }}</a>@endforeach</div>@else<p class="muted">This user has not saved any bands.</p>@endif</section>
            </div>
        @else
            <div class="profile-stats"><div><span>Favorite genre</span><strong>{{ $favoriteGenre !== 'None' ? $favoriteGenre : 'None yet' }}</strong></div><div><span>Saved bands</span><strong>{{ $user->favoriteBands->count() }}</strong></div><div><span>Account type</span><strong>{{ ucfirst($user->role) }}</strong></div></div>
            <section class="detail-section"><div class="detail-section__heading"><span class="eyebrow">Saved bands</span><h2>Favorites</h2></div>@if ($user->favoriteBands->isNotEmpty())<div class="tag-list tag-list--large">@foreach ($user->favoriteBands as $band)<a href="{{ route('bands.show', $band->id) }}">{{ $band->name }} <span aria-hidden="true">→</span></a>@endforeach</div>@else<div class="empty-state empty-state--compact"><p>You have not saved any bands yet.</p><a class="button button--secondary" href="{{ route('bands.list') }}">Browse bands</a></div>@endif</section>
            <div class="form-actions"><a class="button button--primary" href="{{ route('users.edit', $user->id) }}">Edit profile</a><a class="button button--quiet" href="{{ route('favorites.list') }}">View favorites</a></div>
        @endif
    </section>
@endsection
