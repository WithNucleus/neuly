<ul class="nav nav-tabs mb-2">
    <li class="nav-item">
        <a class="nav-link @if(Route::is('user.settings')) active text-primary @else text-muted @endif" href="{{ route('user.settings') }}">
        	<i class="fad fa-id-card"></i> Profile
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::is('user.settings.email')) active text-primary @else text-muted @endif" href="{{ route('user.settings.email') }}">
        <i class="fad fa-envelope"></i> Email
    </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::is('user.settings.password')) active text-primary @else text-muted @endif" href="{{ route('user.settings.password') }}">
        <i class="fad fa-lock"></i> Password
    </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::is('user.settings.social')) active text-primary @else text-muted @endif" href="{{ route('user.settings.social') }}">
            <i class="fad fa-share-alt"></i> Social accounts
        </a>
    </li>
</ul>
