@extends('layouts.admin')

@section('content')

    <div class="container my-5">
        <p class="lead mb-5">There's an example navigation tile in the bottom left corner</p>

        @include('discover.includes.status-messages')

        <div class="alert js-ajax-response position-relative" style="display: none;">
            <span class="message"></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Domain</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($navigationTiles as $navigationTile)
                    <tr>
                        <td>
                            <a href="{{ route('adminx.nav-tiles.edit', $navigationTile->id) }}">{{ $navigationTile->name }}</a>
                        </td>
                        <td>
                            {{ $navigationTile->domain }}
                        </td>
                        <td style="min-width: 270px;">
                            <a href="{{ route('adminx.nav-tiles.edit', $navigationTile->id) }}" class="btn btn-sm" data-bs-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="fad fa-edit text-info"></i>
                            </a>
                            <button class="btn btn-sm delete-nav-tile" data-delete="{{ $navigationTile->id }}" data-action="{{ route('adminx.nav-tiles.delete', $navigationTile->id) }}" data-bs-toggle="tooltip" data-placement="top" title="Delete">
                                <i class="fad fa-trash-alt text-danger"></i>
                            </button>
                            <a href="{{ route('adminx.nav-tiles.clone', $navigationTile->id) }}" class="btn btn-sm" data-bs-toggle="tooltip" data-placement="top" title="Clone">
                                <i class="fad fa-copy text-secondarydark"></i>
                            </a>
                            @include('admin.nav-tiles._get-code-btn')
                        </td>
                    </tr>
                @empty
                <tr>
                    <td colspan="3">No navigation tiles yet</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Example --}}
    @include('admin.nav-tiles._example')

    <script>
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.delete-nav-tile').on('click', function() {

                if(confirm(('Are you sure?'))) {

                    let deleteUrl = $(this).data('action'),
                        parent = $(this).closest('tr');

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

            $('button.close').on('click', function() {
                $(this).parent().hide();
            });

        });
    </script>
@endsection
