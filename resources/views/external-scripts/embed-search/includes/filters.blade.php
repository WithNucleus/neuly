<div class="col-3 bg-light nes-filter">
    <div class="title clearfix">
        <div class="h3 border-bottom pb-2 filter-title">
            Filters
            <span class="nes-filter-reset"></span>
        </div>
    </div>
    <div class="sidebar-sticky">
        @isset($filters['has-events'])
            <div class="nes-filter-item nes-filter-has-events"></div>
        @endisset
        @isset($filters['has-jobs'])
            <div class="nes-filter-item nes-filter-has-jobs"></div>
        @endisset
        @isset($filters['type'])
            <div class="h4">Type:</div>
            <div class="nes-filter-item nes-filter-type"></div>
        @endisset
        @if(isset($filters['countries']) || isset($filters['locations']))
            <div class="h4">Locations:</div>
            @isset($filters['countries'])
                <div class="nes-filter-item nes-filter-countries"></div>
            @endisset
            @isset($filters['locations'])
                <div class="nes-filter-item nes-filter-locations"></div>
            @endisset
        @endif
        @isset($filters['focus'])
            <div class="h4">Focus:</div>
            <div class="nes-filter-item nes-filter-focus" data-name="focus" @isset($filters['focus']['prefilter']) data-prefilter='{{ json_encode($filters['focus']['prefilter'], JSON_FORCE_OBJECT) }}' @endisset></div>
        @endisset
        @isset($filters['people'])
            <div class="h4">{{ isset($labels['people']) ? $labels['people'] : 'People' }}:</div>
            <div class="nes-filter-item nes-filter-people"></div>
        @endisset
        @isset($filters['companies'])
            <div class="h4">{{ isset($labels['companies']) ? $labels['companies'] : 'Organizations' }}:</div>
            <div class="nes-filter-item nes-filter-companies"></div>
        @endisset
        @isset($filters['status'])
            <div class="h4">Status:</div>
            <div class="nes-filter-item nes-filter-status"></div>
        @endisset
    </div>
</div>
