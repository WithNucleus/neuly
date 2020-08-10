<div class="row mt-1">
    <div class="col-12">

        <div class="card card-body">

            <div class="clearfix">
                <h2 class="h3 float-left">Imported Data</h2>
                <div class="d-inline-block float-right">
                    <button id="maximize-csv-data" class="btn btn-sm btn-primary">Open Larger</button>
                </div>
            </div>
            
            @isset($csv)
                <div id="csv-table">
                    <button id="close-csv-data" class="btn btn-lg p-0 btn-link d-none float-right mb-1 text-white"><i class="lar la-times-circle"></i></button>
                    <div class="content bg-white">
                        <table class="table" style="font-size: .8rem">
                            @foreach($csv as $row)
                                <tr>
                                    @if($loop->iteration == 1)
                                            @foreach($row as $column)
                                                <th style="white-space: nowrap;">{{ $column }}</th>
                                            @endforeach
                                    @else
                                        <tr>
                                            @foreach($row as $column)
                                                <td>{{ $column }}</td>
                                            @endforeach
                                        </tr>
                                    @endif
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            @endisset

        </div>
    </div>
</div>
<style>
    #csv-table .content {
        width: 100%;
        height: 800px;
        overflow-x:scroll;
        /* resize: both; */
    }

    #csv-table.fixed {
        position: fixed;
        display:  block;
        top:  0;
        left:  0;
        width:  100%;
        height:  100%;
        z-index:  9;
        background: rgba(0, 0, 0, .80);
        padding:  2rem;
    }

    #csv-table.fixed .content {
        height:  100%;
    }

    #close-csv-data {
        position:  fixed;
        z-index:  10;
        top: 0;
        right:  0;
        font-size:  1.8rem;
    }

    body.noscroll {
        overflow:  hidden;
    }
</style>

<script>
    document.getElementById('maximize-csv-data').onclick = function changeContent() {

       document.getElementById('csv-table').classList.toggle('fixed');
       document.getElementById('close-csv-data').classList.toggle('d-none');
       document.body.classList.toggle('noscroll');

    }

    document.getElementById('close-csv-data').onclick = function closeCsv() {
        document.getElementById('csv-table').classList.toggle('fixed');
        document.getElementById('close-csv-data').classList.toggle('d-none');
        document.body.classList.toggle('noscroll');
    }
</script>