<div>
    @if($clinicalTrial)
        <div class="d-flex align-items-center flex-wrap">
            <div class="me-4">
                <button wire:click="updateEntity" class="btn text-accent rounded-0">
                    <i class="fa-sharp fa-solid fa-rotate fa-lg me-2"></i><span>sync import</span>
                </button>
            </div>
            @if($showPage)
                <div class="small text-muted text-uppercase me-5">
                    <div class="fw-bold text-primary">Clinical trial</div>
                    <div>created {{ \Carbon\Carbon::parse($clinicalTrial->created_at)->diffForHumans() }} &amp; updated {{ \Carbon\Carbon::parse($clinicalTrial->updated_at)->diffForHumans() }}</div>
                </div>
                <div class="small text-muted text-uppercase me-5">
                    <div class="fw-bold text-primary">Import</div>
                    <div>created {{ \Carbon\Carbon::parse($importedEntity->created_at)->diffForHumans() }} &amp; updated {{ \Carbon\Carbon::parse($importedEntity->updated_at)->diffForHumans() }}</div>
                </div>
                <div>
                    <x-entities.data-modal-with-button uniqueId="clinical-trial-import-{{ $importedEntity->id }}" :model="$importedEntity" field="data" buttonLabel="view data" />
                </div>
                <div class="w-100 mt-3">
                    @if($importedEntity->errors)
                        <div>
                            @foreach($importedEntity->errors as $key => $error)
                                <div class="small mb-2">
                                    <i class="fa-sharp fa-solid fa-triangle-exclamation text-danger"></i>
                                    <strong class="text-danger text-uppercase">{{ $key }}:</strong>
                                    <span>{{ $error }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="d-flex">
                        <livewire:admin.import.clinical-trials.lead-sponsor :clinicalTrial="$clinicalTrial" />
                        <livewire:admin.import.clinical-trials.responsible-party :clinicalTrial="$clinicalTrial" />
                    </div>
                </div>
            @else
                <div>
                    <a href="{{ route('discover.clinicaltrials.show', $clinicalTrial->slug) }}" class="fw-bold text-uppercase">View Entity</a>
                    <span class="d-block text-muted small">updated {{ \Carbon\Carbon::parse($clinicalTrial->updated_at)->diffForHumans() }}</span>
                </div>
            @endif
        </div>
    @else
        <div>
            <button wire:click="createEntity" class="btn btn-accent">Create Entity</button>
        </div>
    @endif
</div>
