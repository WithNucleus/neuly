<div class="clinical-trial-controls mb-3">
    <div class="d-flex align-items-stretch">
        <button class="btn btn-sm has-accordion-arrow" type="button" data-toggle="collapse" data-target="#clinical-trial-focus" aria-expanded="false" aria-controls="clinical-trial-focus">
            Focus Filter
        </button>
        <div class="number-pages form-inline ml-4">
            <select id="clinical-trial-pages" class="custom-select auto-width">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
            <label for="clinical-trial-pages" class="ml-2">items</label>
        </div>
    </div>
    <div class="category">
        <div class="collapse" id="clinical-trial-focus">
            @foreach ($focusList as $slug => $name)
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="cf-feed-filter-{{ $slug }}" data-name="{{ $name }}">
                    <label class="custom-control-label" for="cf-feed-filter-{{ $slug }}">{{ $name }}</label>
                </div>
            @endforeach
        </div>
    </div>
</div>
