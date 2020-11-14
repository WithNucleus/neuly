<div class="py-4 col-12 col-lg-12">

    <h4 class="text-center">You have raised a claim that is missing verification. Please choose:</h4>

    @include('members.includes.status-messages')
    <div class="row mt-5">
        <div class="col-6 d-inline-flex justify-content-center flex-column align-items-center">
            <div class="d-flex justify-content-center align-items-center" style="background: rgba(115, 251, 211, 0.75); border-radius: 50%; width:200px; height: 200px; color: #275DAD;">
                <svg width="8em" height="8em" viewBox="0 0 16 16" class="bi bi-person-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
                    <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
                </svg>
            </div>
            <a href="{{ route('user.person.social.verify') }}" class="btn btn-primary mt-4">verify by social media</a>
        </div>
        <div class="col-6  d-inline-flex justify-content-center flex-column align-items-center">
            <div class="d-flex justify-content-center align-items-center" style="background: rgba(115, 251, 211, 0.75); border-radius: 50%; width:200px; height: 200px; color: #275DAD;">
                <svg width="8em" height="8em" viewBox="0 0 16 16" class="bi bi-mailbox" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4 4a3 3 0 0 0-3 3v6h6V7a3 3 0 0 0-3-3zm0-1h8a4 4 0 0 1 4 4v6a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V7a4 4 0 0 1 4-4zm2.646 1A3.99 3.99 0 0 1 8 7v6h7V7a3 3 0 0 0-3-3H6.646z"/>
                    <path fill-rule="evenodd" d="M11.793 8.5H9v-1h5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.354-.146l-.853-.854z"/>
                    <path d="M5 7c0 .552-.448 0-1 0s-1 .552-1 0a1 1 0 0 1 2 0z"/>
                </svg>
            </div>
            <a href="{{ route('user.person.email.verify') }}" class="btn btn-primary mt-4">verify by email</a>
        </div>
    </div>

</div>
