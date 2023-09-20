<div class="entity-index-listings">
    <div class="container">
        <div class="d-flex flex-column flex-md-row flex-wrap justify-content-center align-items-center">
            <div class="filter-widget d-flex align-items-center me-md-4 mb-3">
                <input wire:model.lazy="search" type="text" class="form-control me-2" placeholder="Search by keyword" aria-label="Search listings">
                <span>
                    <i class="fa-sharp fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Search by keyword, focus, organization, etc."></i>
                </span>
            </div>

            <div class="filter-widget me-md-4 mb-3">
                <div class="btn-group">
                    <button type="button" class="btn btn-md @if($filters['focus']) btn-accent @else btn-primary @endif btn-primary dropdown-toggle rounded-0" data-bs-toggle="dropdown" aria-expanded="false">
                        I'm interested in
                    </button>
                    <ul class="dropdown-menu" style="min-width: 220px">
                        @foreach ($focusOptions as $option)
                            <li class="px-3">
                                <div class="form-check form-check-small form-check-inline">
                                    <input wire:model="filters.focus" class="form-check-input" type="checkbox" value="{{ $option['name'] }}"
                                           id="filter-focus-{{ $option['slug'] }}" @if(in_array($option['name'], $filters['focus'])) checked @endif>
                                    <label class="form-check-label @if(in_array($option['name'], $filters['focus'])) fw-bold @endif" for="filter-focus-{{ $option['slug'] }}">
                                        {{ $option['name'] }} ({{ $option['courses_count'] }})
                                    </label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="filter-widget me-md-4 mb-3">
                <div class="btn-group">
                    <button type="button" class="btn btn-md @if($filters['type']) btn-accent @else btn-primary @endif btn-primary dropdown-toggle rounded-0" data-bs-toggle="dropdown" aria-expanded="false">
                        I'm looking for
                    </button>
                    <ul class="dropdown-menu" style="min-width: 260px">
                        @foreach ($typeOptions as $optionId => $option)
                            <li class="px-3">
                                <div class="form-check form-check-small form-check-inline">
                                    <input wire:model="filters.type" class="form-check-input" type="checkbox" value="{{ $option }}"
                                           id="filter-type-{{ $optionId }}" @if(in_array($option, $filters['type'])) checked @endif>
                                    <label class="form-check-label @if(in_array($option, $filters['type'])) fw-bold @endif" for="filter-type-{{ $optionId }}">
                                        {{ $option }}
                                    </label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-center">
            <div class="filter-widget my-3 me-4">
                <div class="form-check lead">
                    <input wire:model="filters.free" class="form-check-input" type="checkbox" id="filter-free">
                    <label class="form-check-label" for="filter-free">
                        Free Courses
                    </label>
                </div>
            </div>
            <div class="filter-widget my-3 me-4">
                <div class="form-check lead">
                    <input wire:model="filters.open-enrollment" class="form-check-input" type="checkbox" id="filter-open-enrollment">
                    <label class="form-check-label" for="filter-open-enrollment">
                        Open Enrollment
                    </label>
                </div>
            </div>
            <div class="filter-widget my-3">
                <div class="form-check lead">
                    <input wire:model="filters.self-paced" class="form-check-input" type="checkbox" id="filter-self-paced">
                    <label class="form-check-label" for="filter-self-paced">
                        Self Paced
                    </label>
                </div>
            </div>
        </div>
        <div class="d-flex flex-wrap align-items-center justify-content-center">
            @if($search)
                <div class="me-3 mb-3">
                    <span>{{ $search }}</span>
                    <button wire:click="clearSearch" class="btn text-danger px-1 border-0" aria-label="Clear search"><i class="fa-sharp fa-solid fa-circle-xmark"></i></button>
                </div>
            @endif
            @foreach($filters['focus'] as $id => $focus)
                <div class="me-3 mb-3">
                    <span>{{ $focus }}</span>
                    <button wire:click="clearFilter('focus', '{{ $id }}')" class="btn text-danger px-1 border-0" aria-label="Clear search"><i class="fa-sharp fa-solid fa-circle-xmark"></i></button>
                </div>
            @endforeach
            @foreach($filters['type'] as $id => $type)
                <div class="me-3 mb-3">
                    <span>{{ $type }}</span>
                    <button wire:click="clearFilter('type', '{{ $id }}')" class="btn text-danger px-1 border-0" aria-label="Clear search"><i class="fa-sharp fa-solid fa-circle-xmark"></i></button>
                </div>
            @endforeach
        </div>
        <div class="d-md-flex align-items-center justify-content-between max-width-1000 mx-auto">
            <div class="me-3">
                <strong>{{ $records->total() }}</strong><span class="ms-1">results</span>
            </div>
            <div class="filter-widget">
                <button wire:click="clearFilters" class="btn btn-sm btn-ghost-primary">Clear Filters</button>
            </div>
        </div>
        <div class="mt-4">
            @forelse($records as $record)
                <div wire:key="{{ $record->id }}" class="mb-4">
                    <div wire:click="goListing('{{ $record->id }}')" class="neuly-edu-course-item bg-body">
                        <div class="image">
                            <div>
                                <img src="{{ $record->companies->first()->entityImageUrl ?? asset('images/image-placeholder-edu.png') }}"
                                    alt="{{ $record->name }}" class="entity-square-image mb-3">
                                <div class="text-uppercase fw-bold text-body-secondary text-center">{{ $record->companies->first()->name ?? '' }}</div>
                            </div>
                            <div>
                                @if ($record->education_credits)
                                    <div class="lead mt-3">
                                        <span class="badge bg-primary-subtle text-primary-emphasis">
                                            {{ $record->education_credits }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="text">
                            <div>
                                <h2 class="h4 text-success">{{ $record->name }}</h2>
                                @if($record->next_date)
                                    <div class="my-2 lead text-uppercase text-body-emphasis">
                                        <strong>Next
                                            date:</strong> {{ \Carbon\Carbon::parse($record->next_date)->format('M d, Y') }}
                                    </div>
                                @endif
                                @if($record->focus->count() > 0)
                                    <p class="fw-bold mb-2 text-body-secondary text-uppercase">
                                        @foreach ($record->focus as $item)
                                            {{ $item->name }}
                                            @if (!$loop->last)/@endif
                                        @endforeach
                                    </p>
                                @endif
                                <div class="text-start w-100">{{ $record->short_summary }}</div>
                            </div>
                            <div class="d-md-flex justify-content-between mt-3 text-primary text-uppercase fw-bold">
                                <div class="text-start me-4">{{ $record->type }}</div>
                                <div class="text-end">{{ $record->formattedCost }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div wire:key="empty" class="w-100">
                    <div class="border p-4 max-width-780 bg-body mx-auto">
                        <p class="h3 text-primary text-transform-none">
                            <i class="fa-solid fa-books text-accent"></i>
                            No courses match your search criteria.
                        </p>
                        @if($noCoursesConcierge)
                            <div class="lead">Thanks for your interest in Neuly EDU! We'll be in touch soon.</div>
                        @else
                            <div>
                                <p class="lead">We're adding new courses every day, and we'd love to help you find the best educational content tailored to your needs.</p>
                                <form wire:submit.prevent="submit">
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="name" class="fw-bold text-uppercase">Your name</label>
                                            <input wire:model="name" type="text" class="form-control" id="name">
                                            @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="email" class="fw-bold text-uppercase">Email</label>
                                            <input wire:model="email" type="email" class="form-control" id="email">
                                            @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message" class="fw-bold text-uppercase">Tell us what you're interested in</label>
                                        <textarea wire:model="message" name="message" id="message" rows="4" class="form-control"></textarea>
                                        @error('message') <div class="text-danger small">{{ $message }}</div> @enderror
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-accent">Send</button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center my-5">
            {{ $records->links() }}
        </div>
    </div>

    @if($records->count() > 0)
        <div class="bg-body py-5">
           <div class="container text-center">
                <div style="width: 300px" class="mx-auto mb-3">
                    @include('navbars.neuly-edu-logo')
                </div>
                <div>
                    <h2 class="text-body-secondary">Neuly Concierge</h2>
                    <p class="lead max-width-800 mx-auto">We know psychedelic education, and we'd love to help you find courses that are tailored to you. Fill out the form below and Neuly EDU will find you the perfect match!</p>
                    <div class="max-width-600 mx-auto text-start">
                        @if($conciergeSuccess)
                            <div class="lead text-center text-accent fw-bold">Thanks for your interest in Neuly EDU! We'll be in touch soon.</div>
                        @else
                            <div>
                                <form wire:submit.prevent="submitConcierge">
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="name" class="fw-bold text-uppercase">Your name</label>
                                            <input wire:model="name" type="text" class="form-control" id="name">
                                            @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="email" class="fw-bold text-uppercase">Email</label>
                                            <input wire:model="email" type="email" class="form-control" id="email">
                                            @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message" class="fw-bold text-uppercase">Tell us what you're interested in</label>
                                        <textarea wire:model="message" name="message" id="message" rows="4" class="form-control"></textarea>
                                        @error('message') <div class="text-danger small">{{ $message }}</div> @enderror
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-accent">Send</button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
           </div>
        </div>
    @endif

</div>
