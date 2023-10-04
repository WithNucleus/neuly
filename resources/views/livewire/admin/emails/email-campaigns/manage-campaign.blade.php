<div>
    <div>
        <h1 class="h3">Email Campaign</h1>
        <p class="fs-6 mb-2 text-body-secondary">{{ $emailCampaign->description }}</p>
        <table class="table table-sm table-borderless w-auto mb-4">
            @if($emailCampaign->type === \App\Models\EmailCampaign::TYPE_DRIP)
                <tr>
                    <th class="ps-0 text-uppercase">Trigger</th>
                    <td>{{ $emailCampaign->trigger }}</td>
                </tr>
            @endif
            <tr>
                <th class="ps-0 text-uppercase">Name</th>
                <td>{{ $emailCampaign->name }}</td>
            </tr>
            <tr>
                <th class="ps-0 text-uppercase">Type</th>
                <td>{{ $emailCampaign->type }}</td>
            </tr>
            <tr>
                <th class="ps-0 text-uppercase">Status</th>
                <td>{{ $emailCampaign->status }}</td>
            </tr>
            <tr>
                <th class="ps-0 text-uppercase">From</th>
                <td>{{ $emailCampaign->from_name }} <span class="text-body-secondary">({{ $emailCampaign->from_email }})</span></td>
            </tr>
            <tr>
                <th class="ps-0 text-uppercase">Created</th>
                <td>{{ $emailCampaign->created_at }}</td>
            </tr>
            <tr>
                <th class="ps-0 text-uppercase">Updated</th>
                <td>{{ $emailCampaign->updated_at }}</td>
            </tr>
        </table>
        @if($emailCampaign->type === \App\Models\EmailCampaign::TYPE_REGULAR)
            <div>
                <div>
                    <span class="fw-bold text-uppercase me-2">Subject</span>
                    <span>{{ $emailCampaign->subject }}</span>
                </div>
                <div class="fw-bold text-uppercase me-2">Subject</div>
                <div>{!! $emailCampaign->body !!}</div>
            </div>
        @endif
        @if($emailCampaign->type === \App\Models\EmailCampaign::TYPE_DRIP)
            <div>
                <h2 class="h4">Drip Emails</h2>
                <table class="table w-auto">
                    <thead>
                        <tr  class="text-uppercase">
                            <th>Name</th>
                            <th>Delay</th>
                            <th>Subject</th>
                            <th>Template</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($emailCampaign->emailDrips as $drip)
                            <tr>
                                <td>{{ $drip->name }}</td>
                                <td>{{ $drip->delay }}</td>
                                <td>{{ $drip->subject }}</td>
                                <td>
                                    <a href="{{ route('adminx.emails.templates.show', $drip->emailTemplate->id) }}">{{ $drip->emailTemplate->name }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
