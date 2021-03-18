<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Illuminate\Events\queueable;

/**
 * @property mixed name
 */
class Project extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
       'name', 'tableau_id', 'photo_url'
    ];

    public function workbooks(){
        return $this->hasMany(Workbook::class);
    }

    protected static function booted()
    {
        static::created(queueable(function ($project) {
            Permission::create(['name' => $project->name]);
        }));

        static::deleted(queueable(function ($project) {
            Permission::where('name', $project->name)->delete();
        }));
    }
}
