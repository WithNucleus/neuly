@extends('layouts.admin')

@section('content')

    @include('admin.nav-tiles._menu')

    <div class="container my-5">
        <h1 class="h2 mb-4">Editing {{ $navigationTile->name }}</h1>

        <div class="row">
            <div class="col-12 col-lg-5">
                @include('admin.nav-tiles._edit-form')
                <div class="my-4">
                    <h3 class="h5">Code</h3>
                    <div class="d-flex align-items-center">
                        <div class="form-control w-auto">
                            {{ route('nav-tiles.script', $navigationTile->slug) }}
                        </div>
                        <div class="flex-shrink-0">
                            @include('admin.nav-tiles._get-code-btn')
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5 offset-lg-1">
                @include('admin.nav-tiles.items.items-list')
                @include('admin.nav-tiles.items.add-item-form')
            </div>
        </div>
    </div>

<script src="{{ route('nav-tiles.script', $navigationTile->slug) }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('assets/sortable.min.js') }}"></script>
<script>
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let linksTable = document.getElementById('sortable-links');
        Sortable.create(linksTable, {
            animation: 150,
            ghostClass: 'bg-warning',
            onUpdate: function () {
                $('.js-list-updated-message').show();
            }
        });

        $('.js-save-link-order').on('click', function() {

            // TODO: Update the navTile after reordering

            let linkOrder = [],
                actionUrl = $(this).data('action');

            $('#sortable-links li').each(function (index){
                let listItem = $(this),
                    navLinkId = listItem.data('nav-link-id'),
                    order = index + 1;

                linkOrder.push({
                    'link_id' : navLinkId,
                    'order': order,
                });
            });

            $.post(actionUrl, {'linkOrder' : linkOrder}, function (response) {
                $('.js-ajax-response .message').text(response.message);

                if (response.status === 'success') {
                    $('.js-ajax-response').addClass('alert-success').show();
                } else {
                    $('.js-ajax-response').addClass('alert-danger').show();
                }
            });

            $('.js-list-updated-message').hide();
        });

        $('button.close').on('click', function() {
            $(this).parent().hide();
        });

        $('.js-link-type-radio').change(function(){

            if ($(this).val() === 'link') {
                $(this).closest('form').children('.for-link-type').show();
            } else {
                $(this).closest('form').children('.for-link-type').hide();
            }
        });

        $('.delete-nav-tile-item').on('click', function() {

            if(confirm(('Are you sure?'))) {

                let deleteUrl = $(this).data('action'),
                    parent = $(this).closest('.nav-tile-item');

                $.post(deleteUrl, function (response) {

                    $('.js-ajax-response .message').text(response.message);
                    parent.remove();

                    if (response.status === 'success') {
                        $('.js-ajax-response').addClass('alert-success').show();

                    } else {
                        $('.js-ajax-response').addClass('alert-danger').show();
                    }
                });
            }
        });
    });
</script>
<style>
    #sortable-links {
        margin: 0 0 2rem 0;
        padding: 0;
    }

    #sortable-links li {
        display: block;
        padding: .5rem .75rem;
        margin: 0;
        border: 1px solid #ccc;
        border-top: 0;
        background: #fff;
    }

    #sortable-links li:hover {
        cursor: grab;
    }

    #sortable-links li .title {
        font-size: 1.2rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    #sortable-links li:first-of-type {
        border-top-right-radius: .25rem;
        border-top-left-radius: .25rem;
        border-top: 1px solid #ccc;
    }

    #sortable-links li:last-of-type {
        border-bottom-right-radius: .25rem;
        border-bottom-left-radius: .25rem;
    }
</style>
@endsection
