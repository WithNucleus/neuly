<div>
    <h1 class="mb-5">Email Template: {{ $template->name }}</h1>
    <x-admin.emails.email-template-details :emailTemplate="$template" />

    <hr class="my-5">

    <h2 class="h4">Edit Email Template</h2>
    <div class="d-xl-flex">
        <div class="flex-grow-1 max-width-780">
            <form wire:submit.prevent="submit">
                <div class="mb-3">
                    <label for="subject" class="fw-bold text-uppercase">Subject</label>
                    <input wire:model="template.subject" type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="body" class="fw-bold text-uppercase">Template Body</label>
                    <textarea wire:model="template.body" id="body" rows="10" class="form-control"></textarea>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        <div class="mt-4 mt-xl-0 ms-xl-5">
            <p>
                Emails are rendered in Markdown -- <strong>HTML is allowed</strong><br>
                Use <code>&lt;br&gt;</code> for line breaks
            </p>

            <div>
                <p class="h6 mb-1">Merge Fields</p>
                @include('adminx.emails.templates._merge-fields')
            </div>
        </div>
    </div>
</div>
