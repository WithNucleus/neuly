<div>
    <div class="offcanvas-lg offcanvas-start" tabindex="-1" id="offcanvasSidebar"
         aria-labelledby="offcanvasSidebarLabel">
        <div class="offcanvas-header">
            <h5 class="h3 offcanvas-title" id="offcanvasSidebarLabel">Narrow Your Search</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                    data-bs-target="#offcanvasSidebar" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="w-100">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
