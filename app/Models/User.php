<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;
use App\Helpers\MenuGenerationHelper;

class User extends Authenticatable
{
    use HasFactory, Notifiable, CrudTrait, HasRoles, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'department_id',
        'unit_id',
        'position_id',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static $logAttributes = ['name', 'department_id', 'unit_id', 'position_id', 'email'];

    protected static $ignoreChangedAttributes = ['password', 'remember_token', 'updated_at'];

//    protected static $recordEvents = ['created', 'updated', 'deleted'];

    protected static $logOnlyDirty = true;

    protected static $logName = 'user';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "You have {$eventName} user";
    }

    public function position(){
        return $this->belongsTo(Position::class);
    }

    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function getContent(){
        $projs = Project::with('workbooks', 'workbooks.views')->get();
        $perms = $this->getPermissionsViaRoles();
        $arr = [];

        foreach ($projs as $i => $proj){
            if($this->can($proj->name) || MenuGenerationHelper::projChecker($perms, $proj->name)){
                array_push($arr, $proj);
                foreach ($proj->workbooks as $j=> $workbook){
                    if (!$this->can($proj->name . '.' . $workbook->name) && !MenuGenerationHelper::wbChecker($perms, $workbook->name)){
                        unset($arr[$i]->workbooks[$j]);
                    }
                    else {
                        foreach ($workbook->views as $k => $view){
                            if (!$this->can($proj->name . '.' . $workbook->name . '.' . $view->name) && !MenuGenerationHelper::viewChecker($perms, $view->name)){
                                unset($arr[$i]->workbooks[$j]->views[$k]);
                            }
                        }
                    }
                }
            }
        }
        return $arr;
    }
}
