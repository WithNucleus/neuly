<?php
use App\Models\EmbeddableSearchWidget;
?>
<div id="neulyEmbedSearchModal" class="nes-modal modal" tabindex="-1" role="dialog" aria-modal="true"
     style="display: none;">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <nav class="navbar navbar-dark bg-dark flex-xl-nowrap shadow navbar-expand-lg">
                    <span class="navbar-brand ml-3">
                        @if($widget->logo)
                            <img src="{{ asset('storage/embed_search_widget/' . $widget->logo) }}" alt="Nucleus">
                        @else
                            <img src="{{ asset('images/nucleus-logo-white.png') }}" alt="Nucleus">
                        @endif
                    </span>
                    <div class="ml-3 mr-auto d-flex">
                        <input class="nes-main-input form-control search-field" name="search"
                               type="search" placeholder="Search..."
                               aria-label="Search" autocomplete="off" spellcheck="false" dir="auto">
                        <button class="nes-submit-button btn ml-2 my-2 my-sm-0" type="submit"
                                title="Search">&#128269
                        </button>
                    </div>
                    <button type="button" class="close nes-btn-close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&#x2715</span></button>
                </nav>
                <div class="content">
                    <ul class="nav nav-tabs mb-2" role="tablist">
                        @foreach($widget->tabs as $tab)
                            @if($tab == EmbeddableSearchWidget::TAB_MAIN)
                                <li class="nav-item">
                                    <a class="nav-link nes-main-tab {{ $activeTab == $tab ? 'active' : '' }}" data-toggle="tab" href=".nes-main-section"
                                       role="tab" aria-controls="main" aria-selected="true">All</a>
                                </li>
                            @endif
                            @if($tab == EmbeddableSearchWidget::TAB_COMPANIES)
                                <li class="nav-item">
                                    <a class="nav-link nes-companies-tab {{ $activeTab == $tab ? 'active' : '' }}" data-toggle="tab"
                                       href=".nes-section-companies"
                                       role="tab" aria-controls="companies" aria-selected="false">Organizations</a>
                                </li>
                            @endif
                            @if($tab == EmbeddableSearchWidget::TAB_PEOPLE)
                                <li class="nav-item">
                                    <a class="nav-link nes-people-tab {{ $activeTab == $tab ? 'active' : '' }}" data-toggle="tab" href=".nes-section-people"
                                       role="tab"
                                       aria-controls="people" aria-selected="false">People</a>
                                </li>
                            @endif
                            @if($tab == EmbeddableSearchWidget::TAB_INVESTORS)
                                <li class="nav-item">
                                    <a class="nav-link nes-investors-tab {{ $activeTab == $tab ? 'active' : '' }}" data-toggle="tab"
                                       href=".nes-section-investors"
                                       role="tab" aria-controls="investors" aria-selected="false">Investors</a>
                                </li>
                            @endif
                            @if($tab == EmbeddableSearchWidget::TAB_RESEARCH)
                                <li class="nav-item">
                                    <a class="nav-link nes-research-tab {{ $activeTab == $tab ? 'active' : '' }}" data-toggle="tab" href=".nes-section-research"
                                       role="tab" aria-controls="research" aria-selected="false">Research</a>
                                </li>
                            @endif
                            @if($tab == EmbeddableSearchWidget::TAB_CLINICAL_TRIALS)
                                <li class="nav-item">
                                    <a class="nav-link nes-clinical-trials-tab {{ $activeTab == $tab ? 'active' : '' }}" data-toggle="tab"
                                       href=".nes-section-clinical-trials" role="tab" aria-controls="clinical-trials"
                                       aria-selected="false">Clinical Trials</a>
                                </li>
                            @endif
                            @if($tab == EmbeddableSearchWidget::TAB_EVENTS)
                                <li class="nav-item">
                                    <a class="nav-link nes-events-tab {{ $activeTab == $tab ? 'active' : '' }}" data-toggle="tab" href=".nes-section-events"
                                       role="tab"
                                       aria-controls="events" aria-selected="false">Events</a>
                                </li>
                            @endif
                            @if($tab == EmbeddableSearchWidget::TAB_JOBS)
                                <li class="nav-item">
                                    <a class="nav-link nes-jobs-tab {{ $activeTab == $tab ? 'active' : '' }}" data-toggle="tab" href=".nes-section-jobs"
                                       role="tab"
                                       aria-controls="jobs" aria-selected="false">Jobs</a>
                                </li>
                            @endif
                            @if($tab == EmbeddableSearchWidget::TAB_NEWS_ARTICLES)
                                <li class="nav-item">
                                    <a class="nav-link nes-news-articles-tab {{ $activeTab == $tab ? 'active' : '' }}" data-toggle="tab" href=".nes-section-news-articles"
                                       role="tab"
                                       aria-controls="news-articles" aria-selected="false">News Articles</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach($widget->tabs as $tab)
                            @if($tab == EmbeddableSearchWidget::TAB_MAIN)
                                <div class="nes-main-section tab-pane fade {{ $activeTab == $tab ? 'show active' : '' }}" role="tabpanel"
                                     aria-labelledby="main-tab">
                                </div>
                            @endif
                            @if($tab == EmbeddableSearchWidget::TAB_COMPANIES)
                                <div class="nes-section-companies tab-pane fade {{ $activeTab == $tab ? 'show active' : '' }}" role="tabpanel"
                                     aria-labelledby="companies-tab">
                                    <div class="row search-content-row">
                                        @if(isset($widget->filters[EmbeddableSearchWidget::TAB_COMPANIES]))
                                            @include('external-scripts.embed-search.includes.filters', [
                                                'filters' => $widget->filters[EmbeddableSearchWidget::TAB_COMPANIES]
                                            ])
                                        @endif
{{--                                        @include('external-scripts.embed-search.includes.filters', [--}}
{{--                                            'filters' => [--}}
{{--                                                /*'has-events' => true,--}}
{{--                                                'has-jobs' => true,--}}
{{--                                                'type' => true,--}}
{{--                                                'countries' => true,--}}
{{--                                                'locations' => true,*/--}}
{{--                                                'focus' => true,--}}
{{--                                            ]--}}
{{--                                        ])--}}
                                        @include('external-scripts.embed-search.includes.data-section', ['title' => 'Organizations'])
                                    </div>
                                </div>
                            @endif
                            @if($tab == EmbeddableSearchWidget::TAB_PEOPLE)
                                <div class="nes-section-people tab-pane fade {{ $activeTab == $tab ? 'show active' : '' }}" role="tabpanel"
                                     aria-labelledby="people-tab">
                                    <div class="row search-content-row">
                                        @if(isset($widget->filters[EmbeddableSearchWidget::TAB_PEOPLE]))
                                            @include('external-scripts.embed-search.includes.filters', [
                                                'filters' => $widget->filters[EmbeddableSearchWidget::TAB_PEOPLE]
                                            ])
                                        @endif
{{--                                        @include('external-scripts.embed-search.includes.filters', [--}}
{{--                                            'filters' => [--}}
{{--                                                'focus' => true,--}}
{{--                                                /*'countries' => true,*/--}}
{{--                                            ]--}}
{{--                                        ])--}}
                                        @include('external-scripts.embed-search.includes.data-section', ['title' => 'People'])
                                    </div>
                                </div>
                            @endif
                            @if($tab == EmbeddableSearchWidget::TAB_INVESTORS)
                                <div class="nes-section-investors tab-pane fade {{ $activeTab == $tab ? 'show active' : '' }}" role="tabpanel"
                                     aria-labelledby="investors-tab">
                                    <div class="row search-content-row">
                                        @if(isset($widget->filters[EmbeddableSearchWidget::TAB_INVESTORS]))
                                            @include('external-scripts.embed-search.includes.filters', [
                                                'filters' => $widget->filters[EmbeddableSearchWidget::TAB_INVESTORS]
                                            ])
                                        @endif
{{--                                        @include('external-scripts.embed-search.includes.filters', [--}}
{{--                                            'filters' => [--}}
{{--                                                'has-jobs' => true,--}}
{{--                                                'type' => true,--}}
{{--                                                'countries' => true,--}}
{{--                                            ]--}}
{{--                                        ])--}}
                                        @include('external-scripts.embed-search.includes.data-section', ['title' => 'Investors'])
                                    </div>
                                </div>
                            @endif
                            @if($tab == EmbeddableSearchWidget::TAB_RESEARCH)
                                <div class="nes-section-research tab-pane fade {{ $activeTab == $tab ? 'show active' : '' }}" role="tabpanel"
                                     aria-labelledby="research-tab">
                                    <div class="row search-content-row">
                                        @if(isset($widget->filters[EmbeddableSearchWidget::TAB_RESEARCH]))
                                            @include('external-scripts.embed-search.includes.filters', [
                                                'filters' => $widget->filters[EmbeddableSearchWidget::TAB_RESEARCH]
                                            ])
                                        @endif
{{--                                        @include('external-scripts.embed-search.includes.filters', [--}}
{{--                                            'filters' => [--}}
{{--                                                'focus' => true,--}}
{{--                                                'companies' => true,--}}
{{--                                                'people' => true,--}}
{{--                                            ]--}}
{{--                                        ])--}}
                                        @include('external-scripts.embed-search.includes.data-section', ['title' => 'Research'])
                                    </div>
                                </div>
                            @endif
                            @if($tab == EmbeddableSearchWidget::TAB_CLINICAL_TRIALS)
                                <div class="nes-section-clinical-trials tab-pane fade {{ $activeTab == $tab ? 'show active' : '' }}" role="tabpanel"
                                     aria-labelledby="clinical-trials-tab">
                                    <div class="row search-content-row">
                                        @if(isset($widget->filters[EmbeddableSearchWidget::TAB_CLINICAL_TRIALS]))
                                            @include('external-scripts.embed-search.includes.filters', [
                                                'filters' => $widget->filters[EmbeddableSearchWidget::TAB_CLINICAL_TRIALS]
                                            ])
                                        @endif
{{--                                        @include('external-scripts.embed-search.includes.filters', [--}}
{{--                                            'filters' => [--}}
{{--                                                'focus' => true,--}}
{{--                                                'people' => true,--}}
{{--                                                'companies' => true,--}}
{{--                                                'status' => true,--}}
{{--                                            ],--}}
{{--                                            'labels' => ['people' => 'Researches']--}}
{{--                                        ])--}}
                                        @include('external-scripts.embed-search.includes.data-section', ['title' => 'Clinical Trials'])
                                    </div>
                                </div>
                            @endif
                            @if($tab == EmbeddableSearchWidget::TAB_EVENTS)
                                <div class="nes-section-events tab-pane fade {{ $activeTab == $tab ? 'show active' : '' }}" role="tabpanel"
                                     aria-labelledby="events-tab">
                                    <div class="row search-content-row">
                                        @if(isset($widget->filters[EmbeddableSearchWidget::TAB_EVENTS]))
                                            @include('external-scripts.embed-search.includes.filters', [
                                                'filters' => $widget->filters[EmbeddableSearchWidget::TAB_EVENTS]
                                            ])
                                        @endif
{{--                                        @include('external-scripts.embed-search.includes.filters', [--}}
{{--                                            'filters' => [--}}
{{--                                                'type' => true,--}}
{{--                                                'countries' => true,--}}
{{--                                                'focus' => true,--}}
{{--                                                'companies' => true,--}}
{{--                                            ]--}}
{{--                                        ])--}}
                                        @include('external-scripts.embed-search.includes.data-section', ['title' => 'Events'])
                                    </div>
                                </div>
                            @endif
                            @if($tab == EmbeddableSearchWidget::TAB_JOBS)
                                <div class="nes-section-jobs tab-pane fade {{ $activeTab == $tab ? 'show active' : '' }}" role="tabpanel" aria-labelledby="jobs-tab">
                                    <div class="row search-content-row">
                                        @if(isset($widget->filters[EmbeddableSearchWidget::TAB_JOBS]))
                                            @include('external-scripts.embed-search.includes.filters', [
                                                'filters' => $widget->filters[EmbeddableSearchWidget::TAB_JOBS]
                                            ])
                                        @endif
{{--                                        @include('external-scripts.embed-search.includes.filters', [--}}
{{--                                            'filters' => [--}}
{{--                                                'type' => true,--}}
{{--                                                'countries' => true,--}}
{{--                                                'companies' => true,--}}
{{--                                            ],--}}
{{--                                            'labels' => ['companies' => 'Owner']--}}
{{--                                        ])--}}
                                        @include('external-scripts.embed-search.includes.data-section', ['title' => 'Jobs'])
                                    </div>
                                </div>
                            @endif
                            @if($tab == EmbeddableSearchWidget::TAB_NEWS_ARTICLES)
                                <div class="nes-section-news-articles tab-pane fade {{ $activeTab == $tab ? 'show active' : '' }}" role="tabpanel" aria-labelledby="news-articles-tab">
                                    <div class="row search-content-row">
                                        @if(isset($widget->filters[EmbeddableSearchWidget::TAB_NEWS_ARTICLES]))
                                            @include('external-scripts.embed-search.includes.filters', [
                                                'filters' => $widget->filters[EmbeddableSearchWidget::TAB_NEWS_ARTICLES]
                                            ])
                                        @endif
                                        @include('external-scripts.embed-search.includes.data-section', ['title' => 'News articles'])
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
