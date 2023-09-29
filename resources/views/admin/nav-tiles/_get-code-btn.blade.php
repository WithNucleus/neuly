<button class="btn btn-sm btn-outline-tertiary copy-nav-tile rounded-0" data-clipboard-text='<script src="{{ route('nav-tiles.script', $navigationTile->slug) }}" type="text/javascript"></script>'>
    <i class="fa fa-strong fa-code me-1"></i>
    <span>Get Code</span>
</button>
<span class="badge bg-primary copied" style="display: none">Copied!</span>

<script type="text/javascript" src="{{ asset('assets/clipboard.min.js') }}"></script>
<script>
    $(document).ready(function () {
        let clipboard = new ClipboardJS('.btn');

        clipboard.on('success', function(event) {
            $(event.trigger).siblings('span').show().delay(2500).fadeOut();
            event.clearSelection();
        });
    });
</script>
