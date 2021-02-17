<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitPosition extends Model
{
    use HasFactory, CrudTrait;

    protected $fillable = [
        'unit_id', 'position_id'
    ];

    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    public function position(){
        return $this->belongsTo(Position::class);
    }
}
