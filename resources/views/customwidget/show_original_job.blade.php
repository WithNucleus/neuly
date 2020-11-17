@if($widget['entity'])
    <div class="clearfix">
        <h4 class="h5">{{ $widget['entity']->job_title }}</h4>

        @if ($widget['entity']->slug)
            <p class="mb-2"><strong>Slug:</strong> {{ $widget['entity']->slug }}</p>
        @endif

        @if ($widget['entity']->posted_date)
            <p class="mb-2"><strong>Posted date:</strong> {{ $widget['entity']->posted_date }}</p>
        @endif

        @if ($widget['entity']->salary)
            <p class="mb-2"><strong>Salary:</strong> {{ $widget['entity']->salary }}</p>
        @endif

        @if ($widget['entity']->hourly_rate)
            <p class="mb-2"><strong>Hourly Rate:</strong> {{ $widget['entity']->hourly_rate }}</p>
        @endif

        @if ($widget['entity']->employment_type)
            <p class="mb-2"><strong>Employment Type:</strong> {{ $widget['entity']->employment_type }}</p>
        @endif

        <p class="mb-2">
            <strong>Company:</strong>
            @if ($widget['entity']->company)
                <a href="{{ route('company.show', $widget['entity']->company->id) }}">{{ $widget['entity']->company->name }}</a>
            @else
                -
            @endif
        </p>

        <p class="mb-0">
            <strong>Focus: </strong>
            @forelse ($widget['entity']['focus'] as $item)
                <a href="{{ route('focus.show', $item->id) }}">{{ $item->name }}</a>@if (!$loop->last) / @endif
            @empty
                -
            @endforelse
        </p>

        @if ($widget['entity']->job_description)
            <p class="mb-2"><strong>Job Description:</strong>{!! $widget['entity']->job_description  !!}</p>
        @endif
    </div>
@else
    <p class="lead text-danger font-weight-bold">
        We couldn't find the entity record for the listing request based on the record ID. Tell Sydney.
    </p>
@endif
