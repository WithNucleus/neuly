@extends('layouts.entity-show')

@section('breadcrumbs')
    @include('navbars.breadcrumb', [
        'items' => [
            'Industry Reports' => route('discover.industry-reports'),
            $report->name  => false
        ]
    ])
@endsection

@section('content')

    <div class="bg-body-secondary">
        <div class="container py-5">
            <div class="row industry-report-hero">
                <div class="col-12 col-lg-6 pe-lg-5 mb-3 mb-lg-0">
                    <img src="{{ $report->entityImageUrl }}" alt="{{ $report->name }}">
                    @can('edit companies')
                        <div class="mt-2 text-center">
                            <a href="{{ route('adminx.reports.edit', $report->id) }}" class="fw-bold text-uppercase">Edit Report</a>
                        </div>
                    @endcan
                </div>
                <div class="col-12 col-lg-6">
                    <div class="d-flex">
                        <div>
                            <p class="post-meta">
                                <span class="date">{{ \Carbon\Carbon::parse($report->date)->format('M j, Y') }}</span>
                                <span class="mx-1">&bull;</span>
                                <span class="read-time">{{ $report->reading_time }}</span>
                            </p>
                            <h1 class="mb-0">{{ $report->name }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-4">
        <div class="industry-report-single">
            <div class="industry-report-flex-container">
                <div class="industry-report-content">
                    @can('view pro content')
                        <div class="d-lg-none my-4">
                            <button id="toc-mobile-trigger" class="btn btn-primary btn-sm">Table of Contents</button>
                        </div>
                        {!! $report->content !!}
                    @else
                        <div class="mb-5 fs-6">
                            {!! $report->preview ?? $report->excerpt !!}
                        </div>
                        <div class="bg-accent text-white px-4 py-5 text-center fs-4">
                            <div class="mb-3">
                                You must have PRO to access this content.
                            </div>
                            <div class="d-flex align-items-center justify-content-center flex-wrap">
                                <a href="https://pro.psychedelicinvest.com" class="btn btn-primary btn-lg m-2">Become a PRO</a>
                                <a href="{{ route('login') }}" class="btn btn-dark btn-lg m-2">Login to Neuly</a>
                            </div>
                        </div>
                    @endif
                </div>
                <div id="sidebar" class="industry-report-sidebar">
                    @can('view pro content')
                        <div id="sticky-stabilizer" style="height: 20px;"></div>
                        <div id="sticky-sidebar-contents">
                            @if($report->aside)
                                {!! $report->aside !!}
                            @endif
                        </div>
                    @else
                        <div class="mt-5 mt-lg-0">
                            <div class="mb-3 max-width-400">
                                @include('navbars.pi-pro-logo')
                            </div>
                            <p class="fs-6">Designated for the community members that have always asked us for more.</p>
                            <p class="text-uppercase fw-bold text-primary">More data. More insights. More speed.</p>
                            <div class="mb-2">
                                <i class="fa-sharp fa-regular fa-check me-1 text-body-secondary"></i>
                                <span class="text-body-emphasis">Exclusive industry reports</span>
                            </div>
                            <div class="mb-2">
                                <i class="fa-sharp fa-regular fa-check me-1 text-body-secondary"></i>
                                <span class="text-body-emphasis">Daily market analyses</span>
                            </div>
                            <div class="mb-2">
                                <i class="fa-sharp fa-regular fa-check me-1 text-body-secondary"></i>
                                <span class="text-body-emphasis">Full access to the Neuly Platform</span>
                            </div>
                            <div class="mb-2">
                                <i class="fa-sharp fa-regular fa-check me-1 text-body-secondary"></i>
                                <span class="text-body-emphasis">Real-time stock information</span>
                            </div>
                            <div class="mb-2">
                                <i class="fa-sharp fa-regular fa-check me-1 text-body-secondary"></i>
                                <span class="text-body-emphasis">Access to all online events</span>
                            </div>
                            <div class="mb-2">
                                <i class="fa-sharp fa-regular fa-check me-1 text-body-secondary"></i>
                                <span class="text-body-emphasis">Community chat</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="sticky-sidebar-stop"></div>

@endsection

@section('livewire_scripts')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        jQuery(document).ready(function($) {

            function stickToTheTop() {
                let browserWidth = window.innerWidth;
                let window_top = $(window).scrollTop() + 60;
                let stickyStabilizerTop = $('#sticky-stabilizer').offset().top;
                let postContent = $('.industry-report-content');
                let widthOfSidebar = $('#sidebar').width();

                if (browserWidth > 991 && postContent.height() > 1500) {
                    if (window_top > stickyStabilizerTop) {
                        $('#sticky-sidebar-contents').addClass('sticky-sidebar');
                        $('#sticky-sidebar-contents').css('maxWidth', widthOfSidebar);
                        $('#sticky-stabilizer').height($('#sticky-sidebar-contents' + 20).outerHeight());
                    } else {
                        $('#sticky-sidebar-contents').removeClass('sticky-sidebar');
                        $('#sticky-stabilizer').height(20);
                    }
                } else {
                    $('#sticky-sidebar-contents').removeClass('sticky-sidebar');
                    $('#sticky-stabilizer').height(20);
                }
            }

            // Check Footer
            function checkFooter() {
                let footer = document.querySelector('.sticky-sidebar-stop');
                let footerBounding = footer.getBoundingClientRect();

                let stickySidebar = document.querySelector('#sticky-sidebar-contents');
                let sidebarBounding = stickySidebar.getBoundingClientRect();

                let difference = footerBounding.top - sidebarBounding.bottom;

                if (difference < 25) {
                    $('#sticky-sidebar-contents').removeClass('sticky-sidebar');
                    $('#sticky-stabilizer').height(0);
                }
            }

            checkFooter();

            $(window).on('resize', function() {
                stickToTheTop();
                checkFooter();
                clearMobileTocOptions();
            });

            $(window).on('scroll', function() {
                stickToTheTop();
                checkFooter();
            });

            if(document.querySelector('.toc-list') && window.innerWidth < 992) {
                $('#toc-mobile-trigger').on('click', function() {
                    $('#table-of-contents').addClass('mobile-fixed');
                });

                $('.toc-list a').on('click', function() {
                    $('#table-of-contents').removeClass('mobile-fixed');
                });
            }

            function clearMobileTocOptions() {
                if((document.querySelector('.toc-list')) && (window.innerWidth < 992)) {
                    $('#toc-mobile-trigger').show();
                } else {
                    $('#toc-mobile-trigger').hide();
                    $('#table-of-contents').removeClass('mobile-fixed');
                }
            }
        });
    </script>
@endsection
