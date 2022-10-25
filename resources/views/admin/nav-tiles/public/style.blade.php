@import '{{ url('/') . mix('css/nav-tiles.css') }}';

/* Tile Button */
.nucleus-nav-tile {
    {{ $navigationTile->placement }}: 0.25rem;
}

.nucleus-nav-tile .btn {
    background-color: {{ $navigationTile->button_bg }};
}

.nucleus-nav-tile .btn:focus {
    outline: 0;
    box-shadow: 0 0 0 0.2rem {{ $navigationTile->button_bg }}50;
    -webkit-box-shadow:0 0 0 0.2rem {{ $navigationTile->button_bg }}50;
    -moz-box-shadow: 0 0 0 0.2rem {{ $navigationTile->button_bg }}50;
}

/* Menu */
#nucleus-nav-menu {
    background-color: {{ $navigationTile->menu_bg }};
    color: {{ $navigationTile->menu_link_color }};
    {{ $navigationTile->placement }}: 0.25rem;
}

#nucleus-nav-menu a {
    color: {{ $navigationTile->menu_link_color }};
}

#nucleus-nav-menu a:hover {
    color: {{ $navigationTile->menu_link_hover_color }};
}

#nucleus-nav-menu .title {
    color: {{ $navigationTile->title_color }};
    border-color: {{ $navigationTile->title_border_color }};
}

#nucleus-nav-menu span.badge {
    background-color: {{ $navigationTile->badge_bg }};
    color: {{ $navigationTile->badge_color }};
}
