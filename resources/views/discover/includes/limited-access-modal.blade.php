<div class="modal fade" id="limitedAccessModal" tabindex="-1" role="dialog" aria-labelledby="limitedAccessModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5 class="modal-title">Welcome to Neuly’s interactive database!</h5>
            </div>
            <div class="modal-body text-center">
                <p class="lead mt-4">Register for your free membership to access the entire database, view unique insights, and utilize your personal dashboard</p>

                <p class="mt-4">
                    <a href="{{ route('register') }}" class="btn btn-lg btn-primary text-uppercase">Register</a>
                    <span class="h4"> or </span>
                    <a href="{{ route('login') }}" class="btn btn-lg btn-primary text-uppercase">Login</a>
                </p>

                <p class="mt-4 text-center">
                    Neuly is a free resource to push forward our understanding of psychedelics.
                </p>
            </div>
        </div>
    </div>
</div>

@section('after_scripts')
    <script>
        $(function() {
            if ($('body').hasClass('unauthorized')) {
                $('#limitedAccessModal').modal({backdrop: 'static', keyboard: false}).show();
                $('body').css('overflow', 'hidden');
            }
        });
    </script>
@endsection


