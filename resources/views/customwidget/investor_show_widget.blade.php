
<div class="{{ $widget['class'] ?? 'well mb-2' }} mt-4">
    <div class="row">

        <div class="col-12 col-md-8 col-xl-4 d-flex">
            <div class="card card-body flex-fill">

                <div class="row mb-2">
                    <div class="col"><h5 class="mb-1">People</h5></div>
                    <div class="col text-right">
                        <a href="/admin/investor/{{ $widget['investor']->id }}/person" class="btn btn-sm btn-primary font-weight-bold">Add <i class='nav-icon la la-user'></i></a>

                        {{-- <button class="btn btn-link p-0 load-ajax-modal text-left" data-title="{{ $widget['company']->name }}" data-path="/admin/companyperson/{{ $widget['company']->id }}" data-toggle="modal" data-target="#dynamic-modal">{{ $widget['company']->name }}</button> --}}
                    </div>
                </div>

                @forelse ($widget['investor']['people'] as $person)
                    <div class="d-flex justify-content-between">
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
</div>

<script>
    function confirm_action() {
        return confirm('are you sure?');
    }
</script>