@extends('layouts.app')

@section('title', 'Edit profile — Vibraze')

@section('content')
    <section class="page-shell page-section page-section--narrow">
        @include('partials.flash')
        <a class="back-link" href="{{ route('users.show', $user->id) }}"><span aria-hidden="true">←</span> Back to profile</a>
        <div class="page-heading"><div><span class="eyebrow">Account settings</span><h1>Edit your profile.</h1><p>Update your account details or choose a new password.</p></div></div>
        <form class="form-card" method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="form-section"><div class="form-section__heading"><span>01</span><div><h2>Personal details</h2><p>The information associated with your account.</p></div></div><div class="form-grid"><div class="field"><label for="name">Full name</label><input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required>@error('name')<span class="field-error">{{ $message }}</span>@enderror</div><div class="field"><label for="email">Email address</label><input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required>@error('email')<span class="field-error">{{ $message }}</span>@enderror</div></div></div>
            <div class="form-section"><div class="form-section__heading"><span>02</span><div><h2>Change password</h2><p>Leave both fields blank to keep your current password.</p></div></div><div class="form-grid"><div class="field"><label for="password">New password</label><input id="password" name="password" type="password" autocomplete="new-password">@error('password')<span class="field-error">{{ $message }}</span>@enderror</div><div class="field"><label for="password_confirmation">Confirm new password</label><input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">@error('password_confirmation')<span class="field-error">{{ $message }}</span>@enderror</div></div></div>
            <div class="form-actions"><button class="button button--primary" type="submit">Save changes</button><a class="button button--quiet" href="{{ route('users.show', $user->id) }}">Cancel</a></div>
        </form>
    </section>
@endsection
