<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CivilianVehicle extends Model
{
    use HasFactory;

    protected $table = 'owned_vehicles';

    protected $connection = 'ingame';

    public function owner()
    {
        return $this->belongsTo(Civilian::class, 'owner');
    }

}
