<?php
/**
 * @var \Illuminate\Database\Eloquent\Collection[] $items
 */

$showMoreLimit = 9;
?>
<div class="d-flex flex-column">
    @foreach($items as $entityType => $collection)
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 shadow-sm">

                    @if($entityType == 'organizations')
                        <div class="card-header lead lead">
                            <span class="text-danger"><i class="fad fa-building"></i></span> Organizations
                        </div>
                        <div class="card-body">
                            <div class="card-deck justify-content-center">
                                @foreach($collection as $organization)
                                    <div class="col-sm-4">
                                        <div class="card">
                                            <div
                                                class="card-body text-center d-flex justify-content-center align-items-center">
                                                <a href="{{ route('discover.organizations.show', ['slug' => $organization->slug]) }}">
                                                    @if($organization->logo != '')
                                                        <img src="/storage/{{ $organization->logo }}"
                                                             alt="{{ $organization->name }}" class="company-logo mx-auto"
                                                             alt="{{$organization->name}}">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="card-footer bg-white text-center">
                                                <a href="{{ route('discover.organizations.show', ['slug' => $organization->slug]) }}"
                                                   class="lead text-primary">{{ $organization->name }}</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <p class="text-center mt-3 mb-0">
                                @if ($collection->count() > $showMoreLimit AND $term != '')
                                    <a href="{{ route('search.organizations').'/'.$term }}"
                                       class="btn btn-sm btn-dark shadow-sm mr-1">Show more...</a>
                                @endif
                                <a href="{{ route('discover.organizations') }}"
                                   class="btn btn-sm btn-outline-dark shadow-sm">See all organizations</a>
                            </p>
                        </div>
                    @endif

                    @if($entityType == 'focus')
                        <div class="card-header lead">
                            <span class="text-danger"><i class="fad fa-tags"></i></span> Focus
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach($items['focus'] as $item)
                                    <li class="list-group-item @if ($loop->last)border-bottom-0 @endif">
                                        <a href="{{ route('discover.focus.show', ['slug' => $item->slug]) }}">{{ $item->name }}</a>
                                    </li>
                                @endforeach
                                <li class="list-group-item text-center">
                                    @if ($items['focus']->count() > $showMoreLimit AND $term != '')
                                        <a href="{{ route('search.focus').'/'.$term }}"
                                           class="btn btn-sm btn-dark shadow-sm mr-1">Show more...</a>
                                    @endif
                                    <a href="{{ route('discover.focus') }}"
                                       class="btn btn-sm btn-outline-dark shadow-sm">See
                                        all focus categories</a>
                                </li>
                            </ul>
                        </div>
                    @endif

                    @if($entityType == 'people')
                        <div class="card-header lead">
                            <span class="text-danger"><i class="fad fa-users"></i></span> People
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach($collection as $person)
                                    <li class="list-group-item @if ($loop->last)border-bottom-0 @endif">
                                        <a href="{{ route('discover.people.show', ['slug' => $person->slug]) }}">{{ $person->name }}</a>
                                    </li>
                                @endforeach
                                <li class="list-group-item text-center">
                                    @if ($collection->count() > $showMoreLimit AND $term != '')
                                        <a href="{{ route('search.people').'/'.$term }}"
                                           class="btn btn-sm btn-dark shadow-sm mr-1">Show more...</a>
                                    @endif
                                    <a href="{{ route('discover.people') }}"
                                       class="btn btn-sm btn-outline-dark shadow-sm">See
                                        all people</a>
                                </li>
                            </ul>
                        </div>
                    @endif

                    @if($entityType == 'investors')
                        <div class="card-header lead">
                            <span class="text-danger"><i class="fad fa-hands-usd"></i></span> Investors
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach($collection as $investor)
                                    <li class="list-group-item  @if ($loop->last)border-bottom-0 @endif">
                                        <a href="{{ route('discover.investors.show', ['slug' => $investor->slug]) }}">{{ $investor->name }}</a>
                                    </li>
                                @endforeach
                                <li class="list-group-item text-center">
                                    @if ($collection->count() > $showMoreLimit AND $term != '')
                                        <a href="{{ route('search.investors').'/'.$term }}"
                                           class="btn btn-sm btn-dark shadow-sm mr-1">Show more...</a>
                                    @endif
                                    <a href="{{ route('discover.investors') }}"
                                       class="btn btn-sm btn-outline-dark shadow-sm">See all investors</a>
                                </li>
                            </ul>
                        </div>
                    @endif

                    @if($entityType == 'research')
                        <div class="card-header lead">
                            <span class="text-danger"><i class="fad fa-microscope"></i></span> Research
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach($collection as $publication)
                                    <li class="list-group-item @if ($loop->last)border-bottom-0 @endif">
                                        <a href="{{ route('discover.research.show', ['slug' => $publication->slug]) }}">{{ $publication->name }}</a>
                                    </li>
                                @endforeach
                                <li class="list-group-item text-center">
                                    @if ($collection->count() > $showMoreLimit AND $term != '')
                                        <a href="{{ route('search.research').'/'.$term }}"
                                           class="btn btn-sm btn-dark shadow-sm mr-1">Show more...</a>
                                    @endif
                                    <a href="{{ route('discover.research') }}"
                                       class="btn btn-sm btn-outline-dark shadow-sm">See all research</a>
                                </li>
                            </ul>
                        </div>
                    @endif

                    @if($entityType == 'locations')
                        <div class="card-header lead">
                            <span class="text-danger"><i class="fad fa-map-pin"></i></span> Locations
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach($collection as $location)
                                    <li class="list-group-item @if ($loop->last)border-bottom-0 @endif">
                                        <a href="{{ route('discover.locations.show', ['slug' => $location->slug]) }}">{{ $location->name }}</a>
                                    </li>
                                @endforeach
                                <li class="list-group-item text-center">
                                    @if ($collection->count() > $showMoreLimit AND $term != '')
                                        <a href="{{ route('search.locations').'/'.$term }}"
                                           class="btn btn-sm btn-dark shadow-sm mr-1">Show more...</a>
                                    @endif
                                    <a href="{{ route('discover.locations') }}"
                                       class="btn btn-sm btn-outline-dark shadow-sm mr-2">See all locations</a>
                                </li>
                            </ul>
                        </div>
                    @endisset

                    @if($entityType == 'events')
                        <div class="card-header lead">
                            <span class="text-danger"><i class="fad fa-calendar"></i></span> Events
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach($collection as $event)
                                    <li class="list-group-item @if ($loop->last)border-bottom-0 @endif">
                                        <a href="{{ route('discover.events.show',['slug' => $event->slug]) }}">{{ $event->name }}</a>
                                    </li>
                                @endforeach
                                <li class="list-group-item text-center">
                                    @if ($collection->count() > $showMoreLimit AND $term != '')
                                        <a href="{{ route('search.events').'/'.$term }}"
                                           class="btn btn-sm btn-dark shadow-sm mr-1">Show more...</a>
                                    @endif
                                    <a href="{{ route('discover.events') }}"
                                       class="btn btn-sm btn-outline-dark shadow-sm">See
                                        all events</a>
                                </li>
                            </ul>
                        </div>
                    @endif

                    @if($entityType == 'jobs')
                        <div class="card-header lead">
                            <span class="text-danger"><i class="fad fa-briefcase"></i></span> Jobs
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach($collection as $job)
                                    <li class="list-group-item @if ($loop->last)border-bottom-0 @endif">
                                        <a href="{{ route('discover.jobs.show', ['slug' => $job->slug]) }}">{{ $job->job_title }}</a>
                                    </li>
                                @endforeach
                                <li class="list-group-item text-center">
                                    @if ($collection->count() > $showMoreLimit AND $term != '')
                                        <a href="{{ route('search.jobs').'/'.$term }}"
                                           class="btn btn-sm btn-dark shadow-sm mr-1">Show more...</a>
                                    @endif
                                    <a href="{{ route('discover.jobs') }}"
                                       class="btn btn-sm btn-outline-dark shadow-sm">See
                                        all jobs</a>
                                </li>
                            </ul>
                        </div>
                    @endif

                    @if($entityType == 'clinicalTrials')
                        <div class="card-header lead lead">
                            <span class="text-danger"><i class="fad fa-stethoscope"></i></span> Clinical Trials
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach($collection as $clinicalTrial)
                                    <li class="list-group-item @if ($loop->last)border-bottom-0 @endif">
                                        <a href="{{ route('discover.clinicaltrials.show', ['slug' => $clinicalTrial->slug]) }}">{{ $clinicalTrial->title }}</a>
                                    </li>
                                @endforeach
                                <li class="list-group-item text-center">
                                    @if ($collection->count() > $showMoreLimit AND $term != '')
                                        <a href="{{ route('search.clinicaltrials').'/'.$term }}"
                                           class="btn btn-sm btn-dark shadow-sm mr-1">Show more...</a>
                                    @endif
                                    <a href="{{ route('discover.clinicaltrials') }}"
                                       class="btn btn-sm btn-outline-dark shadow-sm">See all clinical trials</a>
                                </li>
                            </ul>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    @endforeach
</div>
