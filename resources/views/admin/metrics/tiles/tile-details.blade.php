@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h2>
            <span class="text-capitalize">{{ $entityLabel }} Records</span>
            <small id="datatable_info_stack" class="animated fadeIn" style="display: inline-flex;">
                <span class="mr-2">
                    {{ Carbon\Carbon::parse($filterDateStart)->format('M d, Y') }} - {{ Carbon\Carbon::parse($filterDateEnd)->format('M d, Y') }}
                </span>
                <a href="{{ route('admin.metrics.tiles') }}?start={{ Carbon\Carbon::parse($filterDateStart)->format('Y-m-d') }}&end={{ Carbon\Carbon::parse($filterDateEnd)->format('Y-m-d') }}">Go Back</a>
            </small>
        </h2>
    </div>
@endsection

@section('content')
    <div class="row mt-4">

        <div class="col-12">
            <?php
            $template = match($entity) {
                'companies' => 'admin.metrics.tiles.entities.organizations',
                'jobs' => 'admin.metrics.tiles.entities.jobs',
                'clinicaltrials' => 'admin.metrics.tiles.entities.clinical_trials',
                'users' => 'admin.metrics.tiles.entities.users',
                "News",
                "Article",
                "Image",
                "Video",
                "Mixed",
                "Podcast",
                "Book",
                "Patent Filing",
                "courses",
                "patents" => 'admin.metrics.tiles.entities.external-link',
                default => 'admin.metrics.tiles.entities.default'
            }
            ?>

            <ul class="list-group">
                @foreach($metrics as $record)
                    <li class="list-group-item">
                        @include($template)
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
@endsection
