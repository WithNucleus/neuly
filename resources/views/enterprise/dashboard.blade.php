@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('navbars.primary')

    <div class="enterprise-dashboard-container">
        @include('members.includes.status-messages')

        <div class="enterprise-dashboard-controls">
            <button id="widget-drag-toggle" class="btn btn-sm" data-drag="false">
                <span class="on">On</span>
                <span class="off">Off</span>
                <span class="label">Rearrange Widgets</span>
            </button>
        </div>

        <div class="enterprise-widget-grid">
            <div class="grid-sizer"></div>
            <div class="enterprise-widget">
                <h2 class="widget-title">Notes</h2>
{{--                @include('members.dashboard-widgets.notes')--}}
            </div>
            <div class="enterprise-widget">
                <h2 class="widget-title">Follows</h2>
{{--                @include('members.dashboard-widgets.following')--}}
            </div>
            <div class="enterprise-widget">
                <h2 class="widget-title">Recently Viewed</h2>
{{--                @include('members.dashboard-widgets.recent')--}}
            </div>
            <div class="enterprise-widget">
                <h2 class="widget-title">Latest News &amp; More</h2>
                <div class="combined-feed-controls">
                    <div class="category">
                        <div class="text-uppercase">
                            Category
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="cf-feed-filter-news" data-name="News">
                            <label class="custom-control-label" for="cf-feed-filter-news">News</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="cf-feed-filter-video" data-name="Video">
                            <label class="custom-control-label" for="cf-feed-filter-video">Videos</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="cf-feed-filter-podcast" data-name="Podcast">
                            <label class="custom-control-label" for="cf-feed-filter-podcast">Podcasts</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="cf-feed-filter-article" data-name="Article">
                            <label class="custom-control-label" for="cf-feed-filter-article">Articles</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="cf-feed-filter-patent-filing" data-name="Patent Filing">
                            <label class="custom-control-label" for="cf-feed-filter-patent-filing">Patent Filings</label>
                        </div>
                    </div>
                    <div class="number-pages">
                        <label for="cf-feed-pages" class="text-uppercase">Max Results</label>
                        <select id="cf-feed-pages" class="custom-select">
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>
                <div id="combined-feed" data-url="{{ route('enterprise.dashboard.newsfeed') }}">
                    Loading feed...
                </div>
            </div>
            <div class="enterprise-widget">
                @include('members.dashboard-widgets.team')
            </div>
        </div>

    </div>



@endsection

@section('after_scripts')
    <script>
        $(document).ready(function() {

            // TODO: Add 'blank' widgets to keep empty columns if they want to? & resizeable heights

            // Widget Grid
            let $widgetGrid = $('.enterprise-widget-grid').packery({
                itemSelector: '.enterprise-widget',
                columnWidth: '.grid-sizer',
                percentPosition: true,
                initLayout: false,
            });

            let draggies = [];
            let isDrag = false;

            $widgetGrid.find('.enterprise-widget').each( function( i, gridItem ) {

                let draggie = new Draggabilly( gridItem );
                draggies.push( draggie );
                $widgetGrid.packery( 'bindDraggabillyEvents', draggie );

                draggies.forEach( function( draggie ) {
                    draggie[ 'disable' ]();
                });
            });

            $('#widget-drag-toggle').on( 'click', function() {

                isDrag = !isDrag;

                $(this).attr('data-drag', isDrag);

                let method = isDrag ? 'enable' : 'disable';

                draggies.forEach( function( draggie ) {
                    draggie[ method ]();
                    draggie.element.setAttribute('data-drag', method);
                });

            });

            // ajax newsfeed
            let combinedFeedUrl = $('#combined-feed').data('url');

            function updateCombinedFeed(url) {
                // update combined feed html
                $.get(
                    url,
                    function (data) {
                        $("#combined-feed").html(data);
                        $widgetGrid.packery();
                    }
                );
            }

            updateCombinedFeed(combinedFeedUrl);

            // last thing - packery init
            $widgetGrid.packery();

            function buildCombinedFeedUrl() {

                let newUrl = combinedFeedUrl;

                // Pagination
                newUrl += '?page[size]=' + $('#cf-feed-pages').find(":selected").text();

                // Filter Media Type
                let filterTypes = [];

                $('.combined-feed-controls .custom-control-input').each(function() {
                    if ($(this).prop('checked') === true) {
                        filterTypes.push($(this).data('name'));
                    }
                });

                if (filterTypes.length > 0) {
                    newUrl += '&filter[type]=' + filterTypes.join('|');
                }

                // Update Combined Feed
                updateCombinedFeed(newUrl);
                console.log("newUrl: " + newUrl);
            }

            // Combined Feed - Filter by Media Type
            $('.combined-feed-controls .custom-checkbox').on('change', function() {
                buildCombinedFeedUrl();
            });

            $('#cf-feed-pages').on('change', function() {
                buildCombinedFeedUrl();
            });
        });
    </script>
@endsection
