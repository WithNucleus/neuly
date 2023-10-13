<div>
    <table class="table-borderless w-auto fs-6 align-top">
        @if($showTemplateLink)
            <tr>
                <th class="min-width-125 text-uppercase ps-0 pe-3 text-end">Template:</th>
                <td><a href="{{ route('adminx.emails.templates.show', $emailTemplate->id) }}">{{ $emailTemplate->name }}</a></td>
            </tr>
        @endif
        <tr>
            <th class="min-width-125 text-uppercase ps-0 pe-3 text-end">From:</th>
            <td>
                <span>{{ $emailTemplate->from_name }}</span>
                <span class="text-body-tertiary">{{ $emailTemplate->from_email }}</span>
            </td>
        </tr>
        <tr>
            <th class="min-width-125 text-uppercase ps-0 pe-3 text-end">Subject:</th>
            <td>{{ $emailTemplate->subject }}</td>
        </tr>
    </table>

    <div class="mt-4">
        <div class="d-lg-flex">
            <div class="fs-6 text-uppercase fw-bold min-width-125 text-end pe-3">Body:</div>
            <div class="flex-grow-1 pt-1 max-width-780">{!! $emailTemplate->body !!}</div>
        </div>
    </div>
</div>
