<div class="d-flex flex-column flex-lg-row w-100">
    <div class="entity-index-sidebar">
        <x-entities.offcanvas-sidebar>
            <h3 class="d-none d-lg-block mb-4 text-body-emphasis">Filters</h3>

            <div class="mb-4">
                <x-livewire-filters.checkbox-single wireModel="filters.education-credits" id="filter-education-credits" label="Education Credits" />
                <x-livewire-filters.checkbox-single wireModel="filters.free" id="filter-free" label="Free Courses" />
                <x-livewire-filters.checkbox-single wireModel="filters.open-enrollment" id="filter-open-enrollment" label="Open Enrollment" />
                <x-livewire-filters.checkbox-single wireModel="filters.self-paced" id="filter-self-paced" label="Self Paced" />
            </div>

            <x-livewire-filters.search label="Search courses" placeholder="Search" search="{{ $search }}" tooltip="Search by title, organization, keyword..." />

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Course Type</h4>
                <x-livewire-filters.checkbox-multiple wireModel="filters.type" id="filter-type" :options="$typeOptions" :currentFilters="$filters['type']" />
            </div>

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Delivery Method</h4>
                <x-livewire-filters.checkbox-multiple wireModel="filters.delivery-method" id="filter-delivery-method" :options="$deliveryMethodOptions" :currentFilters="$filters['delivery-method']" />
            </div>

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Focus</h4>
                <x-livewire-filters.checkbox-multiple-with-count wireModel="filters.focus" id="filter-focus" :options="$focusOptions" :currentFilters="$filters['focus']" countName="courses_count" />
            </div>

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Education Credits</h4>
                <x-livewire-filters.checkbox-multiple wireModel="filters.education" id="filter-education" :options="$educationOptions" :currentFilters="$filters['education']" />
            </div>

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Organizations</h4>
                <x-livewire-filters.faux-multi-select
                    wireModelSearch="companySearch"
                    wireModelFilter="filters.companies"
                    label="Search companies"
                    checkboxIdPrefix="filter-company"
                    setFilterFunction="setCompanyFilter"
                    :searchResults="$companySearchResults"
                    :currentFilters="$filters['companies']"
                />
            </div>

            <div>
                <button wire:click="clearFilters" class="btn btn-sm btn-secondary">Clear Filters</button>
            </div>
        </x-entities.offcanvas-sidebar>
    </div>
    <div class="entity-index-listings w-100">
        <div class="row">
            <div class="col-12 d-md-flex justify-content-between align-items-end">
                <h1 class="me-4 mb-md-0 text-body-emphasis">Courses</h1>
                <div class="lead">
                    {{ $records->total() }} Courses
                </div>
            </div>
            <div class="col-12 my-3">
                <x-entities.offcanvas-sidebar-toggle />
                <div>
                    <x-entities.entity-index-sort-button label="Name" field="name" :sorts="$sorts" />
                    <x-entities.entity-index-sort-button label="Date" field="next_date" :sorts="$sorts" />
                </div>
            </div>
        </div>
        <div class="row">
            @forelse($records as $record)
                <div wire:key="{{ $record->id }}">
                    <div class="mb-5 d-lg-flex">
                        <div class="d-flex flex-column flex-md-row border-bottom pb-5">
                            <div class="order-2 order-md-1 flex-shrink-0 mt-3 mt-md-0 me-3 me-lg-4">
                                <img src="{{ $record->entity_image_url ?? asset('images/image-placeholder-course.png') }}" alt="{{ $record->name }}" class="d-none d-md-block entity-square-image mb-3">
                                <div class="d-md-flex flex-column justify-content-lg-center align-items-lg-center">
                                    <a href="{{ route('discover.courses.show', $record->slug) }}" class="btn btn-primary rounded-0 me-2 me-md-0 mb-md-2 text-nowrap">
                                        <span class="d-none d-xl-inline ms-1">More</span><span>Details</span>
                                    </a>
                                </div>
                            </div>
                            <div class="order-1 order-md-2 flex-grow-1 max-width-780">
                                <a href="{{ route('discover.courses.show', $record->slug) }}" class="text-success underline-on-hover">
                                    <h2 class="h4">{{ $record->name }}</h2>
                                </a>
                                @if($record->next_date)
                                    <div class="my-2 lead text-uppercase text-body-emphasis">
                                        <strong>Next date:</strong> {{ \Carbon\Carbon::parse($record->next_date)->format('M d, Y') }}
                                    </div>
                                @endif
                                @if($record->focus->count() > 0)
                                    <p class="lead mb-2 text-body-secondary">
                                        @foreach ($record->focus as $item)
                                            {{ $item->name }}@if (!$loop->last) / @endif
                                        @endforeach
                                    </p>
                                @endif
                                @if ($record->education_credits)
                                    <p class="lead mb-3">
                                        <span class="badge bg-primary-subtle text-primary-emphasis">
                                            {{ $record->education_credits }}
                                        </span>
                                    </p>
                                @endif
                                <div class="text-start w-100">{{ $record->short_summary }}</div>
                                @if($record->companies)
                                    <div class="mb-3">
                                        @foreach($record->companies as $company)
                                            <x-entities.related.company-logo :company="$company" />
                                        @endforeach
                                    </div>
                                @endif
                                <div class="d-md-flex justify-content-between mt-3 text-body-secondary text-uppercase">
                                    <div class="text-start me-4">{{ $record->type }}</div>
                                    <div class="text-end">{{ $record->formattedCost }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @empty
                <div wire:key="empty" class="w-100">
                    <p class="lead mb-0">
                        No courses match your search criteria.
                    </p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mb-5">
            {{ $records->links() }}
        </div>
    </div>

</div>
