<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory, CrudTrait;

    protected $fillable = [
        'name'
    ];

    public function units(){
        return $this->belongsToMany(Unit::class, 'unit_positions', 'position_id', 'unit_id');
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
