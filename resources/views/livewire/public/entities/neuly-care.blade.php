<div>
    <div>
            <div>$ipLatitude: {{ $ipLatitude }}</div>
            <div>$ipLongitude: {{ $ipLongitude }}</div>
            <div>$latitude: {{ $latitude }}</div>
            <div>$longitude: {{ $longitude }}</div>
            <div>$savedLocation: {{ print_r($savedLocation) }}</div>
            <div>
                <div class="d-lg-flex align-items-center">

                    <div class="filter-widget me-4">
                        <div class="btn-group">
                            <button type="button" class="btn btn-md @if($filters['selected-conditions']) has-pink-border @endif btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                I would like help with
                            </button>
                            <ul class="dropdown-menu" style="min-width: 300px">
                                @foreach ($optionsConditions as $option)
                                    <li class="px-3">
                                        <div class="form-check form-check-small form-check-inline">
                                            <input wire:model="filters.selected-conditions" class="form-check-input" type="checkbox" value="{{ $option }}"
                                                   id="filter-condition-{{ $option }}" @if(in_array($option, $filters['selected-conditions'])) checked @endif>
                                            <label class="form-check-label @if(in_array($option, $filters['selected-conditions'])) fw-bold @endif" for="filter-condition-{{ $option }}">
                                                {{ $option }}
                                            </label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="filter-widget me-4">
                        <div class="btn-group">
                            <button type="button" class="btn btn-md @if($filters['selected-services']) has-pink-border @endif btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                I'm looking for
                            </button>
                            <ul class="dropdown-menu" style="min-width: 300px">
                                @foreach ($optionsServices as $option)
                                    <li class="px-3">
                                        <div class="form-check form-check-inline">
                                            <input wire:model="filters.selected-services" class="form-check-input" type="checkbox" value="{{ $option }}"
                                                   id="filter-service-{{ $option }}" @if(in_array($option, $filters['selected-services'])) checked @endif>
                                            <label class="form-check-label @if(in_array($option, $filters['selected-services'])) fw-bold @endif" for="filter-service-{{ $option }}">
                                                {{ $option }}
                                            </label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="filter-widget me-4">
                        <div class="btn-group">
                            <button type="button" class="btn btn-md @if($filters['selected-treatments']) has-pink-border @endif btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                I'm interested in
                            </button>
                            <ul class="dropdown-menu">
                                @foreach ($optionsTreatments as $option)
                                    <li class="px-3">
                                        <div class="form-check form-check-inline">
                                            <input wire:model="filters.selected-treatments" class="form-check-input" type="checkbox" value="{{ $option }}"
                                                   id="filter-treatment-{{ $option }}" @if(in_array($option, $filters['selected-treatments'])) checked @endif>
                                            <label class="form-check-label @if(in_array($option, $filters['selected-treatments'])) fw-bold @endif" for="filter-treatment-{{ $option }}">
                                                {{ $option }}
                                            </label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="filter-widget me-4">
                        <div class="lead-lg form-check">
                            <input wire:model="virtual" class="form-check-input" type="checkbox" id="telehealth">
                            <label class="form-check-label fw-bold text-tertiary" for="telehealth">
                                Telehealth / Virtual
                            </label>
                        </div>
                    </div>

                    <div class="filter-widget">
                        @if ($filters['selected-treatments'] OR $filters['selected-conditions'] OR $filters['selected-services'])
                            <button wire:click="resetFilters()" class="btn p-0 ms-1">
                                <i class="fa-sharp fa-solid fa-circle-xmark"></i> Clear Filters
                            </button>
                        @endif
                    </div>
                </div>
                <div class="d-md-flex flex-wrap mb-3">
                    @if ($listings->total() > 0)
                            <div class="me-3 fw-bold">
                            <span>{{ $listings->total() }}</span>
                            <span>
                                @if ($listings->total() > 1)
                                    <span>results</span>
                                @else
                                    <span>result</span>
                                @endif
                            </span>
                        </div>
                    @endif

                    @if($location)
                        <div class="d-inline-flex me-3">
                            <span>{{ $location }}</span>
                            <button wire:click="clearGeoSearch" class="btn btn-link text-primary p-0 ms-2">
                                <i class="fa-sharp fa-solid fa-circle-xmark"></i>
                            </button>
                        </div>
                    @endif

                    @if ($filters['selected-conditions'])
                        <div class="d-inline-flex me-3">
                            @foreach($filters['selected-conditions'] as $option)
                                <span>{{ $option }}</span> @if(!$loop->last) <span class="text-muted mx-1">/</span> @endif
                            @endforeach
                            <button wire:click="resetFilterArray('selected-conditions')" class="btn btn-link text-primary p-0 ms-1">
                                <i class="fa-sharp fa-solid fa-circle-xmark"></i>
                            </button>
                        </div>
                    @endif

                    @if ($filters['selected-services'])
                        <div class="d-inline-flex me-3">
                            @foreach($filters['selected-services'] as $option)
                                <span>{{ $option }}</span> @if(!$loop->last) <span class="text-muted mx-1">/</span> @endif
                            @endforeach
                            <button wire:click="resetFilterArray('selected-services')" class="btn btn-link text-primary p-0 ms-1">
                                <i class="fa-sharp fa-solid fa-circle-xmark"></i>
                            </button>
                        </div>
                    @endif

                    @if ($filters['selected-treatments'])
                        <div class="d-inline-flex me-3">
                            @foreach($filters['selected-treatments'] as $option)
                                <span>{{ $option }}</span> @if(!$loop->last) <span class="text-muted mx-1">/</span> @endif
                            @endforeach
                            <button wire:click="resetFilterArray('selected-treatments')" class="btn btn-link text-primary p-0 ms-1">
                                <i class="fa-sharp fa-solid fa-circle-xmark"></i>
                            </button>
                        </div>
                    @endif
                </div>
                <div class="mt-5">
                    <div id="listings-index" class="row">
                        @foreach($listings as $listing)
                            <x-entities.entity-logo-card url="{{ route('discover.bookable-listing.show', $listing->slug) }}" linkClasses="py-5">
                                <div>
                                    @if ($listing->bookable_type == \App\Models\Person::class)
                                        <div class="bookable-image rounded-circle"
                                         style="background-image: url('{{ $listing->image ?? asset('images/person-blank.png') }}');">
                                            <span class="visually-hidden">{{ $listing->name }}</span>
                                        </div>
                                    @else
                                        <div class="bookable-image"
                                         style="background-image: url('{{ $listing->image ?? asset('images/image-placeholder.jpg') }}');">
                                            <span class="visually-hidden">{{ $listing->name }}</span>
                                        </div>
                                    @endif
                                </div>
                                <address class="text-dark">
                                    @if($bookableListing->address)
                                        <span class="d-block">{{$bookableListing->address }}</span>
                                    @endif
                                    @if ($bookableListing->location_name)
                                        <span class="d-block">{{ $bookableListing->location_name }}</span>
                                    @endif
                                </address>
                                @if($bookableListing->virtual === 1)
                                    <div class="d-block text-muted">Virtual / Remote</div>
                                @endif

                            </x-entities.entity-logo-card>
                        @endforeach
                        @if ($listings->total() <= 3)
                            <div class="listing-item">
                                <div class="listing-item-link no-results">
                                    <div class="title">We'll find what you're looking for</div>
                                    <div class="content">
                                        <livewire:forms.finder-opt-in-form />
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div id="listings-sidebar" class="col-12 col-md-4 col-lg-3 offset-lg-1 mb-4">
                        <div class="bg-secondary text-white fw-bolder py-2 px-3">
                            <h2 class="h1 text-primary text-lowercase">We'll find it</h2>
                            <p class="fw-bold">Psychedelic Finder Concierge will handle the hard work and find you the perfect match.</p>
                            <p class="mb-1"><a href="" class="btn btn-info d-block">find my match!</a></p>
                        </div>

                        <div class="mt-5 bg-white py-2 px-3">
                            <h2 class="h3 mb-3 fw-bold"><span class="text-primary">Telehealth</span> makes it easy to get help from <em>anywhere</em></h2>
                            <ul class="lead-sm list-style-plus">
                                <li>Talk your to provider from your home or office</li>
                                <li>Schedule appointments when they work for you</li>
                                <li>You won't spread or catch infectious diseases</li>
                            </ul>
                            <h3 class="h5 text-center text-muted">Virtual Care Partners</h3>
                            <div class="px-4 py-2 mx-auto" style="max-width: 240px">
                                <a href="/listings/nue-life">
                                    <img src="https://pf.neuly.com/build/assets/logo-nuelife.4b4615b7.webp" alt="nue.life">
                                </a>
                            </div>
                            <div class="px-4 py-2 mx-auto" style="max-width: 240px">
                                <a href="/listings/ketamd">
                                    <img src="https://pf.neuly.com/build/assets/logo-ketamd.135c3d3c.webp" alt="KetaMD">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="my-3">
                    {{ $listings->links() }}
                </div>
            </div>
    </div>

    @push('end')
        <script>
            Livewire.on('gotoTop', () => {
                window.scrollTo({
                    top: document.getElementById('listings').offsetTop,
                    behaviour: 'smooth'
                })
            })
        </script>

        <script src="{{ asset('resources/sass/choices.scss') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js"></script>
        <script>
            const conditionsElement = document.getElementById('conditions');

            const conditionsChoice = new Choices(conditionsElement);
            const treatmentsChoice = new Choices(document.getElementById('treatments'));
            const servicesChoice = new Choices(document.getElementById('services'));
            // const populationsChoice = new Choices(document.getElementById('populations'));
            // const racesChoice = new Choices(document.getElementById('races'));

            conditionsElement.addEventListener('addItem', function(event) {
               console.log(event.detail);
            });
        </script>
    @endpush
</div>
