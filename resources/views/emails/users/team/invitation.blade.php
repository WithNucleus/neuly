@component('mail::message')
Hello,

You have been invited to join team on Neuly by {{ $inviterName }}. Use link below to sign up.

@component('mail::button', ['url' => $url])
Register
@endcomponent

Have a great week!<br>
Neuly
@endcomponent




