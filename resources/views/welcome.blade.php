@extends('layouts.app')

@section('content')

<section class="container py-5">
    <div class="row align-items-center">
        <div class="col-lg-6">
        <h1 class="display-4 fw-bold">Welcome to Vibraze!</h1>
        <p class="lead"></p>
        <a href="#" class="btn btn-primary btn-lg">More About</a>
        </div>
        <div class="col-lg-6">
        <!-- Imagem ou conteúdo adicional -->
        <img src="https://via.placeholder.com/500" class="img-fluid rounded" alt="Image">
        </div>
    </div>
</section>

<script src="{{ asset('js/darkmode.js') }}"></script>

@endsection
