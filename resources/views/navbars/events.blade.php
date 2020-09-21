<div class="d-md-flex justify-content-between align-items-center">
    {{-- Sorting --}}
    @isset($sort)
        <div class="sort-container font-size-small mt-3 mb-3">
            <strong class="text-uppercase mr-3 text-black-50">Sort by:</strong>
            <div class="d-inline sort-name text-uppercase">

                @if(Route::is('discover.events') || Route::is('discover.events.embedIndex'))
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
    @if(Route::is('discover.events.embedIndex') === false)
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
<?php if (
    isset($filters_location) && $filters_location OR
    isset($filters_company_name) && $filters_company_name OR
    isset($filters_type) && $filters_type
    ) : ?>
<div class="current-filter-list font-size-small align-self-end border-bottom mb-3 pb-1">
    <strong class="text-uppercase mr-3 text-black-50">Current Filters:</strong>

    <?php if (isset($filters_type) && $filters_type) : ?>
            <span class="mr-3">
                <i class="fad fa-briefcase text-quaternary"></i>
                @foreach ($filters_type as $type)
                    {{ $type }}
                    @if (!$loop->last) <strong class="text-black-50">/</strong> @endif
                @endforeach
            </span>
    <?php endif; ?>

    <?php if (isset($filters_location) && $filters_location) : ?>
            <span class="mr-3">
                <i class="fad fa-map-marker-alt text-info"></i>
                @foreach ($filters_location as $location)
                    {{ $location }}
                    @if (!$loop->last) <strong class="text-info">/</strong> @endif
                @endforeach
            </span>
    <?php endif; ?>

    <?php if (isset($filters_company_name) && $filters_company_name) : ?>
            <span class="mr-3">
                <i class="fad fa-building text-secondarydark"></i>
                @foreach ($filters_company_name as $company)
                    {{ $company }}
                    @if (!$loop->last) <strong class="text-black-50">/</strong> @endif
                @endforeach
            </span>
    <?php endif; ?>

</div>
<?php endif; ?>
