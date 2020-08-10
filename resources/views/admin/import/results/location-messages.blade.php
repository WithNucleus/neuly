<div class="row mt-1">
    <div class="col-12 col-md-6">
        <div class="card card-body">
            <h3 class="h5">Locations</h3>
            <ul class="list-group">
                @forelse($location_messages as $key => $array)
                    <li class="list-group-item">

                        <p class="mb-0 font-weight-bold">
                            <a href="/admin/clinicaltrial/{{ $array->id }}/show">{{ $key }}</a>
                        </p>

                        <ul>
                            @foreach ($array->messages as $message)
                                <li>
                                    <span @if ($message->info == 'Error') class="bg-danger text-white" @endif>
                                        {{ $message->info }} - {{ $message->location }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>

                    </li>
                @empty
                    <li class="list-group-item">
                        No location messages in this - check with the devs if you've waited at least 3 minutes since importing and still see this message.
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>