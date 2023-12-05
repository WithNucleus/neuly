<div>
    <table class="table w-auto">
        <thead>
            <tr>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($coursePrograms as $program)
                <tr wire:key="program-{{ $program->id }}">
                    <td>{{ $program->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4 d-flex justify-content-start">
        {{ $coursePrograms->links() }}
    </div>
    <div class="mt-5">
        <h2 class="h4">Add Program</h2>
        <form wire:submit.prevent="submit" class="max-width-500">
            <div class="d-flex">
                <input wire:model="name" id="name" type="text" class="form-control me-2" aria-label="Program Name" placeholder="Program Name">
                <button type="submit" class="btn btn-primary rounded-0">Save</button>
            </div>
            @error('name') <div class="small text-danger">{{ $message }}</div> @enderror
        </form>
    </div>
</div>
