@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h1>
            <span class="text-capitalize">Import</span>
            <a href="/admin/research" class="font-sm"><i class="la la-angle-double-left"></i> Back to <span>Research Articles</span></a>
        </h1>
    </div>
@endsection

@section('content')


    @if (session('info'))
    
        <pre>
            <?php
            // var_dump(session('info'));

            $next_link = session('info')['next_link'];
            $import_results = session('info')['import_results'];
            $focus_id = session('info')['focus_id'];
            ?>
        </pre>

        <div class="row">
            <div class="col-12 col-md-8 col-xl-6">
                <div class="card card-body">

                    {{-- {{ $next_link }} --}}

                    <form action="{{ route('import.research.process') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                        @csrf
                        <input type="hidden" name="serpapi_pagination" value="{{ $next_link }}">
                        <input type="hidden" name="focus_id" value="{{ $focus_id }}">
                        <input type="hidden" name="api" value="Google Scholar">
                        <button type="submit" class="btn btn-primary">Continue Searching...</button>
                    </form>

                    <h2 class="h3">Import Results</h2>
                    <ul class="list-group">
                        @foreach($import_results as $result)
                            <li class="list-group-item">
                                @if($result['status'] == 'success')
                                    <span class="h4"><i class="las la-check-double text-success mr-2"></i></span>
                                    #{{ $result['model_id'] }} - 
                                @else
                                    <span class="h4"><i class="las la-times-circle text-danger mr-2"></i></span>
                                @endif
                                {{ $result['title'] }}

                                @if ($result['authors'] != '')
                                    <span class="badge badge-primary">{{ $result['authors'] }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    @endif

    <div class="row mt-4">

        <div class="col-12 col-md-8 col-xl-6">

            <div class="card card-body">

                <h3 class="h4">New Search</h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('import.research.process') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <div class="col-12 col-md-6">
                            <label for="focus_id" class="font-weight-bold">Focus Category</label>
                            <select class="form-control custom-select" name="focus_id" required>
                                <option value="" selected disabled="">--</option>
                                <option value="25">Psilocybin</option>
                                <option value="29">MDMA</option>
                                <option value="26">LSD</option>
                                <option value="28">DMT</option>
                                <option value="30">Ketamine</option>
                                <option value="31">Ibogaine</option>
                                <option value="52">GHB</option>
                                <option value="49">Tryptamine</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="api" class="font-weight-bold">API</label>
                            <select name="api" id="" class="form-control custom-select">
                                <option value="Google Scholar">Google Scholar</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                            <span class="la la-atom" role="presentation" aria-hidden="true"></span> &nbsp;
                            <span>Search</span>
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12 col-md-8 col-xl-6">

            @isset($import_results)
            {{-- <div class="card card-body">
                <h4>Previous Searches</h4>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Focus</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    @foreach($import_results as $result)
                        <tr>
                            <td>
                                {{ Carbon\Carbon::parse($result->created_at)->diffForHumans() }}
                            </td>
                            <td>
                                {{ $result->focus->name }}
                            </td>
                            <td>
                                <a href="{{ route('import.results', $result->id) }}" class="btn btn-sm btn-link"><i class="la la-eye"></i> Preview</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div> --}}
            @endisset

        </div>
    </div>

@endsection