<?php
/**
 * @var string $label
 * @var string $name
 * @var array $items
 */
?>
@if(!empty($items))
<div class="form-group">
    <label class="font-weight-bold">{{ $label }}:</label>
    <select name="{{ $name }}[]"  class="form-control" multiple>
        @foreach($items as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
</div>
@endif
