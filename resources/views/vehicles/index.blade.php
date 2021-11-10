@extends('base')
@section('content')
<div class="container mt-5">
    <a class="btn btn-outline-success btn-lg" href="{{ URL::to('vehicles/create') }}">Sukurti naują</a>
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
        <tbody>
        @foreach($vehicles as $key => $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->plates }}</td>
                <td>{{ $value->vehicleModel->manufacturer_name }} {{ $value->vehicleModel->model_name }}</td>
                <td>{{ $value->fuel_tank_volume }}</td>
                <td>{{ $value->average_fuel_consumption }}</td>
                <td>{{ $value->getDistance() }} km</td>
                <td scope="col">
                    <a class="btn btn-outline-danger btn-lg" href="{{ URL::to('vehicles/' . $value->id. '/delete') }}"><i class="bi bi-trash-fill"></i></a>
                    <a class="btn btn-outline-warning btn-lg" href="{{ URL::to('vehicles/' . $value->id . '/edit') }}"><i class="bi bi-pencil-fill"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop