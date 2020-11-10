@component('mail::message')
    Hi {{ $person_name }},

    your person profile at neuly.com was claimed. If the claim was raised by you please verify by clicking on the button.

    @component('mail::button', ['url' => route('discover.people.claim.verify', ['slug' => $person_slug, 'token' => $verification_token]), 'color' => 'primary'])
        verify claim
    @endcomponent

    If you didn't raise this claim please contact us at <a hre="http://www.neuly.com">neuly.com</a>.

    Best regards,

    Your team of neuly.com
@endcomponent
