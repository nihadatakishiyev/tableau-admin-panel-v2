<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory, CrudTrait;

    protected $fillable = [
        'name'
    ];


    public function units(){
        return $this->hasMany(Unit::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
