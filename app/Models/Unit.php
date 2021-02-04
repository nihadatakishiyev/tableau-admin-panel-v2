<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Unit extends Model
{
    use HasFactory, CrudTrait, LogsActivity;

    protected $fillable = [
        'name', 'department_id'
    ];

    protected static $logAttributes = ['name', 'department_id'];

    protected static $ignoreChangedAttributes = ['updated_at'];

    protected static $logOnlyDirty = true;

    protected static $logName = 'unit';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "You have {$eventName} unit";
    }

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
