<div>
    <form wire:submit.prevent="save">
        <div class="row">
            <div class="col-12 col-md-6 mb-4">
                <label for="name">First Name</label>
                <input type="text" wire:model="user.name" class="form-control" id="name">
                @error('user.name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="col-12 col-md-6 mb-4">
                <label for="last_name">Last Name</label>
                <input wire:model="user.last_name" type="text" class="form-control" id="last_name">
                @error('user.last_name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="mb-4">
            <label for="member_url" class="form-label">Member URL</label>
            <div class="input-group">
                <span class="input-group-text" id="member_url">neuly.com/member/</span>
                <input wire:model="user.member_url" type="text" class="form-control" id="member_url" aria-describedby="member_url member_url_description">
            </div>
            <div class="form-text text-small" id="member_url_description">If want to share anything publicly or with the Neuly community, you'll need a member URL</div>
            @error('user.member_url') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="d-flex flex-wrap">
            <div class="me-3">
                <button class="btn btn-lg btn-primary">Save</button>
            </div>
            @if($success)
                <div class="text-accent">{{ $success }}</div>
            @endif
        </div>
    </form>
</div>
