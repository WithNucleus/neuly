<div id="neulyEmbedSearchModal" class="nes-modal modal" tabindex="-1" role="dialog" aria-modal="true" style="display: none;">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <nav class="navbar navbar-dark bg-dark flex-xl-nowrap shadow navbar-expand-lg">
                    <span class="navbar-brand ml-3"><img src=" {{ asset('images/neuly-logo-dark.png') }}"
                                                         alt="Neuly"></span>
                    <div class="ml-3 mr-auto d-flex">
                        <input class="nes-main-input form-control search-field" name="search"
                               type="search" placeholder="Search..."
                               aria-label="Search" autocomplete="off" spellcheck="false" dir="auto">
                        <button class="nes-submit-button btn ml-2 my-2 my-sm-0" type="submit"
                                title="Search">&#128269</button>
                    </div>
                    <button type="button" class="close nes-btn-close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&#x2715</span></button>
                </nav>
                <div class="content">
                    <ul class="nav nav-tabs mb-2" role="tablist">
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a class="nav-link nes-main-tab " data-toggle="tab" href=".nes-main-section"--}}
                        {{--                               role="tab" aria-controls="main" aria-selected="true">All</a>--}}
                        {{--                        </li>--}}
                        <li class="nav-item">
                            <a class="nav-link nes-companies-tab active" data-toggle="tab" href=".nes-section-companies"
                               role="tab" aria-controls="companies" aria-selected="false">Organizations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nes-people-tab" data-toggle="tab" href=".nes-section-people" role="tab"
                               aria-controls="people" aria-selected="false">People</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nes-investors-tab" data-toggle="tab" href=".nes-section-investors"
                               role="tab" aria-controls="investors" aria-selected="false">Investors</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nes-research-tab" data-toggle="tab" href=".nes-section-research"
                               role="tab" aria-controls="research" aria-selected="false">Research</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nes-clinical-trials-tab" data-toggle="tab"
                               href=".nes-section-clinical-trials" role="tab" aria-controls="clinical-trials"
                               aria-selected="false">Clinical Trials</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nes-events-tab" data-toggle="tab" href=".nes-section-events" role="tab"
                               aria-controls="events" aria-selected="false">Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nes-jobs-tab" data-toggle="tab" href=".nes-section-jobs" role="tab"
                               aria-controls="jobs" aria-selected="false">Jobs</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                    {{--                        <div class="nes-main-section tab-pane fade show active" role="tabpanel"--}}
                    {{--                             aria-labelledby="main-tab">--}}
                    {{--                        </div>--}}
                    <!-- Organizations -->
                        <div class="nes-section-companies tab-pane fade show active" role="tabpanel"
                             aria-labelledby="companies-tab">
                            <div class="row search-content-row">
                                @include('external-scripts.embed-search.includes.filters', [
                                    'filters' => [
                                        'has-events' => true,
                                        'has-jobs' => true,
                                        'type' => true,
                                        'countries' => true,
                                        'locations' => true,
                                        'focus' => true,
                                    ]
                                ])
                                @include('external-scripts.embed-search.includes.data-section', ['title' => 'Organizations'])
                            </div>
                        </div>
                        <!-- People -->
                        <div class="nes-section-people tab-pane fade" role="tabpanel" aria-labelledby="people-tab">
                            <div class="row search-content-row">
                                @include('external-scripts.embed-search.includes.filters', [
                                    'filters' => [
                                        'countries' => true,
                                    ]
                                ])
                                @include('external-scripts.embed-search.includes.data-section', ['title' => 'People'])
                            </div>
                        </div>
                        <!-- Investors -->
                        <div class="nes-section-investors tab-pane fade" role="tabpanel"
                             aria-labelledby="investors-tab">
                            <div class="row search-content-row">
                                @include('external-scripts.embed-search.includes.filters', [
                                    'filters' => [
                                        'has-jobs' => true,
                                        'type' => true,
                                        'countries' => true,
                                    ]
                                ])
                                @include('external-scripts.embed-search.includes.data-section', ['title' => 'Investors'])
                            </div>
                        </div>
                        <!-- Research -->
                        <div class="nes-section-research tab-pane fade" role="tabpanel" aria-labelledby="research-tab">
                            <div class="row search-content-row">
                                @include('external-scripts.embed-search.includes.filters', [
                                    'filters' => [
                                        'focus' => true,
                                        'companies' => true,
                                        'people' => true,
                                    ]
                                ])
                                @include('external-scripts.embed-search.includes.data-section', ['title' => 'Research'])
                            </div>
                        </div>
                        <!-- Clinical Trials -->
                        <div class="nes-section-clinical-trials tab-pane fade" role="tabpanel"
                             aria-labelledby="clinical-trials-tab">
                            <div class="row search-content-row">
                                @include('external-scripts.embed-search.includes.filters', [
                                    'filters' => [
                                        'focus' => true,
                                        'people' => true,
                                        'companies' => true,
                                        'status' => true,
                                    ],
                                    'labels' => ['people' => 'Researches']
                                ])
                                @include('external-scripts.embed-search.includes.data-section', ['title' => 'Clinical Trials'])
                            </div>
                        </div>
                        <!-- Events -->
                        <div class="nes-section-events tab-pane fade" role="tabpanel" aria-labelledby="events-tab">
                            <div class="row search-content-row">
                                @include('external-scripts.embed-search.includes.filters', [
                                    'filters' => [
                                        'type' => true,
                                        'countries' => true,
                                        'focus' => true,
                                        'companies' => true,
                                    ]
                                ])
                                @include('external-scripts.embed-search.includes.data-section', ['title' => 'Events'])
                            </div>
                        </div>
                        <!-- Jobs -->
                        <div class="nes-section-jobs tab-pane fade" role="tabpanel" aria-labelledby="jobs-tab">
                            <div class="row search-content-row">
                                @include('external-scripts.embed-search.includes.filters', [
                                    'filters' => [
                                        'type' => true,
                                        'countries' => true,
                                        'companies' => true,
                                    ],
                                    'labels' => ['companies' => 'Owner']
                                ])
                                @include('external-scripts.embed-search.includes.data-section', ['title' => 'Jobs'])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
