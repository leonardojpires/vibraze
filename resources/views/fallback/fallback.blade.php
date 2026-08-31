@extends('layouts.app')

@section('title', 'Page not found — Vibraze')

@section('content')
    <section class="page-shell error-page">
        <span class="error-code">404</span>
        <span class="eyebrow">Page not found</span>
        <h1>We couldn’t find that page.</h1>
        <p>Check the address or head back to the band catalog.</p>
        <div class="hero-actions"><a class="button button--primary" href="{{ route('home') }}">Go home</a><a class="button button--quiet" href="{{ route('bands.list') }}">Browse bands</a></div>
    </section>
@endsection
