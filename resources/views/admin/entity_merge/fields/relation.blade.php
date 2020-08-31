@if(isset($options['relationField']))
    @if($entity->{$name}->count() > 0)
    <ul>
        @forelse($entity->{$name} as $relation)
            <li>
                {{ $relation->{$options['relationField']} }}
            </li>
        @endforeach
    </ul>
    @else
        <p><span class="badge badge-secondary">No data</span></p>
    @endif
@else
    <div class="alert alert-danger">"relationField" is missing in field mapping configuration!</div>
@endif
