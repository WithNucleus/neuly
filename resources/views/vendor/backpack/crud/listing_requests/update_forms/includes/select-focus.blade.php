@if(!empty($focusCategories))
<div class="row">
    <div class="form-group col-6">
        <label>Focus:</label>
        <select name="original_focus[]" class="form-control" multiple disabled>
            @foreach($original->focus as $focus)
                <option value="{{ $focus->id }}" selected>
                    {{ $focus->name }}
                </option>
            @endforeach
        </select>
        <a href="#" class="btn btn-sm btn-link btn-restore-focus">use original data</a>
    </div>
    <div class="form-group col-6 {{ !empty($focusIdsSelected) ? 'bg-success' : '' }}">
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
</div>
@endif
