@extends('layouts.app')

@section('title', 'Reset password — Vibraze')

@section('content')
    <section class="auth-layout auth-layout--centered page-shell">
        <div class="auth-card">
            <a class="back-link" href="{{ route('login') }}"><span aria-hidden="true">←</span> Back to login</a>
            <div class="auth-card__heading"><span class="eyebrow">Account recovery</span><h1>Reset your password.</h1><p>Enter your email and we’ll send you a secure reset link.</p></div>
            @if (session('status'))<div class="notice notice--success" role="status">{{ session('status') }}</div>@endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="field"><label for="email">Email address</label><input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus>@error('email')<span class="field-error">{{ $message }}</span>@enderror</div>
                <button class="button button--primary button--block" type="submit">Send reset link</button>
            </form>
        </div>
    </section>
@endsection
