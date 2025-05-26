<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vibraze</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <link rel="shortcut icon" href="{{ asset('images/logo/vibraze_logo_symbol_only.png') }}" type="image/x-icon">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
        <script src="{{ asset('js/delete_user_modal.js') }}"></script>
        <script src="{{ asset('js/delete_band_modal.js') }}"></script>

    </head>
    <body>

        @include('layouts.navbar');

        <div class="main-content container mt-2">
            @yield('content')
        </div>

    </body>
<script src="{{ asset('js/darkmode.js') }}"></script>

</html>
