<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use function Illuminate\Events\queueable;

/**
 * @property mixed name
 */
class Project extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
       'name'
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
            DB::delete ('delete from permissions where SUBSTRING_INDEX(name, \'.\', 1) = \'' . $project->name . '\'');
        }));

        static::updated(queueable(function ($project) {
            DB::select('call update_permission(\'' . $project->getOriginal('name') . '\',\'' . $project->name . '\',\'' . '1\')');
        }));
    }
}
