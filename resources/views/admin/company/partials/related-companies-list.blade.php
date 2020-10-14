<div class="list-group list-group-flush">
    @forelse ($companies as $company)
        <div class="list-group-item d-flex justify-content-between">
            <a href="{{ route('company.show', $company->id) }}">
                {{ $company->name }} ({{ $company->pivot->type }})
            </a>
            <form action="{{ route($actionRouteName, [$currentCompanyId, $company->id]) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-link btn-sm" onclick="return confirm('Are you sure?');">
                    <i class="la la-trash"></i> Remove
                </button>
            </form>
        </div>
    @empty
        -
    @endforelse
</div>
