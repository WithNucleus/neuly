@component('mail::message')
# Request for {{ $bookable }}

**Name:** {{ $name }}

**Email:** {{ $email }}

**Phone:** {{ $phone }}

**Requested Date:** {{ $date }}

**Message:** {{ $message }}
@endcomponent
