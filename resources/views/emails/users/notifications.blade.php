@component('mail::message')
**Hi {{$name}}!**

Here are your updates for this week:

@foreach($notifications as $notification)
**{{ $notification->title }}**\
{!! $notification->message !!}

@endforeach

Have a great week!

Neuly
@endcomponent
