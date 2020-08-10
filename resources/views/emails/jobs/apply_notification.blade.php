@component('mail::message')

**Job Application**

**Organization:** {{ $organization }}

**Position:** {{ $position }}

**Name:** {{ $name }}

Resume and cover letter are attached.

<small>Before downloading any files, it's recommended to use a malware scanning tool, such as Gmail's built-in scanner.</small>

@endcomponent