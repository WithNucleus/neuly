@if ($crud->hasAccess('bulkImport') && $crud->get('list.bulkActions'))
    <a href="javascript:void(0)" onclick="bulkParseEntries(this)" class="btn btn-sm btn-secondary bulk-button"><i class="la la-import"></i> Bulk Import</a>
@endif

@push('after_scripts')
    <script>
        if (typeof bulkParseEntries != 'function') {
            function bulkParseEntries(button) {

                if (typeof crud.checkedItems === 'undefined' || crud.checkedItems.length == 0)
                {
                    new Noty({
                        type: "warning",
                        text: "<strong>{!! trans('backpack::crud.bulk_no_entries_selected_title') !!}</strong><br>{!! trans('backpack::crud.bulk_no_entries_selected_message') !!}"
                    }).show();

                    return;
                }

                var message = "Are you sure you want to add these :number entries to the import queue?";
                message = message.replace(":number", crud.checkedItems.length);

                // show confirm message
                swal({
                    title: "{!! trans('backpack::base.warning') !!}",
                    text: message,
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: "{!! trans('backpack::crud.cancel') !!}",
                            value: null,
                            visible: true,
                            className: "bg-secondary",
                            closeModal: true,
                        },
                        delete: {
                            text: "Add",
                            value: true,
                            visible: true,
                            className: "bg-primary",
                        }
                    },
                }).then((value) => {
                    if (value) {
                        var ajax_calls = [];
                        var action_route = "{{ route('admin.import.company.serpapi.bulkImport')  }}";

                        // submit an AJAX delete call
                        $.ajax({
                            url: action_route,
                            type: 'POST',
                            data: { entries: crud.checkedItems },
                            success: function(result) {
                                // Show an alert with the result
                                new Noty({
                                    type: "success",
                                    text: crud.checkedItems.length+" entries were added to the import queue!"
                                }).show();

                                crud.checkedItems = [];
                                crud.table.ajax.reload();
                            },
                            error: function(result) {
                                // Show an alert with the result
                                new Noty({
                                    type: "danger",
                                    text: "Error: unable to add "+crud.checkedItems.length+" entries to the import queue!"
                                }).show();
                            }
                        });
                    }
                });
            }
        }
    </script>
@endpush
