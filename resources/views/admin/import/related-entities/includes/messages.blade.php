<div class="col-12 col-md-4">
    <div class="card card-body">
        <h3 class="h5">{{ $type }}</h3>
        <ul class="list-group">
            @forelse($messages as $messageData)
                <li class="list-group-item">
                    <p class="mb-0 font-weight-bold">{{ $messageData->target_id }}</p>
                    <ul>
                        @foreach ($messageData->messages as $message)
                            <li>{{ $message->import_value }}</li>
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
