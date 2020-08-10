@component('mail::message')

**Hello {{$name}}!**

You are receiving this email because your email was changed to {{ $newMailAddress }}.

If you haven't done this, you can reset the changed email.

@component('mail::button', ['url' => $link])
Restore Email
@endcomponent

<hr>

<small>If you're having trouble clicking the "Restore Email" button, copy and paste the URL below into your web browser: {{ $link }}</small>

@endcomponent