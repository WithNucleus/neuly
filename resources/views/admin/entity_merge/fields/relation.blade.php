<?php
/**
 * @var string $name
 * @var array $options
 */
?>
@if(isset($options['relationField']))
    @if($entity->{$name}->count() > 0)
    <ul>
        @foreach($entity->{$name} as $relation)
            <li>
            @if(is_array($options['relationField']))
                <ul>
                @foreach($options['relationField'] as $field)
                    <li>{{ ucfirst($field) }}: {{ $relation->{$field} }}</li>
                @endforeach
                </ul>
            @else
                {{ $relation->{$options['relationField']} }}
            @endif
            </li>
        @endforeach
    </ul>
    @else
        <p><span class="badge badge-secondary">No data</span></p>
    @endif
@else
    <div class="alert alert-danger">"relationField" is missing in field mapping configuration!</div>
@endif
