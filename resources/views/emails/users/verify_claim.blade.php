@component('mail::message')
Hi {{ $person_name }},

Your person listing at neuly.com was claimed. If this was you, please verify by clicking on the button below.

@component('mail::button', ['url' => route('user.person.verify.email.check', ['token' => $verification_token]), 'color' => 'primary'])
verify claim
@endcomponent

If you didn't intend to do this, please contact us at <a href="{{ route('index') }}">neuly.com</a>.

Best regards,

Neuly
@endcomponent
