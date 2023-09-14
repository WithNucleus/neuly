<div class="d-flex flex-column flex-lg-row w-100">
    <div class="entity-index-sidebar">
        <x-entities.offcanvas-sidebar>
            <h3 class="d-none d-lg-block mb-4 text-body-emphasis">Filters</h3>

            <x-livewire-filters.search label="Search locations" placeholder="Search" search="{{ $search }}" />

            <div>
                <button wire:click="clearFilters" class="btn btn-sm btn-secondary">Clear Filters</button>
            </div>
        </x-entities.offcanvas-sidebar>
    </div>
    <div class="entity-index-listings w-100">
        <div class="row">
            <div class="col-12 d-md-flex justify-content-between align-items-end">
                <h1 class="me-4 mb-md-0 text-body-emphasis">locations</h1>
                <div class="lead">
                    {{ $records->total() }} locations
                </div>
            </div>
            <div class="col-12 my-3">
                <x-entities.offcanvas-sidebar-toggle />
                <div>
                </div>
            </div>
            <table class="table align-middle table-hover">
                <thead>
                    <tr>
                        <th>
                            <x-entities.entity-index-sort-button label="Name" field="name" :sorts="$sorts" />
                        </th>
                        <th>
                            <x-entities.entity-index-sort-button label="Companies" field="companies_count" :sorts="$sorts" />
                        </th>
                        <th>
                            <x-entities.entity-index-sort-button label="People" field="people_count" :sorts="$sorts" />
                        </th>
                        <th>
                            <x-entities.entity-index-sort-button label="Investors" field="investors_count" :sorts="$sorts" />
                        </th>
                        <th>
                            <x-entities.entity-index-sort-button label="Clinical Trials" field="clinicaltrials_count" :sorts="$sorts" />
                        </th>
                        <th>
                            <x-entities.entity-index-sort-button label="Jobs" field="jobs_count" :sorts="$sorts" />
                        </th>
                        <th>
                            <x-entities.entity-index-sort-button label="Events" field="events_count" :sorts="$sorts" />
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $location)
                        <tr wire:key="{{ $location->slug }}" class="fs-6">
                            <td class="fs-normal">
                                <a href="{{ route('discover.locations.show', $location->slug) }}">
                                    {{ $location->name }}
                                </a>
                            </td>
                            <td>{{ $location->companies_count }}</td>
                            <td>{{ $location->people_count }}</td>
                            <td>{{ $location->investors_count }}</td>
                            <td>{{ $location->clinicaltrials_count }}</td>
                            <td>{{ $location->jobs_count }}</td>
                            <td>{{ $location->events_count }}</td>
                        </tr>
                    @empty
                        <tr wire:key="empty">
                            <td class="lead" colspan="99">
                                No locations match your search criteria.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mb-5">
            {{ $records->links() }}
        </div>
    </div>

</div>
