<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class VehicleController extends Controller
{
    private string $message = 'Privalote įvesti transporto priemonės';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $vehicles = Vehicle::with('vehicleModel')->get();

        return View::make('vehicles.index')
            ->with('vehicles', $vehicles);
    }

    public function liveSearch(Request $request)
    {
        $searchParam = $request->get('searchParam');

        if ($searchParam != '') {
            $vehicles = Vehicle::whereHas('vehicleModel', function ($relation) use ($searchParam) {
                return $relation
                    ->where('manufacturer_name', 'like', '%' . $searchParam . '%')
                    ->orWhere('model_name', 'like', '%' . $searchParam . '%');
            })
                ->orWhere('plates', 'like', '%' . $searchParam . '%')
                ->get();
        } else {
            $vehicles = Vehicle::with('vehicleModel')->get();
        }

        $returnHTML = View::make('vehicles.table')
            ->with('vehicles', $vehicles)->render();
        return response()->json(array('success' => true, 'html' => $returnHTML));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return View::make('vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'plates' => 'required',
                'manufacturer_name' => 'required',
                'model_name' => 'required',
                'fuel_tank_volume' => 'required|numeric',
                'average_fuel_consumption' => 'required|numeric',
            ],
            [
                'plates.required' => $this->message . ' valstybinius numerius!',
                'manufacturer_name.required' => $this->message . ' gamintoją!',
                'model_name.required' => $this->message . ' modelį!',
                'fuel_tank_volume.required' => $this->message . ' kuro bako talpą!',
                'average_fuel_consumption.required' => $this->message . ' vidutines kuro sanaudos!',
            ]
        );

        if ($validator->fails()) {
            return redirect('vehicles/create')
                ->withErrors($validator)
                ->withInput();
        }

        $data = request()->all();

        $vehicleModel = VehicleModel::firstOrCreate(
            ['manufacturer_name' => $data['manufacturer_name'], 'model_name' => $data['model_name']],
        );

        Vehicle::create(
            [
                'plates' => $data['plates'],
                'model_id' => $vehicleModel->id,
                'fuel_tank_volume' => $data['fuel_tank_volume'],
                'average_fuel_consumption' => $data['average_fuel_consumption']
            ]
        );

        return Redirect::to('/')->with('success', 'Transporto priemonė ' . $data['plates'] . '  pridėta.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $vehicle = Vehicle::with('vehicleModel')->find($id);

        return View::make('vehicles.edit')
            ->with('vehicle', $vehicle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'plates' => 'required',
                'vehicleModel' => [
                    'manufacturer_name' => 'required',
                    'model_name' => 'required'
                ],
                'fuel_tank_volume' => 'required|numeric',
                'average_fuel_consumption' => 'required|numeric',
            ]
            ,
            [
                'plates.required' => $this->message . ' valstybinius numerius!',
                'vehicleModel' => [
                    'manufacturer_name.required' => $this->message . ' gamintoją!',
                    'model_name.required' => $this->message . ' modelį!',
                ],
                'fuel_tank_volume.required' => $this->message . ' kuro bako talpą!',
                'average_fuel_consumption.required' => $this->message . ' vidutines kuro sanaudos!',
            ]
        );

        if ($validator->fails()) {
            return redirect('vehicles/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $data = request()->all();

        $vehicleModel = VehicleModel::firstOrCreate(
            ['manufacturer_name' => $data['vehicleModel']['manufacturer_name'], 'model_name' => $data['vehicleModel']['model_name']],
        );

        Vehicle::find($id)
            ->update(
            [
                'plates' => $data['plates'],
                'model_id' => $vehicleModel->id,
                'fuel_tank_volume' => $data['fuel_tank_volume'],
                'average_fuel_consumption' => $data['average_fuel_consumption']
            ]
        );

        return Redirect::to('/')->with('success', 'Transporto priemonė ' . $data['plates'] . ' atnaujinta.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);
        $vehiclesWithSameModels = Vehicle::where('model_id', '=', $vehicle->model_id)->count();

        $vehicle->delete();

        if ($vehiclesWithSameModels <= 1) {
            $model = VehicleModel::find($vehicle->model_id);
            $model->delete();
        }

        return Redirect::to('/')->with('success', 'Transporto priemonė ' . $vehicle['plates'] . ' pašalinta.');
    }
}
