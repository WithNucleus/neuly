<x-entities.entity-logo-card url="{{ route('discover.research.show', $research->slug) }}" linkClasses="py-1 text-start">
    <div class="d-flex h-100 flex-column justify-content-between">
        <div>
            <h2 class="mb-3 h5 px-1 text-success">{{ $research->name }}</h2>
            <div class="d-flex justify-content-start text-body-secondary my-3">
                @foreach ($research->focus as $focus)
                    <span class="badge bg-secondary text-uppercase">{{ $focus->name }}</span>
                @endforeach
            </div>
        </div>
        <div>
            @if ($research->publication_info)
                <p class="text-body-secondary">
                    {{ $research->publication_info }}
                </p>
            @endif
            @if($resources)
                <div class="d-flex align-items-center">
                    @foreach ($resources as $resource)
                        <span class="me-3 text-body-secondary">
                            @isset($resource->file_format)
                                @if($resource->file_format == 'PDF')
                                    <i class="fad fa-file-pdf fa-lg text-quaternary me-1"></i>
                                @elseif($resource->file_format == 'HTML')
                                    <i class="fad fa-link fa-lg text-quaternary me-1"></i>
                                @else
                                    [{{ $resource->file_format }}]
                                @endif
                            @endisset
                            {{ $resource->title }}
                        </span>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-entities.entity-logo-card>
