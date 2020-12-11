<ul class="nav nav-tabs mb-2">
    <li class="nav-item">
        <a class="nav-link @if(Route::is('user.person.index')) active text-primary @else text-muted @endif" href="{{ route('user.person.index') }}">
            <i class="fad fa-id-card"></i> Personal
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::is('user.person.email')) active text-primary @else text-muted @endif" href="{{ route('user.person.email') }}">
            <i class="fad fa-envelope"></i> Email
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::is('user.person.social')) active text-primary @else text-muted @endif" href="{{ route('user.person.social') }}">
            <i class="fad fa-lock"></i> Social
        </a>
    </li>
</ul>
