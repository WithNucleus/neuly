<table class="table table-striped mt-3">
    <thead>
        <th scope="col">Name</th>
        <th scope="col">Clinical Trials</th>
    </thead>
    <tbody>
    @foreach($countriesByCode as $alpha2code => $item)
        <tr>
            <td>{{ $item['country'] }}</td>
            <td>{{ $item['total'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
