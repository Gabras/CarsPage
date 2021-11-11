@foreach($vehicles as $key => $value)
    <tr>
        <td>{{ $value->id }}</td>
        <td>{{ $value->plates }}</td>
        <td>{{ $value->vehicleModel->manufacturer_name }} {{ $value->vehicleModel->model_name }}</td>
        <td>{{ $value->fuel_tank_volume }}</td>
        <td>{{ $value->average_fuel_consumption }}</td>
        <td>{{ $value->getDistance() }} km</td>
        <td>
            {{ Form::open(array('url' => 'vehicles/' . $value->id . '/delete')) }}
            {{ Form::hidden('_method', 'DELETE') }}
            {{ Form::button('<i class="bi bi-trash-fill"></i>', array('class' => 'btn btn-outline-danger btn-lg', 'type' => 'submit')) }}
            {{ Form::close() }}
            <a class="btn btn-outline-warning btn-lg" href="{{ URL::to('vehicles/' . $value->id . '/edit') }}"><i class="bi bi-pencil-fill"></i></a>
        </td>
    </tr>
@endforeach
