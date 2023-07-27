<div class="modal fade" id="share-list" tabindex="-1" role="dialog" aria-labelledby="share-list-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="fs-4 modal-title">Share {{ $list->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="py-3 px-2 text-center">
                    <div class="clipboard-container mb-4">
                        <label data-toggle="tooltip" data-bs-trigger="manual" data-bs-placement="top" title="Copied!" data-clipboard-target="#share-url" for="share_url" id="copy-url" class="fw-bold text-center text-primary cursor-hover-pointer">
                            <i class="fad fa-copy"></i> Copy URL to Clipboard
                        </label>
                        <input name="share_url" id="share-url" class="form-control form-control-sm" type="text" value="{{ $shareUrl }}">
                    </div>

                    <p class="mb-1 fw-bold">
                        Share on Social Media:
                    </p>

                    <div class="social-container d-flex align-items-center justify-content-center mb-4">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" rel="noopener noreferrer" class="mx-2 text-info">
                            <i class="fab fa-facebook fa-3x"></i>
                        </a>

                        <a href="https://twitter.com/intent/tweet?text={{ $list->name }} by {{ $user->name }} {{ $user->last_name }} on Neuly {{ $shareUrl }} " target="_blank" rel="noopener noreferrer" class="mx-2 text-info">
                            <i class="fab fa-twitter fa-3x"></i>
                        </a>

                        <a href="https://pinterest.com/pin/create/button/?url={{ $shareUrl }}&media=&description={{ $list->name }} by {{ $user->name }} {{ $user->last_name }} on Neuly" target="_blank" rel="noopener noreferrer" class="mx-2 text-info">
                            <i class="fab fa-pinterest fa-3x"></i>
                        </a>

                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}" target="_blank" rel="noopener noreferrer" class="mx-2 text-info">
                            <i class="fab fa-linkedin fa-3x"></i>
                        </a>
                    </div>

                    <div class="email-container">
                        <p class="mb-1 p-0 fw-bold">Email a Friend:</p>
                        <a href="mailto:?&subject={{ $list->name }}&body=I saw this on Neuly and thought you'd be interested: {{ $shareUrl }}">
                            Open your mail app <i class="fad fa-external-link"></i></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ asset('assets/clipboard.min.js') }}"></script>
<script>
    let clipboard = new ClipboardJS('#copy-url');

    clipboard.on('success', function(e) {
        $('#copy-url').tooltip('show');
    });
</script>
