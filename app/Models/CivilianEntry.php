<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CivilianEntry extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $guarded = ['id'];

    public function civilian()
    {
        return $this->belongsTo(Civilian::class, 'civilian_id');
    }

    public function penalties()
    {
        return $this->belongsToMany(Penalty::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
