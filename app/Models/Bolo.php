<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bolo extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'civilian_id', 'reason', 'status', 'type'];

    public function civilian()
    {
        return $this->belongsTo(Civilian::class, 'civilian_id');
    }
}
