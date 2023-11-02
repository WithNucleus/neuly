<div>
    <p class="lead mb-0">Import CSV or Excel files. The <strong>unique field</strong> is <code>{{ $uniqueField }}</code></p>
    <div>
        @if($success)
            <div class="bg-success mt-2 p-2 fw-bold text-uppercase text-white">{{ $success }}</div>
        @endif
        @if($failure)
            <div class="bg-danger mt-2 p-2 fw-bold text-uppercase text-white">{{ $failure }}</div>
        @endif
    </div>
    <form wire:submit.prevent="upload" method="post" enctype="multipart/form-data" class="my-3">
        <div class="max-width-400">
            <div class="mb-3">
                <label for="file">
                    <span class="fw-bold text-uppercase">File</span>
                </label>
                <input type="file" wire:model="file" class="form-control form-control-file" aria-label="File">
                @error('file') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="inviter_id">
                    <span class="fw-bold text-uppercase">Inviter</span>
                </label>
                <select wire:model="inviter" id="inviter_id" class="form-select" aria-label="Email Journey">
                    @foreach($userOptions as $user)
                        <option value="{{ $user->id }}">{{ $user->id }} {{ $user->full_name }}</option>
                    @endforeach
                </select>
                @error('inviter_id') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="journey">
                    <span class="fw-bold text-uppercase">Email Journey</span>
                    <span class="text-body-secondary">(optional)</span>
                </label>
                <select wire:model="journey" id="journey" class="form-select" aria-label="Email Journey">
                    <option value="No Journey"></option>
                    @foreach($journeyTypeOptions as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
                @error('journey') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </form>
    <div class="d-lg-flex">
        <div class="mt-5">
            <strong class="text-uppercase text-body-emphasis">Required Columns:</strong>
            <table class="table table-sm w-auto border">
                @foreach($requiredFields as $field => $type)
                    <tr>
                        <th class="fw-normal">
                            <code>{{ $field }}</code>
                        </th>
                        <td class="text-body-secondary">
                            {{ $type }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="mt-5 ms-lg-5">
            <strong class="text-uppercase text-body-emphasis">Optional:</strong>
            <table class="table table-sm w-auto border">
                @foreach($optionalFields as $field => $type)
                    <tr>
                        <th class="fw-normal">
                            <code>{{ $field }}</code>
                        </th>
                        <td class="text-body-secondary">
                            {{ $type }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
