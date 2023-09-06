<div>
    <div>
        @if($success)
            <div class="bg-success mt-3 p-2 fw-bold text-uppercase text-white">{{ $success }}</div>
        @endif
        @if($failure)
            <div class="bg-danger mt-3 p-2 fw-bold text-uppercase text-white">{{ $failure }}</div>
        @endif
    </div>
    <form wire:submit.prevent="upload" method="post" enctype="multipart/form-data" class="my-3">
        <div class="d-flex max-width-450">
            <div>
                <input type="file" wire:model="file" class="form-control form-control-file">
                @error('file') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="ms-3">
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </form>
    <div class="mt-3">
        <div class="d-flex">
            <div class="me-5">
                <strong class="text-uppercase text-body-emphasis">Required spreadsheet columns:</strong>
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
            <div>
                <strong class="text-uppercase text-body-emphasis">Optional spreadsheet columns:</strong>
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
</div>
