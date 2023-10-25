<div class="d-xl-flex">
    <div class="max-width-600 flex-grow-1 me-lg-5 mb-5">
        <form wire:submit.prevent="save">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mb-3">
                <label for="name" class="fw-bold text-uppercase">Name / Title</label>
                <input wire:model="report.name" type="text" id="name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="name" class="fw-bold text-uppercase">Slug</label>
                <input wire:model="report.slug" type="text" id="name" class="form-control">
            </div>
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <label for="name" class="fw-bold text-uppercase">Status</label>
                    <input wire:model="report.status" type="text" id="name" class="form-control">
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="name" class="fw-bold text-uppercase">Sticky</label>
                    <select wire:model="report.sticky" class="form-select">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="excerpt" class="fw-bold text-uppercase">Excerpt</label>
                <textarea wire:model="report.excerpt" id="excerpt" rows="6" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="preview" class="fw-bold text-uppercase">Preview</label>
                <textarea wire:model="report.preview" id="excerpt" rows="6" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="aside" class="fw-bold text-uppercase">Aside</label>
                <textarea wire:model="report.aside" id="aside" rows="10" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-uppercase" for="photo">Image</label>
                <input type="file" id="photo" wire:model.debounce.500ms="image" class="form-control max-width-500 me-3">
                <p class="m-0 text-small fst-italic">Images only, 1024 KB max</p>
                @error('image') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div>
                <p>Update the content at <a href="https://psychedelicinvest.com/wp-admin/post.php?post={{ $report->id }}&action=edit" target="_blank" rel="noopener noreferrer">Psychedelic Invest</a></p>
                <button type="submit" class="btn btn-primary rounded-0">Save Report</button>
            </div>
        </form>
    </div>
    <div class="max-width-400 ps-xl-5">
        <div>
            <p class="h6 text-uppercase">Featured Image</p>
            <img src="{{ $report->entityImageUrl }}" alt="{{ $report->name }}">
        </div>
        <div class="mt-3">
            <a href="{{ route('discover.industry-reports.show', $report->slug) }}" class="btn btn-accent rounded-0">View Report</a>
        </div>
    </div>
</div>
