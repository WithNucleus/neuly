<div class="d-md-flex justify-content-between align-items-center">
    {{-- Sorting --}}
    @isset($sort)
        <div class="sort-container font-size-small mt-3 mb-3">
            <strong class="text-uppercase mr-3 text-black-50">Sort by:</strong>
            <div class="d-inline sort-name text-uppercase">

                @if(Route::is('discover.events') || Route::is('embeds.events.index'))
                    @include('discover.includes.filters.sort-button-default', [
                        'asc' => '-date',
                        'desc' => 'date',
                        'label' => 'Date'
                    ])
                @else
                    @include('discover.includes.filters.sort-button-default', [
                        'asc' => 'date',
                        'desc' => '-date',
                        'label' => 'Date'
                    ])
                @endif

                @include('discover.includes.filters.sort-button', [
                    'asc' => 'name',
                    'desc' => '-name',
                    'label' => 'Name'
                ])

            </div>
        </div>
    @endisset
    @if(Route::is('embeds.events.index') === false)
    <nav class="events-nav lead mb-3 mb-md-0">
        @if(Route::is('discover.events'))
            <a href="{{ route('discover.events.past') }}" class="text-uppercase">Past Events <i class="fad fa-chevron-double-right"></i></a>
        @else
            <a href="{{ route('discover.events') }}" class="text-uppercase"><i class="fad fa-chevron-double-left"></i> Upcoming Events</a>
        @endif
    </nav>
    @endif
</div>

{{-- Filters --}}
@if (
    isset($filters_location) && $filters_location OR
    isset($filters_company_name) && $filters_company_name OR
    isset($filters_focus) && $filters_focus OR
    isset($filters_type) && $filters_type
)
<div class="current-filter-list font-size-small align-self-end border-bottom mb-3 pb-1">
    <strong class="text-uppercase mr-3 text-black-50">Current Filters:</strong>

    @if(isset($filters_type) && $filters_type)
        @include('discover.includes.filters.current-filter', [
            'iconClass' => 'fa-briefcase',
            'items' => $filters_type
        ])
    @endif

    @if(isset($filters_location) && $filters_location)
        @include('discover.includes.filters.current-filter', [
            'iconClass' => 'fa-map-marker-alt',
            'items' => $filters_location
        ])
    @endif

    @if(isset($filters_focus) && $filters_focus)
        @include('discover.includes.filters.current-filter', [
            'iconClass' => 'fa-tags',
            'items' => $filters_focus
        ])
    @endif

    @if(isset($filters_company_name) && $filters_company_name)
        @include('discover.includes.filters.current-filter', [
            'iconClass' => 'fa-building',
            'items' => $filters_company_name
        ])
    @endif
</div>
@endif
