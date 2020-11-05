@if($widget['entity'] != null)
    <div>
        @if($widget['entity']->entityImageUrl)
            <img src="{{ $widget['entity']->entityImageUrl }}" alt="{{ $widget['entity']->name }}" class="company-logo pull-right">
        @endif

        <h2 class="h3">{{ $widget['entity']->name }}</h2>

        @if ($widget['entity']->website != '')
            <p class="mb-2"><strong>Website:</strong> <a href="{{ $widget['entity']->website }}" target="_blank" rel="noopener noreferrer">
                    {{ $widget['entity']->website }} <i class="las la-external-link-alt"></i>
                </a></p>
        @endif

        @if ($widget['entity']->slug != '')
            <p class="mb-2"><strong>Slug:</strong> <a href="{{ $widget['entity']->slug }}" target="_blank" rel="noopener noreferrer">
                {{ $widget['entity']->slug }} <i class="las la-external-link-alt"></i>
            </a></p>
        @endif

        @if ($widget['entity']->type != '')
            <p class="mb-2"><strong>Type:</strong> {{ $widget['entity']->type }}
                </a></p>
        @endif

        <p class="mb-0">
            <strong>Focus: </strong>
            @forelse ($widget['entity']['focus'] as $item)
                <a href="/admin/focus/{{ $item->id }}/show">{{ $item->name }}</a>@if (!$loop->last) / @endif
            @empty
                -
            @endforelse
        </p>
    </div>
@else
    <p class="lead text-danger font-weight-bold">
        We couldn't find the entity record for the listing request based on the record ID. Tell Sydney.
    </p>
@endif
