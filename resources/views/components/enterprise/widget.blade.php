@props([
    'name',
    'heading'
])

<div class="enterprise-widget" id="{{ $name }}" data-label="{{ $heading }}">
    <div class="drag-handle">
        <i class="fal fa-arrows"></i>
    </div>
    <h2 class="widget-title">
        {{ $heading }}
        <div class="dropdown">
            <button class="btn settings" type="button" id="widget-settings-{{ $name }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fal fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="widget-settings-{{ $name }}">
                <a class="dropdown-item widget-collapse-label" href="#" data-toggle="collapse" data-target="#widget-collapse-{{ $name }}" aria-expanded="true" aria-controls="widget-collapse-{{ $name }}">
                    <span>Widget</span>
                </a>
                <a class="dropdown-item remove-widget" href="#" data-widget="#{{ $name }}">Remove Widget</a>
            </div>
        </div>
    </h2>
    <div id="widget-collapse-{{ $name }}" class="widget-collapsable-content collapse show">
        @if ($name == 'combined-feed')
            @include('enterprise.widget-controls.combined-feed')
        @elseif($name == 'clinical-trials')
            @include('enterprise.widget-controls.clinical-trials')
        @elseif($name == 'patents')
            @include('enterprise.widget-controls.patents')
        @endif
        <div class="enterprise-widget-content" data-url="{{ Route::has('enterprise.dashboard.' . $name) ? route('enterprise.dashboard.' . $name) : '' }}">
            Loading {{ $name }}...
        </div>
    </div>
</div>
