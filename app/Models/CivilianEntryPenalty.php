<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CivilianEntryPenalty extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function civilian_entry()
    {
        return $this->belongsTo(CivilianEntry::class);
    }

    public function penalty()
    {
        return $this->belongsTo(Penalty::class);
    }
}
