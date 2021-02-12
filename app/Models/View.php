<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Illuminate\Events\queueable;

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

    protected static function booted()
    {
        static::created(queueable(function ($view) {
            $project = $view->workbook()->get()[0]->project()->get()[0];
            $workbook = $view->workbook()->get()[0];
            Permission::create(['name' => $project->name . '.' . $workbook->name . '.' . $view->name]);
        }));

        static::deleted(queueable(function ($view) {
            $project = $view->workbook()->get()[0]->project()->get()[0];
            $workbook = $view->workbook()->get()[0];
            Permission::where('name', $project->name . '.' . $workbook->name . '.' . $view->name)->delete();
        }));
    }
}
