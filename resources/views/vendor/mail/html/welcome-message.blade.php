@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        <span class="preheader" style="display: none !important; visibility: hidden; opacity: 0; color: transparent; height: 0; width: 0;">look what that means...</span>
        <tr>
            <td class="header">
                <a href="{{ config('app.url') }}" style="display: inline-block;">
                    <img src="https://neuly.com/images/neuly-logo-light.png" class="logo">
                </a>
            </td>
        </tr>
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent
