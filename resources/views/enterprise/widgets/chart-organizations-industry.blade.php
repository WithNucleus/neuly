<div>
    <div class="organizations-industry-chart" style="height: 300px;" data-action="{{ route('insights.companies-by-focus-industry') }}"></div>
</div>

<script>
    $(document).ready(function() {
        new Chartisan({
            el: '.organizations-industry-chart',
            url: $('.organizations-industry-chart').attr('data-action'),
            hooks: new ChartisanHooks()
                .colors(['rgba(63, 69, 49, 1)'])
                .responsive()
                .beginAtZero()
                .legend(false)
                .datasets(['bar']),
        });
    });
</script>
