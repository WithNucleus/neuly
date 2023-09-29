@extends('layouts.admin')

@section('head')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
@endsection

@section('content')

    <div class="container my-5">
        <p class="lead mb-5">There's an example navigation tile in the bottom left corner</p>

        @include('discover.includes.status-messages')

        <div class="alert js-ajax-response position-relative" style="display: none;">
            <div class="d-flex justify-content-between">
                <span class="message"></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
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
                            <a href="{{ route('adminx.nav-tiles.edit', $navigationTile->id) }}" class="btn btn-sm btn-outline-primary rounded-0 me-3">
                                <i class="fa fa-strong fa-edit me-1"></i>
                                <span>Edit</span>
                            </a>
                            <button class="btn btn-sm btn-outline-danger rounded-0 delete-nav-tile me-3" data-delete="{{ $navigationTile->id }}" data-action="{{ route('adminx.nav-tiles.delete', $navigationTile->id) }}">
                                <i class="fa fa-strong fa-trash-alt me-1"></i>
                                <span>Delete</span>
                            </button>
                            <a href="{{ route('adminx.nav-tiles.clone', $navigationTile->id) }}" class="btn btn-sm btn-outline-success rounded-0 me-3">
                                <i class="fa fa-strong fa-copy me-1"></i>
                                <span>Clone</span>
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
