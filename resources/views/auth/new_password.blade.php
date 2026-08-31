@extends('layouts.app')

@section('title', 'Choose a new password — Vibraze')

@section('content')
    <section class="auth-layout auth-layout--centered page-shell">
        <div class="auth-card">
            <div class="auth-card__heading"><span class="eyebrow">Almost there</span><h1>Choose a new password.</h1><p>Use a strong password you do not use on another service.</p></div>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ request()->token }}">
                <div class="field"><label for="email">Email address</label><input id="email" name="email" type="email" value="{{ request()->email }}" readonly required>@error('email')<span class="field-error">{{ $message }}</span>@enderror</div>
                <div class="field"><label for="password">New password</label><input id="password" name="password" type="password" autocomplete="new-password" required>@error('password')<span class="field-error">{{ $message }}</span>@enderror</div>
                <div class="field"><label for="password_confirmation">Confirm new password</label><input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required>@error('password_confirmation')<span class="field-error">{{ $message }}</span>@enderror</div>
                <button class="button button--primary button--block" type="submit">Update password</button>
            </form>
        </div>
    </section>
@endsection
