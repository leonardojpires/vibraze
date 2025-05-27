@extends('layouts.app')

@section('content')

    <section class="px-2 px-lg-0">

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
            <h1 class="text-center text-lg-start mb-5">Favorited Bands</h1>
        </div>

        <div
            class="bands-container mb-5 d-flex flex-wrap justify-content-lg-start justify-content-center align-content-center gap-5 ">
            @if ($bands->count() > 0)
                @foreach ($bands as $band)
                    <div class="card card_effect" style="width: 18rem;">
                        <img src="{{ $band->image ? asset('storage/' . $band->image) : asset('images/soad.png') }}"
                            class="card-img-top" alt="{{ $band->name }}">
                        <div class="card-body">
                            <p class="card-text">{{ $band->name }}</p>
                            <form method="POST" action="{{ route('favorites.remove', $band->id) }}">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="band_id" value="{{ $band->id }}">
                                <input type="submit" value="&#10060;" class="favorite-button rounded-circle">
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <div>
                    <p>You don't have any favorite bands.</p>
                </div>
            @endif
        </div>
        <div class="d-flex justify-content-start mt-4">
            {{ $bands->appends(request()->except('page'))->links() }}
        </div>
        </div>
    </section>
@endsection
