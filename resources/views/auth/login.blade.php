@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row w-100">
        <div class="col-lg-6 col-md-8 col-12 mx-auto">
            <!-- Card de Login -->
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header text-center py-4 bg-success text-white">
                    <h2 class="fw-bold">Login to Your Account</h2>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success w-48">Log In</button>
                            <a href="{{ route('users.add') }}" class="btn btn-outline-success w-48 text-decoration-none text-center">Don't have an account?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
