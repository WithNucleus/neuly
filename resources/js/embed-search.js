require('bootstrap/js/src/tab');
import algoliasearch from 'algoliasearch/lite';
import instantsearch from 'instantsearch.js/dist/instantsearch.production.min';

const searchModalId = '#neulyEmbedSearchModal';

(function($) {
    $.fn.neulyEmbedSearch = function() {
        let searchButton = $(this);
        //TODO make domain dynamic
        const mainDomain = 'http://neuly.loc';
        // const mainDomain = 'https://staging.neuly.com';

        $.get(mainDomain + '/js/external/embedSearch/template', function(template) {
            $('body').append(template);

            let searchModal = $(searchModalId);

            searchButton.on('click', function(e) {
                e.preventDefault();
                searchModal.fadeIn();
                $('body').css('overflow', 'hidden');
            });

            searchModal.find('.nes-btn-close').on('click', function(e) {
                e.preventDefault();
                searchModal.fadeOut();
                $('body').css('overflow', 'visible');
            });

            const searchClient = algoliasearch('2WZKZJIBUG', '686437b222f70e8cdbbba3899ea1f93d');
            const searchIndexes = {
                companies: 'companies',
                people: 'people',
                investors: 'investors',
                research: 'research',
                clinicaltrials: 'clinicaltrials',
                events: 'events',
                jobs: 'jobs',
            };
            const sectionSelectors = {
                main: '.nes-section-main',
                companies: '.nes-section-companies',
                people: '.nes-section-people',
                investors: '.nes-section-investors',
                research: '.nes-section-research',
                clinicalTrials: '.nes-section-clinical-trials',
                events: '.nes-section-events',
                jobs: '.nes-section-jobs',
            };
            const filterSelectors = {
                hasEvents: '.nes-filter-has-events',
                hasJobs: '.nes-filter-has-jobs',
                type: '.nes-filter-type',
                countries: '.nes-filter-countries',
                locations: '.nes-filter-locations',
                focus: '.nes-filter-focus',
                people: '.nes-filter-people',
                companies: '.nes-filter-companies',
                status: '.nes-filter-status',
                reset: '.nes-filter-reset',
            }
            const widgetSelectors = {
                stats: '.nes-stats',
                hits: '.nes-hits',
                sort: '.nes-sort-by',
                pagination: '.nes-pagination',
            };

            function makeSelectorFromArray(selectors) {
                return selectors.join(' ');
            }

            function getElementBySelectorsArray(selectors) {
                return document.querySelector(makeSelectorFromArray(selectors));
            }

            function createStatsWidget(sectionSelector) {
                return (renderOptions, isFirstRender) => {
                    const { nbHits } = renderOptions;

                    let selector = makeSelectorFromArray([
                        sectionSelector,
                        widgetSelectors.stats
                    ]);

                    document.querySelector(selector).innerHTML = nbHits;
                };
            }

            /**
             * Company search
             */

            const companySearch = instantsearch({
                indexName: searchIndexes.companies,
                searchClient,
            });

            const renderCompaniesStats = instantsearch.connectors.connectStats(
                createStatsWidget(sectionSelectors.companies)
            );

            companySearch.addWidgets([
                renderCompaniesStats(),
                instantsearch.widgets.configure({
                    hitsPerPage: 6,
                }),
                instantsearch.widgets.clearRefinements({
                    container: getElementBySelectorsArray([
                        sectionSelectors.companies,
                        filterSelectors.reset
                    ]),
                }),
                instantsearch.widgets.hits({
                    container: getElementBySelectorsArray([
                        sectionSelectors.companies,
                        widgetSelectors.hits
                    ]),
                    cssClasses: {
                        list: ['d-flex', 'flex-wrap'],
                        item: ['col-12', 'col-md-6', 'col-xl-4', 'mb-5'],
                    },
                    templates: {
                        item: `
                <div class="card shadow-sm">
                    <div class="pt-4 text-center">
                        <a href="` + mainDomain + `/organization/{{ slug }}" class="text-decoration-none">
                            <div class="logo-is-contained" style="background-image: url('{{ logo }}')" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ name }}"></div>
                        </a>
                        <p class="my-3 lead">
                            <a href="` + mainDomain + `/organization/{{ slug }}" class="text-decoration-none">{{ name }}</a>
                        </p>

                    </div>
                </div>
                `,
                    },
                }),
                instantsearch.widgets.pagination({
                    container: getElementBySelectorsArray([
                        sectionSelectors.companies,
                        widgetSelectors.pagination
                    ]),
                    cssClasses: {
                        list: ['pagination'],
                        item: ['page-item'],
                        selectedItem: ['active'],
                        disabledItem: ['disabled'],
                        link: ['page-link'],
                    },
                }),
                instantsearch.widgets.refinementList({
                    container: getElementBySelectorsArray([
                        sectionSelectors.companies,
                        filterSelectors.focus
                    ]),
                    attribute: 'focus',
                }),
                // instantsearch.widgets.refinementList({
                //     container: getElementBySelectorsArray([
                //         sectionSelectors.companies,
                //         filterSelectors.type
                //     ]),
                //     attribute: 'ownership'
                // }),
                // instantsearch.widgets.refinementList({
                //     container: getElementBySelectorsArray([
                //         sectionSelectors.companies,
                //         filterSelectors.countries
                //     ]),
                //     attribute: 'locations.country',
                //     showMore: false,
                //     searchable: true,
                //     searchablePlaceholder: 'e.g. United States',
                // }),
                // instantsearch.widgets.refinementList({
                //     container: getElementBySelectorsArray([
                //         sectionSelectors.companies,
                //         filterSelectors.locations
                //     ]),
                //     attribute: 'locations.name',
                //     showMore: false,
                //     searchable: true,
                //     searchablePlaceholder: 'e.g. New York',
                // }),
                // instantsearch.widgets.toggleRefinement({
                //     container: getElementBySelectorsArray([
                //         sectionSelectors.companies,
                //         filterSelectors.hasEvents
                //     ]),
                //     attribute: 'events',
                //     templates: {
                //         labelText: 'Upcoming Events',
                //     },
                // }),
                // instantsearch.widgets.toggleRefinement({
                //     container: getElementBySelectorsArray([
                //         sectionSelectors.companies,
                //         filterSelectors.hasJobs
                //     ]),
                //     attribute: 'jobs',
                //     templates: {
                //         labelText: 'Now Hiring',
                //     },
                // }),
            ]);

            companySearch.start();

            /**
             * People search
             */

            const peopleSearch = instantsearch({
                indexName: searchIndexes.people,
                searchClient,
            });

            const renderPeopleStats = instantsearch.connectors.connectStats(
                createStatsWidget(sectionSelectors.people)
            );

            peopleSearch.addWidgets([
                renderPeopleStats(),
                instantsearch.widgets.configure({
                    hitsPerPage: 6,
                }),
                instantsearch.widgets.clearRefinements({
                    container: getElementBySelectorsArray([
                        sectionSelectors.people,
                        filterSelectors.reset,
                    ]),
                }),

                instantsearch.widgets.hits({
                    container: getElementBySelectorsArray([
                        sectionSelectors.people,
                        widgetSelectors.hits,
                    ]),
                    cssClasses: {
                        list: ['d-flex', 'flex-wrap'],
                        item: ['col-12', 'col-md-6', 'col-xl-4', 'mb-5'],
                    },
                    templates: {
                        item: `
                <div class="card shadow-sm">
                    <div class="pt-4 text-center">
                        <a href="` + mainDomain + `/person/{{ slug }}" class="text-decoration-none">
                            <div class="person-photo-small shadow-sm" style="background-image: url('{{ photo }}')" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ name }}"></div>
                        </a>
                        <p class="my-3 lead">
                            <a href="` + mainDomain + `/person/{{ slug }}" class="text-decoration-none">{{ name }}</a>
                        </p>

                    </div>
                </div>
                `,
                    },
                }),
                instantsearch.widgets.pagination({
                    container: getElementBySelectorsArray([
                        sectionSelectors.people,
                        widgetSelectors.pagination,
                    ]),
                    cssClasses: {
                        list: ['pagination'],
                        item: ['page-item'],
                        selectedItem: ['active'],
                        disabledItem: ['disabled'],
                        link: ['page-link'],
                    },
                }),
                instantsearch.widgets.refinementList({
                    container: getElementBySelectorsArray([
                        sectionSelectors.people,
                        filterSelectors.focus
                    ]),
                    attribute: 'focus',
                }),
                // instantsearch.widgets.refinementList({
                //     container: getElementBySelectorsArray([
                //         sectionSelectors.people,
                //         filterSelectors.countries,
                //     ]),
                //     attribute: 'locations.country',
                //     showMore: false,
                //     searchable: true,
                //     searchablePlaceholder: 'e.g. United States',
                // }),
            ]);

            peopleSearch.start();

            /**
             * Investor search
             */
/*
            const investorSearch = instantsearch({
                indexName: searchIndexes.investors,
                searchClient,
            });


            const renderInvestorsStats = instantsearch.connectors.connectStats(
                createStatsWidget(sectionSelectors.investors)
            );

            investorSearch.addWidgets([
                renderInvestorsStats(),
                instantsearch.widgets.configure({
                    hitsPerPage: 6,
                }),
                instantsearch.widgets.clearRefinements({
                    container: getElementBySelectorsArray([
                        sectionSelectors.investors,
                        filterSelectors.reset,
                    ]),
                }),

                instantsearch.widgets.hits({
                    container: getElementBySelectorsArray([
                        sectionSelectors.investors,
                        widgetSelectors.hits,
                    ]),
                    cssClasses: {
                        list: ['d-flex', 'flex-wrap'],
                        item: ['col-12', 'col-md-6', 'col-xl-4', 'mb-5'],
                    },
                    templates: {
                        item: `
                    <div class="card shadow-sm">
                        <div class="pt-4 text-center">
                            <a href="`+ mainDomain +`/investor/{{ slug }}" class="text-decoration-none">
                                <div class="logo-is-contained" style="background-image: url('{{ logo }}')" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ name }}"></div>
                            </a>
                            <p class="my-3 lead">
                                <a href="`+ mainDomain +`/investor/{{ slug }}" class="text-decoration-none">{{ name }}</a>
                            </p>
                        </div>
                    </div>
                    `,
                    },
                }),
                instantsearch.widgets.refinementList({
                    container: getElementBySelectorsArray([
                        sectionSelectors.investors,
                        filterSelectors.countries,
                    ]),
                    attribute: 'locations.country',
                    showMore: false,
                    searchable: true,
                    searchablePlaceholder: 'e.g. United States',
                }),

                instantsearch.widgets.refinementList({
                    container: getElementBySelectorsArray([
                        sectionSelectors.investors,
                        filterSelectors.type,
                    ]),
                    attribute: 'type'
                }),

                instantsearch.widgets.pagination({
                    container: getElementBySelectorsArray([
                        sectionSelectors.investors,
                        widgetSelectors.pagination,
                    ]),
                    cssClasses: {
                        list: ['pagination'],
                        item: ['page-item'],
                        selectedItem: ['active'],
                        disabledItem: ['disabled'],
                        link: ['page-link'],
                    },
                }),

                instantsearch.widgets.toggleRefinement({
                    container: getElementBySelectorsArray([
                        sectionSelectors.investors,
                        filterSelectors.hasJobs,
                    ]),
                    attribute: 'jobs',
                    templates: {
                        labelText: 'Now Hiring',
                    },
                }),
            ]);

            investorSearch.start();
*/
            /**
             * Research search
             */
/*
            const researchSearch = instantsearch({
                indexName: searchIndexes.research,
                searchClient,
            });

            const renderResearchStats = instantsearch.connectors.connectStats(
                createStatsWidget(sectionSelectors.research)
            );

            researchSearch.addWidgets([
                renderResearchStats(),
                instantsearch.widgets.configure({
                    hitsPerPage: 4,
                }),
                instantsearch.widgets.clearRefinements({
                    container: getElementBySelectorsArray([
                        sectionSelectors.research,
                        filterSelectors.reset,
                    ]),
                }),

                instantsearch.widgets.hits({
                    container: getElementBySelectorsArray([
                        sectionSelectors.research,
                        widgetSelectors.hits,
                    ]),
                    cssClasses: {
                        list: ['d-flex', 'flex-wrap'],
                        item: ['col-12', 'mb-5'],
                    },
                    templates: {
                        item: `
                    <div class="card shadow-sm">
                        <div class="p-3">
                            <p class="lead">
                                <a href="`+ mainDomain +`/research/{{ slug }}" class="text-decoration-none">{{ name }}</a>
                            </p>
                        </div>
                    </div>
                    `,
                    },
                }),
                instantsearch.widgets.refinementList({
                    container: getElementBySelectorsArray([
                        sectionSelectors.research,
                        filterSelectors.people,
                    ]),
                    attribute: 'people',
                    showMore: false,
                    searchable: true,
                }),

                instantsearch.widgets.refinementList({
                    container: getElementBySelectorsArray([
                        sectionSelectors.research,
                        filterSelectors.focus,
                    ]),
                    attribute: 'focus',
                    showMore: true,
                }),

                instantsearch.widgets.refinementList({
                    container: getElementBySelectorsArray([
                        sectionSelectors.research,
                        filterSelectors.companies,
                    ]),
                    attribute: 'companies',
                    showMore: true,
                }),

                instantsearch.widgets.pagination({
                    container: getElementBySelectorsArray([
                        sectionSelectors.research,
                        widgetSelectors.pagination,
                    ]),
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
*/
            /**
             * Clinical Trial search
             */
/*
            const clinicalTrialsSearch = instantsearch({
                indexName: searchIndexes.clinicaltrials,
                searchClient,
            });

            const renderClinicalTrialStats = instantsearch.connectors.connectStats(
                createStatsWidget(sectionSelectors.clinicalTrials)
            );

            clinicalTrialsSearch.addWidgets([
                renderClinicalTrialStats(),
                instantsearch.widgets.configure({
                    hitsPerPage: 4,
                }),
                instantsearch.widgets.clearRefinements({
                    container: getElementBySelectorsArray([
                        sectionSelectors.clinicalTrials,
                        filterSelectors.reset,
                    ]),
                }),
                instantsearch.widgets.hits({
                    container: getElementBySelectorsArray([
                        sectionSelectors.clinicalTrials,
                        widgetSelectors.hits,
                    ]),
                    cssClasses: {
                        list: ['d-flex', 'flex-wrap'],
                        item: ['col-12', 'mb-5'],
                    },
                    templates: {
                        item: `
                    <div class="card shadow-sm">
                        <div class="p-3">
                            <p class="lead">
                                <a href="` + mainDomain + `/research/{{ slug }}" class="text-decoration-none">{{ name }}</a>
                            </p>
                        </div>
                    </div>
                    `,
                    },
                }),
                instantsearch.widgets.refinementList({
                    container: getElementBySelectorsArray([
                        sectionSelectors.clinicalTrials,
                        filterSelectors.focus,
                    ]),
                    attribute: 'focus',
                    showMore: true,
                }),

                instantsearch.widgets.refinementList({
                    container: getElementBySelectorsArray([
                        sectionSelectors.clinicalTrials,
                        filterSelectors.companies,
                    ]),
                    attribute: 'companies',
                    showMore: true,
                }),

                instantsearch.widgets.refinementList({
                    container: getElementBySelectorsArray([
                        sectionSelectors.clinicalTrials,
                        filterSelectors.status,
                    ]),
                    attribute: 'status',
                    showMore: true,
                }),

                instantsearch.widgets.refinementList({
                    container: getElementBySelectorsArray([
                        sectionSelectors.clinicalTrials,
                        filterSelectors.people,
                    ]),
                    attribute: 'people',
                    showMore: false,
                    searchable: true,
                }),

                instantsearch.widgets.pagination({
                    container: getElementBySelectorsArray([
                        sectionSelectors.clinicalTrials,
                        widgetSelectors.pagination,
                    ]),
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
*/
            /**
             * Event search
             */
/*
            const eventsSearch = instantsearch({
                indexName: searchIndexes.events,
                searchClient,
            });

            const renderEventsStats = instantsearch.connectors.connectStats(
                createStatsWidget(sectionSelectors.events)
            );

            eventsSearch.addWidgets([
                renderEventsStats(),
                instantsearch.widgets.configure({
                    hitsPerPage: 4,
                }),
                instantsearch.widgets.clearRefinements({
                    container: getElementBySelectorsArray([
                        sectionSelectors.events,
                        filterSelectors.reset,
                    ]),
                }),
                instantsearch.widgets.hits({
                    container: getElementBySelectorsArray([
                        sectionSelectors.events,
                        widgetSelectors.hits,
                    ]),
                    cssClasses: {
                        list: ['d-flex', 'flex-wrap'],
                        item: ['col-12', 'mb-5'],
                    },
                    templates: {
                        item: `
                    <div class="card shadow-sm">
                        <div class="p-3">
                            <p class="lead">
                                <a href="` + mainDomain + `/event/{{ slug }}" class="text-decoration-none">{{ name }}</a>
                            </p>
                        </div>
                    </div>
                    `,
                    },
                }),
                instantsearch.widgets.refinementList({
                    container: getElementBySelectorsArray([
                        sectionSelectors.events,
                        filterSelectors.focus,
                    ]),
                    attribute: 'focus',
                    showMore: true,
                }),

                instantsearch.widgets.refinementList({
                    container: getElementBySelectorsArray([
                        sectionSelectors.events,
                        filterSelectors.companies,
                    ]),
                    attribute: 'companies',
                    showMore: true,
                }),

                instantsearch.widgets.refinementList({
                    container: getElementBySelectorsArray([
                        sectionSelectors.events,
                        filterSelectors.type,
                    ]),
                    attribute: 'eventTypes',
                    showMore: true,
                }),

                instantsearch.widgets.refinementList({
                    container: getElementBySelectorsArray([
                        sectionSelectors.events,
                        filterSelectors.countries,
                    ]),
                    attribute: 'locations.country',
                    showMore: false,
                    searchable: true,
                    searchablePlaceholder: 'e.g. United States',
                }),

                instantsearch.widgets.pagination({
                    container: getElementBySelectorsArray([
                        sectionSelectors.events,
                        widgetSelectors.pagination,
                    ]),
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
*/
            /**
             * Jobs search
             */
/*
            const jobsSearch = instantsearch({
                indexName: searchIndexes.jobs,
                searchClient,
            });

            const renderJobsStats = instantsearch.connectors.connectStats(
                createStatsWidget(sectionSelectors.jobs)
            );

            jobsSearch.addWidgets([
                renderJobsStats(),
                instantsearch.widgets.configure({
                    hitsPerPage: 4,
                }),
                instantsearch.widgets.clearRefinements({
                    container: getElementBySelectorsArray([
                        sectionSelectors.jobs,
                        filterSelectors.reset,
                    ]),
                }),
                instantsearch.widgets.hits({
                    container: getElementBySelectorsArray([
                        sectionSelectors.jobs,
                        widgetSelectors.hits,
                    ]),
                    cssClasses: {
                        list: ['d-flex', 'flex-wrap'],
                        item: ['col-12', 'mb-5'],
                    },
                    templates: {
                        item: `
                    <div class="card shadow-sm">
                        <div class="p-3">
                            <p class="lead">
                                <a href="` + mainDomain + `/jobs/{{ slug }}" class="text-decoration-none">{{ name }}</a>
                            </p>
                        </div>
                    </div>
                    `,
                    },
                }),
                instantsearch.widgets.refinementList({
                    container: getElementBySelectorsArray([
                        sectionSelectors.jobs,
                        filterSelectors.countries,
                    ]),
                    attribute: 'locations.country',
                    showMore: false,
                    searchable: true,
                    searchablePlaceholder: 'e.g. United States',
                }),
                instantsearch.widgets.refinementList({
                    container: getElementBySelectorsArray([
                        sectionSelectors.jobs,
                        filterSelectors.type,
                    ]),
                    attribute: 'employment_type',
                    showMore: true,
                }),
                instantsearch.widgets.refinementList({
                    container: getElementBySelectorsArray([
                        sectionSelectors.jobs,
                        filterSelectors.companies,
                    ]),
                    attribute: 'owner',
                    showMore: true,
                }),
                instantsearch.widgets.pagination({
                    container: getElementBySelectorsArray([
                        sectionSelectors.jobs,
                        widgetSelectors.pagination,
                    ]),
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
*/
            $('.nes-submit-button').on('click', function(e) {
                var query = $('.nes-main-input').val().trim();

                companySearch.helper.setQuery(query).search();
                peopleSearch.helper.setQuery(query).search();
                // investorSearch.helper.setQuery(query).search();
                // researchSearch.helper.setQuery(query).search();
                // clinicalTrialsSearch.helper.setQuery(query).search();
                // eventsSearch.helper.setQuery(query).search();
                // jobsSearch.helper.setQuery(query).search();
            });
        });
    };
}( jQuery ));


