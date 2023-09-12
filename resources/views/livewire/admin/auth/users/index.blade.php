<div>
    <div class="d-md-flex flex-wrap">

        <div class=" me-md-5 mb-3">
            <x-livewire-filters.search label="Search" placeholder="Search" search="{{ $search }}" tooltip="Search by name, email, role, etc." />
        </div>

        <div class="filter-widget me-md-5 mb-3">
            <div class="btn-group">
                <button type="button" class="btn btn-md @if($filters['roles']) btn-accent @else btn-primary @endif btn-primary dropdown-toggle rounded-0" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter by Role
                </button>
                <ul class="dropdown-menu" style="min-width: 220px">
                    @foreach ($roleOptions as $option)
                        <li class="px-3">
                            <div class="form-check form-check-small form-check-inline">
                                <input wire:model="filters.roles" class="form-check-input" type="checkbox" value="{{ $option['name'] }}"
                                       id="filter-roles-{{ $option['id'] }}" @if(in_array($option['name'], $filters['roles'])) checked @endif>
                                <label class="form-check-label @if(in_array($option['name'], $filters['roles'])) fw-bold @endif" for="filter-roles-{{ $option['id'] }}">
                                    <span>{{ $option['name'] }}</span>
                                    <small class="text-secondary">({{ $option['users_count'] }})</small>
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="filter-widget me-md-5 mb-3">
            <div class="form-check">
                <input wire:model="filters.has-bookable-listings" class="form-check-input" type="checkbox" id="has-bookable-listings">
                <label class="form-check-label" for="has-bookable-listings">
                    <span>Has Bookable Listings</span>
                </label>
            </div>
        </div>

        <div class="filter-widget ms-auto">
            <button wire:click="clearFilters" class="btn btn-sm btn-dark rounded-0">Clear Filters</button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-sm small table-hover align-middle">
            <thead class="text-uppercase fs-6 text-nowrap">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Directory</th>
                    <th>Social Auth</th>
                    <th>Teams</th>
                    <th>Dashboards</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $user)
                    <tr wire:key="role-{{ $user->id }}">
                        <td>
                            {{ $user->id }}
                        </td>
                        <td>
                            <span class="truncate-300">{{ $user->full_name }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items center">
                                <div class="me-2">
                                    @if($user->email_verified_at)
                                        <i class="fa-sharp fa-solid fa-envelope-circle-check fa-fw text-accent"></i>
                                    @else
                                        <i class="fa-sharp fa-solid fa-reply-clock fa-fw text-danger"></i>
                                    @endif
                                </div>
                                <div>{{ $user->email }}</div>
                            </div>
                        </td>
                        <td>
                            @foreach($user->roles as $role)
                                <span class="badge {{ $role->color }} mb-1 me-1">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <div>
                                @if($user->relatedPerson)
                                    <div class="d-flex align-items-center">
                                        <i class="fa-sharp fa-solid fa-users text-primary-light fa-fw me-1"></i>
                                        <a href="{{ route('discover.people.show', $user->relatedPerson->slug) }}">
                                            <span class="truncate-200">
                                                {{ $user->relatedPerson->name }}
                                            </span>
                                        </a>
                                    </div>
                                @endif
                                @if($user->member_url)
                                    <div class="d-flex align-items-center">
                                        <i class="fa-sharp fa-solid fa-link fa-fw text-secondary me-1"></i>
                                        <span class="truncate-200">{{ $user->member_url }}</span>
                                    </div>
                                @endif
                                @if($user->raisedClaim)
                                    <div>
                                        @if($user->raisedClaim->is_approved)
                                            <i class="fa-sharp fa-solid fa-shield-check fa-fw text-accent"></i>
                                        @else
                                            <i class="fa-sharp fa-solid fa-shield-exclamation fw-fw text-warning-bright"></i>
                                        @endif
                                        <span>
                                            {{ $user->raisedClaim->person->name }}
                                        </span>
                                    </div>
                                @endif
                                @if($user->bookableListings->count() > 0)
                                    <div>
                                        <i class="fa-sharp fa-solid fa-bags-shopping fa-fw text-primary"></i>
                                        <span>{{ $user->bookableListings->count() }} Bookable Listings</span>
                                    </div>
                                @endif
                                @if($user->bookableListingRequests->count() > 0)
                                    <div>
                                        <i class="fa-sharp fa-solid fa-cart-circle-check fa-fw text-primary"></i>
                                        <span>{{ $user->bookableListingRequests->count() }} Bookable Listing Requests</span>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            @foreach($user->socialAuth as $auth)
                                <div>
                                    <i class="{{ $auth->icon }}"></i>
                                    <span>{{ $auth->provider_id }}</span>
                                </div>
                            @endforeach
                        </td>
                        <td>
                            <div>
                                @if($user->ownedTeam)
                                    <div>
                                        <i class="fa-sharp fa-solid fa-square-star fa-fw text-primary"></i>
                                        <span>{{ $user->ownedTeam->name }}</span>
                                    </div>
                                @endif
                                @foreach($user->teams as $team)
                                    <div>
                                        <i class="fa-sharp fa-solid fa-user fa-fw text-secondary"></i>
                                        <span>{{ $team->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td>
                            @foreach($user->dashboards as $dashboard)
                                <div>
                                    <i class="fa-sharp fa-strong fa-lightbulb-gear {{ ($dashboard->widget_names) ? 'text-accent' : 'text-secondary opacity-50' }}"></i>
                                    <span>{{ $dashboard->name }}</span>
                                </div>
                            @endforeach
                        </td>
                        <td>{{ $user->pretty_created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-lg-flex align-items-center justify-content-between mt-5">
        <div class="d-flex align-items-center me-4">
            <select wire:model="perPage" id="perPage" class="form-select">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="250">250</option>
            </select>
            <label for="perPage" class="d-block fw-bold ms-2 flex-shrink-0">Per Page</label>
        </div>
        <div>
            {{ $records->links() }}
        </div>
    </div>
    <div class="mt-5">
        <div class="text-uppercase fw-bold m-1">Icon Key</div>
        <div class="w-auto">
            <div class="border pt-3 ps-3 pe-2 pb-2 d-flex flex-wrap small text-uppercase w-auto flex-grow-0 me-auto">
                <div class="mb-2 me-4">
                    <i class="fa-sharp fa-strong fa-lightbulb-gear text-accent"></i>
                    <span>Customized dashboard</span>
                </div>

                <div class="mb-2 me-4">
                    <i class="fa-sharp fa-solid fa-square-star fa-fw text-primary"></i>
                    <span>Team owner</span>
                </div>
                <div class="mb-2 me-4">
                    <i class="fa-sharp fa-solid fa-user fa-fw text-secondary"></i>
                    <span>Team member</span>
                </div>

                <div class="mb-2 me-4">
                    <i class="fa-sharp fa-solid fa-envelope-circle-check fa-fw text-accent"></i>
                    <span>Verified email</span>
                </div>

                <div class="mb-2 me-4">
                    <i class="fa-sharp fa-solid fa-reply-clock fa-fw text-danger"></i>
                    <span>Email not verified</span>
                </div>

                <div class="mb-2 me-4">
                    <i class="fa-sharp fa-solid fa-users fa-fw text-primary-light"></i>
                    <span>Person listing</span>
                </div>

                <div class="mb-2 me-4">
                    <i class="fa-sharp fa-solid fa-link fa-fw text-secondary"></i>
                    <span>Member URL</span>
                </div>

                <div class="mb-2 me-4">
                    <i class="fa-brands fa-facebook text-facebook fa-fw"></i>
                    <span>Facebook</span>
                </div>
                <div class="mb-2 me-4">
                    <i class="fa-brands fa-google text-google fa-fw"></i>
                    <span>Google</span>
                </div>
                <div class="mb-2 me-4">
                    <i class="fa-brands fa-linkedin-in text-linkedin fa-fw"></i>
                    <span>LinkedIn</span>
                </div>
                <div class="mb-2 me-4">
                    <i class="fa-brands fa-twitter text-twitter fa-fw"></i>
                    <span>Twitter</span>
                </div>

                <div class="mb-2 me-4">
                    <i class="fa-sharp fa-solid fa-shield-check fa-fw text-accent"></i>
                    <span>Verified Claim</span>
                </div>
                <div class="mb-2 me-4">
                    <i class="fa-sharp fa-solid fa-shield-exclamation fw-fw text-warning-bright"></i>
                    <span>Raised Claim - Needs Attention</span>
                </div>
            </div>
        </div>
    </div>
</div>
