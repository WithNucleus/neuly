<div>
    <input wire:model="{{ $wireModelSearch }}" type="text" class="form-control" placeholder="{{ $label }}" aria-label="{{ $label }}">
    <div>
        @if($searchResults)
            <div class="overflow-y-scroll border border-top-0" style="max-height: 300px">
                @foreach($searchResults as $result)
                    <div>
                        <button wire:click="{{ $setFilterFunction }}('{{$result['name']}}')" class="btn faux-select-item">
                            <span>{{ $result['name'] }}</span> <small class="text-secondary">({{ $result['related_count'] }})</small>
                        </button>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <div>
        @foreach($currentFilters as $filterKey => $filterName)
            <div wire:key="{{ $checkboxIdPrefix }}-{{ $filterKey }}" class="form-check my-2">
                <input wire:model="{{ $wireModelFilter }}" class="form-check-input" type="checkbox" value="{{ $filterName }}" id="{{ $checkboxIdPrefix }}-{{ $filterName }}">
                <label class="form-check-label" for="{{ $checkboxIdPrefix }}-{{ $filterName }}">
                    {{ $filterName }}
                </label>
            </div>
        @endforeach
    </div>
</div>
