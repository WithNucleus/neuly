@extends('layouts.app')

@section('body-class', 'enterprise-dashboard-page')

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

            <button id="show-details-toggle" class="enterprise-toggle-switch btn btn-sm ms-4" data-drag="true">
                <span class="on">On</span>
                <span class="off">Off</span>
                <span class="label">Detailed View</span>
            </button>

            <button id="collapse-all-widgets-toggle" class="btn btn-sm btn-info ms-4" data-collapsed="false">
                <span class="icon"></span><span class="label">Widgets</span>
            </button>

            <button id="add-widget-column" class="btn btn-sm btn-info ms-4">
                <i class="fas fa-line-columns me-2"></i>Add Widget Space
            </button>

            <div class="dropdown ms-4">
              <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fas fa-th-large me-2"></i>Add Widget
              </button>
                <ul class="dropdown-menu">
                    @foreach ($allWidgets as $widgetGroup)
                        @foreach ($widgetGroup as $widgetName => $widgetLabel)
                            <li>
                                <button class="dropdown-item add-widget-link"
                                        data-widget="{{ $widgetName }}"
                                        data-template="{{ route('enterprise.dashboard.template') }}?name={{ $widgetName }}&label={{ $widgetLabel }}"
                                        data-url="{{ Route::has('enterprise.dashboard.' . $widgetName) ? route('enterprise.dashboard.' . $widgetName) : '' }}">
                                    {{ $widgetLabel }}
                                </button>
                            </li>
                        @endforeach
                    @endforeach
                </ul>
            </div>

            <button type="button" class="btn btn-sm btn-info ms-4" data-bs-toggle="modal" data-bs-target="#requestWidget">
                <i class="fad fa-question-square me-2"></i>Request Widget
            </button>

            <button id="saveDashboard" type="button" class="btn btn-sm btn-info ms-4">
                <i class="fa-duotone fa-floppy-disk me-2"></i>Save
            </button>
        </div>

        <div class="enterprise-widget-grid" data-dashboard="{{ $dashboard->name }}">
            @foreach ($widgets as $key => $columns)
                <div class="widget-column" data-name="{{ $widgetColumns[$key]['name'] }}" data-size="{{ $widgetColumns[$key]['size'] }}">
                    @foreach($columns as $widgetName => $widgetLabel)
                        <x-enterprise.widget name="{{ $widgetName }}" heading="{{ $widgetLabel }}" />
                    @endforeach
                </div>
            @endforeach
        </div>

    </div>
<div class="filter-backdrop" style="display: none"></div>

<div class="modal fade" id="requestWidget" tabindex="-1" aria-labelledby="requestWidgetLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="requestWidgetLabel">Request a Widget</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="js-ajax-response alert position-relative" style="display: none;">
                    <span class="message"></span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="" class="max-width-450">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @csrf
                    <div class="form-group mb-3">
                        <label for="request-widget-content" class="font-weight-bold">What data / info would you like to see?</label>
                        <textarea class="form-control" name="request-widget-content" id="request-widget-content" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <button id="request-widget" type="submit" class="btn btn-primary" data-url="{{ route('enterprise.dashboard.request.widget') }}">Submit Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Dashboard saved!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

@endsection

@section('after_scripts')

    @if(array_key_exists('chart-clinical-trials-locations', $widgets[2]))
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/maps.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/geodata/data/countries2.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/plugins/overlapBuster.js"></script>
    @endif

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ mix('css/enterprise-dashboard.css') }}">
    <script src="https://unpkg.com/packery@2/dist/packery.pkgd.js"></script>
    <script src="https://unpkg.com/draggabilly@2/dist/draggabilly.pkgd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha256-t9UJPrESBeG2ojKTIcFLPGF7nHi2vEc7f5A2KpH/UBU=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            Chart.defaults.global.defaultFontColor = "#adb5bd";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

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
                let widgetColumns = [];

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

            // Request Widget
            $('#request-widget').on('click', function(event) {
                event.preventDefault();

                let url = $(this).data('url');

                let content = $('#request-widget-content').val();

                $.post(url, {
                    content: content,
                }, function (response) {
                    $('.js-ajax-response .message').text(response.message);
                    $('.js-ajax-response').removeClass('alert-danger').addClass('alert-success').show();
                    $('#request-widget-content').val('');
                })
                .fail(function(jqXHR) {
                    $.each(jqXHR.responseJSON.errors, function (key, item) {
                        $('.js-ajax-response .message').append("<span>"+item+"</span>")
                    });
                    $('.js-ajax-response').removeClass('alert-success').addClass('alert-danger').show();
                });
            });

            $('button.close-ajax-response').on('click', function() {
                $(this).parent().hide();
            });

            const saveDashboardToast = bootstrap.Toast.getOrCreateInstance(document.getElementById('liveToast'));

            $('#saveDashboard').on('click', function() {
                saveWidgetData();
                saveDashboardToast.show();
            });

            // TODO: Add toast notifications for adding/removing widgets
            // TODO: save category/focus filters and # of items in prefs

        });
    </script>
@endsection
