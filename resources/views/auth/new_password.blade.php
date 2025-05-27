@extends('layouts.app')

@section('content')
    <section class="mb-5 px-3 px-lg-0 py-5">
        <div class="bands-container d-flex justify-content-center justify-content-lg-start">
            <div class="row w-100">
                <div class="col-lg-6 col-md-8 col-12 mx-auto">

                    <div class="card shadow-lg border-0 rounded-lg">
                        <div class="card-header text-center py-4 bg-success text-white">
                            <h2 class="fw-bold">Set Your New Password</h2>
                        </div>
                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ request()->email }}" required readonly>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Password Confirmation</label>
                                    <input type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="password_confirmation" name="password_confirmation" required>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <input type="hidden" name="token" value="{{ request()->token }}">
                                <button type="submit" class="btn btn-success">Update Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
