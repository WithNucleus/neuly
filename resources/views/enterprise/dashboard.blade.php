@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('navbars.primary')

    <div class="enterprise-dashboard-container">
        @include('members.includes.status-messages')

        <div class="enterprise-dashboard-controls">
            <button id="widget-drag-toggle" class="enterprise-toggle-switch btn btn-sm" data-drag="false">
                <span class="on">On</span>
                <span class="off">Off</span>
                <span class="label">Rearrange Widgets</span>
            </button>

            <button id="show-details-toggle" class="enterprise-toggle-switch btn btn-sm ml-4" data-drag="true">
                <span class="on">On</span>
                <span class="off">Off</span>
                <span class="label">Show Details</span>
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
                <h2 class="widget-title">Patents</h2>
                <div id="patents-widget" data-url="{{ route('enterprise.dashboard.patents') }}">
                    Loading patents...
                </div>
            </div>
            <div class="enterprise-widget">
                <h2 class="widget-title">Latest News &amp; More</h2>
                @include('enterprise.widget-controls.combined-feed')
                <div id="combined-feed" data-url="{{ route('enterprise.dashboard.combined-feed') }}">
                    Loading feed...
                </div>
            </div>
            <div class="enterprise-widget">
                <h2 class="widget-title">Clinical Trials</h2>
                <div id="clinical-trials-widget" data-url="{{ route('enterprise.dashboard.clinical-trials') }}">
                    Loading clinical trials...
                </div>
            </div>
            <div class="enterprise-widget">
                <h2 class="widget-title">Jobs</h2>
                <div id="jobs-widget" data-url="{{ route('enterprise.dashboard.jobs') }}">
                    Loading jobs...
                </div>
            </div>
            <div class="enterprise-widget">
                <h2 class="widget-title">Events</h2>
                <div id="events-widget" data-url="{{ route('enterprise.dashboard.events') }}">
                    Loading events...
                </div>
            </div>
            <div class="enterprise-widget">
                <h2 class="widget-title">Follows</h2>
                <div id="follows-widget" data-url="{{ route('enterprise.dashboard.follows') }}">
                    Loading follows...
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

            // Show/Hide Details in Widgets
            let showDetails = true;

            $('#show-details-toggle').on( 'click', function() {
                showDetails = !showDetails;
                $(this).attr('data-drag', showDetails);

                if (showDetails === true) {
                    $('.widget-expandable-details').slideDown(400, function() {
                        $widgetGrid.packery();
                    });
                } else {
                    $('.widget-expandable-details').slideUp(400, function() {
                        $widgetGrid.packery();
                    });
                }
            });

            /* FUNCTION FOR AJAX WIDGETS */
            function getEnterpriseWidget(widgetId, url = false) {

                if (url === false) {
                    url = $(widgetId).data('url');
                }

                $.get(
                    url,
                    function (data) {
                        $(widgetId).html(data);
                        $widgetGrid.packery();
                    }
                );
            }

            // Query Filters for Combined Feed
            function buildCombinedFeedUrl() {

                let newUrl = $('#combined-feed').data('url') + '?page[size]=' + $('#cf-feed-pages').find(":selected").text();

                let filterTypes = [];

                $('.combined-feed-controls .custom-control-input').each(function() {
                    if ($(this).prop('checked') === true) {
                        filterTypes.push($(this).data('name'));
                    }
                });

                if (filterTypes.length > 0) {
                    newUrl += '&filter[type]=' + filterTypes.join('|');
                }

                getEnterpriseWidget('#combined-feed', newUrl);
            }

            $('.combined-feed-controls .custom-checkbox').on('change', function() {
                buildCombinedFeedUrl();
            });

            $('#cf-feed-pages').on('change', function() {
                buildCombinedFeedUrl();
            });

            // get widgets
            getEnterpriseWidget('#combined-feed');
            getEnterpriseWidget('#follows-widget');
            getEnterpriseWidget('#notes-widget');
            getEnterpriseWidget('#recently-viewed-widget');
            getEnterpriseWidget('#team-widget');
            getEnterpriseWidget('#patents-widget');
            getEnterpriseWidget('#clinical-trials-widget');
            getEnterpriseWidget('#jobs-widget');
            getEnterpriseWidget('#events-widget');
        });
    </script>
@endsection
