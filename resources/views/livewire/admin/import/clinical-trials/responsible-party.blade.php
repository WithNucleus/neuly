<div>
    @if($clinicalTrial->responsible_party_type AND $clinicalTrial->responsible_party_id)
        <div class="text-uppercase fw-bold">
            <i class="fa-sharp fa-solid fa-check me-1"></i><span>Responsible Party</span>
        </div>
    @else
        <div>
            <div class="fw-bold text-uppercase">Assign Responsible Party</div>
            <input wire:model="search" class="form-control form-control-sm max-width-200 rounded-0" aria-label="Search" placeholder="Search">

            @if($this->search)
                <div class="faux-search-box-container">
                    <div class="faux-search-box-results">
                        <ul class="list-group list-group-flush">
                            @forelse($this->results['people'] as $result)
                                <li class="list-group-item list-group-item-action p-0">
                                    <button wire:click="assignPerson('{{ $result['id'] }}')" class="btn text-start w-100 fw-normal rounded-0">
                                        {{ $result['name'] }}
                                    </button>
                                </li>
                            @empty
                                <li class="list-group-item">
                                    No matches for your search
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    @endif
</div>
