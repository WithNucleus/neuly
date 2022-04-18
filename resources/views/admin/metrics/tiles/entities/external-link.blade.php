<table class="table">
    <thead>
    <tr>
        <th>Created</th>
        <th>Name</th>
    </tr>
    </thead>
    <tbody>
    @foreach($metrics as $record)
        <tr>
            <td>
                {{ \Carbon\Carbon::parse($record->created_at)->format('M d, Y') }}
            </td>
            <td>
                <a href="{{ $record->url }}">
                    {{ $record->name }}
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
