<nav class="navbar navbar-dark bg-dark navbar-expand-lg justify-content-center">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand" href="{{ route('adminx.nav-tiles.index') }}">
            <img src="{{ asset('images/nucleus-icon.png') }}" alt="Neuly" style="height: 30px;width: auto;"> <span class="ml-2">Navigation Tiles</span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto ms-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('adminx.nav-tiles.create') }}">Create Nav Tile</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto me-0">
                <li class="nav-item">
                    <a class="nav-link" href="/admin">Back to Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/">Back to Neuly</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
