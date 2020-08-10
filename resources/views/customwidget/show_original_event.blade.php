@if($widget['entity'] != null)
    <div>
        <h2 class="h3">{{ $widget['entity']->name }}</h2>

        @if ($widget['entity']->start_date != '')
            <p class="mb-2"><strong>Start:</strong> {{ $widget['entity']->start_date }}
            </p>
        @endif

        @if ($widget['entity']->end_date != '')
            <p class="mb-2"><strong>Start:</strong> {{ $widget['entity']->end_date }}
            </p>
        @endif

        @if ($widget['entity']->event_url != '')
            <p class="mb-2"><strong>Website:</strong> <a href="{{ $widget['entity']->event_url }}" target="_blank" rel="noopener noreferrer">
                    {{ $widget['entity']->event_url }} <i class="las la-external-link-alt"></i>
                </a></p>
        @endif

        @if ($widget['entity']->registration_url != '')
            <p class="mb-2"><strong>Registration Website:</strong> <a href="{{ $widget['entity']->registration_url }}" target="_blank" rel="noopener noreferrer">
                    {{ $widget['entity']->registration_url }} <i class="las la-external-link-alt"></i>
                </a></p>
        @endif

        @if ($widget['entity']->slug != '')
            <p class="mb-2"><strong>Slug:</strong> <a href="{{ $widget['entity']->slug }}" target="_blank" rel="noopener noreferrer">
                {{ $widget['entity']->slug }} <i class="las la-external-link-alt"></i>
            </a></p>
        @endif

        @if ($widget['entity']->description != '')
            <p class="mb-2"><strong>Description:</strong>
            <div>{{ $widget['entity']->description }}</div>
            </p>
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
