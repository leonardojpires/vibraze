@extends('layouts.app')

@section('content')

<section class="container py-5">
  <div class="row align-items-center">
    <div class="col-lg-6 mb-4 mb-lg-0">
      <h1 class="display-4 fw-bold">Welcome to Vibraze!</h1>
      <p class="lead text-muted mb-4">Discover your favorite bands, explore genres, and connect with music lovers worldwide.</p>
      <a href="#" class="btn btn-primary btn-lg me-3">Get Started</a>
      <a href="#" class="btn btn-outline-secondary btn-lg">Learn More</a>
    </div>
    <div class="col-lg-6 text-center">
      <img src="https://via.placeholder.com/500x350" class="img-fluid rounded shadow" alt="Music Vibes">
    </div>
  </div>
</section>

<section class="bg-light py-5">
  <div class="container">
    <div class="row text-center g-4">
      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body">
            <div class="mb-3 text-primary fs-1">
              <i class="bi bi-music-note-beamed"></i>
            </div>
            <h5 class="card-title">Explore Genres</h5>
            <p class="card-text text-muted">Find bands from every style and era, from rock to jazz and beyond.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body">
            <div class="mb-3 text-primary fs-1">
              <i class="bi bi-people-fill"></i>
            </div>
            <h5 class="card-title">Connect with Fans</h5>
            <p class="card-text text-muted">Join a community that shares your music passion and favorite bands.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body">
            <div class="mb-3 text-primary fs-1">
              <i class="bi bi-heart-fill"></i>
            </div>
            <h5 class="card-title">Save Favorites</h5>
            <p class="card-text text-muted">Keep track of your favorite bands and discover new music every day.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="container py-5">
  <div class="row align-items-center">
    <div class="col-md-7">
      <h2 class="fw-bold mb-4">Ready to amplify your music experience?</h2>
      <p class="mb-4 text-muted">Sign up today and dive into the world of music with Vibraze.</p>
      <a href="#" class="btn btn-success btn-lg">Create Account</a>
    </div>
    <div class="col-md-5 text-center">
      <img src="https://via.placeholder.com/400x300" class="img-fluid rounded shadow" alt="Join Vibraze">
    </div>
  </div>
</section>

<script src="{{ asset('js/darkmode.js') }}"></script>

@endsection
