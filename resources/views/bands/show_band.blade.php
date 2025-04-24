@extends('layouts.app')

@section('content')

    <div class="container mb-3 darkmode-container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="display-4">{{ $band->name }}</h1>
                <p class="lead">{{ $genreName }}</p>
                <p><strong>Formation Year:</strong> {{ $band->formation_year }}</p>
                <p><strong>Description: </strong> {{ $band->description }}</p>

                <h3>Membros</h3>
                <ul>
                    <li><strong>Vocalista:</strong> João Silva</li>
                    <li><strong>Guitarrista:</strong> Pedro Oliveira</li>
                    <li><strong>Baterista:</strong> Carla Souza</li>
                    <li><strong>Baixista:</strong> Ricardo Almeida</li>
                </ul>

                <h3>Discografia</h3>
                <ul>
                    <li><strong>Álbum 1:</strong> "Primeiro Álcool" (2010)</li>
                    <li><strong>Álbum 2:</strong> "Sem Limites" (2013)</li>
                    <li><strong>Álbum 3:</strong> "Novo Horizonte" (2018)</li>
                </ul>

                <h3>Redes Sociais</h3>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="https://facebook.com" class="btn btn-primary">Facebook</a></li>
                    <li class="list-inline-item"><a href="https://twitter.com" class="btn btn-info">Twitter</a></li>
                    <li class="list-inline-item"><a href="https://instagram.com" class="btn btn-danger">Instagram</a></li>
                    <li class="list-inline-item"><a href="https://spotify.com" class="btn btn-success">Spotify</a></li>
                </ul>

                <div class="d-flex justify-content-between mt-4">
                    <a href="/list-bands" class="btn btn-outline-secondary">Voltar</a>
                </div>
            </div>

            <div class="col-md-6">
                <img src="{{ asset("images/$band->image_url.png") }}" class="img-fluid rounded" alt="{{ $band->name }}">
            </div>
        </div>
    </div>
    <script src="{{ asset('js/darkmode.js') }}"></script>

@endsection
