<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $vehicles = Vehicle::with('vehicleModel')->get();

        return View::make('vehicles.index')
            ->with('vehicles', $vehicles);    }

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plates' => 'required',
            'manufacturer_name' => 'required',
            'model_name' => 'required',
            'fuel_tank_volume' => 'required|numeric',
            'average_fuel_consumption' => 'required|numeric',
        ]);

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
                'fuel_tank_volume'=> $data['fuel_tank_volume'],
                'average_fuel_consumption' => $data['average_fuel_consumption']
            ]
        );

        return Redirect::to('/')->with('success','Vehicle created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
