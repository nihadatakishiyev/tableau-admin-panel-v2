<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Models\Role as OriginalRole;

class Role extends OriginalRole
{
    use CrudTrait, LogsActivity;

    protected $fillable = ['name', 'guard_name', 'updated_at', 'created_at'];

    protected static $logAttributes = ['name'];

    protected static $ignoreChangedAttributes = ['updated_at'];

    protected static $logOnlyDirty = true;

    protected static $logName = 'role';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "You have {$eventName} role";
    }
}
