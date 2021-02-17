<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Models\Permission as OriginalPermission;

/**
 * @method static where(string $string, $name)
 */
class Permission extends OriginalPermission
{
    use CrudTrait, LogsActivity;

    protected $fillable = ['name', 'guard_name', 'updated_at', 'created_at'];

    protected static $logAttributes = ['name'];

    protected static $ignoreChangedAttributes = ['updated_at'];

    protected static $logOnlyDirty = true;

    protected static $logName = 'permissions';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "You have {$eventName} permissions";
    }
}
