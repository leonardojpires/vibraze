@extends('layouts.app')

@section('title', 'Log in — Vibraze')

@section('content')
    <section class="auth-layout page-shell">
        <div class="auth-intro">
            <span class="eyebrow">Welcome back</span>
            <h1>Pick up where you left off.</h1>
            <p>Log in to see your saved bands and keep browsing the catalog.</p>
            <div class="auth-note"><span class="brand-mark">V</span><p><strong>Everything in one place.</strong><br>Your bands, favorites, and most-listened genre.</p></div>
        </div>
        <div class="auth-card">
            <div class="auth-card__heading"><h2>Log in to Vibraze</h2><p>Enter the details associated with your account.</p></div>
            <form method="POST" action="{{ route('login.store') }}">
                @csrf
                <div class="field"><label for="email">Email address</label><input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus>@error('email')<span class="field-error">{{ $message }}</span>@enderror</div>
                <div class="field"><div class="field-label-row"><label for="password">Password</label><a href="{{ route('password.request') }}">Forgot password?</a></div><input id="password" name="password" type="password" autocomplete="current-password" required>@error('password')<span class="field-error">{{ $message }}</span>@enderror</div>
                <label class="check-field"><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}><span>Keep me logged in</span></label>
                <button class="button button--primary button--block" type="submit">Log in</button>
            </form>
            <p class="auth-card__footer">New to Vibraze? <a href="{{ route('users.add') }}">Create an account</a></p>
        </div>
    </section>
@endsection
