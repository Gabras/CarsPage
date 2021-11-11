@extends('base')
@section('content')
<div class="container mt-5">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <a class="btn btn-outline-success btn-lg" href="{{ URL::to('vehicles/create') }}">Sukurti naują</a>
        <div class="form-group mt-2">
            <input type="text" id="search" class="form-control" placeholder="Paieška"/>
        </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Valstybinis numeris</th>
                <th scope="col">Gamintojas ir modelis</th>
                <th scope="col">Kuro bako talpa (l)</th>
                <th scope="col">Vidutinis kuro sunaudojimas (l/100 km)</th>
                <th scope="col">Prognozuojama distancija (apskaičiuoti)</th>
                <th scope="col">Valdymas</th>
            </tr>
        </thead>
        <tbody id="ajaxData">
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function (){
        fetchVehiclesData();
    });

    $("#search").on('keyup', function(){
        var data = $("#search").val();
        fetchVehiclesData(data);
    });

    function fetchVehiclesData(data = '') {
        $.ajax({
            url:"{{ route('search.action') }}",
            method:'GET',
            data: {'searchParam' : data},
            dataType:'json',
            success:function(data)
            {
                $('#ajaxData').html(data.html);
            }
        })
    }
</script>

@stop
