<div>
    <div class="organizations-focus-chart" style="height: 300px;" data-action="{{ route('insights.companies-by-focus-drug') }}"></div>
</div>

<script>
    $(document).ready(function() {
        new Chartisan({
            el: '.organizations-focus-chart',
            url: $('.organizations-focus-chart').attr('data-action'),
            hooks: new ChartisanHooks()
                .colors(['rgba(63, 69, 49, 1)'])
                .responsive()
                .beginAtZero()
                .legend(false)
                .datasets(['bar']),
        });
    });
</script>
