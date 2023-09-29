<ul class="user-settings-tabs nav nav-tabs justify-content-center text-uppercase">
    <li class="nav-item">
        <a class="nav-link @if(Route::is('user.settings')) active text-accent @else text-body-secondary @endif" href="{{ route('user.settings') }}">
        	<i class="fad fa-id-card me-2"></i><span>Profile</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::is('user.settings.email')) active text-accent @else text-body-secondary @endif" href="{{ route('user.settings.email') }}">
        <i class="fad fa-envelope me-2"></i><span>Email</span>
    </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::is('user.settings.password')) active text-accent @else text-body-secondary @endif" href="{{ route('user.settings.password') }}">
        <i class="fad fa-lock me-2"></i><span>Password</span>
    </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::is('user.settings.social')) active text-accent @else text-body-secondary @endif" href="{{ route('user.settings.social') }}">
            <i class="fad fa-share-alt me-2"></i><span>Social Accounts</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::is('user.settings.oauth')) active text-accent @else text-body-secondary @endif" href="{{ route('user.settings.oauth') }}">
            <i class="fad fa-key me-2"></i><span>Connected Apps</span>
        </a>
    </li>
</ul>
