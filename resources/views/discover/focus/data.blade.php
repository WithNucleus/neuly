@if($focus->companies_count > 0)
    <x-entities.collapsable-related-entity collapsableId="companiesList" label="Organizations">
        @foreach ($focus->companies as $company)
            <x-entities.related.company-card :company="$company" pivot="position" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($focus->people_count > 0)
    <x-entities.collapsable-related-entity collapsableId="peopleList" label="People">
        @foreach ($focus->people as $person)
            <x-entities.related.person-card :person="$person" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($focus->jobs_count > 0)
    <x-entities.collapsable-related-entity collapsableId="jobsList" label="Jobs">
        @foreach ($focus->jobs as $job)
            <x-entities.related.job-card :job="$job" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($focus->events_count > 0)
    <x-entities.collapsable-related-entity collapsableId="eventsList" label="Events">
        @foreach ($focus->events as $event)
            <x-entities.related.event-card :event="$event" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($focus->clinicaltrials_count > 0)
    <x-entities.collapsable-related-entity collapsableId="clinicalTrialsList" label="Clinical Trials">
        @foreach ($focus->clinicaltrials as $clinicalTrial)
            <x-entities.related.clinical-trial-card :clinicalTrial="$clinicalTrial" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($focus->research_count > 0)
    <x-entities.collapsable-related-entity collapsableId="researchList" label="Research">
        @foreach ($focus->research as $research)
            <x-entities.related.research-card :research="$research" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($focus->bookable_listings_count > 0)
    <x-entities.collapsable-related-entity collapsableId="bookableList" label="Services Related to {{ $focus->name }}">
        @foreach ($focus->bookableListings as $bookableListing)
            <x-entities.related.bookable-listing-card :bookableListing="$bookableListing" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif
