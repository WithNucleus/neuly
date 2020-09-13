<div class="clinicaltrial-collaborators mb-3">
    <label for="organizations" class="h4">Organizations</label>
    <div class="d-flex">
        <input type="text" class="typeahead form-control" name="organizations-search" placeholder="Search organizations">
        <button class="btn btn-link px-1 text-primary"><i class="fad fa-search fa-lg"></i></button>
    </div>

    <div id="organizations-filter">
        <span class="d-block title"></span>

        @isset($filters_organizations)
            @foreach ($filters_organizations as $company)
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="company" id="{{ $company }}" value="{{ $company }}" checked>
                    <label class="custom-control-label" for="{{ $company }}">{{ $company }}</label>
                </div>
            @endforeach
        @endisset
    </div>
</div>

@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Focus',
    'name'      => 'focus',
    'items'     => $focus_cats,
    'item_filters' => $filters_focus
])

@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Status',
    'name'      => 'status',
    'items'     => $status,
    'item_filters' => $filters_status
])

@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Phase',
    'name'      => 'phase',
    'items'     => $phases,
    'item_filters' => $filters_phases
])

@include('sidebars.filters.scripts')

<script>
    $(document).ready(function() {
        var clinicalTrialCollaborators = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: '/searchassets/clinicalTrialCollaborators.json'
        });

        clinicalTrialCollaborators.initialize();

        $('.clinicaltrial-collaborators .typeahead').typeahead(null, {
            name: 'organizations',
            display: 'name',
            source: clinicalTrialCollaborators,
            limit: 10,
        });
    });
</script>
