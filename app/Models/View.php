<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
       'name', 'workbook_id', 'tableau_url', 'photo_url'
    ];

    public function workbook(){
        return $this->belongsTo(Workbook::class);
    }
}
