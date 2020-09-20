<div class="d-flex flex-wrap mt-4">
    @foreach($countriesByCode as $alpha2code => $item)
        <div class="col-4 col-md-2 col-xl-2 mb-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $item['country'] }}</h5>
                    <table>
                        @foreach($item['focus'] as $focus)
                            <tr>
                                <td>{{ $focus['name'] }}</td>
                                <td>{{ $focus['trials'] }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    @endforeach
</div>
