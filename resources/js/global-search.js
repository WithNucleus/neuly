$('.global-search-trigger').on('click', function(e) {
    e.preventDefault();
    $('#searchModal').show();
    $('#searchModal').addClass('show');
});

$('#searchModal .btn-close').on('click', function(e) {
    e.preventDefault();
    $('#searchModal').hide();
    $('#searchModal').removeClass('show');
});

$(function() {
    const search = window.location.search;
    const params = new URL(location.href).searchParams;
    const options = ['companies', 'people', 'investors', 'research', 'clinicaltrials', 'events', 'jobs'];
    var tab = search.split('%5B')[0].replace('?','');


    if(options.indexOf(tab) != -1 && $('.global-search-button ')) {
        $('#searchModal').show();
        $('#searchModal').addClass('show');

        switch (tab) {
            case 'people':
                $('#people-tab').trigger('click');
                break;
            case 'investors':
                $('#investors-tab').trigger('click');
                break;
            case 'research':
                $('#research-tab').trigger('click');
                break;
            case 'clinicaltrials':
                $('#clinical-trials-tab').trigger('click');
                break;
            case 'events':
                $('#events-tab').trigger('click');
                break;
            case'jobs':
                $('#jobs-tab').trigger('click');
                break;
        }
    }
});


$(function() {
    const searchClient = algoliasearch(ALGOLIA_APP_ID, ALGOLIA_SECRET);
    const instantSearchRouter = instantsearch.routers.history();

    /**
     * Define Company based search
     */

    const companySearch = instantsearch({
        indexName: 'companies',
        routing: instantSearchRouter,
        searchClient,
    });

    const renderStats = (renderOptions, isFirstRender) => {
        const { nbHits } = renderOptions;

        document.querySelector('#companies #stats').innerHTML = nbHits;
    };

    const customStats = instantsearch.connectors.connectStats(
        renderStats
    );

    companySearch.addWidgets([
        instantsearch.widgets.configure({
            hitsPerPage: 6,
        }),
        instantsearch.widgets.clearRefinements({
            container: '#companies #reset',

        }),

        instantsearch.widgets.hits({
            container: '#companies #hits',
            cssClasses: {
                list: ['d-flex', 'flex-wrap'],
                item: ['col-12', 'col-md-6', 'col-xl-4', 'mb-5'],
            },
            templates: {
                item: `
                    <div class="card shadow-sm">
                        <div class="pt-4 text-center">
                            <a href="https://app.neuly.com/organization/{{ slug }}" class="text-decoration-none">
                                <div class="logo-is-contained" style="background-image: url('{{ logo }}')" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ name }}"></div>
                            </a>
                            <p class="my-3 lead">
                                <a href="https://app.neuly.com/organization/{{ slug }}" class="text-decoration-none">{{ name }}</a>
                            </p>

                        </div>
                    </div>
                    `,
            },
        }),

        customStats(),

        instantsearch.widgets.refinementList({
            container: '#companies #type',
            attribute: 'ownership'
        }),

        instantsearch.widgets.refinementList({
            container: '#companies #focus',
            attribute: 'focus',
            showMore: true,
        }),

        instantsearch.widgets.refinementList({
            container: '#companies #countries',
            attribute: 'locations.country',
            showMore: false,
            searchable: true,
            searchablePlaceholder: 'e.g. United States',
            templates: {
                searchableSubmit: '<i class="fad fa-search fa-lg"></i>',
            },
        }),

        instantsearch.widgets.refinementList({
            container: '#companies #locations',
            attribute: 'locations.name',
            showMore: false,
            searchable: true,
            searchablePlaceholder: 'e.g. New York',
            templates: {
                searchableSubmit: '<i class="fad fa-search fa-lg"></i>',
            },
        }),

        instantsearch.widgets.toggleRefinement({
            container: '#companies #has-events',
            attribute: 'hasEvents',
            on: 1,
            templates: {
                labelText: 'Upcoming Events',
            },
        }),

        instantsearch.widgets.toggleRefinement({
            container: '#companies #has-jobs',
            attribute: 'hasJobs',
            on: 1,
            templates: {
                labelText: 'Now Hiring',
            },
        }),

        instantsearch.widgets.pagination({
            container: '#companies #pagination',
            cssClasses: {
                list: ['pagination'],
                item: ['page-item'],
                selectedItem: ['active'],
                disabledItem: ['disabled'],
                link: ['page-link'],
            },
        }),
    ]);

    companySearch.start();

    /**
     * Define People based search
     */

    const peopleSearch = instantsearch({
        indexName: 'people',
        routing: instantSearchRouter,
        searchClient,
    });

    const renderPeopleStats = (renderOptions, isFirstRender) => {
        const { nbHits } = renderOptions;

        document.querySelector('#people #stats').innerHTML = nbHits;
    };

    const customPeopleStats = instantsearch.connectors.connectStats(
        renderPeopleStats
    );

    peopleSearch.addWidgets([
        instantsearch.widgets.configure({
            hitsPerPage: 6,
        }),
        instantsearch.widgets.clearRefinements({
            container: '#people #reset',
        }),

        instantsearch.widgets.hits({
            container: '#people #hits',
            cssClasses: {
                list: ['d-flex', 'flex-wrap'],
                item: ['col-12', 'col-md-6', 'col-xl-4', 'mb-5'],
            },
            templates: {
                item: `
                    <div class="card shadow-sm">
                        <div class="pt-4 text-center">
                            <a href="https://app.neuly.com/person/{{ slug }}" class="text-decoration-none">
                                <div class="person-photo-small shadow-sm" style="background-image: url('{{ photo }}')" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ name }}"></div>
                            </a>
                            <p class="my-3 lead">
                                <a href="https://app.neuly.com/person/{{ slug }}" class="text-decoration-none">{{ name }}</a>
                            </p>

                        </div>
                    </div>
                    `,
            },
        }),

        customPeopleStats(),

        instantsearch.widgets.refinementList({
            container: '#people #countries',
            attribute: 'locations.country',
            showMore: false,
            searchable: true,
            searchablePlaceholder: 'e.g. United States',
            templates: {
                searchableSubmit: '<i class="fad fa-search fa-lg"></i>',
            },
        }),

        instantsearch.widgets.pagination({
            container: '#people #pagination',
            cssClasses: {
                list: ['pagination'],
                item: ['page-item'],
                selectedItem: ['active'],
                disabledItem: ['disabled'],
                link: ['page-link'],
            },
        }),
    ]);

    peopleSearch.start();

    /**
     * Define Investor based search
     */

    const investorSearch = instantsearch({
        indexName: 'investors',
        routing: instantSearchRouter,
        searchClient,
    });

    const renderInvestorsStats = (renderOptions, isFirstRender) => {
        const { nbHits } = renderOptions;

        document.querySelector('#investors #stats').innerHTML = nbHits;
    };

    const customInvestorsStats = instantsearch.connectors.connectStats(
        renderInvestorsStats
    );

    investorSearch.addWidgets([
        instantsearch.widgets.configure({
            hitsPerPage: 6,
        }),
        instantsearch.widgets.clearRefinements({
            container: '#investors #reset',

        }),

        instantsearch.widgets.hits({
            container: '#investors #hits',
            cssClasses: {
                list: ['d-flex', 'flex-wrap'],
                item: ['col-12', 'col-md-6', 'col-xl-4', 'mb-5'],
            },
            templates: {
                item: `
                    <div class="card shadow-sm">
                        <div class="pt-4 text-center">
                            <a href="https://app.neuly.com/investor/{{ slug }}" class="text-decoration-none">
                                <div class="logo-is-contained" style="background-image: url('{{ logo }}')" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ name }}"></div>
                            </a>
                            <p class="my-3 lead">
                                <a href="https://app.neuly.com/investor/{{ slug }}" class="text-decoration-none">{{ name }}</a>
                            </p>

                        </div>
                    </div>
                    `,
            },
        }),

        customInvestorsStats(),

        instantsearch.widgets.refinementList({
            container: '#investors #countries',
            attribute: 'locations.country',
            showMore: false,
            searchable: true,
            searchablePlaceholder: 'e.g. United States',
            templates: {
                searchableSubmit: '<i class="fad fa-search fa-lg"></i>',
            },
        }),

        instantsearch.widgets.refinementList({
            container: '#investors #type',
            attribute: 'type'
        }),

        instantsearch.widgets.pagination({
            container: '#investors #pagination',
            cssClasses: {
                list: ['pagination'],
                item: ['page-item'],
                selectedItem: ['active'],
                disabledItem: ['disabled'],
                link: ['page-link'],
            },
        }),

        instantsearch.widgets.toggleRefinement({
            container: '#investors #has-jobs',
            attribute: 'hasJobs',
            on: 1,
            templates: {
                labelText: 'Now Hiring',
            },
        }),
    ]);

    investorSearch.start();

    /**
     * Define Research based search
     */

    const researchSearch = instantsearch({
        indexName: 'research',
        routing: instantSearchRouter,
        searchClient,
    });

    const renderResearchStats = (renderOptions, isFirstRender) => {
        const { nbHits } = renderOptions;

        document.querySelector('#research #stats').innerHTML = nbHits;
    };

    const customResearchStats = instantsearch.connectors.connectStats(
        renderResearchStats
    );

    researchSearch.addWidgets([
        instantsearch.widgets.configure({
            hitsPerPage: 4,
        }),
        instantsearch.widgets.clearRefinements({
            container: '#research #reset',

        }),

        instantsearch.widgets.hits({
            container: '#research #hits',
            cssClasses: {
                list: ['d-flex', 'flex-wrap'],
                item: ['col-12', 'mb-5'],
            },
            templates: {
                item: `
                    <div class="card shadow-sm">
                        <div class="p-3">
                            <p class="lead">
                                <a href="https://app.neuly.com/research/{{ slug }}" class="text-decoration-none">{{ name }}</a>
                            </p>
                        </div>
                    </div>
                    `,
            },
        }),

        customResearchStats(),

        instantsearch.widgets.refinementList({
            container: '#research #people',
            attribute: 'people',
            showMore: false,
            searchable: true,
            templates: {
                searchableSubmit: '<i class="fad fa-search fa-lg"></i>',
            },
        }),

        instantsearch.widgets.refinementList({
            container: '#research #focus',
            attribute: 'focus',
            showMore: true,
        }),

        instantsearch.widgets.refinementList({
            container: '#research #companies',
            attribute: 'companies',
            showMore: true,
        }),

        instantsearch.widgets.pagination({
            container: '#research #pagination',
            cssClasses: {
                list: ['pagination'],
                item: ['page-item'],
                selectedItem: ['active'],
                disabledItem: ['disabled'],
                link: ['page-link'],
            },
        }),
    ]);

    researchSearch.start();

    /**
     * Define Clinical Trial based search
     */

    const clinicalTrialsSearch = instantsearch({
        indexName: 'clinicaltrials',
        routing: instantSearchRouter,
        searchClient,
    });

    const renderClinicalTrialsStats = (renderOptions, isFirstRender) => {
        const { nbHits } = renderOptions;

        document.querySelector('#clinical-trials #stats').innerHTML = nbHits;
    };

    const customClinicalTrialsStats = instantsearch.connectors.connectStats(
        renderClinicalTrialsStats
    );

    clinicalTrialsSearch.addWidgets([
        instantsearch.widgets.configure({
            hitsPerPage: 4,
        }),
        instantsearch.widgets.clearRefinements({
            container: '#clinical-trials #reset',

        }),

        instantsearch.widgets.hits({
            container: '#clinical-trials #hits',
            cssClasses: {
                list: ['d-flex', 'flex-wrap'],
                item: ['col-12', 'mb-5'],
            },
            templates: {
                item: `
                    <div class="card shadow-sm">
                        <div class="p-3">
                            <p class="lead">
                                <a href="https://app.neuly.com/research/{{ slug }}" class="text-decoration-none">{{ name }}</a>
                            </p>
                        </div>
                    </div>
                    `,
            },
        }),

        customClinicalTrialsStats(),

        instantsearch.widgets.refinementList({
            container: '#clinical-trials #focus',
            attribute: 'focus',
            showMore: true,
        }),

        instantsearch.widgets.refinementList({
            container: '#clinical-trials #companies',
            attribute: 'companies',
            showMore: true,
        }),

        instantsearch.widgets.refinementList({
            container: '#clinical-trials #status',
            attribute: 'status',
            showMore: true,
        }),

        instantsearch.widgets.refinementList({
            container: '#clinical-trials #people',
            attribute: 'people',
            showMore: false,
            searchable: true,
            templates: {
                searchableSubmit: '<i class="fad fa-search fa-lg"></i>',
            },
        }),

        instantsearch.widgets.pagination({
            container: '#clinical-trials #pagination',
            cssClasses: {
                list: ['pagination'],
                item: ['page-item'],
                selectedItem: ['active'],
                disabledItem: ['disabled'],
                link: ['page-link'],
            },
        }),
    ]);

    clinicalTrialsSearch.start();

    /**
     * Define Event based search
     */

    const eventsSearch = instantsearch({
        indexName: 'events',
        routing: instantSearchRouter,
        searchClient,
    });

    const renderEventsStats = (renderOptions, isFirstRender) => {
        const { nbHits } = renderOptions;

        document.querySelector('#events #stats').innerHTML = nbHits;
    };

    const customEventsStats = instantsearch.connectors.connectStats(
        renderEventsStats
    );

    eventsSearch.addWidgets([
        instantsearch.widgets.configure({
            hitsPerPage: 4,
        }),
        instantsearch.widgets.clearRefinements({
            container: '#events #reset',

        }),

        instantsearch.widgets.hits({
            container: '#events #hits',
            cssClasses: {
                list: ['d-flex', 'flex-wrap'],
                item: ['col-12', 'mb-5'],
            },
            templates: {
                item: `
                    <div class="card shadow-sm">
                        <div class="p-3">
                            <p class="lead">
                                <a href="https://app.neuly.com/event/{{ slug }}" class="text-decoration-none">{{ name }}</a>
                            </p>
                        </div>
                    </div>
                    `,
            },
        }),

        customEventsStats(),

        instantsearch.widgets.refinementList({
            container: '#events #focus',
            attribute: 'focus',
            showMore: true,
        }),

        instantsearch.widgets.refinementList({
            container: '#events #companies',
            attribute: 'companies',
            showMore: true,
        }),

        instantsearch.widgets.refinementList({
            container: '#events #type',
            attribute: 'eventTypes',
            showMore: true,
        }),

        instantsearch.widgets.refinementList({
            container: '#events #countries',
            attribute: 'locations.country',
            showMore: false,
            searchable: true,
            searchablePlaceholder: 'e.g. United States',
            templates: {
                searchableSubmit: '<i class="fad fa-search fa-lg"></i>',
            },
        }),

        instantsearch.widgets.pagination({
            container: '#events #pagination',
            cssClasses: {
                list: ['pagination'],
                item: ['page-item'],
                selectedItem: ['active'],
                disabledItem: ['disabled'],
                link: ['page-link'],
            },
        }),
    ]);

    eventsSearch.start();

    /**
     * Define Jobs based search
     */

    const jobsSearch = instantsearch({
        indexName: 'jobs',
        routing: instantSearchRouter,
        searchClient,
    });

    const renderJobsStats = (renderOptions, isFirstRender) => {
        const { nbHits } = renderOptions;

        document.querySelector('#jobs #stats').innerHTML = nbHits;
    };

    const customJobsStats = instantsearch.connectors.connectStats(
        renderJobsStats
    );

    jobsSearch.addWidgets([
        instantsearch.widgets.configure({
            hitsPerPage: 4,
        }),
        instantsearch.widgets.clearRefinements({
            container: '#jobs #reset',

        }),

        instantsearch.widgets.hits({
            container: '#jobs #hits',
            cssClasses: {
                list: ['d-flex', 'flex-wrap'],
                item: ['col-12', 'mb-5'],
            },
            templates: {
                item: `
                    <div class="card shadow-sm">
                        <div class="p-3">
                            <p class="lead">
                                <a href="https://app.neuly.com/jobs/{{ slug }}" class="text-decoration-none">{{ name }}</a>
                            </p>
                        </div>
                    </div>
                    `,
            },
        }),

        customJobsStats(),


        instantsearch.widgets.refinementList({
            container: '#jobs #countries',
            attribute: 'locations.country',
            showMore: false,
            searchable: true,
            searchablePlaceholder: 'e.g. United States',
            templates: {
                searchableSubmit: '<i class="fad fa-search fa-lg"></i>',
            },
        }),

        instantsearch.widgets.refinementList({
            container: '#jobs #type',
            attribute: 'employment_type',
            showMore: true,
        }),

        instantsearch.widgets.refinementList({
            container: '#jobs #companies',
            attribute: 'owner',
            showMore: true,
        }),

        instantsearch.widgets.pagination({
            container: '#events #pagination',
            cssClasses: {
                list: ['pagination'],
                item: ['page-item'],
                selectedItem: ['active'],
                disabledItem: ['disabled'],
                link: ['page-link'],
            },
        }),
    ]);

    jobsSearch.start();

    // Set the InstantSearch index UI state from external events.
    function setInstantSearchUiState(indexUiState) {
        companySearch.setUiState(uiState => ({
            ...uiState,
            ['companies']: {
                ...uiState['companies'],
                // We reset the page when the search state changes.
                page: 1,
                ...indexUiState,
            },
        }))
    }

    function getInstantSearchUiState() {
        const uiState = instantSearchRouter.read()

        return (uiState && uiState['companies']) || {}
    }

    const searchPageState = getInstantSearchUiState();

    const querySuggestionsPlugin = createQuerySuggestionsPlugin({
        searchClient,
        indexName: 'general_query_suggestions',
        transformSource({ source }) {
            return {
                ...source,
                sourceId: 'querySuggestionsPlugin',
                onSelect({ setIsOpen, setQuery, item, event }) {
                    setSearchQuery(item.name);
                    setQuery(item.name);
                },
                templates: {
                    item(params) {
                        const { item } = params;
                        return item.name;
                    },
                },
            };
        },
    });

    function setSearchQuery(query)
    {
        companySearch.helper.setQuery(query).search();
        peopleSearch.helper.setQuery(query).search();
        investorSearch.helper.setQuery(query).search();
        researchSearch.helper.setQuery(query).search();
        clinicalTrialsSearch.helper.setQuery(query).search();
        eventsSearch.helper.setQuery(query).search();
        jobsSearch.helper.setQuery(query).search();
    }

    autocomplete({
        container: '#autocomplete',
        placeholder: 'Search',
        detachedMediaQuery: 'none',
        plugins: [querySuggestionsPlugin],
        openOnFocus: true,
        initialState: {
            query: searchPageState.query || '',
        },
        onSubmit({ state }) {
            setInstantSearchUiState({ query: state.query });
            setSearchQuery(state.query);
        },
        onReset() {
            setInstantSearchUiState({ query: '' });
            setSearchQuery('');
        },
        onStateChange({ prevState, state }) {
            if (prevState.query !== state.query) {
                setInstantSearchUiState({ query: state.query });
                setSearchQuery(state.query);
            }
        },
    });
});
