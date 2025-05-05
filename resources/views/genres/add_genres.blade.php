@extends('layouts.app')

@section('content')

    <div class="w-75">
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

        <div>
            <form method="POST" action="{{ route('genres.store') }}" >
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="nome" aria-describedby="name" required>
                </div>

                <button type="submit" class="btn btn-success">Submit</button>

            </form>
            <hr>
            <h2 class="text-secondary mt-2 mb-3">Genres List</h2>
            <div class="d-flex flex-row flex-wrap gap-3">
                @foreach ($genres as $genre)
                    <div class="btn btn-outline-secondary d-flex flex-row align-items-center justify-content-center">{{ $genre->name }}
                        <form action="{{ route('genres.remove', $genre->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn">&#10060;</button>
                        </form>
                    </div>
                @endforeach
            </div>

              <div class="text-danger">
                @error('name')
                    Invalid Name!
                @enderror

        </div>
    </div>
    <script src="{{ asset('js/darkmode.js') }}"></script>

@endsection
