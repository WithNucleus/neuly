<div class="col-12 col-md-4">
    <div class="card card-body">
        <h3 class="h5">{{ Str::plural(ucfirst($entityName)) }}</h3>
        <ul class="list-group">
            @forelse($messages as $nctNumber => $messagesData)
                <li class="list-group-item">

                    <p class="mb-0 font-weight-bold">
                        <a href="{{ route('clinicaltrial.show', $messagesData->clinicaltrial_id) }}">{{ $nctNumber }}</a>
                    </p>

                    <ul>
                        @foreach ($messagesData->messages as $message)
                            <li>
                                [ID: {{ $message->import_id }}] {{ $message->import_value }}
                            </li>
                        @endforeach
                    </ul>

                </li>
            @empty
                <li class="list-group-item">
                    No messages in this category - check Import Failures.
                </li>
            @endforelse
        </ul>
    </div>
</div>
