<?php $note_url = 'https://neuly.com/members/' . $member->member_url . '/' . $note->slug; ?>

<div class="modal fade" id="share-note" tabindex="-1" role="dialog" aria-labelledby="share-note-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="h3 modal-title">Share {{ $note->title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="py-3 px-2 text-center">
                    <div class="clipboard-container mb-4">
                            <label data-toggle="tooltip" data-trigger="manual" data-placement="top" title="Copied!" data-clipboard-target="#note-url" for="note_url" id="copy-note-url" class="fw-bold text-center text-primary cursor-hover-pointer">
                            <i class="fad fa-copy"></i> Copy Note URL to Clipboard
                        </label>
                        <input name="note_url" id="note-url" class="form-control form-control-sm" type="text" value="{{ $note_url }}">
                    </div>

                    <p class="mb-1 fw-bold">
                        Share on Social Media:
                    </p>

                    <div class="social-container d-flex align-items-center justify-content-center mb-4">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $note_url }}" target="_blank" rel="noopener noreferrer" class="mx-2 text-info">
                            <i class="fab fa-facebook fa-3x"></i>
                        </a>

                        <a href="https://twitter.com/intent/tweet?text={{ $note->title }} by {{ $member->name }} {{ $member->last_name }} on Neuly {{ $note_url }} " target="_blank" rel="noopener noreferrer" class="mx-2 text-info">
                            <i class="fab fa-twitter fa-3x"></i>
                        </a>

                        <a href="https://pinterest.com/pin/create/button/?url={{ $note_url }}&media=&description={{ $note->title }} by {{ $member->name }} {{ $member->last_name }} on Neuly" target="_blank" rel="noopener noreferrer" class="mx-2 text-info">
                            <i class="fab fa-pinterest fa-3x"></i>
                        </a>

                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $note_url }}" target="_blank" rel="noopener noreferrer" class="mx-2 text-info">
                            <i class="fab fa-linkedin fa-3x"></i>
                        </a>
                    </div>

                    <div class="email-container">
                        <p class="mb-1 p-0 fw-bold">Email a Friend:</p>
                        <a href="mailto:?&subject={{ $note->title }}&body=I saw this on Neuly and thought you'd be interested: {{ $note_url }}" class="text-decoration-none">
                            <span class="me-1">Open your mail app</span>
                            <i class="fad fa-external-link"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ asset('assets/clipboard.min.js') }}"></script>

<script>
    var clipboard = new ClipboardJS('#copy-note-url');

    clipboard.on('success', function(e) {
        $('#copy-note-url').tooltip('show');
    });

</script>
