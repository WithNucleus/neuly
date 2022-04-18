<table class="table">
    <thead>
    <tr>
        <th>Created</th>
        <th>Name</th>
        <th>Organization Type</th>
    </tr>
    </thead>
    <tbody>
    @foreach($metrics as $record)
        <tr>
            <td>
                {{ \Carbon\Carbon::parse($record->created_at)->format('M d, Y') }}
            </td>
            <td>
                <a href="{{ route('discover.organizations.show', $record->slug) }}">
                    {{ $record->name }}
                </a>
            </td>
            <td>
                {{ $record->ownership }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
