@extends('layouts.entity-show')

@section('breadcrumbs')
    @include('navbars.breadcrumb', [
        'items' => [
            'Courses' => route('discover.courses'),
            $course->name  => false
        ]
    ])
@endsection

@section('content')

    <div class="container py-4">

        <x-entities.entity-show-title-meta title="{{ urlencode($course->name) }}" />

        <div class="d-lg-flex justify-content-between flex-shrink-1">
            <div class="order-md-2 mb-3 mb-mb-0">
                <div class="max-width-500">
                    @foreach($course->companies as $company)
                        <div class="text-center">
                            <a href="{{ route('discover.organizations.show', $company->slug) }}" class="text-decoration-none">
                                <img src="{{ $company->entityImageUrl ?? asset('images/image-placeholder-course.png') }}" alt="{{ $company->name }}">
                                <p class="h4 mb-0">{{ $company->name }}</p>
                                @if($company->summary)
                                    <p class="text-start mt-2 mb-0 text-body">{{ $company->summary }}</p>
                                @endif
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="order-md-1 pe-md-5 flex-grow-1 max-width-780">
                <div class="row lead">
                    <div class="col-12 col-lg-6">
                        <div>
                            <i class="fa-sharp fa-solid fa-book-medical fa-fw me-1 text-secondary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Course type"></i>
                            <span>{{ $course->type }}</span>
                        </div>
                        <div>
                            <i class="fa-sharp fa-solid fa-book-open-reader fa-fw me-1 text-secondary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delivery method"></i>
                            <span>{{ $course->delivery_method }}</span>
                        </div>
                        @if ($course->next_date)
                            <div>
                                <i class="fa-sharp fa-solid fa-calendars fa-fw me-1 text-secondary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Next course starts"></i>
                                <span>{{ Carbon\Carbon::parse($course->next_date)->format('M d, Y') }}</span>
                                @if($course->finish_date)
                                    <span>&ndash;</span>
                                     <span>{{ Carbon\Carbon::parse($course->finish_date)->format('M d, Y') }}</span>
                                @endif
                            </div>
                        @elseif($course->next_date_string)
                            <div>
                                <i class="fa-sharp fa-solid fa-calendars fa-fw me-1 text-secondary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Next course starts"></i>
                                <span>{{ $course->next_date_string  }}</span>
                            </div>
                        @endif
                        <div>
                            <i class="fa-sharp fa-solid fa-credit-card-front fa-fw me-1 text-secondary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cost"></i>
                            @if($course->lowest_cost === NULL)
                                <span>Unknown</span>
                            @elseif($course->lowest_cost === 0)
                                <span>Free</span>
                            @else
                                {{ number_format($course->lowest_cost , 0)}}
                            @endif
                            @if($course->lowest_cost AND $course->highest_cost)
                                <span>&ndash;</span>
                            @endif
                            @if($course->highest_cost)
                                <span>{{ number_format($course->highest_cost, 0) }}</span>
                            @endif
                            @if($course->currency)
                                <span>{{ $course->currency }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <i class="fa-sharp fa-solid fa-location-dot fa-fw me-1 text-secondary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Learning location"></i>
                            <span>{{ $course->learning_location }}</span>
                        </div>
                        @if($course->length)
                            <div>
                                <i class="fa-sharp fa-solid fa-user-clock fa-fw me-1 text-secondary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Length of course"></i>
                                <span>{{ $course->length }}</span>
                            </div>
                        @endif
                        @if($course->open_enrollment === 1)
                            <div>
                                <i class="fa-sharp fa-solid fa-calendar-plus fa-fw me-1 text-secondary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enroll any time"></i>
                                <span>Open Enrollment</span>
                            </div>
                        @endif
                        @if($course->self_paced === 1)
                            <div>
                                <i class="fa-sharp fa-solid fa-user-clock fa-fw me-1 text-secondary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Learn at your own pace"></i>
                                <span>Self Paced</span>
                            </div>
                        @endif
                    </div>
                </div>

                @if($course->focus->count() > 0)
                    <div class="d-flex mt-3 lead border-top border-bottom py-3">
                        <div class="flex-shrink-0 min-width-150 text-end me-1">
                            <i class="fa-sharp fa-solid fa-tags fa-fw text-secondary fa-lg mt-1"></i>
                        </div>
                        <div>
                            <strong>Focus:</strong>
                            @foreach($course->focus as $focus)
                                <a href="{{ route('discover.focus.show', $focus->slug) }}">
                                    {{ $focus->name }}
                                </a>
                                @if(!$loop->last) <span class="mx-1 text-body-tertiary">/</span> @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($course->awarded)
                    <div class="d-flex mt-3 lead border-bottom pb-3">
                        <div class="flex-shrink-0 min-width-150 text-end me-1">
                            <i class="fa-sharp fa-solid fa-award-simple fa-fw text-secondary fa-lg mt-1"></i>
                        </div>
                        <div><strong>Awarded:</strong> {{ $course->awarded }}</div>
                    </div>
                @endif

                <div class="mt-4">
                    <h2 class="h4 text-body-emphasis">Description</h2>
                        <div class="text-start max-width-1000 text-body-secondary">{!! nl2br($course->summary) !!}</div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ $course->url }}" target="_blank" rel="noopener noreferrer" class="btn btn-lg btn-primary">Register for Course</a>
                    </div>
            </div>
        </div>

        <div class="mt-5 border-top pt-5">
            <h2 class="h3 text-body-emphasis">Related Courses</h2>
            <div class="row">
                @foreach($related as $record)
                    <x-entities.related.course-card :course="$record" />
                @endforeach
            </div>
        </div>

        @can('import')
            <div class="mt-5 border-top pt-3 d-flex justify-content-between small text-uppercase fw-bold">
                <div>Created {{ Carbon\Carbon::parse($course->created_at)->format('M d, Y H:i') }}</div>
                <div>Updated {{ Carbon\Carbon::parse($course->updated_at)->format('M d, Y H:i') }}</div>
                <div>
                    <a href="{{ route('admin.course.edit', $course->id) }}">Edit this record</a>
                </div>
            </div>
        @endcan
    </div>

@endsection
