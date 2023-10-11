<div>
    <div>
        <h1>Email Journey: {{ $emailJourney->name }}</h1>
        <p class="fs-6 mb-2 text-body-secondary">{{ $emailJourney->description }}</p>
        <table class="table table-sm table-borderless w-auto mb-5">
            <tr>
                <th class="ps-0 text-uppercase">Status</th>
                <td>{{ $emailJourney->status }}</td>
            </tr>
            <tr>
                <th class="ps-0 text-uppercase">Created</th>
                <td>{{ $emailJourney->created_at }}</td>
            </tr>
            <tr>
                <th class="ps-0 text-uppercase">Updated</th>
                <td>{{ $emailJourney->updated_at }}</td>
            </tr>
        </table>

        <div>
            <h2 class="h4">Automated Emails</h2>
            <table class="table w-auto">
                <thead>
                <tr class="text-uppercase">
                    <th>Name</th>
                    <th>Delay</th>
                    <th>Template</th>
                </tr>
                </thead>
                <tbody>
                @foreach($emailJourney->emailSequences as $sequence)
                    <tr>
                        <td>{{ $sequence->name }}</td>
                        <td>{{ $sequence->delay }}</td>
                        <td>
                            <a href="{{ route('adminx.emails.templates.show', $sequence->emailTemplate->id) }}">{{ $sequence->emailTemplate->name }}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
