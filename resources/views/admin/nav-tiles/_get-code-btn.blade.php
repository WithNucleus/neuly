<button class="btn btn-sm copy-nav-tile" data-toggle="tooltip" data-placement="top" title="Get code" data-clipboard-text='<script src="{{ route('nav-tiles.script', $navigationTile->slug) }}" type="text/javascript"></script>'>
    <i class="fad fa-code text-tertiary"></i>
</button>
<span class="badge badge-info copied" style="display: none">Copied!</span>

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
