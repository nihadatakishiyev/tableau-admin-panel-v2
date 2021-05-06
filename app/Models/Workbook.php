<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use function Illuminate\Events\queueable;

/**
 * @property mixed project_id
 * @property mixed name
 */
class Workbook extends Model
{
    use CrudTrait;
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

    protected static function booted()
    {
        static::created(queueable(function ($workbook) {
            Permission::create(['name' => $workbook->project()->get()[0]->name . '.' . $workbook->name]);
        }));

        static::deleted(queueable(function ($workbook) {
            DB::delete ('delete from permissions where SUBSTRING_INDEX(name, \'.\', 2) = \'' . $workbook->project()->get()[0]->name . '.' . $workbook->name . '\'');
        }));
    }
}
