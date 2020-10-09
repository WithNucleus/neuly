@if(!empty($focusCategories))
<div class="form-group">
    <label class="font-weight-bold">Focus:</label>
    <select name="entity_focus[]"  class="form-control" multiple>
        @foreach($focusCategories as $focus)
            <option value="{{ $focus->id }}">{{ $focus->name }}</option>
        @endforeach
    </select>
</div>
@endif
