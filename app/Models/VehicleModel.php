<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'manufacturer_name',
        'model_name'
    ];

    public function vehicle()
    {
        return $this->belongsToMany(Vehicle::class);
    }
}
