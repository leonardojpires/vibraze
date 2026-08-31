@extends('layouts.app')

@section('title', 'Create an account — Vibraze')

@section('content')
    <section class="auth-layout page-shell">
        <div class="auth-intro">
            <span class="eyebrow">Make it personal</span>
            <h1>Save the bands you like.</h1>
            <p>Create an account to keep favorites and see which genre you save most often.</p>
            <ol class="auth-steps"><li><span>01</span>Browse the catalog</li><li><span>02</span>Save a band</li><li><span>03</span>Check your profile</li></ol>
        </div>
        <div class="auth-card">
            <div class="auth-card__heading"><h2>Create your account</h2><p>It only takes a minute to get started.</p></div>
            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="field"><label for="name">Full name</label><input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required autofocus>@error('name')<span class="field-error">{{ $message }}</span>@enderror</div>
                <div class="field"><label for="email">Email address</label><input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required>@error('email')<span class="field-error">{{ $message }}</span>@enderror</div>
                <div class="field"><label for="password">Password</label><input id="password" name="password" type="password" autocomplete="new-password" required><span class="field-hint">Use at least 8 characters.</span>@error('password')<span class="field-error">{{ $message }}</span>@enderror</div>
                <div class="field"><label for="password_confirmation">Confirm password</label><input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required></div>
                <button class="button button--primary button--block" type="submit">Create account</button>
            </form>
            <p class="auth-card__footer">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
        </div>
    </section>
@endsection
