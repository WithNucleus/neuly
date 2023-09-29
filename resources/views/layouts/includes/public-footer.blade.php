<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
<link rel="stylesheet" href="{{ mix('css/algolia.css') }}">
<script type="text/javascript" src="{{ mix('js/search.js') }}"></script>
@yield('after_scripts')
@livewireScripts
@yield('livewire_scripts')
<div id="toast-container" class="toast-container position-fixed bottom-0 end-0 p-3"></div>
</body>
</html>
