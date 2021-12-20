@component('mail::message')
Hello,

You have been invited by {{ $inviterName }} to join team "{{ $teamName }}" on Neuly. Use link below to sign up.

@component('mail::button', ['url' => $url])
Join team
@endcomponent

Have a great week!<br>
Neuly
@endcomponent




