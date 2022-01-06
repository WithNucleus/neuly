<div class="search-modal modal fade" id="searchModal" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="companies-tab" data-toggle="tab" href="#companies" role="tab" aria-controls="companies" aria-selected="false">Organizations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="people-tab" data-toggle="tab" href="#people" role="tab" aria-controls="people" aria-selected="false">People</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="investors-tab" data-toggle="tab" href="#investors" role="tab" aria-controls="investors" aria-selected="false">Investors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="research-tab" data-toggle="tab" href="#research" role="tab" aria-controls="research" aria-selected="false">Research</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="clinical-trials-tab" data-toggle="tab" href="#clinical-trials" role="tab" aria-controls="clinical-trials" aria-selected="false">Clinical Trials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="events-tab" data-toggle="tab" href="#events" role="tab" aria-controls="events" aria-selected="false">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="jobs-tab" data-toggle="tab" href="#jobs" role="tab" aria-controls="jobs" aria-selected="false">Jobs</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        ToDo
                    </div>
                    <!-- Organizations -->
                    <div class="tab-pane fade" id="companies" role="tabpanel" aria-labelledby="companies-tab">
                        <div class="row">
                            <div class="col-3 bg-light">
                                <div class="title clearfix">
                                    <div class="h3 border-bottom pb-2 filter-title">
                                        Filters
                                        <span id="reset"></span>
                                    </div>
                                </div>
                                <div class="sidebar-sticky collapse">
                                    <div id="searchbox" class="mb-3"></div>
                                    <div id="has-events"></div>
                                    <div id="has-jobs" class="mb-3"></div>
                                    <div class="h4">Type:</div>
                                    <div id="type" class="mb-3"></div>
                                    <div class="h4">Locations:</div>
                                    <div id="countries" class="mb-3"></div>
                                    <div id="locations" class="mb-3"></div>
                                    <div class="h4">Focus:</div>
                                    <div id="focus"></div>
                                </div>
                            </div>
                            <main role="main" class="col-9">
                                @include('discover.includes.status-messages')

                                <div class="row">
                                    <div class="col-12">
                                        <div class="full-width-show-view">

                                            <div class="page-title-default d-md-flex justify-content-between">
                                                <span class="lead-smaller align-self-end pb-1">
                                                    Showing <span id="stats"></span> Organizations
                                                </span>
                                            </div>

                                            <div id="sort-by"></div>
                                            <div id="hits"></div>
                                            <div id="pagination"></div>

                                        </div>
                                    </div>
                                </div>
                            </main>
                        </div>
                    </div>
                    <!-- People -->
                    <div class="tab-pane fade" id="people" role="tabpanel" aria-labelledby="people-tab">
                        <div class="row">
                            <div class="col-3 bg-light">
                                <div class="title clearfix">
                                    <div class="h3 border-bottom pb-2 filter-title">
                                        Filters
                                        <span id="reset"></span>
                                    </div>
                                </div>
                                <div class="sidebar-sticky collapse">
                                    <div id="searchbox" class="mb-3"></div>
                                    <div class="h4">Locations:</div>
                                    <div id="countries" class="mb-3"></div>
                                </div>
                            </div>
                            <main role="main" class="col-9">
                                @include('discover.includes.status-messages')

                                <div class="row">

                                    <div class="col-12">
                                        <div class="full-width-show-view">

                                            <div class="page-title-default d-md-flex justify-content-between">
                                                <span class="lead-smaller align-self-end pb-1">
                                    Showing <span id="stats"></span> People
                                </span>
                                            </div>

                                            <div id="sort-by"></div>
                                            <div id="hits"></div>
                                            <div id="pagination"></div>

                                        </div>
                                    </div>

                                </div>
                            </main>
                        </div>
                    </div>
                    <!-- Investors -->
                     <div class="tab-pane fade" id="investors" role="tabpanel" aria-labelledby="investors-tab">
                        <div class="row">
                            <div class="col-3 bg-light">
                                <div class="title clearfix">
                                    <div class="h3 border-bottom pb-2 filter-title">
                                        Filters
                                        <span id="reset"></span>
                                    </div>
                                </div>
                                <div class="sidebar-sticky collapse">
                                    <div id="searchbox" class="mb-3"></div>
                                    <div id="has-jobs" class="mb-3"></div>
                                    <div class="h4">Type:</div>
                                    <div id="type" class="mb-3"></div>
                                    <div class="h4">Locations:</div>
                                    <div id="countries" class="mb-3"></div>
                                </div>
                            </div>
                            <main role="main" class="col-9">
                                @include('discover.includes.status-messages')

                                <div class="row">

                                    <div class="col-12">
                                        <div class="full-width-show-view">

                                            <div class="page-title-default d-md-flex justify-content-between">
                                                <span class="lead-smaller align-self-end pb-1">
                                    Showing <span id="stats"></span> Investors
                                </span>
                                            </div>

                                            <div id="sort-by"></div>
                                            <div id="hits"></div>
                                            <div id="pagination"></div>

                                        </div>
                                    </div>

                                </div>
                            </main>
                        </div>
                    </div>
                    <!-- Research -->
                    <div class="tab-pane fade" id="research" role="tabpanel" aria-labelledby="research-tab">
                        <div class="row">
                            <div class="col-3 bg-light">
                                <div class="title clearfix">
                                    <div class="h3 border-bottom pb-2 filter-title">
                                        Filters
                                        <span id="reset"></span>
                                    </div>
                                </div>
                                <div class="sidebar-sticky collapse">
                                    <div id="searchbox" class="mb-3"></div>
                                    <div class="h4">Focus:</div>
                                    <div id="focus" class="mb-3"></div>
                                    <div class="h4">People:</div>
                                    <div id="people" class="mb-3"></div>
                                    <div class="h4">Organizations:</div>
                                    <div id="companies" class="mb-3"></div>
                                </div>
                            </div>
                            <main role="main" class="col-9">
                                @include('discover.includes.status-messages')

                                <div class="row">

                                    <div class="col-12">
                                        <div class="full-width-show-view">

                                            <div class="page-title-default d-md-flex justify-content-between">
                                                <span class="lead-smaller align-self-end pb-1">
                                    Showing <span id="stats"></span> Research
                                </span>
                                            </div>

                                            <div id="sort-by"></div>
                                            <div id="hits"></div>
                                            <div id="pagination"></div>

                                        </div>
                                    </div>

                                </div>
                            </main>
                        </div>
                    </div>
                    <!-- Clinical Trials -->
                    <div class="tab-pane fade" id="clinical-trials" role="tabpanel" aria-labelledby="clinical-trials-tab">
                        <div class="row">
                            <div class="col-3 bg-light">
                                <div class="title clearfix">
                                    <div class="h3 border-bottom pb-2 filter-title">
                                        Filters
                                        <span id="reset"></span>
                                    </div>
                                </div>
                                <div class="sidebar-sticky collapse">
                                    <div id="searchbox" class="mb-3"></div>
                                    <div class="h4">Focus:</div>
                                    <div id="focus" class="mb-3"></div>
                                    <div class="h4">Researchers:</div>
                                    <div id="people" class="mb-3"></div>
                                    <div class="h4">Organizations:</div>
                                    <div id="companies" class="mb-3"></div>
                                    <div class="h4">Status:</div>
                                    <div id="status" class="mb-3"></div>
                                </div>
                            </div>
                            <main role="main" class="col-9">
                                @include('discover.includes.status-messages')

                                <div class="row">

                                    <div class="col-12">
                                        <div class="full-width-show-view">

                                            <div class="page-title-default d-md-flex justify-content-between">
                                                <span class="lead-smaller align-self-end pb-1">
                                    Showing <span id="stats"></span> Clinical Trials
                                </span>
                                            </div>

                                            <div id="sort-by"></div>
                                            <div id="hits"></div>
                                            <div id="pagination"></div>

                                        </div>
                                    </div>

                                </div>
                            </main>
                        </div>
                    </div>
                    <!-- Events -->
                    <div class="tab-pane fade" id="events" role="tabpanel" aria-labelledby="events-tab">
                        <div class="row">
                            <div class="col-3 bg-light">
                                <div class="title clearfix">
                                    <div class="h3 border-bottom pb-2 filter-title">
                                        Filters
                                        <span id="reset"></span>
                                    </div>
                                </div>
                                <div class="sidebar-sticky collapse">
                                    <div id="searchbox" class="mb-3"></div>
                                    <div class="h4">Type:</div>
                                    <div id="type" class="mb-3"></div>
                                    <div class="h4">Locations:</div>
                                    <div id="countries" class="mb-3"></div>
                                    <div class="h4">Focus:</div>
                                    <div id="focus" class="mb-3"></div>
                                    <div class="h4">Organizations:</div>
                                    <div id="companies" class="mb-3"></div>
                                </div>
                            </div>
                            <main role="main" class="col-9">
                                @include('discover.includes.status-messages')

                                <div class="row">

                                    <div class="col-12">
                                        <div class="full-width-show-view">

                                            <div class="page-title-default d-md-flex justify-content-between">
                                                <span class="lead-smaller align-self-end pb-1">
                                    Showing <span id="stats"></span> Events
                                </span>
                                            </div>

                                            <div id="sort-by"></div>
                                            <div id="hits"></div>
                                            <div id="pagination"></div>

                                        </div>
                                    </div>

                                </div>
                            </main>
                        </div>
                    </div>
                    <!-- Jobs -->
                    <div class="tab-pane fade" id="jobs" role="tabpanel" aria-labelledby="jobs-tab">
                        <div class="row">
                            <div class="col-3 bg-light">
                                <div class="title clearfix">
                                    <div class="h3 border-bottom pb-2 filter-title">
                                        Filters
                                        <span id="reset"></span>
                                    </div>
                                </div>
                                <div class="sidebar-sticky collapse">
                                    <div id="searchbox" class="mb-3"></div>
                                    <div class="h4">Type:</div>
                                    <div id="type" class="mb-3"></div>
                                    <div class="h4">Locations:</div>
                                    <div id="countries" class="mb-3"></div>
                                    <div class="h4">Owner:</div>
                                    <div id="companies" class="mb-3"></div>
                                </div>
                            </div>
                            <main role="main" class="col-9">
                                @include('discover.includes.status-messages')

                                <div class="row">

                                    <div class="col-12">
                                        <div class="full-width-show-view">

                                            <div class="page-title-default d-md-flex justify-content-between">
                                                <span class="lead-smaller align-self-end pb-1">
                                    Showing <span id="stats"></span> Events
                                </span>
                                            </div>

                                            <div id="sort-by"></div>
                                            <div id="hits"></div>
                                            <div id="pagination"></div>

                                        </div>
                                    </div>

                                </div>
                            </main>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
