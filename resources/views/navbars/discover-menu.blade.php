<div id="discover-feedback-button">
    <button class="btn btn-dark p-2" id="toggle-feedback-modal" tabindex="1" data-toggle="tooltip" data-placement="left" title="Neuly Feedback">
        <i class="fas fa-comment fa-lg text-tertiary"></i> <span class="sr-only">Neuly Feedback</span></button>
</div>

<div id="discover-menu-button">
    <button class="btn btn-dark p-2" id="toggle-discover-menu" tabindex="1" data-toggle="tooltip" data-placement="left" title="Navigate Neuly">
        <img src="{{ asset('images/brain-icon-cyan.png') }}" alt="Neuly Menu"> <span class="sr-only">Neuly Menu</span></button>
</div>

<div id="discover-backdrop" style="display: none;"></div>
<div id="discover-menu" class="rounded shadow-sm" style="display: none;">
    <p class="title mb-1 font-weight-bold text-uppercase text-tertiary pr-4">Explore</p>
    <ul class="plain-list mb-2">
        <li><a href="{{ route('discover.organizations') }}">Organizations</a></li>
        <li><a href="{{ route('discover.people') }}">People</a></li>
        <li><a href="{{ route('discover.investors') }}">Investors</a></li>
        <li><a href="{{ route('discover.locations') }}">Locations</a></li>
        <li><a href="{{ route('discover.focus') }}">Focus</a></li>
        <li><a href="{{ route('discover.research') }}">Research</a></li>
        <li><a href="{{ route('discover.clinicaltrials') }}">Clinical Trials</a></li>
        <li><a href="{{ route('discover.index') }}">Pubco Index</a></li>
        <li><a href="{{ route('discover.events') }}">Events</a></li>
        <li><a href="{{ route('discover.jobs') }}">Jobs</a></li>
        <li><a href="{{ route('discover.news') }}">News</a></li>
        <li><a href="{{ route('discover.insights') }}">Insights</a></li>
    </ul>

    <p class="title mb-1 font-weight-bold text-uppercase text-tertiary pr-4">Neuly</p>
    <ul class="plain-list mb-0">
        <li><a href="/about">About Us</a></li>
        <li><a href="/what-data-is-included">What Data is Included</a></li>
        <li>Create a Profile <span class="badge badge-warning">Coming soon!</span></li>
        <li><a href="{{ route('member.dashboard') }}">Dashboard</a></li>
        @guest
            <li><a href="{{ route('register') }}">Register</a> / <a href="/login">Login</a></li>
        @else
            <li><a href="{{ route('user.settings') }}">Settings</a></li>
            <li><a href="/help">Help</a></li>
        @endguest
    </ul>
</div>

<div id="discover-feedback" class="rounded shadow-sm" style="display: none;">
    <p class="title mb-1 font-weight-bold text-uppercase text-tertiary pr-4">Give Feedback</p>
    <form id="feedback-form" class="max-width-450">
        @csrf
        <div class="alert alert-success mt-3" style="display: none;">
            We got it - thanks so much for your feedback!
        </div>
        <div class="alert alert-danger mt-3" style="display: none;"></div>
        @auth
            <div class="form-group">
                <input type="hidden" class="form-control" name="user_name" value="{{ Auth::user()->name }}">
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" name="user_email" value="{{ Auth::user()->email  }}">
            </div>
        @endauth
        <div class="form-group">
            <label for="title" class="font-weight-bold">Title:</label>
            <input type="text" class="form-control" name="title" required>
        </div>
        <div class="form-group">
            <label for="type" class="font-weight-bold">Type:</label>
            <select class="custom-select" name="type">
                <option value="feedback" selected>General Feedback</option>
                <option value="bug">Bug / Problem</option>
                <option value="suggestion">Suggestion</option>
                <option value="feature request">Feature Request</option>
            </select>
        </div>
        <div class="form-group">
            <label for="content" class="font-weight-bold">Message:</label>
            <textarea class="form-control" name="content" rows="5" required></textarea>
        </div>
        <div class="form-group">
            @auth
                <button id="submit-feedback" class="btn btn-primary float-right" type="submit">Submit</button>
            @else
                <p>Please login to submit feedback</p>
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            @endauth
        </div>
    </form>
</div>
