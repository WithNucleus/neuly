<div class="{{ $widget['class'] ?? 'well mb-2' }} mt-4 col-xl-8 p-0">
    <div class="row">

        <div class="col-12 col-md-8 col-xl-6 d-flex">
            <div class="card card-body flex-fill">
                <div>
                    @if($widget['investor']->logo != '')
                        <img src="/storage/{{ $widget['investor']->logo }}" alt="{{ $widget['investor']->name }}" class="company-logo pull-right">
                    @endif
                    <h2 class="h3">{{ $widget['investor']->name }}</h2>

                    @if ($widget['investor']->website != '')
                        <p class="mb-2">
                            <i class="las la-external-link-alt"></i> <a href="{{ $widget['investor']->website }}" target="_blank" rel="noopener noreferrer">{{ $widget['investor']->website }}</a>
                        </p>
                    @endif

                    <p class="mb-2">
                        <i class="las la-link"></i> <a href="{{ route('discover.investors.show', $widget['investor']->slug) }}">neuly.com/investor/{{ $widget['investor']->slug }}</a>
                    </p>

                    <p class="mb-2">
                        {{ $widget['investor']->type }}
                    </p>
            
                    @if ($widget['investor']['focus']->count() > 0)
                        <p class="mb-0">
                            <strong>Focus: </strong>
                            @foreach ($widget['investor']['focus'] as $item)
                                <a href="/admin/focus/{{ $item->id }}/show">{{ $item->name }}</a>@if (!$loop->last) / @endif
                            @endforeach
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12 col-md-8 col-xl-6 d-flex">
            <div class="card card-body flex-fill">
                <div class="row mb-2">
                    <div class="col"><h5 class="mb-1">People</h5></div>
                    <div class="col text-right">
                        <a href="/admin/investor/{{ $widget['investor']->id }}/person" class="btn btn-sm btn-primary font-weight-bold">Add <i class='nav-icon la la-user'></i></a>
                    </div>
                </div>

                <div class="list-group list-group-flush">
                    @forelse ($widget['investor']['people'] as $person)
                        <div class="list-group-item d-flex justify-content-between">
                            <a href="/admin/person/{{ $person->id }}/show">
                                {{ $person->name }} ({{ $person->getOriginal('pivot_role') }})
                            </a>
                            <a class="small" onclick="return confirm_action()" href="{{ route('investorperson.remove', ['investor_id' => $widget['investor']->id, 'person_id' => $person->id]) }}">
                                <i class="la la-trash"></i> Remove
                            </a>
                        </div>
                    @empty
                        -
                    @endforelse
                </div>
            </div>
        </div>

        @if ($widget['investor']['companies']->count() > 0)
            <div class="col-12 col-md-8 col-xl-6 d-flex">
                <div class="card card-body flex-fill">
                    <h5 class="mb-1">Organizations</h5>

                    <div class="list-group list-group-flush">
                        @forelse ($widget['investor']['companies'] as $company)
                            <div class="list-group-item">
                                <a href="/admin/company/{{ $company->id }}/show">{{ $company->name }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if ($widget['investor']['locations']->count() > 0)
            <div class="col-12 col-md-8 col-xl-6 d-flex">
                <div class="card card-body flex-fill">
                    <h5 class="mb-1">Locations</h5>
            
                    <div class="list-group list-group-flush">
                        @foreach ($widget['investor']['locations'] as $location)
                            <div class="list-group-item">
                                <a href="/admin/location/{{ $location->id }}/show" class="d-block">{{ $location->name }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    function confirm_action() {
        return confirm('are you sure?');
    }
</script>
<style>
    .company-logo {
        height:  auto;
        width:  75px;
        float:  right;
    }
    .list-group-flush .list-group-item {
        padding: .25rem 0;
    }
    .list-group-flush .list-group-item:first-child {
        border-top-width: 0;
    }
</style>