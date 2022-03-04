@include('enterprise.widget-controls.patents')
<ul class="list-group list-group-flush border">
    @forelse($patents as $patent)
        <li class="list-group-item">
            <p class="font-weight-bold mb-1">
                <a href="{{ $patent->url }}" target="_blank" rel="noopener noreferrer">{{ $patent->name }}</a>
            </p>
            <div class="widget-expandable-details">
                @if($patent->focus->count() > 0)
                    <p class="text-secondarydark mb-1">
                        <i class="fad fa-flask"></i>
                        @foreach ($patent->focus as $item)
                            {{ $item->name }}@if (!$loop->last) / @endif
                        @endforeach
                    </p>
                @endif
                @if($patent->companies->count() > 0)
                    <p class="text-info mb-1">
                        <i class="fad fa-building"></i>
                        @foreach ($patent->companies as $item)
                            <a href="{{ route('discover.organizations.show', $item->slug) }}" class="text-info">{{ $item->name }}</a>
                            @if (!$loop->last) / @endif
                        @endforeach
                    </p>
                @endif
                @if($patent->people->count() > 0)
                    <p class="text-info mb-1">
                        <i class="fad fa-user"></i>
                        @foreach ($patent->people as $item)
                            <a href="{{ route('discover.people.show', $item->slug) }}" class="text-info">{{ $item->name }}</a>
                            @if (!$loop->last) / @endif
                        @endforeach
                    </p>
                @endif
                <div class="mb-1">
                    {{ $patent->summary }}
                </div>
                <table class="table table-sm table-borderless auto-width font-size-small mb-0">
                    <tr>
                        <td>{{ Carbon\Carbon::parse($patent->priority_date)->format('M d, Y') }}</td>
                        <td>Priority Date</td>
                    </tr>
                    @if($patent->granted_date != '')
                        <tr>
                            <td>{{ Carbon\Carbon::parse($patent->granted_date)->format('M d, Y') }}</td>
                            <td>Granted Date</td>
                        </tr>
                    @endif
                    @if($patent->expiration_date != '')
                        <tr>
                            <td>{{ Carbon\Carbon::parse($patent->expiration_date)->format('M d, Y') }}</td>
                            <td>Expiration Date</td>
                        </tr>
                    @endif
                </table>
            </div>
        </li>
    @empty
        <li class="list-group-item">
            <p class="lead mb-0">
                No patents match your search criteria.
            </p>
        </li>
    @endforelse
</ul>

