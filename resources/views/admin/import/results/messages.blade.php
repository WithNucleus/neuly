<div class="col-12 col-md-4">
    <div class="card card-body">
        <h3 class="h5">{{ Str::plural(ucfirst($entityName)) }}</h3>
        <ul class="list-group">
            @forelse($messages as $key => $array)
                <li class="list-group-item">

                    <p class="mb-0 font-weight-bold">
                        <a href="/admin/clinicaltrial/{{ $array->id }}/show">{{ $key }}</a>
                    </p>

                    <ul>
                        @foreach ($array->messages as $message)
                            <li>
                                    <span @if ($message->info == 'Error') class="bg-danger text-white" @endif>
                                        {{ $message->info }} - {{ $message->{$entityName} }}
                                    </span>
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
