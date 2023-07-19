<div class="order-2 order-xxl-1 d-md-flex border-bottom max-width-780 pb-5">
    <div class="flex-shrink-0 mt-3 mt-md-0 me-3 me-lg-4 d-flex d-md-block align-items-center mb-3 mb-mb-0">
        <img src="{{ $record->source->entity_image_url ?? asset('images/image-placeholder-article.png') }}" alt="{{ $record->source->name }}" class="entity-square-image me-3 me-md-0 mb-md-3">
        <div class="fw-bold text-center entity-square-image mb-1">
            {{ $record->source->name }}
        </div>
        <div class="d-md-none mx-2">/</div>
        <div class="text-center entity-square-image">
            {{ \Carbon\Carbon::parse($record->date)->format('M d, Y') }}
        </div>
    </div>
    <div class="flex-grow-1">
        <a href="{{ $record->url }}" target="_blank" rel="noopener noreferrer" class="underline-on-hover text-success">
            <h2 class="h5 mb-2">{{ $record->name }}</h2>
        </a>
        @if($record->summary)
            <div @can('edit news articles') wire:poll.visible @endcan class="my-2">{{ $record->summary }}</div>
        @endif
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
