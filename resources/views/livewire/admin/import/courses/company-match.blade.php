<div class="border my-3 row py-3">
    <div>
        <table class="table table-borderless w-auto table-sm">
            <tr>
                <th class="text-uppercase text-end text-nowrap">Company Name</th>
                <td>{{ $companyName }}</td>
            </tr>
            <tr>
                <th class="text-uppercase text-end text-nowrap">Company URL</th>
                <td>
                    <a href="{{ $companyUrl }}" target="_blank" rel="noopener noreferrer">{{ $companyUrl }}</a>
                </td>
            </tr>
            <tr>
                <th class="text-uppercase text-end text-nowrap">Course IDs</th>
                <td>
                    @foreach($courseIds as $courseId)
                        <code class="me-2">{{ $courseId }}</code>
                    @endforeach
                </td>
            </tr>
        </table>
    </div>
    <div class="row">
        @if($status === 'Pending')
            <div class="col-12 col-lg-6">
                <div class="fw-bold text-uppercase fs-6">Match Existing Company</div>
                <div class="d-flex my-2">
                    <div class="me-3"><input wire:model="companySearch" class="form-control"></div>
                    <button wire:click="searchCompanies" class="btn btn-sm btn-primary">Search</button>
                </div>
                <ul class="list-group rounded-0">
                    @forelse($companyResults as $result)
                        <li wire:key="company-match-result-{{ $result['id'] }}" class="list-group-item list-group-item-action p-0">
                            <button wire:click="matchExistingCompany('{{ $result['id'] }}')" class="btn text-start btn-sm rounded-0 w-100 text-success d-flex">
                                <div style="min-width: 50px" class="text-body">{{ $result['id'] }}</div>
                                <div class="me-2">{{ $result['name'] }}</div>
                                <div class="text-lowercase fw-normal text-secondary">{{ $result['website'] }}</div>
                            </button>
                        </li>
                    @empty
                        <li wire:key="empty" class="list-group-item p-0">
                            <small class="text-danger p-2">No company matches</small>
                        </li>
                    @endforelse
                </ul>
            </div>
            <div class="col-12 col-lg-6 ps-lg-5">
                <div class="fw-bold text-uppercase fs-6">Create New Company</div>
                <div class="d-lg-flex align-items-end">
                    <div class="me-3">
                        <label for="company_name" class="fw-bold">Name</label>
                        <input wire:model="company_name" class="form-control" id="company_name">
                    </div>
                    <div class="me-3">
                        <label for="company_url" class="fw-bold">URL</label>
                        <input wire:model="company_url" class="form-control" id="company_url">
                    </div>
                    <div>
                        <button wire:click="createNewCompany" class="btn btn-accent">Create</button>
                    </div>
                </div>
            </div>
        @else
            <div class="col-12">
                <span class="text-accent fs-6 fw-bold">{{ $status }}</span>
            </div>
        @endif
    </div>
    <div>
        @if($error)
            <div class="text-danger fs-6 fw-bold">{{ $error }}</div>
        @endif
    </div>
</div>
