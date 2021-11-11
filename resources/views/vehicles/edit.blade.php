@extends('base')
@section('content')
<div class="container mt-5">

    <a class="btn btn-outline-success btn-lg" href="{{ URL::to('/') }}"><i class="bi bi-house-door-fill"></i>Pagrindinis</a>

    <h1>Transporto priemonės {{ $vehicle->plates }} redagavimas</h1>
    <hr class="divider">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{ Form::model($vehicle, array('route' => array('vehicle.update', $vehicle->id), 'method' => 'PUT')) }}
    <div class="form-group">
        {{ Form::label('plates', 'Valstybinis numeris', array('class' => 'h4')) }}
        {{ Form::text('plates', null) }}
    </div>
    <div class="form-group">
        {{ Form::label('vehicleModel[manufacturer_name]', 'Gamintojas', array('class' => 'h4')) }}
        {{ Form::text('vehicleModel[manufacturer_name]', null) }}
    </div>
    <div class="form-group">
        {{ Form::label('vehicleModel[model_name]', 'Modelis', array('class' => 'h4')) }}
        {{ Form::text('vehicleModel[model_name]', null) }}
    </div>
    <div class="form-group">
        {{ Form::label('fuel_tank_volume', 'Kuro bako talpa (l)', array('class' => 'h4')) }}
        {{ Form::number('fuel_tank_volume', null) }}
    </div>
    <div class="form-group">
        {{ Form::label('average_fuel_consumption', 'Vidutinis kuro sunaudojimas (l/100 km)', array('class' => 'h4')) }}
        {{ Form::number('average_fuel_consumption', null) }}
    </div>
    {{ Form::submit('Redaguoti!', array('class' => 'btn btn-outline-warning btn-lg')) }}
    {{ Form::close() }}
</div>
@stop
