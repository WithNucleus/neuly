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
                <div id="notes-widget" data-url="{{ route('enterprise.dashboard.notes') }}">
                    Loading notes...
                </div>
            </div>
            <div class="enterprise-widget">
                <h2 class="widget-title">Follows</h2>
                <div id="follows-widget" data-url="{{ route('enterprise.dashboard.follows') }}">
                    Loading follows...
                </div>
            </div>
            <div class="enterprise-widget widget-large">
                <h2 class="widget-title">Latest News &amp; More</h2>
                @include('enterprise.widget-includes.combined-feed-controls')
                <div id="combined-feed" data-url="{{ route('enterprise.dashboard.newsfeed') }}">
                    Loading feed...
                </div>
            </div>
            <div class="enterprise-widget">
                <h2 class="widget-title">Recently Viewed</h2>
                <div id="recently-viewed-widget" data-url="{{ route('enterprise.dashboard.recently-viewed') }}">
                    Loading recently viewed...
                </div>
            </div>
            <div class="enterprise-widget">
                <div id="team-widget" data-url="{{ route('enterprise.dashboard.team') }}">
                    Loading team...
                </div>
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

            // follows
            let followsUrl = $('#follows-widget').data('url');

            function updateFollowsWidget(url) {
                $.get(
                    url,
                    function (data) {
                        $("#follows-widget").html(data);
                        $widgetGrid.packery();
                    }
                );
            }

            updateFollowsWidget(followsUrl);

            // Notes
            let notesUrl = $('#notes-widget').data('url');

            function updateNotesWidget(url) {
                $.get(
                    url,
                    function (data) {
                        $("#notes-widget").html(data);
                        $widgetGrid.packery();
                    }
                );
            }

            updateNotesWidget(notesUrl);

            // Recently Viewed
            let recentlyViewedUrl = $('#recently-viewed-widget').data('url');

            function updateRecentlyViewedWidget(url) {
                $.get(
                    url,
                    function (data) {
                        $("#recently-viewed-widget").html(data);
                        $widgetGrid.packery();
                    }
                );
            }

            updateRecentlyViewedWidget(recentlyViewedUrl);

            // Team
            let teamUrl = $('#team-widget').data('url');

            function updateTeamWidget(url) {
                $.get(
                    url,
                    function (data) {
                        $("#team-widget").html(data);
                        $widgetGrid.packery();
                    }
                );
            }

            updateTeamWidget(teamUrl);
        });
    </script>
@endsection
