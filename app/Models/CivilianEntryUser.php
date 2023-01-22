<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CivilianEntryUser extends Model
{
    use HasFactory;


    public function civilian_entry()
    {
        return $this->belongsTo(CivilianEntry::class);
    }
}
