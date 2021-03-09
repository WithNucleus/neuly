@if ($crud->hasAccess('review') && $entry->reviewed == false)
    @empty($entry->knowledge_graph)
        <a href="{{ route('admin.import.company.serpapi-data.markAsReviewed', $entry->getKey()) }} " class="btn btn-sm btn-link"><i class="la la-check-circle"></i> Mark as reviewed</a>
    @else
        <a href="{{ route('admin.import.company.serpapi-data.review', $entry->getKey()) }} " class="btn btn-sm btn-link"><i class="la la-search"></i> Review</a>
    @endempty
@endif
