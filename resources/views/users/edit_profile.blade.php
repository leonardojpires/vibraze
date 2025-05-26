@extends('layouts.app')

@section('content')

    <div class="w-50">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @elseif (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="mb-3 darkmode-container">
        <form method="POST" action="{{ route('users.update', $user->id) }}"  class="w-50" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" name="band_id" value="{{ $user->id }}">

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-Mail</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="">
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="">
            </div>

            <div class="input-group mb-3">
                <input type="file" name="image" accept="image/*" class="form-control" id="image">
            </div>

            <div class="d-flex flex-column gap-3 justify-content-start align-items-start">
                <input type="submit" class="btn btn-success" value="Save">
                <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-secondary">Go Back</a>
            </div>

        </div>
        </form>

        <div class="text-danger">
            @error('name')
                Invalid Name!
            @enderror

            @error('email')
                Invalid E-Mail!
            @enderror

            @error('password')
                Invalid Password!
            @enderror

            @error('password_confirmation')
                Invalid Password!
            @enderror

            @error('image')
                Invalid Image!
            @enderror
        </div>

    </div>

    <script src="{{ asset('js/darkmode.js') }}"></script>

@endsection
