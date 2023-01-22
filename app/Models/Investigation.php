<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'label', 'reference'];


    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function entries()
    {
        return $this->hasMany(InvestigationEntry::class);
    }

    public function civilians()
    {
        return $this->belongsToMany(Civilian::class);
    }
}
