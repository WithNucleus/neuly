@if ($errors->navigationTile->count() > 0)
    <div class="alert alert-danger">
        @foreach ($errors->navigationTile->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif

@if(Session::has('navigationTileSuccess'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span class="me-auto">{{ Session::get('navigationTileSuccess') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<form action="{{ route('adminx.nav-tiles.update', $navigationTile->id) }}" method="post">
    @csrf
    <div class="form-group row mb-4">
        <div class="col-12 col-md-6">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $navigationTile->name) }}" class="form-control">
        </div>
        <div class="col-12 col-md-6">
            <label for="domain">Domain</label>
            <input type="text" name="domain" id="domain" value="{{ old('domain', $navigationTile->domain) }}" class="form-control">
        </div>
    </div>

    <div class="form-group row mb-4">
        <div class="col-12 col-md-6">
            <label for="placement">Placement {{ old('placement') }}</label>
            <select class="form-select" name="placement" id="placement">
                <option value="right" @if($navigationTile->placement === 'right') selected @endif>Right</option>
                <option value="left" @if($navigationTile->placement === 'left') selected @endif>Left</option>
            </select>
        </div>
    </div>

    <div class="form-group d-flex align-items-center mb-2">
        <input type="color" name="menu_bg" id="menu_bg" value="{{ old('menu_bg', $navigationTile->menu_bg) }}" class="me-2 form-control form-control-color">
        <label for="menu_bg">Menu Background Color</label>
    </div>

    <div class="form-group d-flex align-items-center mb-2">
        <input type="color" name="menu_link_color" id="menu_link_color" value="{{ old('menu_link_color', $navigationTile->menu_link_color) }}" class="me-2 form-control form-control-color">
        <label for="menu_link_color">Menu Link Color</label>
    </div>

    <div class="form-group d-flex align-items-center mb-2">
        <input type="color" name="menu_link_hover_color" id="menu_link_hover_color" value="{{ old('menu_link_hover_color', $navigationTile->menu_link_hover_color) }}" class="me-2 form-control form-control-color">
        <label for="menu_link_hover_color">Menu Hover Color</label>
    </div>

    <div class="form-group d-flex align-items-center mb-2">
        <input type="color" name="button_bg" id="button_bg" value="{{ old('button_bg', $navigationTile->button_bg) }}" class="me-2 form-control form-control-color">
        <label for="button_bg">Button Background Color</label>
    </div>

    <div class="form-group d-flex align-items-center mb-2">
        <input type="color" name="title_color" id="title_color" value="{{ old('title_color', $navigationTile->title_color) }}" class="me-2 form-control form-control-color">
        <label for="title_color">Title Color</label>
    </div>

    <div class="form-group d-flex align-items-center mb-2">
        <input type="color" name="title_border_color" id="title_border_color" value="{{ old('title_border_color', $navigationTile->title_border_color) }}" class="me-2 form-control form-control-color">
        <label for="title_border_color">Title Border Color</label>
    </div>

    <div class="form-group d-flex align-items-center mb-2">
        <input type="color" name="badge_bg" id="badge_bg" value="{{ old('badge_bg', $navigationTile->badge_bg) }}" class="me-2 form-control form-control-color">
        <label for="badge_bg">Badge Background Color</label>
    </div>

    <div class="form-group d-flex align-items-center mb-2">
        <input type="color" name="badge_color" id="badge_color" value="{{ old('badge_color', $navigationTile->badge_color) }}" class="me-2 form-control form-control-color">
        <label for="badge_color">Badge Color</label>
    </div>

    <div class="form-group mt-4">
        <button type="submit" class="btn btn-primary">Save Navigation Tile</button>
    </div>
</form>
