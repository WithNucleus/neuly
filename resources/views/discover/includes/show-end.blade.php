		</div>

		@auth
			@if(Route::is('discover.organizations.show'))

				@include('discover.includes.related.organization')

			@elseif(Route::is('discover.events.show'))

				@include('discover.includes.related.event')

			@elseif(Route::is('discover.research.show'))

				@include('discover.includes.related.research')

	        @endif
	    @endauth

		@include('footers.mini')
    </main>

</div>

@include('discover.includes.modal')
