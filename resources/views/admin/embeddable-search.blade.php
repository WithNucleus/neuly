@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h2>
            <span class="text-capitalize">Embeddable search</span>
        </h2>
    </div>
@endsection

@section('content')
    <!-- Default box -->
    <div class="row mt-4">
        <div class="col-12 col-md-8">
            <div class="card card-body">

                <p>Place this code of the button which will open search window:</p>
<pre style="padding: 10px; background-color: lightgrey;">
&lt;button id="nes-open-modal-btn" class="nes-open-modal-btn"&gt;Search&lt;/button&gt;
</pre>

                <p>Paste this code to the end of the web page (<b>jQuery library is required</b>):</p>
<pre style="padding: 10px; background-color: lightgrey;">
&lt;link href="{{ asset('/css/external/embed-search.css') }}" rel="stylesheet" type="text/css"&gt;
&lt;script src="{{ asset('/js/external/embed-search.js') }}"&gt;&lt;/script&gt;
&lt;script&gt;
    $('#nes-open-modal-btn').neulyEmbedSearch();
&lt;/script&gt;
</pre>
                <p>You can use your own button and initialize <code>neulyEmbedSearch()</code> for it with jQuery selector.</p>
            </div>
        </div>
    </div>
@endsection
