@extends('layouts.app')

@section('content')
    <section class="bands-container">

        {{-- HERO --}}
        <section class="container vibraze-hero mb-5">
            <div class="align-items-center text-white text-center">
                <div class="d-flex flex-column align-items-center justify-content-center w-50 mx-auto">
                    <img src="{{ asset('images/logo/vibraze_logo_symbol_only.png') }}" alt="Vibraze" width="100" class="mb-3" style="pointer-events: none;">
                    <h1 class="mb-4" style="font-size: 3rem;">Welcome to Vibraze</h1>
                    <p class="lead">Find your favorite bands and discover more about them and their music! Get in touch
                        with your favorite genres and artists! <span class="text-success font-weight-bold">Bend the strings
                            of your life</span></p>
                    <a href="#descobrir" class="btn btn-success mt-3" style="font-size: 1.5rem;">Find It Now</a>
                </div>
            </div>
        </section>

        {{-- CARDS --}}
        <section class="d-flex flex-column flex-lg-row justify-content-lg-between align-items-lg-stretch align-items-center justify-content-center mb-5 gap-5">

            <div class="card card_effect" style="width: 18rem">
                <div class="py-4" style="background-color: rgba(94, 211, 94, 0.688);"></div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Search for bands</h5>
                    <hr>
                    <p class="card-text">You can search for bands by name or genre!</p>
                    <div class="mt-auto"><a href="{{ route('bands.list') }}" class="card-link">Go for it</a></div>
                </div>
            </div>

            <div class="card card_effect" style="width: 18rem">
                <div class="py-4" style="background-color: rgba(94, 211, 94, 0.688);"></div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Add a band to your favorites list</h5>
                    <hr>
                    <p class="card-text">Do you love a band? You can add it to your favorites list!</p>
                    <div class="mt-auto">
                        @if (auth()->check())
                            <a href="{{ route('bands.list') }}" class="card-link">Check your favorites!</a>
                        @else
                            <a href="{{ route('login') }}">Log in to check your favorites list!</a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card card_effect" style="width: 18rem">
                <div class="py-4" style="background-color: rgba(94, 211, 94, 0.688);"></div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Find out your favorite genre!</h5>
                    <hr>
                    <p class="card-text">You will see what genre you like the most based on your favorites!</p>
                    <div class="mt-auto">
                        @if (auth()->check())
                            <a href="{{ route('bands.list') }}" class="card-link">Check your favorites!</a>
                        @else
                            <a href="{{ route('login') }}">Log in to check your favorite genre!</a>
                        @endif
                    </div>
                </div>
            </div>

        </section>


        <section class="d-flex flex-column flex-lg-row justify-content-lg-between align-items-lg-stretch align-items-center justify-content-center mb-5">
            <div class="col-lg-4">
                <img src="{{ asset("images/landing_page/vibraze_poster.png") }}" alt="" width=350>
            </div>
            <div class="col-lg-8">
                <h2 class="display-6">Easy to use</h2>
                <p class="lead">Vibraze is a simple and easy to use web application. You can search for bands, add them
                    to your favorites list and check your favorite genre in a few clicks!</p>

                <h2 class="display-6">Find other people</h2>
                <p class="lead">You can find other people who share your passion for music and bands!</p>

                <h2 class="display-6">Customize your experience</h2>
                <p class="lead">You can customize your experience by changing the theme, language and more!</p>
            </div>
        </section>

    </section>

    <script src="{{ asset('js/darkmode.js') }}"></script>
@endsection
