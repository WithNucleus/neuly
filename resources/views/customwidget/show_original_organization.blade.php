@if($widget['entity'] != null)
    <div class="clearfix">
        @if($widget['entity']->logo !== '' && $widget['entity']->logo !== null)
            <img src="/storage/{{ $widget['entity']->logo }}" alt="{{ $widget['entity']->name }}" class="company-logo float-right" style="max-width: 300px">
        @endif

        <h4 class="h5">{{ $widget['entity']->name }}</h4>

        @if ($widget['entity']->ownership != '')
            <p class="mb-2"><strong>Ownership:</strong> {{ $widget['entity']->ownership }}
                </a></p>
        @endif

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

        @if ($widget['entity']->summary != '')
            <p class="mb-2"><strong>Summary:</strong>
            <div>{{ $widget['entity']->summary }}</div>
            </p>
        @endif

        @if ($widget['entity']->founded_date != '')
            <p class="mb-2"><strong>Foundation Date:</strong> {{ $widget['entity']->founded_date }}
            </p>
        @endif

        @if ($widget['entity']->valuation != '')
            <p class="mb-2"><strong>Valuation:</strong> {{ $widget['entity']->valuation }}
            </p>
        @endif

        @if ($widget['entity']->total_founding_amount != '')
            <p class="mb-2"><strong>Total Foundings:</strong> {{ $widget['entity']->total_founding_amount }}
            </p>
        @endif

        @if ($widget['entity']->last_founding_date != '')
            <p class="mb-2"><strong>Last Founding:</strong> {{ $widget['entity']->last_founding_date }}
            </p>
        @endif

        @if ($widget['entity']->number_employees != '')
            <p class="mb-2"><strong>Number Employees:</strong> {{ $widget['entity']->number_employees }}
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
