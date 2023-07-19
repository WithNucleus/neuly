<div class="mb-5 d-flex flex-wrap">
    @if($record->media_type === \App\Enum\MediaTypes::MEDIA_TYPE_ARTICLE)
        <x-entities.show.article-card :record="$record" />
    @else
        <x-entities.show.news-card :record="$record" />
    @endif

    @can('edit news articles')
        <div class="order-1 order-xxl-2 mb-4 mb-xxl-0 ms-xl-5 d-flex flex-wrap align-items-start">
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
