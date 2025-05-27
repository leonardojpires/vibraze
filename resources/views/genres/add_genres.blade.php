@extends('layouts.app')

@section('content')

    <section class="d-flex flex-column align-items-center justify-content-center align-items-lg-start justify-content-lg-start mb-5">
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
                <h1 class="mb-3">Add a Genre</h1>
                <form method="POST" action="{{ route('genres.store') }}" class="d-flex flex-column align-items-center justify-content-center align-items-lg-start justify-content-lg-start" >
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Genre Name</label>
                        <input type="text" placeholder="Ex: Rock" name="name" class="form-control" id="nome" aria-describedby="name" required>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
                <hr>
                <h2 class="text-secondary mt-2 mb-3">Genres List</h2>
                <div class="d-flex flex-row flex-wrap gap-3 align-items-center justify-content-center align-items-lg-start justify-content-lg-start">
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
                    Invalid Genre Name!
                @enderror
            </div>
        </div>
    </section>

@endsection
