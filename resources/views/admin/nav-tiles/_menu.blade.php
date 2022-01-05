<nav class="navbar navbar-dark bg-dark d-flex justify-content-center align-items-center shadow-sm navbar-expand-lg justify-content-center">
    <a class="navbar-brand" href="{{ route('admin.nav-tiles.index') }}">
        <img src="{{ asset('images/nucleus-icon.png') }}" alt="Neuly"> <span class="ml-2">Navigation Tiles</span>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto ml-0">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.nav-tiles.create') }}">Create Nav Tile</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto mr-0">
            <li class="nav-item">
                <a class="nav-link" href="/admin">Back to Admin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/">Back to Neuly</a>
            </li>
        </ul>
    </div>
</nav>
