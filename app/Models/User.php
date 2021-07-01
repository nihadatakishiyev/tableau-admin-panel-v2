<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\Boolean;
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

    public function pagevisitlogs(){
        return $this->hasMany(PageVisitLog::class);
    }

    public function authLogs(){
        return $this->hasMany(AuthLog::class);
    }

    public function getPermittedHierarchy(){
        $perms = auth()->user()->getPermissionsViaRoles();
        $permitted_projects = []; //names of permitted projects

        foreach ($perms as $perm){
            $proj_name = explode('.', $perm->name)[0];
            if (!in_array($proj_name, $permitted_projects))
                $permitted_projects[]= $proj_name;
        }

        $projs = Project::whereIn('name', $permitted_projects)
            ->with('workbooks', 'workbooks.views')
            ->orderBy('order_number')
            ->get(); //permitted projects with all workbooks and views


        $arr = []; //user has permissions

        foreach ($projs as $i => $proj){
                array_push($arr, $proj);
                foreach ($proj->workbooks as $j=> $workbook){
                    if (!$this->can($proj->name . '.' . $workbook->name) && !MenuGenerationHelper::wbChecker($perms, $workbook->name)){ //check for several workbooks same name
                        unset($arr[$i]->workbooks[$j]);
                    }
                    else {
                        foreach ($workbook->views as $k => $view){
                            if (!$this->can($proj->name . '.' . $workbook->name . '.' . $view->name)){
                                Log::info($proj->name . '.' . $workbook->name . '.' . $view->name);
                                unset($arr[$i]->workbooks[$j]->views[$k]);
                            }
                        }
                    }
                }
        }
        return $arr;
    }


    public function getPermittedViews(){
        $projs = $this->getPermittedHierarchy();
        $view_ids = [];

        foreach ($projs as $proj) {
            foreach ($proj->workbooks as $wb){
                foreach ($wb->views as $view){
                    array_push($view_ids, $view->id);
                }
            }
        }

        return $view_ids;
    }

    public function removeTicket(){
            request()->session()->pull('expire_time');
    }

    public function existsValidTicket(): bool
    {
        if (request()->session()->has('expire_time') && request()->session()->get('expire_time') < now()) {
             $this->removeTicket();
             return false;
        }

        return request()->session()->get('expire_time') > now();
    }

    public function setTicketCookie(){
//        setcookie('expire_time', now()->addMinutes(180), 0);
        request()->session()->put('expire_time', now()->addMinutes(180));
    }
}
