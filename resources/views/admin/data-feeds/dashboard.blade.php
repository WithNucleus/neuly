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

        <div class="col-12 mb-4 d-flex align-items-center">
            <div class="d-flex align-items-center">
                <label for="filter-media-type" class="font-weight-bold text-nowrap mr-2 mb-0">Media Type</label>
                <select name="filter-media-type" id="filter-media-type" class="form-control">
                    <option value="All">All</option>
                    @foreach(\App\Models\DataFeed::getMediaTypes() as $mediaType)
                        <option value="{{ $mediaType }}">{{ $mediaType }}</option>
                    @endforeach
                </select>
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
            <div id="item-{{ $item->id }}" class="col-12 mb-4">
                <div class="item-content card shadow-sm p-4">
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
                    <div class="d-flex align-items-center flex-wrap mt-3">

                        <div class="d-flex align-items-center mr-5">
                            <button class="approve-item btn btn-success mr-2 text-nowrap"
                                    data-url="{{ route('admin.media-dashboard.update', $item->id) }}"
                                    data-type="#media-item-{{ $item->id }}"
                                    data-parent="#item-{{ $item->id }}"
                            >Approve as</button>
                            <label for="media-item-{{ $item->id }}" class="sr-only">Approve as</label>
                            <select id="media-item-{{ $item->id }}" class="form-control">
                                @foreach (\App\Enum\MediaTypes::MEDIA_TYPES as $mediaType)
                                    <option value="{{ $mediaType }}" @if ($mediaType === $item->media_type) selected @endif>{{ $mediaType }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button class="btn btn-warning mr-4 decline-item" data-parent="#item-{{ $item->id }}" data-url="{{ route('admin.media-dashboard.update', $item->id) }}">
                            Decline
                        </button>

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
    </div>
@endsection

@section('after_scripts')
    <style>
        .item-content,
        .js-ajax-response {
            max-width: 820px;
        }

        .item-content img {
            max-width: 100%;
            height: auto;
        }
    </style>
    <script>
        $(document).ready(function () {

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

                    $('html, body').animate({scrollTop: $(parent).offset().top -100 });
                    $(parent).slideUp();
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

                    $('html, body').animate({scrollTop: $(parent).offset().top -100 });
                    $(parent).slideUp();
                });
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
                    window.location.href = "{{ route('admin.media-dashboard') }}" + "?filter[media_type]=" + mediaType;
                }
            })
        });
    </script>
@endsection
