@component('mail::message')
# Request for {{ $bookable }}

**Name:** {{ $name }}

**Email:** {{ $email }}

@if($phone != '')
**Phone:** {{ $phone }}
@endif

@if($date != '')
**Requested Date:** {{ $date }}
@endif

@if($number_of_guests != '')
**Number of Guests:** {{ $number_of_guests }}
@endif

@if($message != '')
**Message:** {{ $message }}
@endif

@endcomponent
