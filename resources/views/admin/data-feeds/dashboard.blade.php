@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h2>
            <span class="text-capitalize">Data Feed Dashboard</span>
            <a href="{{ route('admin.datafeed.index') }}" class="font-sm"><i class="la la-angle-double-left"></i> Back to <span>Data Feeds</span></a>
        </h2>
    </div>
@endsection

@section('content')
    <div class="row mt-4">

        <div class="col-12 mb-4 d-flex flex-wrap align-items-center">
            <div class="d-flex align-items-center mr-5 my-1">
                <label for="filter-media-type" class="font-weight-bold text-nowrap mr-2 mb-0">Media Type</label>
                <select name="filter-media-type" id="filter-media-type" class="form-control">
                    <option value="All">All</option>
                    @foreach($mediaTypes as $mediaType)
                        <option value="{{ $mediaType }}">{{ $mediaType }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex align-items-center mr-5 my-1">
                <label for="filter-source" class="font-weight-bold text-nowrap mr-2 mb-0">Source</label>
                <select name="filter-source" id="filter-source" class="form-control">
                    <option value="All">All</option>
                    @foreach($sources as $name => $count)
                        <option value="{{ $name }}">{{ $name }} ({{ $count }})</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex align-items-center mr-5 my-1">
                <label for="filter-pagination" class="font-weight-bold text-nowrap mr-2 mb-0">Items per page</label>
                <select name="filter-pagination" id="filter-pagination" class="form-control">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>

            <div class="mr-5 my-1">
                <a href="{{ route('admin.media-dashboard') }}" class="btn btn-light btn-sm">Remove All Filters</a>
            </div>

            <div>
                <button class="approve-all-items btn btn-info btn-sm">Approve All Visible Items</button>
            </div>
        </div>

        <div class="col-12 mb-3 d-flex flex-wrap align-items-center">
            <div class="selected-checkboxes mr-3 font-weight-bold">
                <span class="checkbox-count">0</span> items selected
            </div>

            <div class="mr-2">
                <button class="approve-selected-items btn btn-success btn-sm">Approve Selected</button>
            </div>

            <div class="mr-4">
                <button class="decline-selected-items btn btn-warning btn-sm">Decline Selected</button>
            </div>

            <div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="select-all-items">
                    <label class="custom-control-label" for="select-all-items">Select All</label>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="js-ajax-response alert position-relative" style="display: none;">
                <span class="message"></span>
                <button type="button" class="close" data-hide="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>

        @forelse ($mediaItems as $item)
            <div id="item-{{ $item->id }}" class="table-view item-container col-12 mb-4 position-relative" data-item="{{ $item->id }}" data-url="{{ route('admin.media-dashboard.update', $item->id) }}">
                <div class="item-content card shadow-sm p-4">
                    <div class="item-checkbox-container">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input item-checkbox" id="select-item-{{ $item->id }}">
                            <label class="custom-control-label" for="select-item-{{ $item->id }}">&nbsp;</label>
                        </div>
                    </div>
                    <div class="hovering-buttons hovering-buttons-{{ $item->id }}">
                        @include('admin.data-feeds.media-item-action-buttons', ['item' => $item])
                    </div>
                    <h3 class="h5 mb-3">
                        <a href="{{ $item->url }}" target="_blank" rel="noopener noreferrer">
                            {{ $item->name }}
                        </a>
                    </h3>
                    @if ($item->summary != '')
                        <div class="summary text-muted">
                            {{ $item->summary }}
                        </div>
                    @endif
                    <div class="content my-3 py-3 border-bottom border-top">
                        {!! $item->content !!}
                    </div>
                    <div class="d-flex align-items-center flex-wrap">
                        <i class="las la-calendar text-muted mr-1"></i>
                        <span class="mr-4">{{ \Carbon\Carbon::parse($item->date)->format('M d, Y') }}</span>

                        <i class="las la-photo-video text-muted mr-1"></i>
                        <span class="mr-4">{{ $item->media_type }}</span>

                        <i class="las la-building text-muted mr-1"></i>
                        <a href="{{ route('admin.datafeed.show', $item->source->id) }}" class="mr-4">
                            {{ $item->source->name }}
                        </a>

                        <i class="las la-eye text-muted mr-1"></i>
                        <a href="{{ route('admin.media-item.show', $item->id) }}" class="mr-4">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 card shadow-sm mb-4 p-4">
                Nothing left :)
            </div>
        @endforelse

        <div class="col-12">
            {{ $mediaItems->links() }}
        </div>

        <div class="col-12">
            <a href="" class="btn btn-primary">Load more results</a>
        </div>
    </div>
@endsection

@section('after_scripts')

    <style>
        .item-content,
        .js-ajax-response {
            max-width: 760px;
            margin-left: 20px;
        }

        .item-content img {
            max-width: 100%;
            height: auto;
        }

        .hovering-buttons {
            margin-bottom: 1rem;
        }

        @media (min-width: 1300px) {
            .hovering-buttons {
                top: 0;
                position: absolute;
            }

            .hovering-buttons .action-buttons-container {
                flex-direction: column;
                align-items: flex-start !important;
                margin-top: 0 !important;
                padding: 1rem;
            }

            .hovering-buttons .action-buttons-container .approve-item-container {
                margin-bottom: 2rem;
            }
        }

        .item-checkbox-container {
            position: absolute;
            top: 0;
            left: -30px;
            z-index: 6;
            display: flex;
            align-items: stretch;
            height: 100%;
        }

        .item-checkbox-container .custom-checkbox {
            display: flex;
            align-items: stretch;
            height: 100%;
        }

        .item-checkbox-container .custom-checkbox label {
            width: 100%;
            height: 100%;
            display: flex;
            position: absolute;
            top: 0;
            left: 0;
        }

        .item-checkbox-container .custom-checkbox label.selected {
            background: rgba(70, 127, 208, 0.25);
        }

        .item-checkbox-container .custom-control-label:after,
        .item-checkbox-container .custom-control-label:before {
            left: .25rem;
            top: .5rem
        }

        @media (min-width: 1400px) {
            .item-content,
            .js-ajax-response {
                max-width: 820px;
            }
        }

        .form-control {
            width: auto;
        }

    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/ScrollTrigger.min.js"></script>
    <script>
        $(document).ready(function () {
            gsap.registerPlugin(ScrollTrigger);

            $(window).on("resize", function () {
                $('.hovering-buttons').css('left', $('.item-content').outerWidth() + 'px');
            }).resize();

            @foreach ($mediaItems as $item)
                ScrollTrigger.matchMedia({
                    "(min-width: 1300px)": function() {
                        ScrollTrigger.create({
                            trigger: "#item-{{ $item->id }}",
                            start: "top top",
                            end: "bottom 150px",
                            pin: ".hovering-buttons-{{ $item->id }}",
                            pinSpacing: false,
                        });
                    },
                });
            @endforeach

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let alertClasses = "alert-danger alert-success alert-warning";

            $('.approve-item').on('click', function() {
                let actionUrl = $(this).data('url');
                let parent = $(this).data('parent');
                let mediaTypeElement = $(this).data('type');
                let mediaType = $(mediaTypeElement).val();

                $.post(actionUrl, {
                    status: "{{ \App\Models\MediaItem::STATUS_PUBLIC }}",
                    type: mediaType
                }, function (response) {
                    $('.js-ajax-response .message').text(response.message);

                    if (response.status === 'success') {
                        $('.js-ajax-response').removeClass(alertClasses).addClass('alert-success').show();
                    } else {
                        $('.js-ajax-response').removeClass(alertClasses).addClass('alert-danger').show();
                    }

                    $(parent).slideUp("normal", function() { $(parent).remove(); } );
                });
            });

            $('.decline-item').on('click', function() {
                let actionUrl = $(this).data('url');
                let parent = $(this).data('parent');

                $.post(actionUrl, {
                    status: "{{ \App\Models\MediaItem::STATUS_DECLINED }}",
                }, function (response) {
                    $('.js-ajax-response .message').text(response.message);

                    if (response.status === 'success') {
                        $('.js-ajax-response').removeClass(alertClasses).addClass('alert-warning').show();
                    } else {
                        $('.js-ajax-response').removeClass(alertClasses).addClass('alert-danger').show();
                    }

                    $(parent).slideUp("normal", function() { $(parent).remove(); } );
                });
            });

            function updateItemFromBulkAction(actionUrl, itemContent, status, successColor) {
                $.post(actionUrl, {
                    status: status,
                }, function (response) {
                    itemContent.text(response.message);
                    if (response.status === 'success') {
                        itemContent.addClass(successColor);
                    } else {
                        itemContent.addClass('text-danger');
                    }
                });
            }

            $('.approve-all-items').on('click', function() {
                let approveAll = confirm('Are you sure you want to approve everything on this page?');

                if (approveAll === true) {
                    $('.item-container').each(function() {
                        let actionUrl = $(this).data('url');
                        let itemContent = $(this).children('.item-content');
                        updateItemFromBulkAction(actionUrl, itemContent, "{{ \App\Models\MediaItem::STATUS_PUBLIC }}", "text-success");
                    });
                }

            });

            $('.approve-selected-items').on('click', function() {
                $('.item-checkbox:checked').each(function() {
                    let parentContainer = $(this).parents('.item-container');
                    let actionUrl = parentContainer.data('url');
                    let itemContent = parentContainer.children('.item-content');
                    updateItemFromBulkAction(actionUrl, itemContent, "{{ \App\Models\MediaItem::STATUS_PUBLIC }}", "text-success");
                });

            });

            $('.decline-selected-items').on('click', function() {
                $('.item-checkbox:checked').each(function() {
                    let parentContainer = $(this).parents('.item-container');
                    let actionUrl = parentContainer.data('url');
                    let itemContent = parentContainer.children('.item-content');
                    updateItemFromBulkAction(actionUrl, itemContent, "{{ \App\Models\MediaItem::STATUS_DECLINED }}", "text-warning");
                });

            });

            function updateCheckboxCount() {
                let checkedCount = $(".item-checkbox:checked").length;
                $('.selected-checkboxes .checkbox-count').text(checkedCount);
            }

            $('.item-checkbox').on('click', function() {
                if ($(this).prop('checked')) {
                    $(this).siblings('label').addClass('selected');
                } else {
                    $(this).siblings('label').removeClass('selected');
                }

                updateCheckboxCount();
            });

            $('#select-all-items').on('click', function() {
                if ($(this).prop('checked')) {
                    $('.item-checkbox').each(function() {
                        $(this).prop('checked', true);
                        $(this).siblings('label').addClass('selected');
                    });
                } else {
                    $('.item-checkbox').each(function() {
                        $(this).prop('checked', false);
                        $(this).siblings('label').removeClass('selected');
                    });
                }

                updateCheckboxCount();
            });

            $('button.close').on('click', function() {
                $(this).parent().hide();
            });

            let filterMediaType = "{{ $filter['media_type'] ?? "All" }}";
            $('#filter-media-type').val(filterMediaType);

            $('#filter-media-type').on('change', function() {
                let mediaType = $(this).val();

                if (mediaType === 'All') {
                    window.location.href = "{{ route('admin.media-dashboard') }}";
                } else {
                    window.location.href = "{{ route('admin.media-dashboard') }}" + "?filter[media_type]=" + mediaType + "&pagination=" + filterPagination;
                }
            });

            let filterSource = "{{ $filter['source'] ?? "All" }}";
            $('#filter-source').val(filterSource);

            $('#filter-source').on('change', function() {
                let source = $(this).val();

                if (source === 'All') {
                    window.location.href = "{{ route('admin.media-dashboard') }}";
                } else {
                    window.location.href = "{{ route('admin.media-dashboard') }}" + "?filter[source]=" + source + "&pagination=" + filterPagination;
                }
            });

            let filterPagination = "{{ $pagination }}";
            $('#filter-pagination').val(filterPagination);

            $('#filter-pagination').on('change', function() {

                let url = "{{ route('admin.media-dashboard') }}?pagination=" + $(this).val();

                if (filterSource !== 'All') {
                    url += "&filter[source]=" + filterSource;
                }

                if (filterMediaType !== 'All') {
                    url += "&filter[media_type]=" + filterMediaType;
                }

                window.location.href = url;
            });
        });
    </script>
@endsection
