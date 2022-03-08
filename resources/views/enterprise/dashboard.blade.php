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
                <div id="notes-widget" class="enterprise-widget-content" data-url="{{ route('enterprise.dashboard.notes') }}">
                    Loading notes...
                </div>
            </div>
            <div class="enterprise-widget">
                <h2 class="widget-title">Patents</h2>
                @include('enterprise.widget-controls.patents')
                <div id="patents-widget" class="enterprise-widget-content" data-url="{{ route('enterprise.dashboard.patents') }}">
                    Loading patents...
                </div>
            </div>
            <div class="enterprise-widget">
                <h2 class="widget-title">Latest News &amp; More</h2>
                @include('enterprise.widget-controls.combined-feed')
                <div id="combined-feed" class="enterprise-widget-content" data-url="{{ route('enterprise.dashboard.combined-feed') }}">
                    Loading feed...
                </div>
            </div>
            <div class="enterprise-widget">
                <h2 class="widget-title">Clinical Trials</h2>
                @include('enterprise.widget-controls.clinical-trials')
                <div id="clinical-trials-widget" class="enterprise-widget-content" data-url="{{ route('enterprise.dashboard.clinical-trials') }}">
                    Loading clinical trials...
                </div>
            </div>
            <div class="enterprise-widget">
                <h2 class="widget-title">Jobs</h2>
                <div id="jobs-widget" class="enterprise-widget-content" data-url="{{ route('enterprise.dashboard.jobs') }}">
                    Loading jobs...
                </div>
            </div>
            <div class="enterprise-widget">
                <h2 class="widget-title">Events</h2>
                <div id="events-widget" class="enterprise-widget-content" data-url="{{ route('enterprise.dashboard.events') }}">
                    Loading events...
                </div>
            </div>
            <div class="enterprise-widget">
                <h2 class="widget-title">Follows</h2>
                <div id="follows-widget" class="enterprise-widget-content" data-url="{{ route('enterprise.dashboard.follows') }}">
                    Loading follows...
                </div>
            </div>
            <div class="enterprise-widget">
                <h2 class="widget-title">Recently Viewed</h2>
                <div id="recently-viewed-widget" class="enterprise-widget-content" data-url="{{ route('enterprise.dashboard.recently-viewed') }}">
                    Loading recently viewed...
                </div>
            </div>
            <div class="enterprise-widget">
                <div id="team-widget" class="enterprise-widget-content" data-url="{{ route('enterprise.dashboard.team') }}">
                    Loading team...
                </div>
            </div>
        </div>

    </div>
@endsection

@section('after_scripts')
    <script>
        $(document).ready(function() {

            let draggableWidgets = [];
            let isDrag = false;
            let showDetails = true;

            // Widget Grid
            let $widgetGrid = $('.enterprise-widget-grid').packery({
                itemSelector: '.enterprise-widget',
                columnWidth: '.grid-sizer',
                percentPosition: true,
                initLayout: false,
            });

            $widgetGrid.find('.enterprise-widget').each( function( i, gridItem ) {
                let draggableWidget = new Draggabilly( gridItem );
                draggableWidgets.push( draggableWidget );
                $widgetGrid.packery( 'bindDraggabillyEvents', draggableWidget );

                draggableWidgets.forEach( function( draggableWidget ) {
                    draggableWidget[ 'disable' ]();
                });
            });

            $('#widget-drag-toggle').on( 'click', function() {
                isDrag = !isDrag;
                $(this).attr('data-drag', isDrag);
                let method = isDrag ? 'enable' : 'disable';

                draggableWidgets.forEach( function( draggableWidget ) {
                    draggableWidget[ method ]();
                    draggableWidget.element.setAttribute('data-drag', method);
                });
            });

            // Show/Hide Details in Widgets
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
            function getEnterpriseWidget(widgetId, url = false, buildWidgets = true) {
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

                // Widget Controls -- Setup Filters
                if (buildWidgets === true) {

                    let widgetControls = $(widgetId).siblings('.widget-controls');

                    widgetControls.each(function() {

                        $(this).find('.filter-checkboxes').each(function() {

                            let url = $(this).data('url');
                            let filterGroup = $(this).children('.filter-group');

                            $.get(
                                url,
                                function (data) {
                                    $(filterGroup).html(data);
                                }
                            );
                        });

                    });
                }
            }

            function buildQueryUrl(element) {

                let widgetControls = $(element).parents('.widget-controls');
                let pageSize = widgetControls.find('.page-size').find(":selected").text();
                let parentWidget = widgetControls.parents('.enterprise-widget').find('.enterprise-widget-content');
                let newUrl = parentWidget.data('url') + '?page[size]=' + pageSize;

                // go through checkboxes
                widgetControls.find('.filter-checkboxes').each(function() {

                    let filterType = $(this).data('filter');
                    let filterValues = [];

                    $(this).find('.custom-control-input').each(function() {
                        if ($(this).prop('checked') === true) {
                            filterValues.push($(this).data('name'));
                        }
                    });

                    if (filterValues.length > 0) {
                        newUrl += '&filter[' + filterType + ']=' + filterValues.join('|');
                    }

                    getEnterpriseWidget(parentWidget, newUrl, false);

                    console.log("newUrl: " + newUrl);

                });

            }

            $(document).on("change", ".custom-checkbox" , function() {
                buildQueryUrl($(this));
            });

            $(document).on("change", ".custom-select", function() {
                buildQueryUrl($(this));
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
