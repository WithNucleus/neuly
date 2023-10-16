<div>
    <form wire:submit.prevent="submit">
        <div class="mb-3">
            <div class="form-check">
                <input wire:model="emailPreference.marketing" class="form-check-input" value="true" type="checkbox" id="marketing">
                <label class="form-check-label" for="marketing">
                    I'd like emails from Neuly about my interests
                </label>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-check">
                <input wire:model="emailPreference.do_not_email" class="form-check-input" value="true" type="checkbox" id="do_not_email">
                <label class="form-check-label" for="do_not_email">
                    DO NOT email me anything at all
                </label>
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-primary btn-lg">Save</button>
        </div>
    </form>
</div>
