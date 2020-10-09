@if(!empty($focusCategories))
<div class="form-group">
    <label class="font-weight-bold">Focus:</label>
    <select name="entity_focus[]"  class="form-control" multiple>
        @foreach($focusCategories as $focus)
            <option value="{{ $focus->id }}"
                {{ !empty($focusIdsSelected) && in_array($focus->id, $focusIdsSelected) ? 'selected' : '' }}>
                {{ $focus->name }}
            </option>
        @endforeach
    </select>
</div>
@endif
