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
                <ul>
                    <li>Paste this code to the end of the web page (jQuery library is required).</li>
                    <li>Replace <code>$('input[type=text]')</code> jQuery selector with your text input selector.</li>
                    <li>Replace <code>API_ACCESS_TOKEN</code> with active Neuly API access token.</li>
                </ul>

<pre style="padding: 10px; background-color: lightgrey;">
&lt;link href="{{ url('/') }}/css/external/embedSearch.css" rel="stylesheet" type="text/css"&gt;
&lt;script src="{{ route('js.embedSearch') }}"&gt;&lt;/script&gt;
&lt;script&gt;
    $('input[type=text]').neulyEmbedSearch('API_ACCESS_TOKEN');
&lt;/script&gt;
</pre>

            </div>
        </div>
    </div>
@endsection
