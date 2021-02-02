<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory, CrudTrait;

    protected $fillable = [
        'name', 'department_id'
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function positions(){
        return $this->belongsToMany(Position::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
