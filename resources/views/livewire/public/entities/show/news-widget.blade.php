<div wire:poll.visible class="mb-5 d-lg-flex">
    <div class="d-flex border-bottom max-width-780 pb-5">
        <div class="flex-shrink-0 me-3">
            <div class="bg-primary text-center text-white p-2">
                <div class="h5">{{ \Carbon\Carbon::parse($record->date)->format('M') }}</div>
                <div class="h4">{{ \Carbon\Carbon::parse($record->date)->format('d') }}</div>
                <div class="h6 mb-0">{{ \Carbon\Carbon::parse($record->date)->format('Y') }}</div>
            </div>
        </div>
        <div class="flex-grow-1">
            <a href="{{ $record->url }}" target="_blank" rel="noopener noreferrer" class="underline-on-hover text-success">
                <h2 class="h5 mb-2">{{ $record->name }}</h2>
            </a>
            @if($record->summary)
                <div class="my-2">{{ $record->summary }}</div>
            @endif
            <div>{{ $record->source->name }}</div>
            @if($record->focus->count() > 0)
                <div class="d-flex flex-wrap align-items-center lead">
                    @foreach($record->focus as $focus)
                        <span class="me-2 mt-3 badge bg-body-tertiary text-body-emphasis">{{ $focus->name }}</span>
                    @endforeach
                </div>
            @endif
            @if($record->companies->count() > 0 OR $record->people->count() > 0)
                <div class="d-flex flex-wrap align-items-center justify-content-start">
                    @foreach($record->companies as $company)
                        <a href="{{ $company->show_url }}" class="d-block mt-4 me-3" title="{{ $company->name }}">
                            @if($company->entityImageUrl)
                                <img src="{{ $company->entityImageUrl }}" class="img-height-30" alt="{{ $company->name }}" height="30">
                            @else
                                <small class="truncate-100">{{ $company->name }}</small>
                            @endif
                        </a>
                    @endforeach
                    @foreach($record->people as $person)
                        <a href="{{ $person->show_url }}" class="d-block mt-4 me-3">
                            @if($person->entityImageUrl)
                                <img src="{{ $person->entityImageUrl }}" class="img-height-30 rounded-circle" alt="{{ $person->name }}" height="30">
                            @else
                                <small>{{ $person->name }}</small>
                            @endif
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    @can('edit news articles')
        <div class="ms-lg-5 d-flex flex-wrap align-items-start">
            <div class="me-4 d-flex align-items-center">
                <select wire:model.lazy="selectedTag" class="form-control me-2 {{ ($error) ? 'is-invalid' : '' }}" aria-label="Assign Focus" style="width: 190px">
                    <option></option>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
                <button wire:click="saveTag" class="btn btn-sm btn-primary flex-shrink-0">Set Focus</button>
            </div>
            <div class="me-4">
                <div class="d-flex align-items-center">
                    <input wire:model="organizationSearch" type="text" class="form-control" placeholder="Attach organizations" aria-label="Attach organization" style="width: 190px">
                    @if($organizationSearch)
                        <button wire:click="clearField('organizationSearch', 'organizationsList')" class="btn text-danger px-1 border-0 ms-1" aria-label="Clear search">
                            <i class="fa-sharp fa-solid fa-circle-xmark"></i>
                        </button>
                    @endif
                </div>
                <div>
                    @foreach($organizationsList as $organization)
                        <div class="my-2">
                            <button wire:click="saveOrganization('{{ $organization['id'] }}')" class="btn btn-sm btn-outline-primary rounded-0" title="{{ $organization['name'] }}">
                                <span class="truncate-200">{{ $organization['name'] }}</span>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
            <div>
                <div class="d-flex align-items-center">
                    <input wire:model="personSearch" type="text" class="form-control" placeholder="Attach person" aria-label="Attach person" style="width: 190px">
                    @if($personSearch)
                        <button wire:click="clearField('personSearch', 'peopleList')" class="btn text-danger px-1 border-0 ms-1" aria-label="Clear search"><i class="fa-sharp fa-solid fa-circle-xmark"></i></button>
                    @endif
                </div>
                <div>
                    @foreach($peopleList as $person)
                        <div class="my-2">
                            <button wire:click="savePerson('{{ $person['id'] }}')" class="btn btn-sm btn-outline-primary rounded-0" title="{{ $person['name'] }}">
                                <span class="truncate-200">{{ $person['name'] }}</span>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endcan
</div>
