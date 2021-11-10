@extends('base')
@section('content')
<div class="container mt-5">

    <a class="btn btn-outline-success btn-lg" href="{{ URL::to('/') }}"><i class="bi bi-house-door-fill"></i>Pagrindinis</a>

    <h1>Naujas transportas</h1>
    <hr class="divider">

    {{ Form::open(array('url' => '/')) }}
    <div class="form-group">
        {{ Form::label('plates', 'Valstybinis numeris', array('class' => 'h4')) }}
        {{ Form::text('plates', '') }}
    </div>
    <div class="form-group">
        {{ Form::label('manufacturer_name', 'Gamintojas', array('class' => 'h4')) }}
        {{ Form::text('manufacturer_name', '') }}
    </div>
    <div class="form-group">
        {{ Form::label('model_name', 'Modelis', array('class' => 'h4')) }}
        {{ Form::text('model_name', '') }}
    </div>
    <div class="form-group">
        {{ Form::label('fuel_tank_volume', 'Kuro bako talpa (l)', array('class' => 'h4')) }}
        {{ Form::number('fuel_tank_volume', '') }}
    </div>
    <div class="form-group">
        {{ Form::label('average_fuel_consumption', 'Vidutinis kuro sunaudojimas (l/100 km)', array('class' => 'h4')) }}
        {{ Form::number('average_fuel_consumption', '') }}
    </div>
    {{ Form::submit('Sukurti!', array('class' => 'btn btn-outline-primary btn-lg')) }}
    {{ Form::close() }}
</div>
@stop
