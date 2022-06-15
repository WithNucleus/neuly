window.addEventListener('load', () => {
    nucleusNavTile();
    sortNucleusNavTiles();
});

function nucleusNavTile() {
    // Stylesheet
    const navTileDefaultStylesheet  = document.createElement('link');
    navTileDefaultStylesheet.id   = navTileDefaultStylesheet;
    navTileDefaultStylesheet.rel  = 'stylesheet';
    navTileDefaultStylesheet.type = 'text/css';
    navTileDefaultStylesheet.href = '{{ route('nav-tiles.style', $navigationTile->slug) }}';
    navTileDefaultStylesheet.media = 'all';
    document.body.appendChild(navTileDefaultStylesheet);

    // Script
    const navTileDefaultScript = document.createElement('script');
    navTileDefaultScript.src = '{{ url('/') .mix('js/nav-tiles.js') }}';
    document.body.appendChild(navTileDefaultScript);

    // Nav Tile Button
    const navTileElement = document.createElement("div");
    navTileElement.className = "nucleus-nav-tile js-nucleus-nav-tiles";

    const navTileButton = document.createElement("button");
    navTileButton.className = "btn";
    navTileButton.id = "toggle-nucleus-nav-tile";
    navTileButton.setAttribute("data-toggle", "tooltip");
    navTileButton.setAttribute("data-placement", "left");
    navTileButton.setAttribute("title", "Navigate Nucleus");

    const navTileButtonImage = document.createElement("img");
    navTileButtonImage.src = "{{ asset('images/nucleus-icon.png') }}";
    navTileButton.appendChild(navTileButtonImage);

    navTileElement.appendChild(navTileButton);

    document.body.appendChild(navTileElement);

    // Backdrop
    const navTileBackdrop = document.createElement('div');
    navTileBackdrop.id = "nucleus-nav-menu-backdrop";
    navTileBackdrop.style.display = "none";
    document.body.appendChild(navTileBackdrop);

    // Nav Menu Div
    const navTileMenu = document.createElement('div');
    navTileMenu.id = "nucleus-nav-menu";
    navTileMenu.style.display = "none";
    document.body.appendChild(navTileMenu);

    const navTileMenuList = document.createElement('ul');
    navTileMenuList.className = "nav-links";
    navTileMenu.appendChild(navTileMenuList);

    const navTileItems = <?php echo json_encode($navItems); ?>;

    for (let navTileItem of Object.values(navTileItems)) {

        let element = document.createElement('li');

        // Title or Link
        if (navTileItem.type === "title") {
            // title
            element.className = "title";
            element.appendChild(document.createTextNode(navTileItem.name));
        } else {
            // link
            element.className = "nav-link-item";

            // URL
            if (navTileItem.url !== null) {
                let linkElement = document.createElement('a');
                linkElement.setAttribute('href', navTileItem.url);
                linkElement.setAttribute('target', '_blank');
                linkElement.setAttribute('rel', 'noopener noreferrer');
                linkElement.appendChild(document.createTextNode(navTileItem.name));
                element.appendChild(linkElement);
            } else {
                element.appendChild(document.createTextNode(navTileItem.name));
            }

            // Badge
            if (navTileItem.badge !== null) {
                let badgeElement = document.createElement('span');
                badgeElement.className = "badge";
                badgeElement.appendChild(document.createTextNode(navTileItem.badge));
                element.appendChild(badgeElement);
            }
        }

        navTileMenuList.appendChild(element);
    }
}

function sortNucleusNavTiles() {
    var navTiles = document.getElementsByClassName("js-nucleus-nav-tiles");
    var cssBottomValue = 0.25;

    /* iterate from last item to first) */
    for (var i = navTiles.length - 1; i >= 0; i--) {
        navTiles.item(i).style.bottom = cssBottomValue + 'rem';
        cssBottomValue = cssBottomValue + 3.25;
    }
}
