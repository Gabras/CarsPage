<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'plates',
        'model_id',
        'fuel_tank_volume',
        'average_fuel_consumption',
    ];

    public function vehicleModel()
    {
        return $this->hasOne(VehicleModel::class, 'id', 'model_id');
    }

    public function getDistance()
    {
        return round((($this->fuel_tank_volume / $this->average_fuel_consumption) * 100), 2);
    }
}
