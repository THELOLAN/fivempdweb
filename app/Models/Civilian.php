<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Civilian extends Model
{
    use HasFactory;

    protected $connection = 'ingame';
    protected $table = 'users';

    protected $primaryKey = 'identifier';

    public $timestamps = false;
    public $incrementing = false;

    public function licenses()
    {
        return $this->hasMany(CivilianLicense::class, 'owner');
    }

    public function entries()
    {
        return $this->hasMany(CivilianEntry::class, 'civilian_id');
    }
}
