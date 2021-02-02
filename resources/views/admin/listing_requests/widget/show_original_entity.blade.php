<?php
use App\Helpers\Entity\FieldsMapping;
?>
<div class="{{ $widget['class'] ?? 'well mb-2' }} mt-4">
    <div class="row">
        <div class="col-12 col-md-8 col-xl-8 d-flex">
            <div class="card card-body flex-fill">

                @if($widget['originalEntity'])
                    <h3>Original Record</h3>

                    @foreach($widget['mapping'] as $field => $options)
                        <p class="mb-2">
                            <strong>{{ isset($options['label']) ? $options['label'] : FieldsMapping::makeLabelFromFieldName($field) }}:</strong>

                            @if($options['type'] === FieldsMapping::TYPE_RELATION)
                                @if($options['relation'] === FieldsMapping::RELATION_ONE_ONE_MORPHABLE)
                                    {{ $widget['originalEntity']->{$field}->{$options['relationField']} }}
                                @else
                                    @forelse($widget['originalEntity']->{$field} as $item)
                                        {{ $item->{$options['relationField']} }} {{ !$loop->last ? '/' : '' }}
                                    @empty
                                        -
                                    @endforelse
                                @endif
                            @elseif($options['type'] === FieldsMapping::TYPE_IMAGE)
                                <br><img src="{{ $widget['originalEntity']->entityImageUrl }}" class="company-logo" style="max-width: 300px">
                            @else
                                {!! $widget['originalEntity']->{$field}  !!}
                            @endif
                        </p>
                    @endforeach

                @else
                    This request is a for a new entry. Therefore there is no data for an entity that should be updated.
                @endif

            </div>
        </div>
    </div>
</div>
