<?php

namespace App\Models;

use App\Models\Civilian\CivilianEntry;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Penalty extends Model
{
    use HasFactory, NodeTrait;

    protected $fillable = ['paragraph', 'label', 'fine', 'imprisonment', 'parent_id', 'additional'];

    public function civilian_entries()
    {
        return $this->belongsToMany(CivilianEntry::class);
    }
}
