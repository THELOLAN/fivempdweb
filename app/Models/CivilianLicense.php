<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CivilianLicense extends Model
{
    use HasFactory;

    protected $connection = 'ingame';
    protected $table = 'user_licenses';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo(Civilian::class, 'owner');
    }
}
