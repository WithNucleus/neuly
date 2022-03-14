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
                <span class="label">Detailed View</span>
            </button>

            <button id="collapse-all-widgets-toggle" class="btn btn-sm border ml-4" data-collapsed="false">
                <span class="icon"></span><span class="label">Widgets</span>
            </button>

            <button id="add-widget-column" class="btn btn-sm border ml-4">
                <i class="fas fa-line-columns mr-1"></i>Add Widget Space
            </button>

            <div class="dropdown">
                <button id="add-widgets" class="btn btn-sm border ml-4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-th-large mr-1"></i>Add Widget
                </button>
                <div class="dropdown-menu" aria-labelledby="add-widgets">
                    @foreach ($allWidgets as $widgetGroup)
                        @foreach ($widgetGroup as $widgetName => $widgetLabel)
                            <button class="dropdown-item add-widget-link"
                                    data-widget="{{ $widgetName }}"
                                    data-template="{{ route('enterprise.dashboard.template') }}?name={{ $widgetName }}&label={{ $widgetLabel }}"
                                    data-url="{{ Route::has('enterprise.dashboard.' . $widgetName) ? route('enterprise.dashboard.' . $widgetName) : '' }}">
                                {{ $widgetLabel }}
                            </button>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>

        <div class="enterprise-widget-grid" data-dashboard="{{ $dashboard->name }}">
            @foreach ($widgets as $columns)
                <div class="widget-column">
                    @foreach($columns as $widgetName => $widgetLabel)
                        <x-enterprise.widget name="{{ $widgetName }}" heading="{{ $widgetLabel }}" />
                    @endforeach
                </div>
            @endforeach
        </div>

    </div>
<div class="filter-backdrop" style="display: none"></div>
@endsection

@section('after_scripts')
    <script>
        $(document).ready(function() {
            const dashboard = $('.enterprise-widget-grid').data('dashboard');
            let isDrag = false;
            let showDetails = true;
            let widgetsCollapsed = false;

            // Drag Toggle
            $('#widget-drag-toggle').on( 'click', function() {
                isDrag = !isDrag;
                $(this).attr('data-drag', isDrag);
                let method = isDrag ? 'enable' : 'disable';

                $('.widget-column').sortable(method);

                if (method === 'enable') {
                    $('.widget-column').addClass('has-dragging');
                } else {
                    $('.widget-column').removeClass('has-dragging');
                }
            });

            // Load Sortable
            function loadSortables() {
                $('.widget-column').sortable({
                    connectWith: ".widget-column",
                    handle: ".drag-handle",
                    placeholder: "portlet-placeholder",
                    stop: function( event, ui ) {
                        saveWidgetData();
                    },
                });

                $('.widget-column').sortable(isDrag ? 'enable' : 'disable');
            }

            function saveWidgetData() {
                let widgetNames = [];
                let widgetLabels = [];

                $('.widget-column').each(function() {
                    let columnNames = [];
                    let columnLabels = [];

                    $(this).find('.enterprise-widget').each(function(){
                        columnNames.push($(this).attr('id'));
                        columnLabels.push($(this).attr('data-label'));
                    });

                    if (columnNames.length > 0 && columnLabels.length > 0) {
                        widgetNames.push(columnNames);
                        widgetLabels.push(columnLabels);
                    }
                });

                $.post('{{ route('enterprise.dashboard.widgets.save') }}', {
                    widgetNames: widgetNames,
                    widgetLabels: widgetLabels,
                    dashboard: dashboard
                });
            }

            loadSortables();

            // Add Widget Space
            $('#add-widget-column').on('click', function() {
                $('<div class="widget-column has-dragging"></div>').insertAfter($('.widget-column').last());
                loadSortables();
            });

            function getEnterpriseWidget(widgetName, url = false, buildFilters = true) {
                console.log("getting enterprise widget");
                let widgetId = "#" + widgetName;

                if (url === false) {
                    url = $(widgetId).find('.enterprise-widget-content').attr('data-url');
                }

                if (url !== undefined) {
                    $.get(
                        url,
                        function (data) {
                            $(widgetId).find('.enterprise-widget-content').html(data);
                        }
                    );
                }

                // Widget Controls -- Setup Filters
                if (buildFilters === true) {
                    buildWidgetFilters(widgetId);
                }
            }

            function buildWidgetFilters(widgetId) {
                let widgetControls = $(widgetId).find('.widget-controls');

                widgetControls.each(function() {
                    console.log($(this));
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

            function buildQueryUrl(element) {
                let widgetControls = $(element).parents('.widget-controls');
                let pageSize = widgetControls.find('.page-size').find(":selected").text();
                let parentWidget = widgetControls.parents('.enterprise-widget');
                let widgetContent = parentWidget.find('.enterprise-widget-content');
                let newUrl = widgetContent.attr('data-url') + '?page[size]=' + pageSize;

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

                    getEnterpriseWidget(parentWidget.attr('id'), newUrl, false);
                });
            }

            // On Checkbox
            $(document).on("change", ".custom-checkbox" , function() {
                buildQueryUrl($(this));
            });

            // On Select
            $(document).on("change", ".custom-select", function() {
                buildQueryUrl($(this));
            });

            // Load Widgets
            $('.enterprise-widget').each(function() {
                let widgetName = $(this).attr('id');
                getEnterpriseWidget(widgetName);
            });

            // Open Backdrop for Closing Filters
            $(document).on('click', '.filter-control', function() {
                if ($(this).attr('aria-expanded') === 'true') {
                    $('.filter-backdrop').show();
                } else {
                    $('.filter-backdrop').hide();
                }

            });

            $('.filter-backdrop').on('click', function() {

                $('.filter-control[aria-expanded="true"]').each(function() {
                    let targetElement = $(this).attr('data-target');
                    $(targetElement).collapse('hide');
                });

                $(this).hide();
            });

            // Show Details Toggle
            $('#show-details-toggle').on( 'click', function() {
                showDetails = !showDetails;
                $(this).attr('data-drag', showDetails);

                if (showDetails === true) {
                    $('.widget-expandable-details').slideDown();
                } else {
                    $('.widget-expandable-details').slideUp();
                }
            });

            // Collapse All Widgets
            $('#collapse-all-widgets-toggle').on('click', function() {

                widgetsCollapsed = !widgetsCollapsed;
                $(this).attr('data-collapsed', widgetsCollapsed);

                let method = widgetsCollapsed ? 'hide' : 'show';

                $('.widget-collapsable-content').each(function() {
                    $(this).collapse(method);
                });
            });

            // Remove Widgets
            $(document).on('click', '.remove-widget', function(event) {
                event.preventDefault();
                let parentWidget = $(this).attr('data-widget');
                $(parentWidget).remove();
                saveWidgetData();
                allowAddableWidgets();
            });

            // Sets what widgets are allowed to be added
            function allowAddableWidgets() {
                $('.add-widget-link').each(function() {

                    let widgetId = '#' + $(this).attr('data-widget');

                    if ($(widgetId).length) {
                        $(this).prop('disabled', true);
                    } else {
                        $(this).prop('disabled', false);
                    }
                });
            }

            allowAddableWidgets();

            // Adding a Widget
            $(document).on('click', '.add-widget-link', function() {
                let widgetId = $(this).attr('data-widget');
                let templateUrl = $(this).attr('data-template');
                let dataUrl = $(this).attr('data-url');
                let firstWidget = $('.widget-column:first .enterprise-widget:first');

                $.get(
                    templateUrl,
                    function (data) {
                        $(data).insertBefore(firstWidget);
                    }
                );

                getEnterpriseWidget(widgetId, dataUrl);
                allowAddableWidgets();
                saveWidgetData();
            });
        });
    </script>
@endsection
