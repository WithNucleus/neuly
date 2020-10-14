<div class="{{ $widget['class'] ?? 'well mb-2' }} mt-4 col-xl-8 p-0">
    <div class="row">
        <div class="col-12 col-md-8 col-xl-6 d-flex">
            <div class="card card-body flex-fill">
                <div class="row mb-2">
                    <div class="col"><h5 class="mb-1">Organizations</h5></div>
                    <div class="col text-right">
                        <a href="/admin/person/{{ $widget['person']->id }}/company" class="btn btn-sm btn-primary font-weight-bold">Add <i class='nav-icon la la-user'></i></a>
                    </div>
                </div>

                <div class="list-group list-group-flush">
                    @forelse ($widget['person']['companies'] as $company)
                        <div class="list-group-item d-flex justify-content-between">
                            <a href="/admin/company/{{ $company->id }}/show">
                                {{ $company->name }} ({{ $company->getOriginal('pivot_position') }})
                            </a>
                            <a class="small" onclick="return confirm_action()" href="{{ route('admin.company.person.remove', ['company_id' => $company->id, 'person_id' => $widget['person']->id]) }}">
                                <i class="la la-trash"></i> Remove
                            </a>
                        </div>
                    @empty
                        -
                    @endforelse
                </div>

            </div>
        </div>

        @if ($widget['person']['locations']->count() > 0)
            <div class="col-12 col-md-8 col-xl-6 d-flex">
                <div class="card card-body flex-fill">
                    <h5 class="mb-1">Locations</h5>

                    <div class="list-group list-group-flush">
                        @foreach ($widget['person']['locations'] as $location)
                            <div class="list-group-item">
                                <a href="/admin/location/{{ $location->id }}/show" class="d-block">{{ $location->name }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <div class="col-12 col-md-8 col-xl-6 d-flex">
            <div class="card card-body flex-fill">
                <div class="row mb-2">
                    <div class="col"><h5 class="mb-1">Investors</h5></div>
                    <div class="col text-right">
                        <a href="/admin/person/{{ $widget['person']->id }}/investor" class="btn btn-sm btn-primary font-weight-bold">Add <i class='nav-icon la la-user'></i></a>
                    </div>
                </div>

                <div class="list-group list-group-flush">
                    @forelse ($widget['person']['investors'] as $investor)
                        <div class="list-group-item d-flex justify-content-between">
                            <a href="/admin/investor/{{ $investor->id }}/show">
                                {{ $investor->name }} ({{ $investor->getOriginal('pivot_role') }})
                            </a>
                            <a class="small" onclick="return confirm_action()" href="{{ route('investorperson.remove', ['investor_id' => $investor->id, 'person_id' => $widget['person']->id]) }}">
                                <i class="la la-trash"></i> Remove
                            </a>
                        </div>
                    @empty
                        -
                    @endforelse
                </div>

            </div>
        </div>

        @if ($widget['person']['clinicaltrials']->count() > 0)
            <div class="col-12 col-md-8 col-xl-6 d-flex">
                <div class="card card-body flex-fill">
                    <div class="row mb-0">
                        <div class="col"><h5 class="mb-1">Clinical Trials</h5></div>
                        <div class="col text-right">
                        </div>
                    </div>

                    <div class="list-group list-group-flush">
                        @forelse ($widget['person']['clinicaltrials'] as $clinicaltrial)
                            <div class="list-group-item d-flex justify-content-between">
                                <a href="/admin/clinicaltrial/{{ $clinicaltrial->id }}/show">
                                    {{ $clinicaltrial->title }}
                                </a>
                            </div>
                        @empty
                            -
                        @endforelse
                    </div>
                </div>
            </div>
        @endif

        @if ($widget['person']['research']->count() > 0)
            <div class="col-12 col-md-8 col-xl-6 d-flex">
                <div class="card card-body flex-fill">
                    <div class="row mb-0">
                        <div class="col"><h5 class="mb-1">Research</h5></div>
                        <div class="col text-right">
                        </div>
                    </div>

                    <div class="list-group list-group-flush">
                        @forelse ($widget['person']['research'] as $item)
                            <div class="list-group-item d-flex justify-content-between">
                                <a href="/admin/research/{{ $item->id }}/show">
                                    {{ $item->name }}
                                </a>
                            </div>
                        @empty
                            -
                        @endforelse
                    </div>
                </div>
            </div>
        @endif

        @if ($widget['person']['events']->count() > 0)
            <div class="col-12 col-md-8 col-xl-6 d-flex">
                <div class="card card-body flex-fill">
                    <div class="row mb-0">
                        <div class="col"><h5 class="mb-1">Events</h5></div>
                        <div class="col text-right">
                        </div>
                    </div>

                    <div class="list-group list-group-flush">
                        @forelse ($widget['person']['events'] as $event)
                            <div class="list-group-item d-flex justify-content-between">
                                <a href="/admin/event/{{ $event->id }}/show">
                                    {{ $event->name }}
                                </a>
                            </div>
                        @empty
                            -
                        @endforelse
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
    .list-group-flush .list-group-item {
        padding: .25rem 0;
    }
    .list-group-flush .list-group-item:first-child {
        border-top-width: 0;
    }
</style>
