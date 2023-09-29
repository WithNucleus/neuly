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
            <button class="btn settings" id="widget-settings-{{ $name }}" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Widget Settings">
                <i class="fal fa-ellipsis-v"></i>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item widget-collapse-label" data-bs-toggle="collapse" href="#widget-collapse-{{ $name }}"
                       role="button" aria-expanded="true" aria-controls="widget-collapse-{{ $name }}">
                        <span>Widget</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item remove-widget" data-widget="#{{ $name }}" href="#">Remove Widget</a>
                </li>
            </ul>
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
