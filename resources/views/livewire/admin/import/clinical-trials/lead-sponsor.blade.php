<div class="me-5">
    @if($clinicalTrial->lead_sponsor_type AND $clinicalTrial->lead_sponsor_id)
        <div class="text-uppercase fw-bold">
            <i class="fa-sharp fa-solid fa-check me-1"></i><span>Lead Sponsor</span>
        </div>
    @else
        <div>
            <div class="fw-bold text-uppercase mt-2">Assign Lead Sponsor</div>
            <div class="d-flex">
                <div class="me-4">
                    <input wire:model="search" class="form-control form-control-sm rounded-0" aria-label="Search" placeholder="Search">

                    @if($this->search)
                        <div class="faux-search-box-container">
                            <div class="faux-search-box-results">
                                <ul class="list-group list-group-flush">
                                    @foreach($this->results['companies'] as $result)
                                        <li class="list-group-item list-group-item-action p-0">
                                            <button wire:click="assignCompany('{{ $result['id'] }}')" class="btn text-start w-100 fw-normal rounded-0">
                                                {{ $result['name'] }}
                                            </button>
                                        </li>
                                    @endforeach
                                    @foreach($this->results['people'] as $result)
                                        <li class="list-group-item list-group-item-action p-0">
                                            <button wire:click="assignPerson('{{ $result['id'] }}')" class="btn text-start w-100 fw-normal rounded-0">
                                                {{ $result['name'] }}
                                            </button>
                                        </li>
                                    @endforeach
                                    @if(empty($this->results['companies']) AND empty($this->results['people']))
                                        <li class="list-group-item">
                                            No matches for your search
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
                <div>
                    <button type="button" class="btn btn-secondary btn-sm rounded-0 text-nowrap" data-bs-toggle="modal" data-bs-target="#data-modal-create-lead-sponsor-modal">
                        Create New
                    </button>

                    <div class="modal fade" id="data-modal-create-lead-sponsor-modal" tabindex="-1"
                         aria-labelledby="data-modal-create-lead-sponsor-modal-label"
                         aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5"
                                        id="data-modal-create-lead-sponsor-modal-label">Create Lead Sponsor - Organization</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="pb-4">
                                        <livewire:admin.entities.forms.create-company />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
