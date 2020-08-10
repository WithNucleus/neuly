<div class="{{ $widget['class'] ?? 'well mb-2' }} mt-4">

    <div class="row">

        <div class="col-12 col-md-8 col-xl-4 d-flex">
            <div class="card card-body flex-fill">

                <div class="row mb-2">
                    <div class="col"><h5 class="mb-1">Organizations</h5></div>
                    <div class="col text-right">
                        <a href="/admin/person/{{ $widget['person']->id }}/company" class="btn btn-sm btn-primary font-weight-bold">Add <i class='nav-icon la la-user'></i></a>

                        {{-- <button class="btn btn-link p-0 load-ajax-modal text-left" data-title="{{ $widget['company']->name }}" data-path="/admin/companyperson/{{ $widget['company']->id }}" data-toggle="modal" data-target="#dynamic-modal">{{ $widget['company']->name }}</button> --}}
                    </div>
                </div>

                @forelse ($widget['person']['companies'] as $company)
                    <div class="d-flex justify-content-between">
                        <a href="/admin/company/{{ $company->id }}/show">
                            {{ $company->name }} ({{ $company->getOriginal('pivot_position') }})
                        </a>
                        <a class="small" onclick="return confirm_action()" href="{{ route('companyperson.remove', ['company_id' => $company->id, 'person_id' => $widget['person']->id]) }}">
                            <i class="la la-trash"></i> Remove
                        </a>
                    </div>
                @empty
                    -
                @endforelse

            </div>
        </div>


        <div class="col-12 col-md-8 col-xl-4 d-flex">
            <div class="card card-body flex-fill">
                <div class="row mb-2">
                    <div class="col"><h5 class="mb-1">Investors</h5></div>
                    <div class="col text-right">
                        <a href="/admin/person/{{ $widget['person']->id }}/investor" class="btn btn-sm btn-primary font-weight-bold">Add <i class='nav-icon la la-user'></i></a>

                        {{-- <button class="btn btn-link p-0 load-ajax-modal text-left" data-title="{{ $widget['company']->name }}" data-path="/admin/companyperson/{{ $widget['company']->id }}" data-toggle="modal" data-target="#dynamic-modal">{{ $widget['company']->name }}</button> --}}
                    </div>
                </div>

                @forelse ($widget['person']['investors'] as $investor)
                    <div class="d-flex justify-content-between">
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
</div>

<script>
    function confirm_action() {
        return confirm('are you sure?');
    }
</script>