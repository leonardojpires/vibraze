@extends('layouts.app')

@section('content')
    <section class="mb-5 px-3 px-lg-0 py-5">

        <div class="bands-container d-flex justify-content-center justify-content-lg-start">
            <div class="row w-100">
                <div class="col-lg-6 col-md-8 col-12 mx-auto">

                    <div class="card shadow-lg border-0 rounded-lg">
                        <div class="card-header text-center py-4 bg-success text-white">
                            <h2 class="fw-bold">Login to Your Account</h2>
                        </div>
                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}" required autofocus>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        @if (session('status'))
                                            <div class="text-success mt-2">
                                                {{ session('status') }}
                                            </div>
                                        @endif

                                    </div>
                                    <button type="submit" class="btn btn-success w-100">Send Password Reset Link</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
