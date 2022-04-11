<table class="table">
    <thead>
    <tr>
        <th>Created</th>
        <th>Name</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach($metrics as $record)
        <tr>
            <td>
                {{ \Carbon\Carbon::parse($record->created_at)->format('M d, Y') }}
            </td>
            <td>
                @if ($record->person_id != '')
                    <a href="{{ route('person.show', $record->person_id) }}">
                        {{ $record->name }} {{ $record->last_name }}
                    </a>
                @else
                    {{ $record->name }} {{ $record->last_name }}
                @endif
            </td>
            <td>
                @if ($record->email_verified_at == '')
                    <i class="lar la-times-circle text-danger"></i>
                @else
                    <i class="lar la-check-circle text-success"></i>
                @endif
                {{ $record->email }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
