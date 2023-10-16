<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">
{{ config('app.name') }}
</x-mail::header>
</x-slot:header>

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{{ $subcopy }}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
© {{ date('Y') }} Neuly, LLC. All rights reserved. You're receiving this email because you signed up for Neuly or requested information.<br>
<a href="{{ route('user.settings.email') }}">Manage Email Preferences</a> | <a href="{{ route('member.dashboard') }}">Visit Neuly Dashboard</a>
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
