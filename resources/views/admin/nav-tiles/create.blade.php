@extends('layouts.admin')

@section('head')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
@endsection

@section('content')
    {{-- Example --}}
    @include('admin.nav-tiles._example')

    <div class="container my-5">
        <h1 class="h2 mb-4">Let's make a new navigation tile!</h1>

        <div class="row">
            <div class="col-12 col-lg-5">
                @if ($errors->navigationTile->count() > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->navigationTile->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('adminx.nav-tiles.store') }}" method="post">
                    @csrf

                    <div class="form-group row mb-4">
                        <div class="col-12 col-md-6">
                            <label for="name" class="fw-bold text-uppercase">Name</label>
                            <input type="text" name="name" id="name" placeholder="Psychedelic Invest" class="form-control">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="domain" class="fw-bold text-uppercase">Domain</label>
                            <input type="text" name="domain" id="domain" placeholder="psychedelicinvest.com" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <div class="col-12 col-md-6">
                            <label for="placement" class="fw-bold text-uppercase">Placement</label>
                            <select class="form-select" name="placement" id="placement">
                                <option value="right">Right</option>
                                <option value="left">Left</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group d-flex align-items-center mb-2">
                        <input type="color" name="menu_bg" id="menu_bg" value="{{ \App\Models\NavigationTile::MENU_BG_COLOR }}"
                               class="me-2 form-control form-control-color">
                        <label for="menu_bg">Menu Background Color</label>
                    </div>

                    <div class="form-group d-flex align-items-center mb-2">
                        <input type="color" name="menu_link_color" id="menu_link_color" value="{{ \App\Models\NavigationTile::MENU_LINK_COLOR }}"
                               class="me-2 form-control form-control-color">
                        <label for="menu_link_color">Menu Link Color</label>
                    </div>

                    <div class="form-group d-flex align-items-center mb-2">
                        <input type="color" name="menu_link_hover_color" id="menu_link_hover_color" value="{{ \App\Models\NavigationTile::MENU_LINK_HOVER_COLOR }}"
                               class="me-2 form-control form-control-color">
                        <label for="menu_link_hover_color">Menu Hover Color</label>
                    </div>

                    <div class="form-group d-flex align-items-center mb-2">
                        <input type="color" name="button_bg" id="button_bg" value="{{ \App\Models\NavigationTile::BUTTON_BG }}"
                               class="me-2 form-control form-control-color">
                        <label for="button_bg">Button Background Color</label>
                    </div>

                    <div class="form-group d-flex align-items-center mb-2">
                        <input type="color" name="title_color" id="title_color" value="{{ \App\Models\NavigationTile::TITLE_COLOR }}"
                               class="me-2 form-control form-control-color">
                        <label for="title_color">Title Color</label>
                    </div>

                    <div class="form-group d-flex align-items-center mb-2">
                        <input type="color" name="title_border_color" id="title_border_color" value="{{ \App\Models\NavigationTile::TITLE_BORDER_COLOR }}"
                               class="me-2 form-control form-control-color">
                        <label for="title_border_color">Title Border Color</label>
                    </div>

                    <div class="form-group d-flex align-items-center mb-2">
                        <input type="color" name="badge_bg" id="badge_bg" value="{{ \App\Models\NavigationTile::BADGE_BG }}"
                               class="me-2 form-control form-control-color">
                        <label for="badge_bg">Badge Background Color</label>
                    </div>

                    <div class="form-group d-flex align-items-center mb-2">
                        <input type="color" name="badge_color" id="badge_color" value="{{ \App\Models\NavigationTile::BADGE_COLOR }}"
                               class="me-2 form-control form-control-color">
                        <label for="badge_color">Badge Color</label>
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">Save Navigation Tile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
