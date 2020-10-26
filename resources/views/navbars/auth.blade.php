<?php
$darkmode ?? $darkmode = false;
?>

<div class="container-fluid my-3 my-lg-5 text-center">
    <a class="navbar-brand" href="/">
        @if ($darkmode == true)
            <img src="{{ asset('images/neuly-logo-dark.png') }}" alt="Neuly">
        @else
            <img src="{{ asset('images/neuly-logo-light.png') }}" alt="Neuly">
        @endif
    </a>
</div>
