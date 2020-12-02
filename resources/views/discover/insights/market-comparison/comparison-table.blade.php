<div id="resizable-fullscreen-table-container">
    <button id="close-full-screen-table" class="btn d-none mb-3 btn-dark text-uppercase"><i class="fas fa-times"></i> Close</button>
    <div class="position-relative">
        <table class="table bg-white mb-0" id="resizable-table-with-all-borders">
            <thead class="thead-dark">
            <tr>
                <th class="size-400 text-no-wrap sticky-top">Organization</th>
                <th class="size-150 text-no-wrap sticky-top">Type</th>
                <th class="size-150 text-no-wrap sticky-top">Valuation</th>
                <th class="size-200 text-no-wrap sticky-top">Location</th>
                <th class="size-200 text-no-wrap sticky-top">Focus</th>
                <th class="size-200 text-no-wrap sticky-top">People</th>
                <th class="size-200 text-no-wrap sticky-top">Investors</th>
                <th class="size-150 text-no-wrap sticky-top">Founded in</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($companies as $company)
                <tr>
                    <td class="align-middle">
                        <a href="{{ route('discover.organizations.show', $company->slug) }}" class="d-flex align-items-center">
                            <div class="logo-is-contained-square flex-shrink-0" style="background-image: url('{{ $company->entityImageUrl }}');"></div>
                            <strong class="ml-4 font-size-large">{{ $company->name}}</strong>
                        </a>
                    </td>
                    <td class="align-middle text-no-wrap">{{ $company->ownership }}</td>
                    <td class="align-middle text-no-wrap">
                        @if(!is_null($company->valuation))
                            ${{ number_format($company->valuation) }}
                        @endif
                    </td>
                    <td class="align-middle">
                        @foreach ($company->locations as $location)
                            <a href="{{ route('discover.locations.show', $location->slug) }}">{{ $location->name }}</a> @if (!$loop->last)<br>@endif
                        @endforeach
                    </td>
                    <td class="align-middle">
                        @foreach ($company->focus as $item)
                            <a href="{{ route('discover.focus.show', $item->slug) }}">{{ $item->name }}</a>@if (!$loop->last),@endif
                        @endforeach
                    </td>
                    <td class="align-middle">
                        @foreach ($company->people as $person)
                            <a href="{{ route('discover.people.show', $person->slug) }}">{{ $person->name }} ({{ $person->pivot->position }})</a> @if (!$loop->last)<br>@endif
                        @endforeach
                    </td>
                    <td class="align-middle">
                        @foreach ($company->investors as $investor)
                            <a href="{{ route('discover.investors.show', $investor->slug) }}">{{ $investor->name }}</a> @if (!$loop->last)<br>@endif
                        @endforeach
                    </td>
                    <td class="align-middle text-no-wrap">
                        @if(!is_null($company->founded_date))
                            {{ Carbon\Carbon::parse($company->founded_date)->format('F Y') }}
                        @endif
                    </td>
                </tr>
            @empty
                <td colspan="8">No organizations match your criteria</td>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
