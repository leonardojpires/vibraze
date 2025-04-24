<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<nav class="navbar navbar-expand-lg navbar-light flex-column">
    <a class="navbar-brand mb-3 fs-2 zoom-hover" href="{{ route('home') }}">Vibraze</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse d-flex flex-column align-items-start flex-column" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto d-flex justify-content-center text-center">
        <li class="nav-item active">
          <a class="nav-link text-white underline-hover" href="{{ route('bands.list') }}">Bands</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white underline-hover" href="{{ route('favorites.list') }}">Favorites</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white underline-hover" href="{{ route('bands.add') }}">Add Bands</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white underline-hover" href="{{ route('genres.add') }}">Add Genres</a>
        </li>
      </ul>
      <form class="d-flex mt-auto mb-5" role="logout">
        <button class="btn btn-outline-danger" type="submit">Log Out</button>
      </form>
    </div>
</nav>
