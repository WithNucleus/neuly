<div>
    <div class="max-width-600">
        <form wire:submit.prevent="submit">
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <input wire:model="search" placeholder="Keyword" type="text" class="form-control">
                    @error('search') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <select wire:model="intervention" class="form-select">
                        <option value="">Select Focus</option>
                        @foreach($interventionOptions as $option)
                            <option value="{{ $option->name }}">{{ $option->name }}</option>
                        @endforeach
                    </select>
                    @error('intervention') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Search clinicaltrials.gov</button>
            </div>
        </form>
    </div>
    @if($queryParams['pageToken'] !== null)
        <div class="my-4">
            <button wire:click="getNextPage" class="btn btn-accent">Import Next Page</button>
        </div>
    @endif
    @if($results)
        <div class="mt-4">
            <p>Imported {{ count($results) }} records</p>
            <ul class="list-group">
                @foreach ($results as $result)
                    <li wire:key="result-{{ $result['protocolSection']['identificationModule']['nctId'] }}" class="list-group-item d-flex">
                        <div class="me-2 min-width-120 fw-bold">{{ $result['protocolSection']['identificationModule']['nctId'] }}</div>
                        <span>
                            {{ $result['protocolSection']['identificationModule']['briefTitle'] }}
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
