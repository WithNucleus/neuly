@if($widget['entity'] != null)
    <div>
        @if($widget['entity']->photo !== '' && $widget['entity']->photo !== null)
            <img src="/storage/{{ $widget['entity']->photo }}" alt="{{ $widget['entity']->name }}" class="company-logo pull-right">
        @endif

        <h2 class="h3">{{ $widget['entity']->name }}</h2>

        @if ($widget['entity']->website != '')
            <p class="mb-2"><strong>Website:</strong> <a href="{{ $widget['entity']->website }}" target="_blank" rel="noopener noreferrer">
                    {{ $widget['entity']->website }} <i class="las la-external-link-alt"></i>
                </a></p>
        @endif

        @if ($widget['entity']->linkedin != '')
            <p class="mb-2"><strong>Linkedin:</strong> <a href="{{ $widget['entity']->linkedin }}" target="_blank" rel="noopener noreferrer">
                    {{ $widget['entity']->linkedin }} <i class="las la-external-link-alt"></i>
                </a></p>
        @endif

        @if ($widget['entity']->facebook != '')
            <p class="mb-2"><strong>Facebook:</strong> <a href="{{ $widget['entity']->facebook }}" target="_blank" rel="noopener noreferrer">
                    {{ $widget['entity']->facebook }} <i class="las la-external-link-alt"></i>
                </a></p>
        @endif

        @if ($widget['entity']->twitter != '')
            <p class="mb-2"><strong>twitter:</strong> <a href="{{ $widget['entity']->twitter }}" target="_blank" rel="noopener noreferrer">
                    {{ $widget['entity']->twitter }} <i class="las la-external-link-alt"></i>
                </a></p>
        @endif

        @if ($widget['entity']->email != '')
            <p class="mb-2"><strong>E-Mail:</strong> <a href="{{ $widget['entity']->email }}" target="_blank" rel="noopener noreferrer">
                    {{ $widget['entity']->email }} <i class="las la-external-link-alt"></i>
                </a></p>
        @endif

        @if ($widget['entity']->secondary_email != '')
            <p class="mb-2"><strong>Secondary E-Mail:</strong> <a href="{{ $widget['entity']->secondary_email }}" target="_blank" rel="noopener noreferrer">
                    {{ $widget['entity']->secondary_email }} <i class="las la-external-link-alt"></i>
                </a></p>
        @endif

        @if ($widget['entity']->slug != '')
            <p class="mb-2"><strong>Slug:</strong> <a href="{{ $widget['entity']->slug }}" target="_blank" rel="noopener noreferrer">
                {{ $widget['entity']->slug }} <i class="las la-external-link-alt"></i>
            </a></p>
        @endif

        @if ($widget['entity']->bio != '')
            <p class="mb-2"><strong>Bio:</strong>
                <div>{{ $widget['entity']->bio }}</div>
            </p>
        @endif
    </div>
@else
    <p class="lead text-danger font-weight-bold">
        We couldn't find the entity record for the listing request based on the record ID. Tell Sydney.
    </p>
@endif
