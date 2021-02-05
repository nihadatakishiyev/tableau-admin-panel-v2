<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workbook extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
      'name', 'tableau_id', 'project_id', 'photo_url'
    ];

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function views(){
        return $this->hasMany(View::class);
    }
}
