<div class="col-12 col-lg-6 mb-4">
    <x-entities.entity-logo-card url="{{ route('discover.research.show', $research->slug) }}" linkClasses="py-1 text-start">
        <p class="fs-6 fw-bold text-uppercase m-0">{{ $research->name }}</p>
        <div class="d-flex justify-content-start text-body-secondary my-2">
            @foreach ($research->focus as $focus)
                <span class="badge bg-body-secondary text-body text-uppercase">{{ $focus->name }}</span>
            @endforeach
        </div>
        @if ($research->publication_info)
            <p class="text-body-secondary">
                {{ $research->publication_info }}
            </p>
        @endif
        @if($resources)
            <div class="d-flex align-items-center">
                @foreach ($resources as $resource)
                    <span class="me-3 text-body-tertiary">
                        @isset($resource->file_format)
                            @if($resource->file_format == 'PDF')
                                <i class="fad fa-file-pdf fa-lg me-1"></i>
                            @elseif($resource->file_format == 'HTML')
                                <i class="fad fa-link fa-lg me-1"></i>
                            @else
                                [{{ $resource->file_format }}]
                            @endif
                        @endisset
                        {{ $resource->title }}
                    </span>
                @endforeach
            </div>
        @endif
    </x-entities.entity-logo-card>
</div>
