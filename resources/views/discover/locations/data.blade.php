@if($location->companies_count > 0)
    <x-entities.collapsable-related-entity collapsableId="companiesList" label="Organizations">
        @foreach ($location->companies as $company)
            <x-entities.related.company-card :company="$company" pivot="position" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($location->people_count > 0)
    <x-entities.collapsable-related-entity collapsableId="peopleList" label="People">
        @foreach ($location->people as $person)
            <x-entities.related.person-card :person="$person" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($location->investors_count > 0)
    <x-entities.collapsable-related-entity collapsableId="investorsList" label="Investors">
        @foreach ($location->investors as $investor)
            <x-entities.related.investor-card :investor="$investor" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($location->jobs_count > 0)
    <x-entities.collapsable-related-entity collapsableId="jobsList" label="Jobs">
        @foreach ($location->jobs as $job)
            <x-entities.related.job-card :job="$job" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($location->events_count > 0)
    <x-entities.collapsable-related-entity collapsableId="eventsList" label="Events">
        @foreach ($location->events as $event)
            <x-entities.related.event-card :event="$event" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($location->clinicaltrials_count > 0)
    <x-entities.collapsable-related-entity collapsableId="clinicalTrialsList" label="Clinical Trials">
        @foreach ($location->clinicaltrials as $clinicalTrial)
            <x-entities.related.clinical-trial-card :clinicalTrial="$clinicalTrial" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($location->bookable_listings_count > 0)
    <x-entities.collapsable-related-entity collapsableId="bookableListingsList" label="Neuly Care Providers">
        @foreach ($location->bookableListings as $bookableListing)
            <x-entities.related.bookable-listing-card :bookableListing="$bookableListing" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

<script>
	$(document).ready(function(){

		$(".collapse.show").each(function(){
        	$(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
        });

        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){

        	console.log("show");

        	$(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");

        }).on('hide.bs.collapse', function(){

        	console.log("collapse");

        	$(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");

        });
    });
</script>
