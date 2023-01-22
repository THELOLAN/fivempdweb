<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestigationCivilian extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['civilian_id', 'investigation_id'];
}
