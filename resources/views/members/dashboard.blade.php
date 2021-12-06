@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('members.includes.dashboard-begin')

    @include('members.includes.status-messages')
    <style>
        .dashboard-sortable-grid .drag-handle {
            position: absolute;
            right: 15px;
            top: 0;
            font-size: 2rem;
            visibility: hidden;
            cursor: move;
        }
        .dashboard-sortable-grid > div:hover .drag-handle {
            visibility: visible;
        }
    </style>

    <div class="row dashboard-sortable-grid">
        @foreach($widgetsOrder as $widget)
            @if($widget == 'following')
                <div class="col-12 col-md-6 col-xl-4 mb-5" data-name="following">
                    <span class="drag-handle pull-right text-secondary"><i class="fa fa-arrows-alt"></i></span>
                    @include('members.dashboard-widgets.following')
                </div>
            @elseif($widget == 'notes')
                <div class="col-12 col-md-6 col-xl-4 mb-5" data-name="notes">
                    <span class="drag-handle pull-right text-secondary"><i class="fa fa-arrows-alt"></i></span>
                    @include('members.dashboard-widgets.notes')
                </div>
            @elseif($widget == 'recent')
                <div class="col-12 col-md-6 col-xl-4 mb-5" data-name="recent">
                    <span class="drag-handle pull-right text-secondary"><i class="fa fa-arrows-alt"></i></span>
                    @include('members.dashboard-widgets.recent')
                </div>
            @endif
        @endforeach
    </div>

    @include('members.includes.dashboard-end')

    <script src="{{ asset('js/formValidation.js') }}"></script>

@endsection

@section('after_scripts')
<script>
    $( function() {
        $('.dashboard-sortable-grid').sortable({
            handle: '.drag-handle',
            update: function( event, ui ) {
                let widgetsOrder = [];

                $(this).children().each(function (){
                    widgetsOrder.push($(this).data('name'));
                });

                $.post('{{ route('member.dashboard.updateWidgetsOrder') }}', { order: widgetsOrder});
            }
        });
    } );
</script>
@endsection
