@if ($crud->hasAccess('approve'))
    <a href="{{ route('admin.import.clinicaltrial.parsing-results.approve', $entry->getKey()) }} " class="btn btn-sm btn-link"><i class="la la-check"></i> Approve</a>
@endif
