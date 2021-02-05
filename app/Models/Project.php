<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
       'name', 'tableau_id', 'photo_url'
    ];

    public function workbooks(){
        return $this->hasMany(Workbook::class);
    }
}
