<div>
    <div class="max-width-780 card card-body p-lg-4 px-xl-5 border-0 mx-auto">
        <p class="fs-4 fw-bold text-uppercase text-center text-accent mt-1">Enter your eligibility criteria:</p>
        @if($showTrialsError)
            <div class="text-danger text-center fs-6">{{ $showTrialsError }}</div>
        @endif
        <div class="row">
            <div class="col-12 col-lg-6 my-3">
                <div class="mb-1">
                     <label for="age" class="h5 text-primary white-on-dark mb-0">Your Age</label>
                 </div>
                 <div>
                     <div class="input-group">
                         <input wire:model="age" type="number" id="age" step="1" class="form-control form-control-lg">
                         <span class="input-group-text">years</span>
                     </div>
                 </div>
            </div>
            <div class="col-12 col-lg-6 my-3">
                <div class="mb-1">
                     <label for="sex" class="h5 text-primary white-on-dark mb-0">Your Sex</label>
                 </div>
                 <div>
                     <select wire:model="sex" id="sex" class="form-select form-select-lg">
                         <option value=""></option>
                        @foreach($sexOptions as $option)
                             <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                     </select>
                 </div>
            </div>
        </div>
        <div class="my-3">
             <div class="mb-1">
                 <label for="healthy" class="h5 text-primary white-on-dark mb-0">
                     <span class="me-1">Are you a healthy volunteer?</span>
                     <i class="fa-sharp fa-solid fa-circle-question text-body-tertiary" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="<strong>Healthy Volunteer:</strong> Someone with no known significant health problems who participates in research"></i>
                 </label>
             </div>
             <div>
                 <select wire:model="healthy" id="healthy" class="form-select form-select-lg w-auto min-width-120">
                     <option value=""></option>
                     <option value="{{ \App\Models\Clinicaltrial::HEALTHY_YES }}">{{ \App\Models\Clinicaltrial::HEALTHY_YES }}</option>
                     <option value="{{ \App\Models\Clinicaltrial::HEALTHY_NO }}">{{ \App\Models\Clinicaltrial::HEALTHY_NO }}</option>
                 </select>
             </div>
        </div>
        <div>
            @if($healthy === 'No')
                <div class="my-3">
                    <label for="conditions" class="h5 text-primary white-on-dark mb-1">
                         What condition(s) do you have?
                    </label>
                    <div>
                        @if($conditions)
                            <ul class="list-group rounded-0 mb-2">
                                @foreach($conditions as $id => $condition)
                                    <li class="list-group-item d-flex align-items-center justify-content-between">
                                        <span>{{ $condition }}</span>
                                        <button wire:click="removeCondition({{ $id }})" class="btn text-danger rounded-0">
                                            <i class="fa-sharp fa-regular fa-xmark"></i>
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div>
                        <input wire:model="conditionSearch" type="text" id="conditions" class="form-control form-control-lg" placeholder="Search for conditions">
                    </div>
                    @if($this->conditionSearch)
                        <div class="faux-search-box-container">
                            <div class="faux-search-box-results">
                                <ul class="list-group list-group-flush">
                                    @forelse($this->conditionSearchResults as $result)
                                        <li class="list-group-item list-group-item-action p-0">
                                            <button wire:click="assignCondition('{{ $result['id'] }}')" class="btn text-start w-100 fw-normal rounded-0">
                                                <span>{{ $result['name'] }}</span>
                                                <span class="ms-1 text-secondary">({{ $result['related_count'] }})</span>
                                            </button>
                                        </li>
                                    @empty
                                        <li class="list-group-item">
                                            No matches for your search
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <div class="my-3">
             <div class="h5 mb-1 text-primary white-on-dark">What treatment(s) interest you?</div>
             <div class="row">
                @foreach($focusOptions as $focus)
                    <div class="col-12 col-md-6 col-lg-4">
                        @if(in_array($focus['name'], $treatments))
                            <button wire:click="removeTreatment('{{ $focus['id'] }}')" class="btn rounded-0 text-start text-accent">
                                <i class="fa-sharp fa-regular fa-check"></i>
                                <span class="ms-1">{{ $focus['name'] }}</span>
                            </button>
                        @else
                            <button wire:click="addTreatment('{{ $focus['id'] }}')" class="btn rounded-0 text-start">
                                <i class="fa-sharp fa-regular fa-plus"></i>
                                <span class="ms-1">{{ $focus['name'] }}</span>
                            </button>
                        @endif
                    </div>
                @endforeach
             </div>
         </div>

        <div class="mt-3 mb-2 text-center">
            <button wire:click="showTrials" class="btn btn-accent btn-lg">Find clinical trials</button>
        </div>
    </div>

    <div id="recruiting-trial-results" class="pt-5">
        @if($showClinicalTrials)
            <div class="bg-body-tertiary py-5 mt-4">
                <div>
                    <p class="fs-2 text-center text-body-emphasis">There are {{ number_format($records->total(), 0) }} clinical trials you might be eligible for:</p>

                    <div class="row mt-4 max-width-1000 mx-auto">
                        @forelse($records as $record)
                            <div wire:key="{{ $record->id }}" class="col-12 mb-4">
                                <div wire:click="goListing('{{ $record->id }}')" class="bg-body p-3 recruiting-trial-item card card-body">

                                    <p class="name fs-5 text-primary m-0">{{ $record->name }}</p>

                                    <div class="d-md-flex">
                                        <div class="sponsor mt-2">
                                            @if($record->leadSponsor)
                                                <div class="lead-sponsor">
                                                    <img src="{{ $record->lead_sponsor_image }}" alt="{{ $record->leadSponsor->name }}">
                                                    <div class="mt-2">
                                                        <div class="fw-bold">{{ $record->leadSponsor->name }}</div>
                                                        <small class="fst-italic">Lead Sponsor</small>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="mt-3 lead fst-italic text-body-tertiary">Lead sponsor unlisted</div>
                                            @endif
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex flex-wrap justify-content-start text-body-secondary mt-3 fs-6">
                                                @foreach ($record->focus as $focus)
                                                    <span class="badge bg-body-secondary text-body text-uppercase me-2 mb-2">{{ $focus->name }}</span>
                                                @endforeach
                                            </div>

                                            @if($record->conditions->count() > 0)
                                                <div class="mt-2 mb-3 text-body">
                                                    <strong class="me-1 text-uppercase">Conditions:</strong>
                                                    @foreach ($record->conditions as $item)
                                                        <span>{{ $item->value }}</span>
                                                        @if(!$loop->last) <span class="mx-1 text-body-tertiary">/</span> @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                            <div class="d-flex flex-wrap">
                                                <div class="me-4">
                                                    <strong class="text-uppercase">Start Date:</strong> {{ $record->pretty_start_date }}
                                                </div>
                                                <div>
                                                    <strong class="text-uppercase">Last Updated:</strong> {{ $record->pretty_last_update_posted }}
                                                </div>
                                            </div>
                                            @if($record->responsibleParty)
                                                <div class="mt-3">
                                                    <strong class="text-uppercase me-1">Responsible Party:</strong>
                                                    <span>{{ $record->responsibleParty->name }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div wire:key="empty" class="w-100">
                                <div class="bg-body p-3 py-lg-5 card card-body">
                                    <div class="h3 text-primary text-center">
                                        No clinical trials match your search criteria.
                                    </div>
                                    @if($conciergeSuccess)
                                        <div class="fs-4 fw-bold text-accent text-center">
                                            {{ $conciergeSuccess }}
                                        </div>
                                    @else
                                        <p class="lead text-center">If you'd like us to help you find a matching clinical trial, fill out the form below.</p>
                                        <form wire:submit.prevent="submit" class="px-lg-5 max-width-740 mx-auto">
                                            <div class="row">
                                                <div class="col-12 col-lg-6 mb-3">
                                                    <label for="name" class="fw-bold text-uppercase">Name</label>
                                                    <input wire:model="name" type="text" class="form-control @error('name') is-invalid @enderror" value="" id="name">
                                                </div>
                                                <div class="col-12 col-lg-6 mb-3">
                                                    <label for="email" class="fw-bold text-uppercase">Email</label>
                                                    <input wire:model="email" type="text" class="form-control @error('email') is-invalid @enderror" value="" id="email">
                                                </div>
                                                <div class="col-12">
                                                    <label for="comments" class="fw-bold text-uppercase">Anything we should know?</label>
                                                    <textarea wire:model="message" id="comments" class="form-control @error('message') is-invalid @enderror" cols="30" rows="4"></textarea>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <button type="submit" class="btn btn-primary btn-lg">Find me a match</button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="mt-5">
                    {{ $records->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
