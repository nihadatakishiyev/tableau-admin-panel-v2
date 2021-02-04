<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Department extends Model
{
    use HasFactory, CrudTrait, LogsActivity;

    protected $fillable = [
        'name'
    ];

    protected static $logAttributes = ['name'];

    protected static $ignoreChangedAttributes = ['updated_at'];

    protected static $logOnlyDirty = true;

    protected static $logName = 'department';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "You have {$eventName} department";
    }


    public function units(){
        return $this->hasMany(Unit::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
