<div id="clinical-trial-tracker-container">
    <button id="close-full-screen-tracker" class="btn d-none mb-3 btn-dark text-uppercase"><i class="fas fa-times"></i> Close</button>
    <div class="position-relative">
        <table class="table bg-white mb-0" id="clinical-trial-tracker">
            <thead class="thead-dark">
            <tr>
                <th class="text-no-wrap sticky-top"></th>
                <th class="text-no-wrap sticky-top">Name</th>
                <th class="size-phase text-no-wrap sticky-top">Ownership</th>
                <th class="size-phase text-no-wrap sticky-top">Valuation</th>
                <th class="size-phase text-no-wrap sticky-top">Location</th>
                <th class="size-phase text-no-wrap sticky-top">Focus</th>
                <th class="size-phase text-no-wrap sticky-top">People</th>
                <th class="size-phase text-no-wrap sticky-top">Investors</th>
                <th class="size-phase text-no-wrap sticky-top">Fouded in</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($companies as $company)
                <tr>
                    <td><img style="width:100px" src="{{ $company->entityImageUrl }}" alt="{{ $company->name }}"/></td>
                    <td>{{ $company->name}}</td>
                    <td>{{ $company->ownership }}</td>
                    <td>
                        @if(!is_null($company->valuation))
                            {{ $company->valuation }}
                        @else
                            unknown
                        @endif
                    </td>
                    <td>
                        @foreach ($company->locations as $location)
                            <a href="{{ route('discover.locations.show', $location->slug) }}">{{ $location->name }}</a> @if (!$loop->last)<br>@endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($company->focus as $item)
                            <a href="{{ route('discover.focus.show', $item->slug) }}">{{ $item->name }}</a>@if (!$loop->last),@endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($company->people as $person)
                            <a href="{{ route('discover.people.show', $person->slug) }}">{{ $person->name }} ({{ $person->pivot->position }})</a> @if (!$loop->last)<br>@endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($company->investors as $investor)
                            <a href="{{ route('discover.investors.show', $investor->slug) }}">{{ $investor->name }}</a> @if (!$loop->last)<br>@endif
                        @endforeach
                    </td>
                    <td>
                        @if(!is_null($company->founded_date))
                            {{ $company->founded_date }}
                        @else
                            unknown
                        @endif
                    </td>
                </tr>
            @empty
                <td colspan="8">No organisations match your criteria</td>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
